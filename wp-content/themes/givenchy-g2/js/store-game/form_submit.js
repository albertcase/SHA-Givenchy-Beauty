jQuery(document).ready(function(){
		var emailFlag=phoneFlag=textBoxFlag=nameFlag=counterFlag=0;
		var id=-1;
		var shopMessage;
		var cp={
			"110000":['上海'],
			"120000":['杭州'],
			"130000":['南宁'],
			"140000":['宁波','无锡','苏州','南京'],
			"150000":['长沙'],
			"210000":['南昌'],
			"220000":['昆明'],
			"230000":['贵阳'],
			"310000":['厦门','福州'],
			"320000":['宜昌','武汉'],
			"330000":['广州','深圳'],
			"340000":['合肥'],
			"360000":['北京'],
			"370000":['鞍山','沈阳','大连'],
			"410000":['哈尔滨'],
			"380000":['重庆'],
			"420000":['成都'],
			"430000":['石家庄'],
			"440000":['天津'],
			"450000":['郑州','洛阳'],
			"460000":['青岛','济南','烟台',],
			"500000":['乌鲁木齐'],
			"510000":['长春'],
			"520000":['兰州'],
			"530000":['鄂尔多斯','呼和浩特'],
			"610000":['西安'],
			"620000":['太原']
			}
		var Gprovince,Gcity;
		jQuery("#province").change(function(){
				counterFlag=0;
				jQuery("#city").find("option").remove();
				jQuery("#counter").find("option").remove();

				jQuery("#counter").append('<option value="">请选择领取柜台</option>');
				jQuery("#city").append('<option value="">请选择</option>');
				Gprovince=jQuery("#province").val();
				//console.log(Gprovince);
				for(var i in cp){
					//console.log(i,cp[i]);
					if(i==Gprovince){
							//console.log(cp[i]);
							for(var j=0;j<cp[i].length;j++){
								jQuery("#city").append('<option value="'+cp[i][j]+'">'+cp[i][j]+'</option>');
							}
						}
						
					}
			});
		jQuery("#city").change(function(){
				counterFlag=0;
				jQuery("#counter").find("option").remove();
				jQuery("#counter").append('<option value="0">请选择领取柜台</option>');
				Gcity=jQuery("#city").val();
				//console.log(Gcity);
				jQuery.post("wp-admin/admin-ajax.php",{
				                action:"fgame_ctl_user",
										fgame_action:"getshop",
										ctl:"stock",
										city:Gcity},function(data){
				                            //console.log(data);
											//showMessage=data;
                                            var dataObj=eval("("+data+")");
											//console.log(dataObj);
											//console.log(data);
                                            jQuery.each(dataObj,function(i,ite){
												if(parseInt(ite.stocknum)<5){
                                                jQuery("#counter").append('<option value="'+ite.id+'" class="outOfStocknum">'+ite.address+'</option>');
												}
												else{
											    jQuery("#counter").append('<option value="'+ite.id+'">'+ite.address+'</option>');
													}
                                            })
                                            
										}
                            );
				
			});
		jQuery("#counter").change(function(){
			id=jQuery("#counter").val();
			outOfArray=[];
			inOfArray=[];
			jQuery("#counter .outOfStocknum").each(function(){
				outOfArray.push(jQuery(this).val());
				});
			jQuery("#counter option").each(function(){
				if(!jQuery(this).hasClass("outOfStocknum")){
					inOfArray.push(jQuery(this).val());
					}
				});
			/*for(var i=0;i<jQuery("#counter .outOfStocknum").length;i++){
				if(id==jQuery("#counter .outOfStocknum").eq(i).attr("value")){
				counterFlag=0;
				jQuery("#outOfStocknumAttention").fadeIn("slow");
				}
			}
			if(flag){
				counterFlag=1;
				jQuery("#outOfStocknumAttention").fadeOut("slow");
				}
			*/
			//console.log(outOfArray,inOfArray);
			for(var i=0;i<outOfArray.length;i++){
				if(id==outOfArray[i]){
					counterFlag=0;
					jQuery("#outOfStocknumAttention").fadeIn("slow");
					}
				}
			for(var i=0;i<inOfArray.length;i++){
				if(id==inOfArray[i]){
					jQuery("#outOfStocknumAttention").fadeOut("slow");
					if(id!=0){
						counterFlag=1;
					}
					else{
						counterFlag=0;
						}
					}
				}
		});
		
		var textBoxChecked,inputName,inputEmail,inputPhone;
		
		jQuery(".form-html").mouseover(function(){
				
		 textBoxChecked=jQuery(".check-box").attr("checked");
		if(textBoxChecked=="checked"){
			textBoxFlag=1;
			}
		 inputName=jQuery(".input-name").val();
		 nameFlag=inputName?1:0;
		 inputEmail=jQuery(".input-email").val();
		 inputPhone=jQuery(".input-phone").val();
		
		if(emailFlag&&phoneFlag&&nameFlag&&counterFlag){
			jQuery(".submit").removeAttr("disabled");
			}
		else{
			jQuery(".submit").attr("disabled","disabled");
			}
		
		//console.log(emailFlag,phoneFlag,textBoxFlag,nameFlag);
		
		}
		
		
)
	jQuery(".submit").click(function(){
		if(id<0){
			id=jQuery(".counter").val();
			}
		jQuery.post("wp-admin/admin-ajax.php",{
						action:"fgame_ctl_user",
						ctl:"user",
						fgame_action:"add_fgame_user",
						shopId:id,
						inputName:inputName,
						inputEmail:inputEmail,
						inputPhone:inputPhone,
						textBoxFlag:textBoxFlag
		},function(data){
		  var dataObj=eval("("+data+")");
		  //console.log(dataObj.success);
          if(dataObj.success=="true"){
			jQuery.unblockUI;
			jQuery.blockUI({
						 message: jQuery('#success'),
							 css:{width: "576px"}
			 });
			jQuery("#success button").click(function(){
				weiboShare();
				setTimeout(function(){
					location.href=location.protocol+location.host+"/2012/07/25/焕颜美肌精华液/";
					},1000);
				return false;
				});
			/*setTimeout(function(){
				weiboShare();
				jQuery.unblockUI;
			},2000);
			setTimeout(function(){
				location.href=location.protocol+location.host+"/2012/07/25/焕颜美肌精华液/";
			},4000);
			*/
			
			}
			else{
			 	
				jQuery("#wrong p").html(dataObj.error_message);
				//jQuery.unBlockUI;
				jQuery.blockUI({
					message:jQuery('#wrong'),
					css:{width: "576px"}				
				});
				jQuery("#wrong button").click(function(){
					jQuery.blockUI({
						message:jQuery("#loginForm"),
						css:{width:"",
							top:"20%"}
						});
					});
				//setInterval(jQuery.unblockUI,2000);
                
				}
			});
		
		});
		
		 
	function shake(ele,cls,times){
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
			};
			
			
	
		//通不过mail校验闪动
		jQuery("#mail").blur(
			function(){
				 if(!/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test(jQuery(this).val())) {
					 	//alert(1);
					 	jQuery(".submit").attr("disabled","disabled");
						shake(jQuery(this),"red",3);
						emailFlag=0;
					}
				else{emailFlag=1}
				}
			);
		jQuery("#phone").blur(
			function(){
				 if(!/^1[3|4|5|8][0-9]\d{4,8}$/.test(jQuery(this).val())) {
					 	//alert(1);
					 	jQuery(".submit").attr("disabled","disabled");
						shake(jQuery(this),"red",3);
						phoneFlag=0;
					}
				else{phoneFlag=1};
				}
			);	
		
			
	function weiboShare(){
	
		share_window="http://service.weibo.com/share/share.php?";
		param.pic=share_pic_url;
		param.title=share_words;
		
		//alert(param.title);
		temp = [];
	  	for( var p in param ){
			temp.push(p + '=' + encodeURIComponent( param[p] || '' ) )
	 	 }  
		
		share_window+=temp.join('&');
		//console.log(share_window);
		//$("#share-iframe").attr("src",share_window);
		
		//alert(share_window);
		window.open(share_window,"_blank","width=615,height=505");
	
}		

			
	});