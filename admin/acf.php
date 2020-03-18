<?php

if( function_exists('acf_add_local_field_group') ) {

	acf_add_local_field_group(array(
		'key' => 'group_5e71ee9724ba0',
		'title' => 'WORDPRESS SIMPLE BOOKING',
		'fields' => array(
			array(
				'key' => 'field_5e71eefae37da',
				'label' => 'license code',
				'name' => 'license_code',
				'type' => 'number',
				'instructions' => 'Enter the correct code for the simple booking license',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '0000',
				'placeholder' => '0000',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => 9999,
				'step' => 1,
			),
			array(
				'key' => 'field_5e71ef43e37db',
				'label' => 'language code',
				'name' => 'language_code',
				'type' => 'text',
				'instructions' => 'Enter the correct language code of this page',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'en_EN',
				'placeholder' => 'en_EN',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				)
			),
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				)
			)
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
}