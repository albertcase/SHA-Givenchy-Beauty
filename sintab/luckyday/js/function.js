/* FCT GG */
function track(TableTrack,type,mhref){
			if(type=="A" || type=="") mt = 'actions';
			if(type=="N") mt = 'navigation';
			if(type=="S") mt = 'exit';
			vide = pageTracker._trackEvent(mt,TableTrack);
			if(mhref) {
				try {
				setTimeout('document.location = "' + mhref + '"', 1000);
				}catch(err){}
				return false;
			}else{
			return void(0);
			}

}


/* GRAND CARRE */

function roll_on(id){
	$('#fiche_roll_'+id).slideUp();
	//$('#case'+id+' .rollbg').css('background-color','#f7fcfc');
	//$('#case'+id+' .rollbg2').css('color','#82abad');
}

function close_all_roll(mois){
	i=1;
	while($('#case'+i).size()>0){
		fade_off(i,mois);
		i++;
	}
}

function roll_off(id){
	//$('#case'+id+' .rollbg').css('background-color','transparent');
	//$('#case'+id+' .rollbg2').css('color','#000');
	$('#case'+id+' #fiche_roll_'+id).slideDown();
}

function fade_on(id,mois){
	close_all_roll(mois);
	//alert('#ct_month_'+mois+' #case'+id+' .fiche3');
	$('#ct_month_'+mois+' #case'+id+' .fiche3').show();
}

function fade_off(id,mois){
	$('#ct_month_'+mois+' #case'+id+' .fiche3').hide();
}

/* PETIT CARRE */

    function showHide(id,etat,month){
        if (etat=="on") {
            $('#ct_month_'+month+' #case'+id+" .wording").stop().slideUp(); 
			$('#ct_month_'+month+' #case'+id+" .wording").slideDown("slow");
        } else {
			$('#ct_month_'+month+' #case'+id+" .wording").stop().slideDown(); 
            $('#ct_month_'+month+' #case'+id+" .wording").slideUp("slow");
			
        }
    }
 
 currentid=0;
 
 function slideto(id){
	 if(id>-1 && id<13){
		 vitesse= Math.abs(currentid-id)*250+1500;
		if(id==0){
			$("#wrapper_calendrier").animate({"left": "0px"}, vitesse, "easeInOutQuint");
			footer("off",vitesse);
		 }else{
			pos = id*990;
			footer("on",vitesse);
			$("#wrapper_calendrier").animate({"left": "-"+pos+"px"}, vitesse, "easeInOutQuint");
			
		 }
		 currentid=id;
	 }
	 retiresouligne();
	 $('.m'+id).css("text-decoration","underline");
 }
 
 function retiresouligne(){
	 i=1;
	 while(i<13){
	 $('.m'+i).css("text-decoration","none");
	 i++;
	 }
 }
 
 function footer(etat,vitesse){
	if(etat=="off"){
		$("#calendrier").animate({"height":"708px"}, vitesse,"easeInOutQuint");
		$("#visu_footer").slideUp("slow");
	}else{
		$("#calendrier").animate({"height":"1594px"}, vitesse,"easeInOutQuint");
		$("#visu_footer").slideDown("slow");
	}
 }
 
function callBoxFancy(my_href) {
	if(my_href!=""){
		$(document).ready(function(){
			var j1 = document.getElementById("clickerhide");
			j1.href = my_href;
			$("#clickerhide").fancybox(
			   {'width' : 644,
			   'height' : 739,
			   'autoScale' : false,
			   'transitionIn' : 'none',
			   'transitionOut' : 'none',
			   'type' : 'iframe',
			   'overlayOpacity' : 0.85, 
			   'overlayColor' : '#fff', 
			   'showCloseButton' : false,
			   'centerOnScroll' :true,
			   'margin': '0',
			   'padding' : '0',
			   'resizeOnWindowResize' : true,
			   'hideOnOverlayClick' : false,
			   'scrolling': 'no'
			   }
			).trigger('click');
		});
	}
}

