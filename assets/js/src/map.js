jQuery(document).ready(function($) {
	if ( $( '#map').length < 1 ) {
		return;
	}
	var getQueryStrings = function () {
		var assoc  = {};
		var decode = function (s) { return decodeURIComponent(s.replace(/\+/g, " ")); };
		var queryString = location.search.substring(1);
		var keyValues = queryString.split('&');

		for(var i in keyValues) {
			var key = keyValues[i].split('=');
			if (key.length > 1) {
				assoc[decode(key[0])] = decode(key[1]);
			}
		}
		return assoc;
	}
	var query_strings = getQueryStrings();
    var ajax_load_pins = function( map ) {
    	var data = {
    		action: 'show_pins_json',
    		vars: window.location.search
    	}
    	$.get( odin.ajax_url, data, function( response ) {
    		var json = JSON.parse( response );
    		for ( var k in json ) {
    			var post = json[ k ];
    			var marker = new google.maps.Marker({
    				position: new google.maps.LatLng( post.lat, post.lng ),
    				map: map
    			});
    			marker.set( 'post', post );
    		}
    		//console.log( json );
    	} );
    }
	// init google maps
    var options = {
        center: new google.maps.LatLng( '-15', '-55' ),
        zoom: 4,
        maxZoom: 17,
        streetViewControl: false,
    };
    if ( typeof query_strings[ 'lat'] !== 'undefined' || typeof query_strings[ 'lng'] !== 'undefined' ) {
    	if( query_strings[ 'lat'] != '' && query_strings[ 'lng'] != '' ) {
    		var options = {
    		    center: new google.maps.LatLng( query_strings[ 'lat'], query_strings[ 'lng'] ),
    		    zoom: 17,
    		    maxZoom: 17,
    		    streetViewControl: false,
    		};
    	}
    }
    $( '#map' ).css( 'margin-top', $( '#header-size').outerHeight( false ) );
    var map = new google.maps.Map( document.getElementById( 'map' ), options );
    // load pins by ajax
    ajax_load_pins( map );

    var $input = /** @type {!HTMLInputElement} */( document.getElementById( 'input-address' ) );

    var $input_lat = $( '#input-lat' );
    var $input_lng = $( '#input-lng' );
    var autocomplete = new google.maps.places.Autocomplete( $input );
    autocomplete.bindTo('bounds', map);

    autocomplete.addListener('place_changed', function() {

    	var place = autocomplete.getPlace();
    	if ( ! place.geometry ) {
    		return;
    	}
    	$input_lat.val( place.geometry.location.lat );
    	$input_lng.val( place.geometry.location.lng );

    	console.log( place.geometry.location );
    	// If the place has a geometry, then present it on a map.
    	map.setCenter(place.geometry.location);
    	map.setZoom(17);  // Why 17? Because it looks good.
    });

});
