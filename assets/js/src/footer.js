jQuery(document).ready(function($) {
	$( '.footer-open' ).on( 'click', function( e ) {
		if ( $( this ).attr( 'data-open' ) == 'false' ) {
			$( '.footer-toggle' ).addClass( 'open' )
			$( this ).attr( 'data-open', 'true' );
		}
		else {
			$( '.footer-toggle' ).removeClass( 'open' );
			$( this ).attr( 'data-open', 'false' );
		}
	})
});
