<?php
namespace Cloud2PNG\Customizer;

class Sections {

	public static function add( \WP_Customize_Manager $manager ) {
		$manager->add_section(
			'cloud2png_section[image]',
			array(
				'title'			=> __( 'Image', 'cloud2png' ),
				'description'	=> __( 'Customize your Cloud2PNG image', 'cloud2png' ),
				'priority'		=> 5,
				'capability'	=> 'manage_options',
			)
		);
		$manager->add_section(
			'cloud2png_section[settings]',
			array(
				'title'			=> __( 'Settings', 'cloud2png' ),
				'priority'		=> 15,
				'capability'	=> 'manage_options',
			)
		);

		return $manager;
	}
}
