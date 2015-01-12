// JavaScript Document
var Gform={
	/*emailID:".userEmail",
	phoneID:".userPhone",
	passwordID:".userPassword",
	*/
	/*example: Gform.GFormTest(ID,Type.message)*/
	//ID is your jquery element, Type: email/phone/password/name ,message is your action words
	
	//form-elements-flag
	GFlag:new Object(),
	
	//flagConstruct
	GFlagConstruct:function(formID){
			jQuery(formID).find(".Gsubmit").attr("disabled","disabled");
			var gflags=jQuery(formID+" input[gtype]");
			for(var i=0;i<gflags.length;i++){
				var flagName='flag'+gflags.eq(i).attr("gtype");
				this.GFlag[flagName]=0;
			}
			//return this.Gflag;
		},
	
	//main druge
	GFormTest:function(ID,Type,message){
		var GMatch="";
		if(Type!="confirmPassword"){
			switch(Type){
				case 'name':GMatch=/^[a-zA-Z\d_.@]{6,20}$/;break;//if chinese /^[\u4e00-\u9fa5]{1,10}$/	if english 	/[a-zA-z]{4,20}$/
				case 'email':GMatch=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;break;
				case 'phone':GMatch=/^1[3|4|5|8][0-9]\d{4,8}$/;break;
				case 'password':GMatch=/^(\w){6,20}$/;break;
				
				}
			if(!GMatch.test(jQuery(ID).val())){
				//alert(0);
				//jQuery(".Gsubmit").attr("disabled","disabled");
				var flagName='flag'+Type;
				this.GFlag[flagName]=0;    //为验证单项控制
				
				this.shake(jQuery(ID),"red",3);
				jQuery("#"+Type+"02").remove();
				jQuery(ID).after('<span class="wrong-attension" id="'+Type+'02">'+message+'</span>');
				}
			else{
				var flagName='flag'+Type;
				this.GFlag[flagName]=1;	//单向通过
				jQuery("#"+Type+"02").remove();
				//jQuery(".Gsubmit").removeAttr("disabled");
				//alert(1);
				}
			}
		else{
				if(jQuery('#password_f').val()!=jQuery(ID).val())
				{
					//jQuery(".Gsubmit").attr("disabled","disabled");
					var flagName='flag'+Type;
					this.GFlag[flagName]=0;    //为验证单项控制
					this.shake(jQuery(ID),"red",3);
					jQuery("#"+Type+"02").remove();
					jQuery(ID).after('<span class="wrong-attension" id="'+Type+'02">'+message+'</span>');	
				}
				else{
					var flagName='flag'+Type;
					this.GFlag[flagName]=1;	//单向通过
					jQuery("#"+Type+"02").remove();
					//jQuery(".Gsubmit").removeAttr("disabled");
				}
			}
		},
	
	
	emailTest:function(){
		 if(!/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test(jQuery(this.emailID).val())) {
					 alert(0);
						emailFlag=0;
					}
				else{
					alert(1);
					emailFlag=1;
					}
				
		
		},
	phoneTest:function(){
		if(!/^1[3|4|5|8][0-9]\d{4,8}$/.test(jQuery(this.phoneID).val())) {
					 	alert(0);
					 	jQuery(".submit").attr("disabled","disabled");
						this.shake(jQuery(this.phoneID),"red",3);
						phoneFlag=0;
					}
				else{
					alert(1);
					phoneFlag=1;					
					};
		
		
		
		},
	passwordTest:function(){	
	
	/* /^(\w){6,20}$/ */
	/* /^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,22}$/ */
		if(!/^(\w){6,20}$/.test(jQuery(this.passwordID).val())) {
					 	alert(0);
					 	jQuery(".submit").attr("disabled","disabled");
						this.shake(jQuery(this.passwordID),"red",3);
						passwordFlag=0;
					}
				else{
					alert(1);
					passwordFlag=1;
					};
		
		
		},
		
		
	//效果
	
	shake:function(ele,cls,times){
			var i = 0,t= false ,o =ele.attr("class")+" ",c ="",times=times||2;
			if(t) return;
			t= setInterval(function(){
				i++;
				c = i%2 ? o+cls : o;
				ele.attr("class",c);
				if(i==2*times){
					clearInterval(t);
					ele.removeClass(cls);
					}
				},200);
			},
			
			
	GFlagTest:function(formID){
			for(var i in this.GFlag){
				if(this.GFlag[i]==0){
					//alert(1);
					jQuery(formID).find(".Gsubmit").attr("disabled","disabled");
					break;				
				}
				//console.log(i);
				jQuery(formID).find(".Gsubmit").removeAttr("disabled");
			}
		},		
			
		
	//弹框外部调用			
	popDiv:function(message){
			jQuery(".hidden-success .p-wrong").html(message);
			jQuery(".hidden-success").fadeIn("slow");
			
			jQuery(".hidden-success button").click(function(){
					jQuery(".hidden-success").fadeOut("slow");
				});
			
		},
	
		
		
	init:function(formID){
				jQuery("document").ready(function(){
					Gform.GFlagConstruct(formID);  //构造初始化
					
					jQuery(".fill-box input[type!=submit]").blur(function(){
						var Gtype=jQuery(this).attr("Gtype");
						var GID=jQuery(this).attr("id");
						var GMessage=jQuery(this).attr("Gmessage")
						Gform.GFormTest("#"+GID,Gtype,GMessage);
						Gform.GFlagTest(formID);
					})
				});
		
		
		}
	
		
	};