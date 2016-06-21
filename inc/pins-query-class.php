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
			add_action( 'wp_ajax_show_pins_json', array( &$this, 'show_pins_json' ) );
			add_action( 'wp_ajax_nopriv_show_pins_json', array( &$this, 'show_pins_json' ) );
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
		private function get_args_in_query_vars( $vars ) {
			// clear URL
			$vars = str_replace( get_home_url(), '', $vars );
			$vars = str_replace( array( '?', '/' ), '', $vars );
			$args = array(
				'posts_per_page' => -1,
				'post_type' => 'pins'
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
					$map = get_post_meta( $id, 'map', true );
					if ( ! $map || empty( $map ) ) {
						continue;
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

	}
	new Pins_Query();
