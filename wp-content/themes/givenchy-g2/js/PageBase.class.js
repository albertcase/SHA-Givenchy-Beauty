var PageBase = new Class.create({
	initialize: function() {
		this.__initMenu();
		this.__initComments(); //readMore
		this.__initLangChooser(); //chooseLanguage
		this.__initForm();
		
		
		var c = $('stores');
		if (c) {
			c.value = "";
			c.observe('change', this._storeChangeHandler.bind(this));
		}
		
		
		var f = $('faceWrapper');
		if (f) {
			new Zoomer(f, {trigger: $('zoom'), afterZoomIn: this.__afterZoomIn.bind(this), afterZoomOut: this.__afterZoomOut.bind(this)});
			
			this.selectedElement = null;
			this.selectedTargetElement = null;
			$('menu').select('a').each(function(element) {
				element.observe('click', this.__menuItemClickHandler.bind(this));
			}.bind(this));
			
			$$('.popupWrapperContainer')[0].select('.close').each(function(element) {
				element.observe('click', this.__menuCloseClickHandler.bind(this));
			}.bind(this));
			var location = window.location + '';
			var p = location.indexOf('comment-page-');
			if (p != -1) {
				window.location = location.substring(0, p)+'#comment';
				return;
			}
			if (location.indexOf('#comment') != -1) {
				this.__manageVisibility(null, $('commentPopup'));
			}
		}
	},
	
	_storeChangeHandler: function(event) {
		var element = Event.findElement(event, 'select');
		if (element.value != '') {
			window.location = element.value;
		}
	},
	
	__menuCloseClickHandler: function(event) {
		Event.stop(event);
		var element = Event.findElement(event, 'a');
		var targetElement = element.up('div').hide();
		
		this.__manageVisibility(null, targetElement);
	},
	
	__menuItemClickHandler: function(event) {
		Event.stop(event);
		
		var element = Event.findElement(event, 'a');
		var href = element.name;
		var targetElement = $(href);

		this.__manageVisibility(element, targetElement);
	},
	
	__manageVisibility: function(element, targetElement) {
		if (this.selectedTargetElement) {
			this.selectedTargetElement.hide();
			if (this.selectedElement) {
				this.selectedElement.removeClassName('selected');
			}
		}
		if (this.selectedTargetElement == targetElement) {
			if (this.selectedElement) {
				this.selectedElement.removeClassName('selected');
			}
			this.selectedTargetElement = null;
			return;
		}
		targetElement.show();
		this.selectedElement = element;
		if (this.selectedElement) {
			this.selectedElement.addClassName('selected');
		}
		this.selectedTargetElement = targetElement;
		new Control.ScrollBar(this.selectedTargetElement.down('.scrollbar_content'),this.selectedTargetElement.down('.scrollbar_track'));  
	},
	
	__afterZoomIn: function() {
		 $('zoom').addClassName('zoomOut');
	},
	
	__afterZoomOut: function() {
		$('zoom').removeClassName('zoomOut');
	},
	
	__initLangChooser: function() {
		var element = $('chooseLanguage');
		element.onchange = function() {
			window.location = element.value;
		};
	},

	__initForm: function() {
		$$('#s, #s textarea').each(function(element) {
			var label = element.previous();
			var count = 0;
			while (label && label.tagName.toLowerCase() != 'label') {
				label = label.previous();
				count++;
				if (count == 3) break;
			}
			if (label && label.tagName.toLowerCase() == 'label') {
				element.value = label.innerHTML;
				if (label.next().hasClassName('required')) {
					element.value += ' *';
				} 
				element.onfocus = function(event) {
					if (element.value == label.innerHTML || element.value == label.innerHTML+' *') {
						element.value = '';
						element.addClassName('inputFocus');
					}
				};
				element.onblur = function(event) {
					if (element.value == '') {
						element.value = label.innerHTML;
						if (label.next().hasClassName('required')) {
							element.value += ' *';
						}
						element.removeClassName('inputFocus');
					}
				};
			}
			/*jQuery('.fillTip input').each(function(e){
				jQuery(this).val('');
			})*/
		});		
	},
	
	__initComments: function() {
		var comments = $('comments');
		if (!comments) return;
		
		comments.select('.readMore').each(function(element) {
			element.onclick = function() {
				
				$('modalCommentWrapper').down('.pseudo').innerHTML = element.up('li').down('.comment-author').innerHTML;
				$('modalCommentWrapper').down('.text').innerHTML = element.up('li').down('.full-comment').innerHTML;
				// 2012-8-15 remove the function of DATE, fix the block ui function on comments 
				//$('modalCommentWrapper').down('.date').innerHTML =  element.up('li').down('.commentmetadata a').innerHTML;
				
				Lightview.show({
					href: '#modalCommentWrapper',
					options: {
						width: 485, 
						height: 395

					}	
				});
			};
		});
	},
	
	/*__initCata: function() {

		var secondCata =$$('ul[class=children]');
		var catItem = $$('li[class=cat-item]');
		
		$$('li[class=cat-item]').each(function(el){ 
			el.observe("click", function(event) { 
			
				//el.down().setStyle({  display: 'block'});
			 //secondCata.each(function (element) { 
				  //element.setStyle({  display: 'block'});
				//}); 
	 
			}); 
		}); 

    },*/
	
	//2012-7-12 add catalogue
	
	__initMenu: function() {
		jQuery.noConflict();
		/*added in 2012-10-18 add current-cat*/
		stringfc="";
		allUrl=location.search.slice(1);
		arrayfc=allUrl.split('&');
		for(var i=0;i<arrayfc.length;i++){
			if(arrayfc[i].indexOf('fc=')==0){
				stringfc=arrayfc[i];
			}
		}
		classfc=stringfc.slice(3);
		if(classfc!=""){
			jQuery('.'+classfc).addClass('current-cat');
		}
		else{
			classfc=givenchyFc;
			//console.log(classfc);
			jQuery('.'+classfc).addClass('current-cat');
		}
		//console.log(arrayfc,stringfc,classfc);
		/*if(!classfc.indexOf('&')){
			jQuery('.'+classfc).addClass('current-cat');
		}
		else{
			jQuery('.'+classfc.slice(0,classfc.indexOf('&'))).addClass('current-cat');
		}*/
		
		//console.log(allUrl,classfc,classfc.indexOf('&'));
		/*end*/
		
		jQuery('.cat-item a').click(function(e){
			jQuery(this).parent().siblings().removeClass("current-cat");
			jQuery(this).parent().addClass("current-cat");
			//console.log(jQuery(this).siblings().children());
			jQuery(this).parent().siblings().children("ul").hide("slow");
			//console.log(jQuery(this));
			//console.log(jQuery(this).parent());
			jQuery(this).parent().children('ul').show('slow');
			if(jQuery(this).parent().children('ul').length>0&&(!jQuery(this).parent().parent().hasClass('you-and-us'))){
				
				//console.log('has');
				return false;
			}
			//return false;
		});	
		var currentCata = jQuery('.you-and-us');
		if(currentCata.find('.current-cat')){
			jQuery('.current-cat').parents().show();
			//jQuery('.current-cat').siblings().show();
			//jQuery('.current-cat').children().show();
		}	
    }
});