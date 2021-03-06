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
			<?php if ( isset( $_GET[ 'embed'] ) ) : ?>
				<input type="hidden" name="embed" value="true" />
				<?php if ( isset( $_GET[ 'by_year'] ) && ! empty( $_GET[ 'by_year'] ) ) : ?>
					<input type="hidden" name="by_year" value="<?php echo esc_attr( $_GET[ 'by_year' ] );?>" />
				<?php endif;?>
			<?php endif;?>
			<input id="input-address" type="text" class="text" placeholder="<?php _e( 'Pesquise por endereço', 'odin' );?>" />
			<select name="by_artista[]" class="text select-search" multiple placeholder="<?php _e( 'Pesquise pelo nome do artista', 'odin');?>" data-prefix="<?php _e( 'Artistas: ', 'odin');?>">
				<?php $terms = get_terms( array( 'artistas' ), array( 'hide_empty' => false ) );?>
				<?php foreach ( $terms as $term ) : ?>
					<?php $selected = '';?>
					<?php if ( isset( $_GET[ 'by_artista'] ) && is_array( $_GET[ 'by_artista'] ) && in_array( $term->slug, $_GET[ 'by_artista'] ) ) : ?>
						<?php $selected = 'selected';?>
					<?php endif;?>
					<option value="<?php echo $term->slug;?>" <?php echo $selected;?>>
						<?php echo apply_filters( 'the_title', $term->name );?>
					</option>
				<?php endforeach;?>
			</select>
			<input type="hidden" id="input-lat" name="lat" />
			<input type="hidden" id="input-lng" name="lng" />

			<div class="col-md-12 radio">
				<?php $selected = '';?>
				<?php if( isset( $_GET[ 'event-type' ] ) && $_GET[ 'event-type'] == 'oficial' ) : ?>
					<?php $selected = 'checked';?>
				<?php endif;?>
				<input type="radio" name="event-type" value="oficial" class="pull-left" <?php echo $selected;?> />
				<label for="event-type">
					<?php _e( 'Eventos do Dia do Graffiti', 'odin' );?>
				</label>
			</div><!-- .col-md-12 -->
			<div class="col-md-12 radio">
				<?php $selected = '';?>
				<?php if( isset( $_GET[ 'event-type' ] ) && $_GET[ 'event-type'] == 'externo' ) : ?>
					<?php $selected = 'checked';?>
				<?php endif;?>
				<input type="radio" name="event-type" value="externo" class="pull-left" <?php echo $selected;?> />
				<label for="event-type">
					<?php _e( 'Eventos externos', 'odin' );?>
				</label>
			</div><!-- .col-md-12 -->
			<div class="col-md-12 radio">
				<input type="radio" name="event-type" value="all" class="pull-left" />
				<label for="event-type">
					<?php _e( 'Todos', 'odin' );?>
				</label>
			</div><!-- .col-md-12 -->
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
