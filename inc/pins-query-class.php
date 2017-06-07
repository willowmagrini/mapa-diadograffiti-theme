<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}
	/**
	 *
	 * Pins Query
	 *
	 */
	class Pins_Query {
		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Initialize the class
		 */
		public function __construct() {
			// Query Pins
			add_action( 'wp_ajax_show_pins_json', array( &$this, 'show_pins_json' ) );
			add_action( 'wp_ajax_nopriv_show_pins_json', array( &$this, 'show_pins_json' ) );

			// Show Pin Post on click
			add_action( 'wp_ajax_open_pin', array( &$this, 'ajax_open_pin' ) );
			add_action( 'wp_ajax_nopriv_open_pin', array( &$this, 'ajax_open_pin' ) );

		}
		/**
		 * Return an instance of this class.
		 *
		 * @return object A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
		/**
		 * Get query args in browser query address
		 * @param string $vars
		 * @return array
		 */
		public function get_args_in_query_vars( $vars ) {
			// clear URL
			$vars = str_replace( get_home_url(), '', $vars );
			$vars = str_replace( array( '?', '/' ), '', $vars );
			$args = array(
				'posts_per_page' => -1,
				'post_type' => 'pins',
			);
			parse_str( $vars, $query );
			$args = array_merge( $args, $query );
			if ( isset( $query[ 'event-type'] ) && $query[ 'event-type'] == 'externo' ) {
				$args[ 'meta_query' ] = array(
					array(
						'key'     => 'event_type',
						'value'   => 'externo',
						'compare' => '='
					),
				);
			}
			if ( isset( $query[ 'by_artista' ] ) && is_array( $query[ 'by_artista' ] ) ) {
				$args[ 'tax_query' ] = array(
					array(
						'taxonomy' => 'artistas',
						'field'    => 'slug',
						'terms'    => $query[ 'by_artista' ]
						)
					);
			}
			return $args;
		}
		/**
		 * Query posts ( pins ) and return array with ID, lat, lng
		 * @param array $args
		 * @param bool $format_json
		 * @return array|string
		 */
		private function query( $args = array(), $format_json = true ) {
			$query_pins = new WP_Query( $args );
			$pins = array();
			if ( $query_pins->have_posts() ) {
				while( $query_pins->have_posts() ) {
					$query_pins->the_post();
					$id = get_the_ID();
					$post_parent = wp_get_post_parent_id( $id );
					if ( $post_parent > 0 ) {
						$id = $post_parent;
						$pins[ $id ][ 'children' ] = get_the_ID();
					}
					$map = get_post_meta( $id, 'map', true );
					if ( ! $map || empty( $map ) ) {
						continue;
					}
					if ( isset( $args[ 'by_year'] ) && ! empty( $args[ 'by_year'] ) ) {
						$year = intval( $args[ 'by_year' ] );
						$post_year = get_post_meta( $id, 'event_year', true );
						if ( ! $post_year || intval( $post_year ) != $year ) {
							$children_posts_args = array(
								'post_type'		=> 'pins',
								'post_parent'	=> $id,
								'meta_key'		=> 'event_year',
								'meta_value'	=> $year
							);
							$posts = get_posts( $children_posts_args );
							if ( ! $posts || count( $posts ) < 1 ) {
								unset( $posts );
								continue;
							}
							unset( $posts );
						}
					}
					$pins[ $id ][ 'lat' ] = $map[ 'lat' ];
					$pins[ $id ][ 'lng' ] = $map[ 'lng' ];
					$pins[ $id ][ 'post_id' ] = $id;
				}
				if ( $format_json == true ) {
					return json_encode( $pins );
				} else {
					return $pins;
				}
			} else {
				return false;
			}
		}
		/**
		 * Return infos to AJAX request
		 * @return bool
		 */
		public function show_pins_json() {
			$args = $this->get_args_in_query_vars( $_SERVER[ 'HTTP_REFERER' ] );
			$json_result = $this->query( $args, true );
			echo $json_result;
			wp_die();
		}
		/**
		 * Show pin on ajax request
		 * @return bool
		 */
		public function ajax_open_pin() {
			if ( ! isset( $_REQUEST[ 'post_id'] ) ) {
				return;
			}
			global $post;
			$args = $this->get_args_in_query_vars( $_SERVER[ 'HTTP_REFERER' ] );
			if ( isset( $args[ 'by_year'] ) && ! empty( $args[ 'by_year' ] ) ) {
				if ( ! isset( $_REQUEST[ 'years'] ) ) {
					$_REQUEST[ 'years' ] = array( $args[ 'by_year'] );
				}
			}
			$post = get_post( $_REQUEST[ 'post_id' ] );
			if ( $post ) {
				get_template_part( 'content/single-pin' );
			}
			wp_die();
		}
	}
	$pins_query = Pins_Query::get_instance();
