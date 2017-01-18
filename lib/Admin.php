<?php
namespace Cloud2PNG;

class Admin extends \PluginCustomizer\Plugin_Customizer implements \PluginCustomizer\Plugin_Customizer_Interface {

	function __construct() {
		$this->template_root = plugin_dir_path( __FILE__ ) . 'Customizer/assets/';
		\PluginCustomizer\Plugin_Customizer::init( array(
			'name' => 'Cloud2PNG', // name your plugin
			'url'  => CLOUD2PNG_URL,
			'path' => CLOUD2PNG_PATH,
		) );
		$this->admin_menus();
	}

	public function admin_menus() {
		add_action( 'admin_bar_menu', array( new \Cloud2PNG\AdminMenu( $this ), 'add_admin_bar_customizer_url' ), 500 );
		add_action( 'admin_menu', array( new \Cloud2PNG\AdminMenu( $this ), 'register_sub_menu' ) );
	}

	/**
	 * Load default template
	 * Optionally load separate templates for the customizer sections.
	 *
	 * @author soderlind
	 * @version 1.0.0
	 */
	public function plugin_customizer_add_templates() {
		$cloud_name = \Cloud2PNG\Helper::get_option( 'cloud_name', 'cloud2png' );
		$api_key    = \Cloud2PNG\Helper::get_option( 'api_key', 'cloud2png' );
		$api_secret = \Cloud2PNG\Helper::get_option( 'api_secret', 'cloud2png' );

		if ( false !== \Cloud2PNG\Helper::is_valid_cloudinary_account( $cloud_name, $api_key, $api_secret ) ) {
			$default_template = \PluginCustomizer\Plugin_Customizer::template_url( 'customize' );
		} else {
			$default_template = \PluginCustomizer\Plugin_Customizer::template_url( 'settings' );
		}
		/**
		 * The default template used when opening the customizer
		 * @var array
		 */

		$default_url = array( 'url' => $default_template );
		/**
		 * Add a template to a section. key = section name, value = url to template.
		 *
		 * The last part, title and content in the exmple below, will translate to title.php
		 * and content.php in the templates folder.
		 */
		$section_urls = array(
			'cloud2png_section[image]' => \PluginCustomizer\Plugin_Customizer::template_url( 'customize' ),
			'cloud2png_section[settings]'  => \PluginCustomizer\Plugin_Customizer::template_url( 'settings' ),
		);
		\PluginCustomizer\Plugin_Customizer::add_templates( $default_url, $section_urls );
		// \PluginCustomizer\Plugin_Customizer::add_templates( $default_url );
	}

	/**
	 * Load the preview script. The script is needed sice the transport is postmessage
	 * @author soderlind
	 * @version 1.0.0
	 */
	public function plugin_customizer_previewer_postmessage_script() {

		$handle = 'boxshadow-css-hook';
		$src = plugins_url( 'Customizer/assets/js/boxshadow.js', __FILE__ );
		$deps = array( 'jquery' );
		$version = CLOUD2PNG_VERSION;
		$in_footer = 1;
		wp_enqueue_script( $handle, $src, $deps, $version , $in_footer );

		$handle = 'cloud2png-cusomizer-init';
		$src = plugins_url( 'Customizer/assets/js/plugin-customizer-init.js', __FILE__ );
		$deps = array( 'boxshadow-css-hook', 'customize-preview', 'jquery' );
		$version = CLOUD2PNG_VERSION;
		$in_footer = 1;
		wp_enqueue_script( $handle, $src, $deps, $version , $in_footer );
	}

	/**
	 * Customizer Sections, Settings & Controls
	 */

	/**
	 * Add sections.
	 *
	 * @author soderlind
	 * @version 1.0.0
	 * @param   WP_Customize_Manager $wp_customize
	 */
	public function customizer_plugin_sections( $wp_customize ) {
		global $wp_customize;

		$wp_customize = \Cloud2PNG\Customizer\Sections::add( $wp_customize );

		return true;
	}

	/**
	 * Add settings.
	 *
	 * @author soderlind
	 * @version 1.0.0
	 * @param   WP_Customize_Manager $wp_customize
	 */
	public function customizer_plugin_settings( $wp_customize ) {
		global $wp_customize;

		$wp_customize = \Cloud2PNG\Customizer\Settings::add( $wp_customize );

		return true;
	}

	/**
	 * Add contronls.
	 *
	 * @author soderlind
	 * @version 1.0.0
	 * @param   WP_Customize_Manager $wp_customize
	 */
	public function customizer_plugin_controls( $wp_customize ) {
		global $wp_customize;

		$wp_customize = \Cloud2PNG\Customizer\Controls::add( $wp_customize );

		return true;
	}
} // class
