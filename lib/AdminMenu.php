<?php
namespace Cloud2PNG;

if ( ! class_exists( 'Cloud2PNG\AdminMenu' ) ) {
	class AdminMenu {

		private $plugin_customizer;

		function __construct( \PluginCustomizer\Plugin_Customizer $plugin_customizer ) {
			$this->plugin_customizer = $plugin_customizer;
		}
		/**
		* Create submenu
		* @author soderlind
		* @version 1.0.0
		*/
		public static function register_sub_menu() {
			add_options_page( __( 'Cloud2PNG', 'cloud2png' ), __( 'Cloud2PNG', 'cloud2png' ), 'manage_options', 'cloud2png-template', '__return_null'
			);
			$this->add_sub_menu_customizer_url();
		}

		/**
		* Replace the 'plugin-template' string, in the submenu added by register_sub_menu(),
		* with the customizer url.
		*
		* @link http://wordpress.stackexchange.com/a/131214/14546
		*
		* @author soderlind
		* @version 1.0.0
		*/
		protected function add_sub_menu_customizer_url( $parent = 'options-general.php' ) {
			global $submenu;

			if ( ! isset( $submenu[ $parent ] ) ) {
				return;
			}
			foreach ( $submenu[ $parent ] as $k => $d ) {
				if ( 'cloud2png-template' == $d['2'] ) {
					$submenu[ $parent ][ $k ]['2'] = $this->plugin_customizer->get_customizer_url( $parent );
					break;
				}
			}
		}

		/**
		* [add_admin_bar_customizer_url description]
		* @author soderlind
		* @version 1.0.0
		* @param   [type]	$wp_admin_bar [description]
		*/
		public function add_admin_bar_customizer_url( $wp_admin_bar ) {
			global $post;
			if ( Helper::get_option( 'adminbar', 'cloud2png' ) ) {
				if ( is_admin() ) {
					$return_url = self::_get_current_admin_page_url();
				} elseif ( is_object( $post ) ) {
					$return_url = get_permalink( $post->ID );
				} else {
					$return_url = esc_url( home_url( '/' ) );
				}
				$args = array(
				   'id'    => 'plugin-customizer-link2',
				   'title' => __( 'Cloud2PNG', 'cloud2png' ),
				   'href'  => $this->plugin_customizer->get_customizer_url( $return_url, 'cloud2png_section[image]' ),
				);

				$wp_admin_bar->add_node( $args );
			}
		}

		/**
		 * Find the current admin url.
		 *
		 * @link https://core.trac.wordpress.org/ticket/27888
		 *
		 * @author soderlind
		 * @version 1.0.0
		 * @return  String|Bool    The URL to the current admin page, or false if not in wp-admin.
		 */
		protected function _get_current_admin_page_url() {
			if ( ! is_admin() ) {
				return false;
			}
			global $pagenow;

			$url = $pagenow;
			$query_string = $_SERVER['QUERY_STRING'];

			if ( ! empty( $query_string ) ) {
				$url .= '?' . $query_string;
			}
			return $url;
		}
	}
}
