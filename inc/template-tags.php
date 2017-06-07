<?php
/**
 * Custom template tags for Odin.
 *
 * @package Odin
 * @since 2.2.0
 */

if ( ! function_exists( 'odin_classes_page_full' ) ) {

	/**
	 * Classes page full.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_full() {
		return 'col-md-12';
	}
}

if ( ! function_exists( 'odin_classes_page_sidebar' ) ) {

	/**
	 * Classes page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_sidebar() {
		return 'col-md-9';
	}
}

if ( ! function_exists( 'odin_classes_page_sidebar_aside' ) ) {

	/**
	 * Classes aside of page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_sidebar_aside() {
		return 'col-md-3 hidden-xs hidden-print widget-area';
	}
}

if ( ! function_exists( 'odin_posted_on' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 */
	function odin_posted_on() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post">' . __( 'Sticky', 'odin' ) . ' </span>';
		}

		// Set up and print post meta information.
		printf( '<span class="entry-date">%s <time class="entry-date" datetime="%s">%s</time></span> <span class="byline">%s <span class="author vcard"><a class="url fn n" href="%s" rel="author">%s</a></span>.</span>',
			__( 'Posted in', 'odin' ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			__( 'by', 'odin' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}
}

if ( ! function_exists( 'odin_paging_nav' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 */
	function odin_paging_nav() {
		$mid  = 2;     // Total of items that will show along with the current page.
		$end  = 1;     // Total of items displayed for the last few pages.
		$show = false; // Show all items.

		echo odin_pagination( $mid, $end, false );
	}
}

function get_posts_order_by_year( $post_parent ) {
	$posts = array();
	$args = Pins_Query::get_instance()->get_args_in_query_vars( $_SERVER[ 'HTTP_REFERER'] );

	$post_parent = intval( $post_parent );
	if ( has_term( $args[ 'by_artista' ], 'artistas', $post_parent ) ) {
		if ( $post_parent_year = get_post_meta( $post_parent, 'event_year', true ) ) {
			$post_parent_year = intval( $post_parent_year );
			$posts[ $post_parent_year ] = $post_parent;
		}
	}
	$posts_years = get_posts(
		array(
			'post_parent' => $post_parent,
			'post_type' => 'pins',
			'tax_query' => array(
				array(
					'taxonomy' => 'artistas',
					'field'    => 'slug',
					'terms'    => $args[ 'by_artista' ],
				),
			)
		)
	);
	if ( $posts_years ) {
		foreach ( $posts_years as $post_year ) {
			if ( $year = get_post_meta( $post_year->ID, 'event_year', true ) ) {

				$year = intval( $year );
				$posts[ $year ] = $post_year->ID;
			}
		}
	}
	if ( ! empty( $posts ) ) {
		krsort( $posts );
	}
	return $posts;
}

function the_artistas_list( $posts ) {
	$artistas = array();
	$html = '';
	if ( ! isset( $_REQUEST[ 'years'] ) ) {
		$current = key( $posts );
	}
	$url = home_url( '/?by_artista[]=' );
	if ( ! empty( $posts ) ) {
		foreach ( $posts as $year => $post_id ) {
			if ( isset( $_REQUEST[ 'years'] ) && ! in_array( $year, $_REQUEST[ 'years' ] ) ) {
				continue;
			}
			if ( ! isset( $_REQUEST[ 'years'] ) && $current != $year ) {
				continue;
			}

			$current_artistas = wp_get_object_terms( array( $post_id ), array( 'artistas' ), array() );
			foreach( $current_artistas as $term ) {
				$artistas[ $term->term_id ] = array(
					'name'	=> $term->name,
					'url'	=> $url . $term->slug
				);
			}
		}
	}
	$link = '<a href="%s" title="' . __( 'Pesquisar mais obras desse artista', 'odin' ) . '">%s</a>';
	if ( ! empty( $artistas ) ) {
		$i = 0;
		foreach ( $artistas as $term ) {
			if ( $i == 0 ) {
				$html .= sprintf( $link, $term[ 'url'], $term[ 'name'] );
			} else {
				$html .= ', ' . sprintf( $link, $term[ 'url'], $term[ 'name'] );
			}
			$i++;
		}
	}
	echo $html;
}
