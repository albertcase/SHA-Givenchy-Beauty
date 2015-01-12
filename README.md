# Givenchy Beauty Project

---

[http://www.givenchybeauty.cn/](http://www.givenchybeauty.cn/)

[http://dahlianoir.dangdaimingshi.com](http://dahlianoir.dangdaimingshi.com)



## Wiki

---

<https://bitbucket.org/samecode/sha-givenchy-beauty/wiki/Home>



## Development Environment Setup

---

#### Check software version

* **Vagrant** >= 1.6.2
* **Virtualbox** >= 4.3.12

You can these software from our tech team server smb://TechTeam/tools

	How to check current version
	// vagrant, execute below command in your terminal
	vagrant -v
	// virtualbox, by run Virtualbox --> Help --> About


#### Prepare Vagrant box

Get Vagrant box from smb://TechTeam/vagrant-boxes, ``ubuntu12.04-givenchy-beauty.box``

Then, add the box by execute below command in your terminal

	vagrant box add ubuntu12.04-givenchy-beauty ubuntu12.04-givenchy-beauty.box
	
	// ensure the new Vagrant box existing, you should find it in list
	vagrant box list
	

#### DB and Files

Download DB and Files package from our tech team server,  smb://TechTeam/projects/givenchy-beauty
 
		db: givenchyconversations20150112.sql.bz2
		files: resource.tar.gz

Please put them to project root directory after you checked out project.


#### Checkout project

```
git clone -b develop --recursive --recurse-submodules git@bitbucket.org:samecode/sha-givenchy-beauty.git
```

#### Vagrant Up

1. Go to project directory
2. Execute commands from your terminal  
	
		vagrant up && vagrant provision
	
		
#### Setup

Log into the Virtualbox instance first, then execute following steps in below.

		vagrant ssh
		// you will see your terminal become as "vagrant@Givenchybeauty:~$" after logged
		
		// import db
		cd /vagrant
		mysqladmin -uroot create givenchyconversations
		bunzip -c ddms-file-latest.tar.gz | mysql -uroot -v martell

		//  extract files
		cd /vagrant
		rm -rf files
		mv /vagrant/resource.tar.gz .
		tar xvf resource.tar.gz
		
		// clean cache
		cd /vagrant


Finally, you can visit from browsers by ``http://127.0.0.1:8001``