function closePopup(){
	alert("eewwee");
	$.fancybox.close();
}

var reshow 		= 	false;
var varrules 	= 	false;

function showRules(){
hideSelect();
$('#rulesPanel').show(0);
reshow = $('.button').is(":visible");
if(reshow) $('.button').hide(0);
$('#rules').tinyscrollbar();
varrules=true;
return void(0);
}


function closeRules(){
showSelect();
$('#rulesPanel').hide('fast');
varrules=false;
if(reshow)$('.button').show(0);
}

function showCGU(){
hideSelect();
$('#cguPanel').show(0);
reshow = $('.button').is(":visible");
if(reshow) $('.button').hide(0);
$('#rules2').tinyscrollbar();
varrules=true;
return void(0);
}


function closeCGU(){
showSelect();
$('#cguPanel').hide('fast');
varrules=false;
if(reshow)$('.button').show(0);
}

function validStep2(default_descr,default_name) {
	/*alert(
	"\n librairie : "+
	$("#imglibrairie").val()+
	"\n upload : "+
	$("#upload_image").val()+
	"\n deja upload : "+
	$("#deja_uploade").val()+
	"\n month : "+
	$("#lucky_month").val()+
	"\n day : "+
	$("#lucky_day").val()+
	"\n description : "+
	$("#lucky_description").val()+
	"\n color : "+
	$("#lucky_color").val()+
	"\n name: "+
	$("#lucky_name").val()+
	"\n country: "+
	$("#lucky_country").val()
	);*/
	if(
		($("#imglibrairie").val()!="" || ($("#upload_image").val()!="" && $("#upload_image").val()!="ipad") || $("#deja_uploade").val()!="" ) 
		&& $("#lucky_month").val()!="" 
		&& $("#lucky_day").val()!="" 
		&& $("#lucky_description").val()!=""
		&& $("#lucky_description").val()!=default_descr 
		&& $("#lucky_name").val()!="" 
		&& $("#lucky_name").val()!=default_name 
		&& $("#lucky_country").val()!="" 
		&& $("#lucky_color").val()!=""
	){
		$("#moverlay").show(0);
		$("#carrou1_position").val($("#foo2").triggerHandler("currentPage"));
		//alert($("#foo2").triggerHandler("currentPage"));
		$("#carrou2_position").val($("#foo3").triggerHandler("currentPage"));
		//alert($("#foo3").triggerHandler("currentPage"));
		hideSelect();
		return true;
	}else{
		$("#msgerr").show(0);
		return false;
	}

}

var selectcarrou=0;
var selectimage=0;
function carrouSelector(etat,carrou,id,legende,langue){
	if(selectcarrou!=carrou || selectimage!=id){
		if(etat=="on"){
		$('#galerie'+carrou+'_selector'+id).show(0);
		}else{
		$('#galerie'+carrou+'_selector'+id).hide(0);
		}
	}
	
	if(id>0 && carrou>0 && etat=="on"){
		if(carrou>1) tmpn="2"; else tmpn="";
		$("#imageroll").attr("src","../images/common/transp.gif");
		$("#imageroll").attr("src","../images/configurateur/librairie/"+langue+"/galerie"+tmpn+"_big_"+id+".jpg");
		if(langue=="fr" || langue=="en") { $("#rolloverbig .mlegende").html(legende);}
		hideSelect();
		$("#rolloverbig").show(0);
	}else{
		showSelect();
		$("#rolloverbig").hide(0);
	}
	
}

function chooseImage(carrou,id){
	disableAllSelector(1);
	disableAllSelector(2);
	$('#galerie'+carrou+'_selector'+id).addClass('selected');
	$('#galerie'+carrou+'_selector'+id).show(0);
	selectcarrou=carrou;
	if(selectcarrou==1) gal="";
	else gal=selectcarrou;
	selectimage=id;
	$("#imglibrairie").val("galerie"+gal+"_pf_"+selectimage+".jpg");
	$("#initialise_picto_selection").val(carrou+","+id);
	$("#upload_image").val("");
	$("#deja_uploade").val("");
	$('#cocheupload').attr('src','../images/configurateur/coche_off.gif');
}

