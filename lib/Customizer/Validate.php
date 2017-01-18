<?php
namespace Cloud2PNG\Customizer;
// use Exception; // catch exceptions across namespaces

if ( ! class_exists( '\Cloud2PNG\Customizer\Validate' ) ) {
	class Validate {
		public static function cloud_name( $validity, $value ) {
			if ( \Cloud2PNG\Helper::get_option( 'api_key', 'cloud2png' ) && \Cloud2PNG\Helper::get_option( 'api_secret', 'cloud2png' ) ) {
				try {
					\Cloudinary::config(array(
						'cloud_name' => $value,
						'api_key'    => \Cloud2PNG\Helper::get_option( 'api_key', 'cloud2png' ),
						'api_secret' => \Cloud2PNG\Helper::get_option( 'api_secret', 'cloud2png' ),
					));
					$api = new \Cloudinary\Api();
				    $result = $api->ping();
				} catch ( \Exception $e ) {
					$validity->add( 'required', $e->getMessage() );
				}
			}
			return $validity;
		}
		public static function api_key( $validity, $value ) {
			if ( \Cloud2PNG\Helper::get_option( 'cloud_name', 'cloud2png' ) && \Cloud2PNG\Helper::get_option( 'api_secret', 'cloud2png' ) ) {
				try {
					\Cloudinary::config(array(
						'cloud_name' => \Cloud2PNG\Helper::get_option( 'cloud_name', 'cloud2png' ),
						'api_key'    => $value,
						'api_secret' => \Cloud2PNG\Helper::get_option( 'api_secret', 'cloud2png' ),
					));
					$api = new \Cloudinary\Api();
				    $result = $api->ping();
				} catch ( \Exception $e ) {
					$validity->add( 'required', $e->getMessage() );
				}
			}
			return $validity;
		}
		public static function api_secret( $validity, $value ) {
			if ( \Cloud2PNG\Helper::get_option( 'cloud_name', 'cloud2png' ) && \Cloud2PNG\Helper::get_option( 'api_key', 'cloud2png' ) ) {
				try {
					\Cloudinary::config(array(
						'cloud_name' => \Cloud2PNG\Helper::get_option( 'cloud_name', 'cloud2png' ),
						'api_key'    => \Cloud2PNG\Helper::get_option( 'api_key', 'cloud2png' ),
						'api_secret' => $value,
					));
					$api = new \Cloudinary\Api();
				    // $result = $api->ping();
					$usage_obj = $api->usage();
					$usage = self::get_array( $usage_obj );
					// if ( ! isset( $usage['url2png'] ) ) {
					// 	return new \WP_Error( 'error', '<a href="https://cloudinary.com/console/addons#url2png" target="_blank">URL2PNG add-on</a> not enabled' );
					// }
				} catch ( \Exception $e ) {
					$validity->add( 'required', $e->getMessage() );
				}
			}
			return $validity;
		}

		/**
		 * Take an ArrayObject and turn it into an associative array
		 *
		 * @link http://stackoverflow.com/a/16091221/1434155
		 * @param ArrayObject $obj
		 *
		 * @return array
		 */
		protected static function get_array( $obj ) {
		    $array  = array(); // noisy $array does not exist
		    $arr_obj = is_object( $obj ) ? get_object_vars( $obj ) : $obj;
		    foreach ( $arr_obj as $key => $val ) {
		        $val = (is_array( $val ) || is_object( $val )) ? self::get_array( $val ) : $val;
		        $array[ $key ] = $val;
		    }
		    return $array;
		}
	}
}
