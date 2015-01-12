
jQuery(document).ready(function(){
	 spin=[0,0,0,0],
		spinning=5;	
		var mouseDownFlag=0;
		var mouseOutFlag=1;
		/*jQuery(".tiger-start a").unbind("click").click(function(){
				if(spinning==5){
					startTiger();										
				}
				else if(0<=spinning&&spinning<5){
					stopEach(spinning);
					spinning --;
					}
				return false;
		});*/
		
		jQuery(".tiger-start a").unbind("mousedown").mousedown(function(){
				mouseDownFlag=1;
				if(spinning>0){		
				$("#slot-begin").removeClass().addClass("mouseDown");
				}
				return false;
		});
		jQuery(".tiger-start a").unbind("mouseup").mouseup(function(){
				mouseDownFlag=0;
				return false;
		});
		jQuery(".tiger-start a").unbind("mouseout").unbind("click").mouseout(function(){
					mouseOutFlag=1;
					//console.log('out');
					if(mouseDownFlag==1){
					if(spinning==5){
					startTiger();										
					}
					else if(0<=spinning&&spinning<5){
						stopEach(spinning);
						spinning --;
						}
					}
					//console.log(spinning);
					return false;
					
			});
		jQuery(".tiger-start a").unbind("click").click(function(){
				if(spinning==5){
					startTiger();										
				}
				else if(0<=spinning&&spinning<5){
					stopEach(spinning);
					spinning --;
					}
				//console.log(spinning);
				return false;
		});
		
		

	function startTiger(){
				spinning--;
				
				jQuery('.tiger-start a').addClass('tigerDisabled');
				jQuery('.tiger-wrapper').addClass('slotAction');
				
				stopEach(spinning);
				spinning--;
					
				
			}
			
	function stopEach(slot){					
					spin[slot] = parseInt(Math.random() * 10);
					//console.log(spin)
					setTimeout(function(){
						stopSpin(slot);
					}, 500 + parseInt(500 * Math.random()));
					
			}
			
	function stopSpin(slot) {
					//console.log(slot);
				jQuery('.tr' +(5-slot)).find('img.slotSpinAnimation').hide(function(){
						shinBorder(slot);
						wordsSpin(slot);
						jQuery(this).parent().find('.tiger-Box').animate({border:"1px solid red"},200);
						
						jQuery(this).parent().find('ul').animate({
							top: (- spin[slot - 1] * 183)+"px"
						},{
							duration: 500,
							easing: 'elasticOut',
							complete: function() {
								
								if (spinning <=0 ) {
									jQuery("#slot-begin").removeClass().addClass("slot-"+4);
								}
							}});
				});
				////console.log(slot);		
			}
	function wordsSpin(slot){
			jQuery('.tr'+(5-slot)).find('.tiger-message').animate({marginTop:"26px",opacity:1},500);
	}			
	//边框闪烁
	function shinBorder(slot){
			jQuery("#slot-begin").removeClass().addClass("slot-"+(5-slot));
		}
	
			
 	
			
			
	jQuery.extend(jQuery.easing,{
		bounceOut: function (x, t, b, c, d) {
			if ((t/=d) < (1/2.75)) {
				return c*(7.5625*t*t) + b;
			} else if (t < (2/2.75)) {
				return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
			} else if (t < (2.5/2.75)) {
				return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
			} else {
				return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
			}
		},
		easeOut:function (x, t, b, c, d) {
			return -c *(t/=d)*(t-2) + b;
		},
		elasticOut: function (x, t, b, c, d) {
			var s=1.70158;var p=0;var a=c;
			if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
			if (a < Math.abs(c)) { a=c; var s=p/4; }
			else var s = p/(2*Math.PI) * Math.asin (c/a);
			return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
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
			}