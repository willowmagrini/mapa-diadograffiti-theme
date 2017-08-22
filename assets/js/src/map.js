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
	var ajax_open_pins = function( id, years ) {
		var url = odin.ajax_url;
		var data = {
			action: 'open_pin',
			post_id: id
		}
		if ( typeof years != 'undefined' ) {
			var data = $.param( data ) + '&' + years;
		}
		console.log( data );

		$( 'body' ).addClass( 'loading' );
		$( '#open-pin' ).removeClass( 'open' );
		$.get( url, data, function( response ) {
			$( '#open-pin' ).html( response );
			$( '#open-pin' ).addClass( 'open' );
			$( 'body' ).addClass( 'open-pin' );
			$( 'body' ).removeClass( 'loading' );
			$( 'html' ).attr( 'style', 'overflow-y:scroll !important;' );
			$( '.select-year' ).select2({
				placeholder: $( '.select-year' ).attr( 'placeholder' ),
				maximumSelectionLength: 4
			});
			if ( $( window ).width() >= 800 ) {
				$( '.slider-pin' ).slick({
			 		slidesToShow: 1,
			 		slidesToScroll: 1,
			 		arrows: true,
			 		asNavFor: '.slider-pin-nav',
			 	});
				$( '.slider-pin-nav' ).slick({
			 		slidesToShow: 4,
			 		slidesToScroll: 1,
			 		arrows: true,
			 		asNavFor: '.slider-pin',
			 		focusOnSelect: true
			 	});
			} else {
				$( '.slider-pin' ).slick({
			 		slidesToShow: 1,
			 		slidesToScroll: 1,
			 		arrows: true,
			 	});
			}
		});
	}
	$( '#open-pin' ).on( 'click', '.icon-close',function( e ) {
		$( '#open-pin' ).removeClass( 'open' );
		$( 'body' ).removeClass( 'open-pin' );
		$( 'html' ).removeAttr( 'style');
	});
	$( '#open-pin' ).on( 'click', '.ligthbox-open', function( e ) {
		e.preventDefault();
		if ( $( this ).attr( 'data-embed' ) == 'false' ) {
			var image = '<img src="' + $( this ).attr( 'href' ) + '">';
		} else {
			var image = decodeURIComponent( $( this ).attr( 'data-html' ) );
		}
		$( '#modal-lightbox .modal-body' ).html( image );
		$( '#modal-lightbox' ).modal('show');
	})
	$( '#open-pin' ).on( 'submit', 'form#years', function( e ) {
		e.preventDefault();
		var form_vars = $( this ).serialize();
		console.log( form_vars + ' q' );
		ajax_open_pins( $( 'form#years [name="pin_id"]').val(), form_vars );
	});
	var ajax_load_pins = function( map ) {
		var data = {
			action: 'show_pins_json',
			vars: window.location.search
		}
		var cluster_config = {
			styles: [{
				anchorIcon: [ 32, 39 ],
				fontWeight: 'bold',
				width: 50,
				height: 50,
				textSize: 14,
				url: odin.icon_base+"pin-cluster.png",
    		}]
    	};
			// var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

    	// var image = new google.maps.MarkerImage(
      //       odin.icon,
      //       null,
      //       new google.maps.Point(0,0),
      //       new google.maps.Point(32, 39)
      //   );
		var markers = [];
		$.get( odin.ajax_url, data, function( response ) {

			var json = JSON.parse( response );

			for ( var k in json ) {
				var post = json[ k ];
				var categoria = post.categoria;

				if (categoria) {

					var slug = categoria.slug;
					console.log(slug);

				}
				else{

					var slug = 'cluster';
				}


				var image =  new google.maps.MarkerImage(
	            odin.icon_base+"pin-"+slug+".png",
	            null,
	            new google.maps.Point(0,0),
	            new google.maps.Point(32, 39)
	        );
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng( post.lat, post.lng ),
					map: map,
					icon: image
				});
				marker.set( 'post', post );
				markers.push( marker );
				google.maps.event.addListener(marker, 'click', function(){
					var $marker = this;
					ajax_open_pins( $marker.post.post_id );
				});
			}
			var cluster = new MarkerClusterer( map, markers, cluster_config );
		} );
	}
	// init google maps
	var options = {
		center: new google.maps.LatLng( '-23.802791', '-46.6795491' ),
		zoom: 8,
		streetViewControl: false,
	};

	if ( typeof query_strings[ 'lat'] !== 'undefined' || typeof query_strings[ 'lng'] !== 'undefined' ) {
		if( query_strings[ 'lat'] != '' && query_strings[ 'lng'] != '' ) {
			var options = {
				center: new google.maps.LatLng( query_strings[ 'lat'], query_strings[ 'lng'] ),
				zoom: 17,
				streetViewControl: false,
			};
		}
	}
	if ( $( 'body' ).hasClass( 'embed' ) ) {
		options.scrollwheel = false;
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
