<?php
/**
 *
 * Single Pin
 *
*/
?>
<span class="icon-close"></span>
<div class="col-md-12 each-pin">
	<?php $years = get_posts_order_by_year( get_the_ID() );?>
	<div class="col-md-12 infos infos-select">
		<h4>
			<?php _e( 'Selecione os anos', 'odin');?>
		</h4>
	</div><!-- .col-md-12 infos -->
	<form method="post" id="years">
		<select name="years[]" class="col-md-12 select-year" placeholder="<?php esc_attr_e( 'Selecione o ano', 'odin' );?>" multiple>
			<?php foreach ( $years as $year => $post_id ) : ?>
				<?php $selected = '';?>
				<?php if ( isset( $_REQUEST[ 'years'] ) && in_array( $year, $_REQUEST[ 'years'] ) ) : ?>
					<?php $selected = 'selected';?>
				<?php endif;?>
				<?php if ( ! isset( $_REQUEST[ 'years'] ) ) : ?>
					<?php $selected = 'selected';?>
				<?php endif;?>
				<option value="<?php echo $year;?>" <?php echo $selected;?>>
					<?php echo $year;?>
				</option>
			<?php endforeach;?>
		</select>
		<input type="hidden" name="pin_id" value="<?php echo get_the_ID();?>" />
		<button><?php _e( 'Atualizar', 'odin' );?></button>
	</form><!-- #years -->
	<div class="col-md-12 slider-pin">
		<?php foreach ( $years as $year => $post_id ) : ?>
			<?php if ( isset( $_REQUEST[ 'years'] ) && ! in_array( $year, $_REQUEST[ 'years' ] ) ) : ?>
				<?php continue;?>
			<?php endif;?>
			<?php $galeria = get_post_meta( $post_id, 'galeria', true );?>
			<?php if ( $galeria ) : ?>
				<?php $images = explode( ',', $galeria);?>
				<?php foreach( $images as $image_id ) : ?>
					<?php if ( $image = wp_get_attachment_image_src( $image_id, 'large', false ) ) : ?>
						<?php $full = wp_get_attachment_image_src( $image_id, 'full', false );?>
						<div class="col-md-12 each-slider" style="background-image:url( <?php echo $image[0];?>);">
							<div class="slider-opacity">
								<a href="<?php echo $full[0];?>" class="col-md-6 pull-left text-center ligthbox-open">
									<span class="image-icon text-center">
										<img src="<?php echo get_template_directory_uri();?>/assets/images/zoom-icon.png" alt="<?php esc_attr_e( 'Zoom', 'odin' );?>" />
									</span>
									<?php _e( 'Zoom', 'odin');?>
								</a>
								<a href="#<?php echo $year;?>" class="col-md-6 pull-left text-center">
									<span class="image-icon text-center">
										<img src="<?php echo get_template_directory_uri();?>/assets/images/acervo-icon.png" alt="<?php esc_attr_e( 'Acervo Completo', 'odin' );?>" />
									</span>
									<?php _e( 'Acervo Completo', 'odin');?>
								</a>
							</div><!-- .slider-opacity -->
						</div><!-- .col-md-12 each-slider -->
					<?php endif;?>
				<?php endforeach;?>
			<?php endif;?>
		<?php endforeach;?>
	</div><!-- .col-md-12 post-image -->
	<div class="col-md-12 slider-pin-nav">
		<?php foreach ( $years as $year => $post_id ) : ?>
			<?php if ( isset( $_REQUEST[ 'years'] ) && ! in_array( $year, $_REQUEST[ 'years' ] ) ) : ?>
				<?php continue;?>
			<?php endif;?>
			<?php $galeria = get_post_meta( $post_id, 'galeria', true );?>
			<?php if ( $galeria ) : ?>
				<?php $images = explode( ',', $galeria);?>
				<?php foreach( $images as $image_id ) : ?>
					<?php if ( $image = wp_get_attachment_image_src( $image_id, 'thumbnail', false ) ) : ?>

						<a href="#">
							<img src="<?php echo $image[0];?>" alt="<?php echo get_the_title( $post_id );?>" width="80" height="80"/>
						</a>
					<?php endif;?>
				<?php endforeach;?>
			<?php endif;?>
		<?php endforeach;?>
	</div><!-- .col-md-12 slider-pin -->
	<div class="col-md-12 infos">
		<h3>
			<?php if ( $value = get_post_meta( get_the_ID(), 'address', true ) ) : ?>
				<?php echo apply_filters( 'the_title', $value );?>
			<?php endif;?>
		</h3>
		<h3>
			<?php _e( 'Artistas', 'odin' );?>
		</h3>
		<h5>
			<?php the_artistas_list( $years );?>
		</h5>
	</div><!-- .col-md-12 infos -->
</div><!-- .col-md-12 each-pin -->
