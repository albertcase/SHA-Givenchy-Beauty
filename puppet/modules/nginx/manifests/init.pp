class nginx {
  package {
    'nginx-full':
      ensure => present,
      require => Exec['apt-update']
  }

  service {
    'nginx':
      enable  => true,
      ensure  => running,
      require => Package['nginx-full']
  }

  exec {
    'backup-nginx-conf':
      command => 'cp -r /etc/nginx /etc/nginx.bak',
      creates => '/etc/nginx.bak/nginx.conf',
      require => Package['nginx-full'];
    'enable-site-www-conf':
      command => 'rm -rf * && ln -s ../sites-available/givenchybeauty.conf',
      creates => '/etc/nginx/sites-enabled/givenchybeauty.conf',
      cwd     => '/etc/nginx/sites-enabled',
      user    => 'root',
      require => File['/etc/nginx/sites-available/givenchybeauty.conf'];
  }

  file {
    '/etc/nginx/sites-available/givenchybeauty.conf':
      force        => true,
      recurse      => true,
      source       => 'puppet:///modules/nginx/givenchybeauty.conf',
      sourceselect => all,
      owner        => 'root',
      group        => 'root',
      require      => Package['nginx-full'],
      notify       => Exec['enable-site-www-conf']
  }

}