function disableAllSelector(carrou) {
	$(".crt .selector_roll").removeClass('selected');
	$(".crt .selector_roll").hide(0);
}
var currentcolor="";
function changeColor(id,color){
	currentcolor=color;
	$("#nuancier .nuancier .checked").css("display","none");
	$("#nuancier_"+id+" .checked").css("display","block");
	$("#lucky_color").val(currentcolor);
}

function initializeCrop(idcrop,img,iwidth,iheight,mcolor){
	mcolor="#000";
	$(document).ready(function(){
	  
	  if(idcrop==1){
	  //CROP 1
	  var cropzoom = $('#crop_container').cropzoom({
            width:284,
            height:426,
            bgColor: mcolor,
            enableRotation:false,
            enableZoom:true,
            zoomSteps:10,
            rotationSteps:10,
            expose:{
                slidersOrientation: 'horizontal',
                zoomElement: '.zoom'
            },
            selector:{        
              centered:true,
              borderColor:'transparent',
              borderColorHover:'transparent',
              startWithOverlay: false,
              hideOverlayOnDragAndResize: true,
			  showDimetionsOnDrag:false,
			  showPositionsOnDrag:false,
			  maxHeight:426,
			  maxWidth:284
            },
            image:{
                source:img,
                width:iwidth,
                height:iheight,
                minZoom:10,
                maxZoom:200,
                startZoom:100,
                useStartZoomAsMinZoom:false
            }
        });
		cropzoom.setSelector(0,0,284,426,false);
        $('#crop').click(function(){ 
            cropzoom.send('cropzoom/resize_and_crop.php','POST',{},function(rta){
				$(".crop1").hide(0);
				$(".crop2").show(0);
				//alert(rta);
				$('#imgbig').val(rta);
				$('#crop2').show(0);
				initializeCrop(2,rta,284,426);
				
            });
        });
	  }
	  if(idcrop==2){
	  //CROP 2
	  var cropzoom2 = $('#crop_container2').cropzoom({
            width:284,
            height:426,
            bgColor: mcolor,
            enableRotation:false,
            enableZoom:true,
            zoomSteps:10,
            rotationSteps:10,
            expose:{
                slidersOrientation: 'horizontal',
                zoomElement: '.zoom2'
            },
            selector:{        
              centered:false,
              borderColor:"#000",
              borderColorHover:"#000",
              startWithOverlay: true,
              hideOverlayOnDragAndResize: true,
			  showDimetionsOnDrag:false,
			  showPositionsOnDrag:false,
			  maxHeight:146,
			  maxWidth:250,
			  x:15,
			  y:15,
			  w:250,
			  h:146
            },
            image:{
                source:img,
                width:iwidth,
                height:iheight,
                minZoom:100,
                maxZoom:200,
                startZoom:100,
                useStartZoomAsMinZoom:true
            }
        });
		cropzoom2.setSelector(15,15,250,146,false);
        $('#crop2').click(function(){ 
            cropzoom2.send('cropzoom/resize_and_crop.php?mini=true','POST',{},function(rta){
                /*$('#result_image').find('img').remove();
                var img = $('<img />').attr('src',rta);
                $('#result_image').append(img);*/
				$('#imgcover').val(rta);
				$('#imgminicover').val(rta.replace("tmp_", "tmp_mini_"));
				$('#formimgperso').submit();
            });
			
        });
		}
	});
}
var jours_mois = new Array();
jours_mois[1] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
jours_mois[2] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29);
jours_mois[3] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
jours_mois[4] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
jours_mois[5] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
jours_mois[6] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
jours_mois[7] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
jours_mois[8] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
jours_mois[9] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
jours_mois[10] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
jours_mois[11] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
jours_mois[12] = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);

