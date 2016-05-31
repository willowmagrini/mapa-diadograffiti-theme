jQuery(document).ready(function($) {
	if ( $( '#map').length < 1 ) {
		return;
	}

	// init google maps
    options = {
        center: new google.maps.LatLng( '-15', '-55' ),
        zoom: 4,
        maxZoom: 17,
        streetViewControl: false,
    };
    $( '#map' ).css( 'margin-top', $( '#header-size').outerHeight( false ) );
    var map = new google.maps.Map( document.getElementById( 'map' ), options ); 
});