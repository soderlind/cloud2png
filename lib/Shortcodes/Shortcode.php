<?php

namespace Cloud2PNG\Shortcodes;


if ( ! class_exists( 'Cloud2PNG\Shortcodes\Shortcode' ) ) {
	class Shortcode {
		/**
		 * Singleton from: from http://stackoverflow.com/a/15870364/1434155
		 */
		private static $instances = array();
		protected function __construct() {}
		protected function __clone() {}
		public function __wakeup() {
			throw new Exception( 'Cannot unserialize singleton' );
		}

		public static function instance() {
			$class = get_called_class(); // late-static-bound class name
			if ( ! isset( self::$instances[ $class ] ) ) {
				self::$instances[ $class ] = new static();
			}
			return self::$instances[ $class ];
		}

		public function init() {
			add_shortcode( 'cloud2png', array( $this, 'cloud2png' ) );
		}

		public function cloud2png( $attributes ) {
			// normalize attribute keys, lowercase
    		$attributes = array_change_key_case((array)$attributes, CASE_LOWER);
			$attributes = shortcode_atts( array(
				'url'           => home_url( '/' ),
				'width'         => \Cloud2PNG\Helper::get_option( 'width', 'cloud2png', '430' ),
				'height'        => \Cloud2PNG\Helper::get_option( 'height', 'cloud2png', '225' ),
				'border_width'  => \Cloud2PNG\Helper::get_option( 'border_width', 'cloud2png', '0' ),
				'border_radius' => \Cloud2PNG\Helper::get_option( 'border_radius', 'cloud2png', '0' ),
				'border_color'  => \Cloud2PNG\Helper::get_option( 'border_color', 'cloud2png', '#000000' ),
			), $attributes, 'cloud2png' );

			//harden attributes
			$attributes['url']           = esc_url_raw( $attributes['url'] );
			$attributes['width']         = (int) $attributes['width'];
			$attributes['height']        = (int) $attributes['height'];
			$attributes['border_width']  = (int) $attributes['border_width'];
			$attributes['border_radius'] = (int) $attributes['border_radius'];
			$attributes['border_color']  = \Cloud2PNG\Helper::esc_hex_color( $attributes['border_color'] );

			return $this->webshot( $attributes );
		}

		protected function webshot( $arguments ) {
			$cloud_name = \Cloud2PNG\Helper::get_option( 'cloud_name', 'cloud2png' );
			$api_key    = \Cloud2PNG\Helper::get_option( 'api_key', 'cloud2png' );
			$api_secret = \Cloud2PNG\Helper::get_option( 'api_secret', 'cloud2png' );

			if ( false !== \Cloud2PNG\Helper::is_valid_cloudinary_account( $cloud_name, $api_key, $api_secret ) ) {
				$border = array();
				if ( 0 !== $arguments['border_width'] ) {
					$border['border'] = array(
							'width' => $arguments['border_width'],
							'color' => $arguments['border_color'],
					);
				}

				$settings = array(
					'type'         => 'url2png',
					'crop'         => 'fill',
					'gravity'      => 'north',
					'fetch_format' => 'auto',
					'width'        => $arguments['width'],
					'height'       => $arguments['height'],
					'radius'       => $arguments['border_radius'],
					'sign_url'     => true,
				);

				// fix cloudinary radius bug (makes a radis even though radius = 0. so don't send radius parameter when it's 0)
				if ( 0 === $settings['radius'] ) {
					unset( $settings['radius'] );
				}

				if ( count( $border ) ) {
					$settings = array_merge( $settings, $border );
				}

				$img_width = $arguments['width'];
				$img_height = $arguments['height'];
				if ( 0 !== $arguments['border_width'] ) {
					$img_width = $img_width + ( $arguments['border_width'] * 2 );
					$img_height = $img_height + ( $arguments['border_width'] * 2 );
				}
				$url = $arguments['url'];
				// TODO: Responsive image
				// ob_start();
				// echo cl_image_tag( $url, $settings );
				// return ob_get_clean();

				return  sprintf( '<img src="%s" width="%s" height="%s" />', cloudinary_url( $arguments['url'], $settings ), $img_width, $img_height );
			}
		}


	}
}
