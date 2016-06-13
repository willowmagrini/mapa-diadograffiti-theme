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
		<form>
			<input type="text" class="text" placeholder="<?php _e( 'Pesquise por endereço', 'odin' );?>" />
			<input type="text" class="text" placeholder="<?php _e( 'Pesquise pelo nome do artista', 'odin' );?>" />
			<div class="col-md-12 radio">
				<input type="radio" name="event-type" value="oficial" class="pull-left" />
				<label for="event-type">
					<?php _e( 'Eventos do Dia do Graffiti', 'odin' );?>
				</label>
			</div><!-- .col-md-12 -->
			<div class="col-md-12 radio">
				<input type="radio" name="event-type" value="externo" class="pull-left" />
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
<div id="map"></div><!-- #map -->
<?php
get_footer();
