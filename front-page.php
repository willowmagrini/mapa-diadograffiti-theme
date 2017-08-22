<?php
/**
 * The template for displaying home
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>
<div id="filters" class="col-md-4 pull-right">
	<div class="col-md-12">
		<h3 class="info">
			<?php _e( 'Faça uma pesquisa no Mapa', 'odin' );?>
		</h3><!-- .info -->
		<span id="icon-help" data-toggle="modal" data-target="#help-modal"></span>
		<form>
			<input id="input-address" type="text" class="text" placeholder="<?php _e( 'Pesquise por endereço', 'odin' );?>" />
			<select name="por_categoria[]" class="text select-search" multiple placeholder="<?php _e( 'Pesquise pela categoria', 'odin');?>" data-prefix="<?php _e( 'Categorias: ', 'odin');?>">
				<?php $terms = get_terms( array( 'tipo' ), array( 'hide_empty' => false ) );?>
				<?php foreach ( $terms as $term ) : ?>
					<?php $selected = '';?>
					<?php if ( isset( $_GET[ 'por_categoria'] ) && is_array( $_GET[ 'por_categoria'] ) && in_array( $term->slug, $_GET[ 'por_categoria'] ) ) : ?>
						<?php $selected = 'selected';?>
					<?php endif;?>
					<option value="<?php echo $term->slug;?>" <?php echo $selected;?>>
						<?php echo apply_filters( 'the_title', $term->name );?>
					</option>
				<?php endforeach;?>
			</select>
			<input type="hidden" id="input-lat" name="lat" />
			<input type="hidden" id="input-lng" name="lng" />
			<button class="col-md-6">
				<span class="btn-text">
					<span>
						<?php _e( 'Pesquisar', 'odin' );?>
					</span>
				</span>
			</button>
		</form>
	</div><!-- .col-md-12 -->
</div><!-- #filters.col-md-4 pull-right -->
<div id="open-pin" class="col-md-4 pull-right">
</div><!-- #open-pin.col-md-4 pull-right -->
<div id="map"></div><!-- #map -->
<?php
get_footer();
