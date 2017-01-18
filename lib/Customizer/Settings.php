<?php
namespace Cloud2PNG\Customizer;

class Settings {

	public static function add( \WP_Customize_Manager $manager ) {

		/**
		 * Image Size
		 */
		$manager->add_setting(
			'cloud2png[width]',
			array(
				'type'			=> 'option',
				'capability'	=> 'manage_options',
				'transport'     => 'postMessage',
				'default'		=> '400',
			)
		);

		$manager->add_setting(
			'cloud2png[height]',
			array(
				'type'			=> 'option',
				'capability'	=> 'manage_options',
				'transport'     => 'postMessage',
				'default'		=> '250',
			)
		);

		$manager->add_setting(
			'cloud2png[border_radius]',
			array(
				'type'			=> 'option',
				'capability'	=> 'manage_options',
				'transport'     => 'postMessage',
				'default'		=> '0',
			)
		);

		$manager->add_setting(
			'cloud2png[border_color]',
			array(
				'type'			=> 'option',
				'capability'	=> 'manage_options',
				'transport'     => 'postMessage',
				'default'		=> '#000000',
			)
		);

		$manager->add_setting(
			'cloud2png[border_width]',
			array(
				'type'			=> 'option',
				'capability'	=> 'manage_options',
				'transport'     => 'postMessage',
				'default'		=> '0',
			)
		);

		/**
		 * Settings
		 */

		$manager->add_setting(
			'cloud2png[cloud_name]',
			array(
				'type'			=> 'option',
				'capability'	=> 'manage_options',
				'transport'     => 'postMessage',
				'default'		=> '0',
				'validate_callback' => array( '\Cloud2PNG\Customizer\Validate', 'cloud_name' ),
			)
		);

		$manager->add_setting(
			'cloud2png[api_key]',
			array(
				'type'			=> 'option',
				'capability'	=> 'manage_options',
				'transport'     => 'postMessage',
				'default'		=> '0',
				'validate_callback' => array( '\Cloud2PNG\Customizer\Validate', 'api_key' ),
			)
		);
		$manager->add_setting(
			'cloud2png[api_secret]',
			array(
				'type'			=> 'option',
				'capability'	=> 'manage_options',
				'transport'     => 'postMessage',
				'default'		=> '0',
				'validate_callback' => array( '\Cloud2PNG\Customizer\Validate', 'api_secret' ),
			)
		);
		$manager->add_setting(
			'cloud2png[adminbar]',
			array(
				'type'			=> 'option',
				'capability'	=> 'manage_options',
				'transport'     => 'postMessage',
				'default'		=> false,
			)
		);

		return $manager;
	}
}