function getDays(mois,txtDay,choixCourant){ 

	t="<select name=\"lucky_day\" id=\"lucky_day\" style=\"width:93px;\">\n<option value=''>"+txtDay+"</option>";
	if(mois>0){

		for(i=0;i<jours_mois[mois].length;i++)
		{
		t+="<option value=\""+jours_mois[mois][i]+"\"";
		if(jours_mois[mois][i]==choixCourant) t+="selected";
		t+=">"+jours_mois[mois][i]+"</option>";
		}
	}
	t+="</select>";
	$("#boxday").html(t);
	/*$("#lucky_day").selectbox();
	$("#lucky_month").selectbox("close");
	if(mois<1) $("#lucky_day").selectbox("disable");*/
	
}

function validForms() {
	closeerr();
	err=0;
	if(!$('#firstname').val()) {err=1;$('.labelerr1').addClass('txtErr');$('#err1').show(0);}
	if(!$('#lastname').val() && err==0) {err=1;$('.labelerr2').addClass('txtErr');$('#err2').show(0);}
	if(!$('#email').val() && err==0) {err=1;$('.labelerr3').addClass('txtErr');$('#err3').show(0);}
	if(!validEmail($("#email").val()) &err==0) {err=1; $('.labelerr4').addClass('txtErr');$('#err4').show(0);}
	if($('#email').val() && err==0 ) 	{
		var testmx = ""+emailMX($("#email").val());
		if(testmx=="KO") {err=1; $('.labelerr4').addClass('txtErr');$('#err4').show(0);}
	}	
	if(!$('#country').val() && err==0) {err=1;$('.labelerr5').addClass('txtErr');$('#err5').show(0);}
	if(!$("#optin_legals").is(":checked") && err==0) {err=1;$('.labelerr6').addClass('txtErr');$('#err6').show(0);}
	
	if(err==0){
		return true;
	}else{
		return false;
	}
}

function validEmail(mailteste) { 
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
	return(reg.test(mailteste));
}

function emailMX(email) {
	$.ajaxSetup({async:false});
	var retour = "KO";
	$.post('ajax/mxrecord.php', { e: email }, function(data) {
	  retour = data;
	});
	return retour;
}

function closeerr(){
	i=1;
	while(i<7){
	$('.labelerr'+i).removeClass('txtErr');
	$('#err'+i).hide(0);
	i++;
}
}

function mshare2(reso){
	var id_array=current_item;
	if(reso=="ggplus" || reso=="weibo"){
		mshare(reso,car_img_social_gg[id_array],car_directory[id_array],car_langue[id_array],car_description[id_array],true)
	}else{
		mshare(reso,car_img_social[id_array],car_directory[id_array],car_langue[id_array],car_description[id_array],true)
	}
}


function mshare(reso,img,directory,lg,description,urlun){
	var laDate = Date.parse(new Date());
	var urlunique="";
	if(urlun==true) {urlunique=url_base+"?media="+img;}

	if(reso=="fb"){
		authorizeAppInPopup(url_base+directory+img,urlunique);
	}
	
	if(reso=="pintrest"){
		var ur1= encodeURIComponent(url_base+"?media="+img);
		var ur2= encodeURIComponent(url_base+directory+img);
		var ur3= encodeURIComponent(message_base);
		window.open("http://pinterest.com/pin/create/button/?url="+ur1+"&media="+ur2+"&description="+ur3);
	}
	
	if(reso=="twitter"){
		var ur2="";
		if(urlunique!="") ur2= urlunique;
		else ur2= url_base+directory+img;
		var ur3= encodeURIComponent(message_base_tw);
		make_bit_url_and_twitt(ur2,ur3);
	}
	
	if(reso=="ggplus"){
		murl= encodeURI(url_base+"sharegg.php?img="+img+'-'+lg); 
		window.open("https://plus.google.com/share?url="+murl);
	}
	
	if(reso=="weibo"){
		murl= encodeURI(url_base+"sharegg.php?img="+img); 
		var ur2= encodeURI(url_base+directory+img+".jpg");
		
		window.open('http://v.t.sina.com.cn/share/share.php?title='+encodeURIComponent(message_base)+
		'&url='+murl+'&source=bookmark&pic='+ur2,'_blank','width=450,height=400');
	}
}


