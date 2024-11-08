<?php

if ( function_exists( 'acf_add_local_field_group' ) ) {

	$wordpress_simple_booking_options = get_option( 'wordpress_simple_booking_option_name' );

	$options['license_code']        = $wordpress_simple_booking_options['default_license_code_0'];
	$options['availability_locale'] = $wordpress_simple_booking_options['default_availability_locale_1'];
	$options['language_code']       = $wordpress_simple_booking_options['default_language_code_2'];

	acf_add_local_field_group( [
		'key'                   => 'group_5e71ee9724ba0',
		'title'                 => __( 'WORDPRESS SIMPLE BOOKING', 'wp_sb' ),
		'fields'                => [
			[
				'key'               => 'field_5e71eefae37da',
				'label'             => __( 'license code', 'wp_sb' ),
				'name'              => 'license_code',
				'type'              => 'number',
				'instructions'      => __( 'Enter the correct code for the simple booking license', 'wp_sb' ),
				'required'          => 1,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => $wordpress_simple_booking_options['default_license_code_0'],
				'placeholder'       => $wordpress_simple_booking_options['default_license_code_0'],
				'prepend'           => '',
				'append'            => '',
				'min'               => 0,
				'max'               => 9999,
				'step'              => 1,
			],
			[
				'key'               => 'field_5e71ef43e37db',
				'label'             => __( 'language code', 'wp_sb' ),
				'name'              => 'language_code',
				'type'              => 'text',
				'instructions'      => __( 'Enter the correct language code of this page', 'wp_sb' ),
				'required'          => 1,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => $wordpress_simple_booking_options['default_language_code_2'],
				'placeholder'       => $wordpress_simple_booking_options['default_language_code_2'],
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
		],
		'location'              => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'post',
				],
			],
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				],
			],
		],
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => 1,
		'description'           => '',
	] );
}