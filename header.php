<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( ! get_option( 'site_icon' ) ) : ?>
		<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon" />
	<?php endif; ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<a id="skippy" class="sr-only sr-only-focusable" href="#content">
		<div class="container">
			<span class="skiplink-text"><?php _e( 'Skip to content', 'odin' ); ?></span>
		</div>
	</a>
	<?php get_template_part( 'parts/modal-como-pesquisar' );?>
	<?php get_template_part( 'parts/modal-lightbox' );?>
	<header id="header" role="banner">
		<div class="header-image">
			<?php
			$header_image = get_header_image();
			$home_url = home_url( '/' );
			if ( isset( $_GET[ 'embed'] ) ) {
				$home_url = home_url( '/?embed' );
			}
			if ( ! empty( $header_image ) ) :
			?>
				<a href="<?php echo esc_url( $home_url ); ?>">
					<img src="<?php echo esc_url( $header_image ); ?>" alt="<?php bloginfo( 'name' );?>" />
				</a>
			<?php endif; ?>
		</div><!-- .header-image -->
		<?php if ( ! isset( $_GET[ 'embed'] ) ) : ?>
		<div class="container-menu" id="header-size">
			<div class="col-md-12">

			<div id="main-navigation" class="navbar navbar-default">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-navigation">
					<span class="sr-only"><?php _e( 'Toggle navigation', 'odin' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand visible-xs-block" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</div>
				<nav class="collapse navbar-collapse navbar-main-navigation" role="navigation">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								'depth'          => 2,
								'container'      => false,
								'menu_class'     => 'nav navbar-nav',
								'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
								'walker'         => new Odin_Bootstrap_Nav_Walker()
							)
						);
					?>
				</nav><!-- .navbar-collapse -->
			</div><!-- #main-navigation-->
			<?php if ( $value = get_theme_mod( 'featured_btn_link', false ) ) : ?>
				<a href="<?php echo $value;?>" class="featured-btn">
					<?php echo get_theme_mod( 'featured_btn_txt', '' );?>
				</a>
			<?php endif;?>
		</div><!-- .col-md-12-->
	</div><!-- .container-menu -->
	<?php endif;?>
	</header><!-- #header -->