/******* publication image Facebook *******/

function authorizeAppInPopup(mimage,urlunique) {
    FB.login(function(response) {
        if (response.authResponse) {
            // User authorized app
			$("#moverlay").show(0);
            createalbum(mimage,urlunique);
        } else {
            // User cancelled login or did not fully authorize
        }
    }, {scope: 'publish_stream,user_photos'});
}


function createalbum(mimage,urlunique){
	FB.api('/me/albums',  function(resp) {
				var album_id="";
				if(resp!=""){
					for (var i=0, l=resp.data.length; i<l; i++){
						var album = resp.data[i];
						
						if(album.name=="Days Of Luck by Van Cleef & Arpels"){
							album_id=""+album.id;
						}
						
					}
					if(album_id!=""){
						uploadPhoto(album_id,mimage,urlunique);
					}else{
						makealbum(mimage,urlunique);
					}
				}else{
				makealbum(mimage,urlunique);
				}
            });
			

	
}

function makealbum(mimage,urlunique){
FB.api('/me/albums', 'post',
    {
		name: 'Days Of Luck by Van Cleef & Arpels'
		},
		function(response) {
			// response.id is the album id
			if(response.id>0){
			uploadPhoto(response.id,mimage,urlunique);
			}else{
			alert('Error occured');
			$("#moverlay").hide(0);
			}
		}
    );
}

function uploadPhoto(album_id,mimage,urlunique){
	FB.api('/'+album_id+'/photos', 'post', {
		message:message_base+" "+urlunique,
		url:mimage        
	}, function(response){

		if (!response || response.error) {
			alert('Error occured');
			$("#moverlay").hide(0);
		} else {
			$("#moverlay").hide(0);
		}

	});

}

/******* fin publication image Facebook *******/

/******* genration shorturl bitly *******/
// key : R_aa211967315ef05372f98975e26457d7
// username : o_65ce1gdr8d

//bit_url function
function make_bit_url_and_twitt(url,descr)
{
var url=url;
var username="o_65ce1gdr8d"; // bit.ly username
var key="R_aa211967315ef05372f98975e26457d7";
$.ajax({
url:"http://api.bit.ly/v3/shorten",
data:{longUrl:url,apiKey:key,login:username},
dataType:"jsonp",
success:function(v)
{
var bit_url=v.data.url;
//alert(descr);
window.open("http://twitter.com/share?url="+bit_url+"&text="+descr);
}
});
}

/******* fin bitly *******/

/******* info bulle ******/
document.onmousemove = suivre_souris0;
decal_x = 25;
decal_y = -15;
curx =0;
cury =0;
var contenu
function pop0(contenu,mx,my)
{
decal_x = 25;
decal_y = -15;
if(mx)decal_x=mx;
if(my)decal_x=my;
if(mx<0) document.getElementById("bulle").innerHTML = "<table border='0' cellpading='0' cellspacing='0'><tr><td class='colt2'><b>"+contenu+"</b></td><td align='left' class='colg2'>&nbsp;</td></tr></table>";
else document.getElementById("bulle").innerHTML = "<table border='0' cellpading='0' cellspacing='0'><tr><td align='right' class='colg'>&nbsp;</td><td class='colt'><b>"+contenu+"</b></td></tr></table>";
}

function suivre_souris0()
{
		$("#bulle").css("left", curx+ decal_x); 
		$("#bulle").css("top",  cury + decal_y);
		$("#bulle").css("display","block");
}

jQuery(document).ready(function(){
   $(document).mousemove(
	function(e){
      curx=e.pageX;
	  cury=e.pageY;
   }); 
})

function disparaitre0()
{
	$("#bulle").css("display","none");
	document.getElementById("bulle").innerHTML = '';
}
/******* fin infobulle *****/

function hideSelect(){
$('select').hide(0);
}
function showSelect(){
$('select').show(0);
}
