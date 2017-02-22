jQuery(document).ready(function($) {
	$( '.select-search' ).select2({
		placeholder: $( '.select-search' ).attr( 'placeholder' ),
	});
	var prefixArtistas = function(){
		if ( $( '.select2-selection__choice' ).length > 0 ) {
			if ( 0 === $( '#select-search-prefix').length ) {
				var html = '<li id="select-search-prefix">'
					+ $( '.select-search' ).attr( 'data-prefix' ) +
					'</li>';
				$( '.select2-selection__rendered' ).prepend( html );
			}
		} else {
			if ( $( '#select-search-prefix' ).length > 0 ) {
				$( '#select-search-prefix' ).remove();
			}
		}

	}
	$( '.select-search' ).on( 'change', function( e ){
		prefixArtistas();
	});
	prefixArtistas();
});
