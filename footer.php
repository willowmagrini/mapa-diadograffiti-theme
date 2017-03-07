<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>
<?php if ( ! isset( $_GET[ 'embed'] ) ) : ?>
	<footer id="footer-container" class="col-md-12">
		<span class="icon"></span>
		<div class="col-md-12 footer-open text-center" data-open="false">
			<h3><?php _e( 'Clique e veja quem apoia esse projeto', 'odin');?></h3>
		</div><!-- .col-md-12 footer-open -->
		<div class="footer-toggle col-md-12">
			<div class="container">
				<div class="row">
					<?php for ( $i = 1; $i < 5; $i++ ) : ?>
						<?php $option_img = sprintf( 'apoiador_img_%s', $i );?>
						<?php $option_link = sprintf( 'apoiador_link_%s', $i );?>
						<?php if ( $value = get_theme_mod( $option_img, false ) ) : ?>
							<a href="<?php echo get_theme_mod( $option_link, '#' );?>">
								<img src="<?php echo $value;?>"/>
							</a>
						<?php endif;?>
					<?php endfor;?>
				</div><!-- .row -->
			</div><!-- .container -->
			<div class="col-md-12 text-center madewith">
				<?php printf( __( 'Feito com <i class="fa fa-heart" aria-hidden="true"></i> amor e <a href="%s"><i class="fa fa-wordpress" aria-hidden="true"></i> WordPress</a> pela <a href="%s">Brasa.art.br</a>. Publicado sob licença GPL v2 no <a href="%s"><i class="fa fa-github" aria-hidden="true"></i> GitHub</a>', 'odin' ), 'https://wordpress.org', 'https://brasa.art.br', 'https://github.com/brasadesign/mapa-diadograffiti-theme/' );?>
			</div><!-- .col-md-12 text-center madewith -->
		</div><!-- .footer-toggle -->
	</footer><!-- #footer-container -->
<?php endif;?>
<?php wp_footer(); ?>
</body>
</html>
