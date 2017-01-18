<?php
namespace Cloud2PNG\Customizer;

class Controls {

	public static function add( \WP_Customize_Manager $manager ) {

		/**
		 * Image Size
		 */

		$manager->add_control( new \Cloud2PNG\Customizer\CustomControls\Customizer_RangeValue_Control( $manager, 'width', array(
		    'type'     => 'range-value',
		    'section'  => 'cloud2png_section[image]',
		    'settings' => 'cloud2png[width]',
		    'label'    => __( 'Width', 'cloud2png' ),
		    'input_attrs' => array(
		        'min'     => 5,
		        'max'     => 1000,
		        'step'    => 5,
				'suffix'  => 'px',
		    ),
		) ) );

		$manager->add_control( new \Cloud2PNG\Customizer\CustomControls\Customizer_RangeValue_Control( $manager, 'height', array(
		    'type'     => 'range-value',
		    'section'  => 'cloud2png_section[image]',
		    'settings' => 'cloud2png[height]',
		    'label'    => __( 'Height', 'cloud2png' ),
		    'input_attrs' => array(
		        'min'     => 5,
		        'max'     => 1000,
		        'step'    => 5,
				'suffix'  => 'px',
		    ),
		) ) );

		$manager->add_control( new \Cloud2PNG\Customizer\CustomControls\Customizer_RangeValue_Control( $manager, 'border_width', array(
			'type'     => 'range-value',
			'section'  => 'cloud2png_section[image]',
			'settings' => 'cloud2png[border_width]',
			'label'    => __( 'Border Width', 'cloud2png' ),
			'input_attrs' => array(
				 'min'     => 0,
				 'max'     => 50,
				 'step'    => 1,
				 'suffix'  => 'px',
			 ),
		) ) );

		$manager->add_control( new \Cloud2PNG\Customizer\CustomControls\Customizer_RangeValue_Control( $manager, 'radius', array(
		    'type'     => 'range-value',
		    'section'  => 'cloud2png_section[image]',
		    'settings' => 'cloud2png[border_radius]',
		    'label'    => __( 'Border Radius', 'cloud2png' ),
		    'input_attrs' => array(
		        'min'     => 0,
		        'max'     => 100,
		        'step'    => 1,
				'suffix'  => 'px',
		    ),
		) ) );

		$manager->add_control( new \WP_Customize_Color_Control( $manager, 'border_color', array(
			'label' => __( 'Border Color', 'cloud2png' ),
			'section'  => 'cloud2png_section[image]',
			'settings' => 'cloud2png[border_color]',
		) ) );

		/**
		 * Settings
		 */

		$manager->add_control(  new \WP_Customize_Control(
			$manager,
			'domain',
			array(
				'label'    => __( 'Cloud Name', 'cloud2png' ),
				'type'     => 'text',
				'section'  => 'cloud2png_section[settings]',
				'settings' => 'cloud2png[cloud_name]',
			)
		) );

		$manager->add_control(  new \WP_Customize_Control(
			$manager,
			'key',
			array(
				'label'    => __( 'API Key', 'cloud2png' ),
				'type'     => 'text',
				'section'  => 'cloud2png_section[settings]',
				'settings' => 'cloud2png[api_key]',
			)
		) );

		$manager->add_control(  new \WP_Customize_Control(
			$manager,
			'secret',
			array(
				'label'    => __( 'API Secret', 'cloud2png' ),
				'type'     => 'text',
				'section'  => 'cloud2png_section[settings]',
				'settings' => 'cloud2png[api_secret]',
			)
		) );

		$manager->add_control(  new \WP_Customize_Control(
			$manager,
			'adminbar',
			array(
				'label'    => __( 'Add to admin bar', 'cloud2png' ),
				'type'     => 'checkbox',
				'description' => __( 'Add the Cloud2PNG customize link to the admin bar.', 'cloud2png' ),
				'section'  => 'cloud2png_section[settings]',
				'settings' => 'cloud2png[adminbar]',
			)
		) );

		return $manager;
	}
}
