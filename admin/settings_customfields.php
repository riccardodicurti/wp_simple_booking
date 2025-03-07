<?php

if ( function_exists( 'acf_add_local_field_group' ) ) {

	$wordpress_simple_booking_options = get_option( 'wordpress_simple_booking_option_name' );

	// Verifica se le opzioni sono state caricate correttamente
	if ( ! $wordpress_simple_booking_options ) {
		return; // Esci se le opzioni non sono disponibili
	}

	$options['license_code']        = $wordpress_simple_booking_options['default_license_code_0'];
	$options['availability_locale'] = $wordpress_simple_booking_options['default_availability_locale_1'];
	$options['language_code']       = $wordpress_simple_booking_options['default_language_code_2'];

	// Funzione per aggiungere il gruppo di campi
	function add_acf_field_group( $options ) {
		acf_add_local_field_group( [
			'key'                   => 'group_5e71ee9724ba0',
			'title'                 => __( 'WORDPRESS SIMPLE BOOKING', 'wp_simple_booking' ),
			'fields'                => [
				[
					'key'               => 'field_5e71eefae37da',
					'label'             => __( 'license code', 'wp_simple_booking' ),
					'name'              => 'license_code',
					'type'              => 'number',
					'instructions'      => __( 'Enter the correct code for the simple booking license', 'wp_simple_booking' ),
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'default_value'     => $options['license_code'],
					'placeholder'       => $options['license_code'],
					'prepend'           => '',
					'append'            => '',
					'min'               => 0,
					'max'               => 9999,
					'step'              => 1,
				],
				[
					'key'               => 'field_5e71ef43e37db',
					'label'             => __( 'language code', 'wp_simple_booking' ),
					'name'              => 'language_code',
					'type'              => 'text',
					'instructions'      => __( 'Enter the correct language code of this page', 'wp_simple_booking' ),
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'default_value'     => $options['language_code'],
					'placeholder'       => $options['language_code'],
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

	// Chiamata alla funzione per aggiungere il gruppo di campi
	add_acf_field_group( $options );
}