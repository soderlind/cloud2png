<?php
namespace Cloud2PNG;

if ( ! class_exists( 'Cloud2PNG\Helper' ) ) {
	class Helper {

		protected function __construct() {}
		/**
		 * Get the value of a settings field
		 *
		 * @param string  $option  settings field name
		 * @param string  $section the section name this field belongs to
		 * @param string  $default default text if it's not found
		 * @return string
		 */
		public static function get_option( $option, $section, $default = '' ) {

			$options = get_option( $section );

			if ( isset( $options[ $option ] ) ) {
				return $options[ $option ];
			}

			return $default;
		}

		public static function is_valid_cloudinary_account( $cloud_name, $api_key, $api_secret ) {

			// TODO: Add transient

			try {
				\Cloudinary::config(array(
					'cloud_name' => $cloud_name,
					'api_key'    => $api_key,
					'api_secret' => $api_secret,
				));
				$api = new \Cloudinary\Api();
				$result = $api->ping();
			} catch ( \Exception $e) {
				return false;
			}
			return true;
		}
	}
}
