<?php
/**
 *
 * Template: Help modal
 *
 *@description: modal login using bootstrap API
 *
**/
?>
<div class="modal fade" id="help-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
				<h4 class="modal-title"><?php _e( 'Como pesquisar', 'odin' );?></h4><!-- .modal-title -->
			</div><!-- .modal-header -->
			<div class="modal-body">
				<?php $page = get_page_by_title( 'Como pesquisar' );?>
				<?php if ( $page && is_object( $page ) ) : ?>
					<?php echo apply_filters( 'the_content', $page->post_content );?>
				<?php endif;?>
			</div><!-- .modal-body -->
		</div><!-- .modal-content -->
	</div><!-- .modal-dialog modal-sm -->
</div><!-- .modal fade -->

