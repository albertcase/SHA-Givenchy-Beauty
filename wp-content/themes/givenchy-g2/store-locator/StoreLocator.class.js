var StoreLocator = new Class.create(PageBase, {
	initialize: function($super) {
		$super();
		
		


		this.map = new StoreLocatorMap();
		this.search = new StoreLocatorSearch();
		
		//console.log(geoplugin_city());
	}
	
	
});

var StoreLocatorMap = Class.create(
{
	initialize: function()
	{
		this.loadingDiv = $('map-loading')||{};
		this.loadingDiv.down('div').setOpacity(0.5);
		this.markers = [];
		this.infoWindows = [];		
		
		this.initSearchField();		
		this.initMap();
	
	},
	
	initSearchField: function()
	{
		this.searchField = $('searchQuery')||{};
		this.searchField.value = '';
		this.searchFieldScreen = this.searchField.previous('span');
		this.searchFieldScreen.observe('click', this.focusField.bind(this));
		this.searchField.observe('focus', this.clearField.bind(this));
		this.searchField.observe('blur', this.fillField.bind(this));	
		
		this.has_Perfume = $('searchPerfume')||{};
		this.has_Makeup = $('searchMakeup')||{};
		this.has_Care = $('searchCare')||{};
		this.has_Spa = $('searchSpa')||{};
		
		this.has_Perfume.observe('change', this.updateMapCallback.bind(this));
		this.has_Makeup.observe('change', this.updateMapCallback.bind(this));
		this.has_Care.observe('change', this.updateMapCallback.bind(this));
		this.has_Spa.observe('change', this.updateMapCallback.bind(this));
		
	},
	
	focusField: function()
	{
		this.searchField.activate();
	},
	
	clearField: function()
	{
		this.searchField.removeClassName('inputFocus');
		this.searchFieldScreen.hide();			
	},
	
	fillField: function()
	{
		if(this.searchField.value == '')
		{
			this.searchFieldScreen.show();				
		}

	},
	
	clearMarkers: function()
	{
		if (this.markers.length > 0) {
			for(var i = 0; i < this.markers.length; i++)
			{
				this.infoWindows[i].close();
				google.maps.event.clearInstanceListeners(this.markers[i]);
				this.markers[i].setMap(null);
			}
			this.markers.length = 0;
			this.infoWindows.length = 0;
		}
	},
	
	updateMap: function()
	{
		google.maps.event.addListenerOnce(this.map, 'tilesloaded', this.updateMapCallback.bind(this));
	},
	
	updateMapCallback: function()
	{
		//console.log(google.loader)
		var self = this;
		//this.loadingDiv.show();

		var currentZoom = this.map.getZoom();
		var currentBounds = this.map.getBounds();
		
		var currentDetails = '';
		currentDetails += (this.has_Perfume.checked) ? '1,' : '0,';
		currentDetails += (this.has_Makeup.checked) ? '1,' : '0,';
		currentDetails += (this.has_Care.checked) ? '1,' : '0,';
		currentDetails += (this.has_Spa.checked) ? '1' : '0';
		
//		var path = '/preprod/givenchy-g2/GivenchyG2/g2-public/wp/';
		var path = '/';
//		var path = '/wp/';
		
	    var url = path + 'services.php?service=geoLocator&zoom=' + currentZoom + '&bounds=' + currentBounds.toUrlValue(4) + '&details=' + currentDetails;
		
	    
	    new Ajax.Request(url, {
	    	method: 'get',
	    	onSuccess: function(transport) {
				self.clearMarkers();
    	  		var json = transport.responseJSON;
    	  		//alert('Ajax request with ts = '+json.ts);
				self._successHandler(json);
	    	}
    	});		
	},
	
	initMap: function()
	{
		var latlng = new google.maps.LatLng(36.8444,105.2929);
	    var myOptions = {
	      zoom: 4,
	      center: latlng,
		  disableDefaultUI: true,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
	    this.map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		google.maps.event.addListenerOnce(this.map, 'tilesloaded', this.updateMapCallback.bind(this));
		google.maps.event.addListenerOnce(this.map, 'tilesloaded', this.proposeGeoLocate.bind(this));
		
		
		var imgPath = $('imgPath').value;
		
		this.markerImg = new google.maps.MarkerImage(
			imgPath + 'map/marker.png'
		);
			
		this.markerAnchor = new google.maps.Point(6,30);
			
		this.markerShadow = new google.maps.MarkerImage(
			imgPath + 'map/marker_shadow.png', null, null,
			this.markerAnchor
		);
		
		google.maps.event.addListener(this.map, 'zoom_changed', this.updateMap.bind(this));
		google.maps.event.addListener(this.map, 'dragend', this.updateMap.bind(this));	
		
		$('map-zoom-in').observe('click', this.zoomIn.bind(this));
		$('map-zoom-out').observe('click', this.zoomOut.bind(this));
		
		this.geocoder = new google.maps.Geocoder();
		
		$('map-geolocate').observe('click', this.doGeoSearch.bind(this));
	},
	
	proposeGeoLocate: function()
	{
		if(google.loader.ClientLocation) 
		{
			this.displayGeoLocate('google');
		}
		else if(navigator.geolocation)
		{
			this.displayGeoLocate('navigator');
		}
			
			
	},
	
	displayGeoLocate: function(type)
	{
			$('map-locate-me-refuse').observe('click', function() {$('map-locate-me').hide()});
			$('map-locate-me-accept').observe('click', this.getClientLocation.bind(this,type)); 			
			$('map-locate-me-bg').setOpacity(0.8);
			$('map-locate-me').show();
	},
	
	getClientLocation: function(type)
	{
		var lat, lng;
		if(type == 'google')
		{
			lat = google.loader.ClientLocation.latitude;
			lng = google.loader.ClientLocation.longitude;
			$('map-locate-me').hide();	
			this.gotoClientLocation(lat, lng);
		}
		else if(type == 'navigator')
		{
			$('map-locate-me').hide();		
			this.loadingDiv.show();
			navigator.geolocation.getCurrentPosition(this.extractClientLocation.bind(this), this.geolocError.bind(this));

		}
			
	},
	
	geolocError: function()
	{
		this.loadingDiv.hide();
	},
	
	extractClientLocation: function(position)
	{
		this.loadingDiv.hide();
		this.gotoClientLocation(position.coords.latitude, position.coords.longitude)
	},
	
	gotoClientLocation: function(lat,lng)
	{	
		$('map-locate-me').hide();	
		//console.log(lat); console.log(lng); 
		this.map.setCenter( new google.maps.LatLng(lat,lng) );
		this.map.setZoom(11);
				
	},
	
	doGeoSearch: function()
	{
		if(this.searchField.value == '')
		{
			//this.searchFieldScreen.addClassName('error-highlight');
			Effect.Pulsate(this.searchFieldScreen, {pulses: 5, duration: 1.5});
		}
		else
		{
			//this.searchFieldScreen.removeClassName('error-highlight');
			var geoOpts = {
				address: this.searchField.value
			};
			//this.loadingDiv.show();
			this.geocoder.geocode(geoOpts, this._geocodeCallBack.bind(this));
			
			
		}
			
	},
	
	_geocodeCallBack: function(results, status)
	{
		if(status == google.maps.GeocoderStatus.OK)
		{
			this.searchField.value = results[0].formatted_address;
			
//			this.map.setCenter(results[0].geometry.location);
			this.map.fitBounds(results[0].geometry.viewport);
			this.updateMap();
		}
	},
	
	zoomIn: function()
	{
		this.map.setZoom(this.map.getZoom()+1);
	},
	
	zoomOut: function()
	{
		this.map.setZoom(this.map.getZoom()-1);
	},	
	
	_successHandler: function(result)
	{
		if(result.data != '')
		{
			var self = this;
			result.data.each( function(obj) 
			{
				self.addStore(obj)
			});
		}
		this.loadingDiv.hide();
	},
	
	addStore: function(store)
	{		
		
		var self = this;
		var position = new google.maps.LatLng(store.lat, store.lng);
		var markerOpts = {
			map: this.map,
			cursor: 'pointer',
			position: position,
			icon: this.markerImg,
			shadow: this.markerShadow
		};
		
		
		var content = Builder.node('div', {className: 'mapInfo'});
		if(store.name != '') 
		{
			var title = Builder.node('h1', {}, store.name);
			content.insert({bottom: title});
			
		}
		
		if(store.street != '')
		{
			var street = Builder.node('div', {}, store.street);
			content.insert({bottom: street});
		
		}
		
		if(store.locality != '')
		{
			var locality = Builder.node('div', {}, store.locality );
			content.insert({bottom: locality});
		}
		
		if(store.has_perfum != 0 || store.has_makeup != 0 || store.has_care != 0 || store.has_spa != 0)
		{
			var opt = false;
			var txt = '';
			if(store.has_perfum != 0)
			{
				//txt = $('text_perfume').value;
				opt = true;
			}	
			
			if(store.has_makeup != 0)
			{
				if(opt == true) 
					//txt +=  ' | ';
				//txt += $('text_makeup').value;
				opt = true;
			}
			
			if(store.has_care != 0)
			{
				if(opt == true) 
					//txt +=  ' | ';
				//txt += $('text_care').value;
				opt = true;
			}	
			
			if(store.has_spa != 0)
			{
				if(opt == true) 
					//txt +=  ' | ';
				//txt += $('text_spa').value;
				opt = true;
			}	
			
			var options = Builder.node('div', {className: 'store_details'}, txt);
			content.insert({bottom: options});
		}
		
		
		
		var i = this.markers.length;
		
		this.infoWindows[i] = new google.maps.InfoWindow(
			{
				content: content,
				disableAutoPan: true
			}
		)
		this.markers[i] = new google.maps.Marker(markerOpts);
		google.maps.event.addListener(this.markers[i], 'mouseover', function()
		{
			self.infoWindows[i].open(self.map, self.markers[i]);
		});
		google.maps.event.addListener(this.markers[i], 'mouseout', function()
		{
			self.infoWindows[i].close();
		});	
		
		google.maps.event.addListener(this.markers[i], 'click', function()
		{
			self.map.setCenter(new google.maps.LatLng(store.lat, store.lng));
			self.map.setZoom(16);
			//self.updateMap();
			if($('search_foldin').visible()) self.map.panBy(0,-80);
		});
		
		
	}
}
);

var StoreLocatorSearch = Class.create(
{
	initialize: function()
	{
		this.containerId = 'search_container';
		this.detailsId = 'search_details';
		this.details = $(this.detailsId);
		this.container = $(this.containerId);
		this.container.setOpacity(0.8);
		
		this.foldOutButton = $('search_foldout');
		this.foldInButton = $('search_foldin');
		
		this.foldOutButton.observe('click', this.foldOut.bind(this));
		this.foldInButton.observe('click', this.hideDetails.bind(this));
	},
	
	foldOut: function()
	{
		this.foldOutButton.hide();
		this.foldInButton.show();
		new Effect.Morph(this.containerId, { 
			style: 'height: 120px;',
			duration: 0.3,
			afterFinish: this.showDetails.bind(this)
			}
		);
	},
	
	showDetails: function()
	{
		this.details.appear({duration: 0.2});
	},
	
	foldIn: function()
	{
		this.foldOutButton.show();
		this.foldInButton.hide();		
		new Effect.Morph(this.containerId, { 
			style: 'height: 30px;',
			duration: 0.3
			}
		);
	},

	hideDetails: function()
	{
		this.details.fade({duration: 0.2, afterFinish: this.foldIn.bind(this)});
	}
	
}
);