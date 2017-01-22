<?php
/**
 * Cloud2PNG
 *
 * @package     Cloud2PNG
 * @author      Per Soderlind
 * @copyright   2017 Per Soderlind
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Cloud2PNG
 * Plugin URI:  https://github.com/soderlind/cloud2png
 * Description: Capture snapshots of any website using Cloudinarys URL2PNG add-on.
 * Version: 1.0.1
 * Author:      Per Soderlind
 * Author URI:  https://soderlind.no
 * Text Domain: cloud2png
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
if ( version_compare( PHP_VERSION, '5.6.0' ) < 0 ) {
	return add_action( 'admin_notices', 'cloud2png_admin_notice_php_version' );
}
define( 'CLOUD2PNG_VERSION', '1.0.1' );
define( 'CLOUD2PNG_PATH',   plugin_dir_path( __FILE__ ) );
define( 'CLOUD2PNG_URL',   plugin_dir_url( __FILE__ ) );

// Add the PHP extension for Cloudinary
require_once  CLOUD2PNG_PATH . 'lib/cloudinary/Cloudinary.php';
require_once  CLOUD2PNG_PATH . 'lib/cloudinary/Api.php';
Cloudinary::$USER_PLATFORM = 'Cloud2PNG/' . CLOUD2PNG_VERSION . ' github.com/soderlind/cloud2png'; // @codingStandardsIgnoreLine

// add autoloader
require_once CLOUD2PNG_PATH . 'inc/ps-auto-loader.php';
$class_loader = new PS_Auto_Loader();
$class_loader->addNamespace( 'Cloud2PNG', CLOUD2PNG_PATH . 'lib' );
$class_loader->addNamespace( 'PluginCustomizer', CLOUD2PNG_PATH . 'lib/plugin-customizer' );
$class_loader->register();

//launch the plugin
if ( defined( 'WPINC' ) ) {
	$GLOBALS['cloud_to_png_admin'] = Cloud2PNG\Admin::instance();

	add_action(	'plugins_loaded', function() {
		$GLOBALS['cloud_to_png_shortcode'] = Cloud2PNG\Shortcodes\Shortcode::instance();
		$GLOBALS['cloud_to_png_shortcode']->init();
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), function( $links ) {
			$settings_links = array(
				sprintf( '<a href="%s">%s</a>',  $GLOBALS['cloud_to_png_admin']->get_customizer_url( 'plugins.php', 'cloud2png_section[settings]' ), __( 'Settings', 'cloud2png' ) )
			);
			return array_merge( $links, $settings_links );
		} );
	} );
}

function cloud2png_admin_notice_php_version() {
	$msg[] = '<div class="notice notice-error"><p>';
	$msg[] = '<strong>Cloud2PNG</strong>: Your current PHP version is <strong>' . PHP_VERSION . '</strong>, please upgrade PHP at least to version 5.6 (PHP 7.0 or greater is reccomended). ';
	$msg[] = '<a href="https://wordpress.org/about/requirements/">Ask</a> your hosting provider for an upgrade.';
	$msg[] = '</p></div>';
	deactivate_plugins( plugin_basename( __FILE__ ) );
	echo implode( PHP_EOL, $msg );
	// disable the "Plugin activated." message by unsetting $_GET['activate']
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
}
