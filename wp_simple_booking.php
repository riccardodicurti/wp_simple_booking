<?php

/**
 * Plugin Name:       WordPress Simple Booking
 * Plugin URI:        https://github.com/riccardodicurti/wp_simple_booking
 * GitHub Plugin URI: riccardodicurti/wp_simple_booking
 * Description:       WordPress Simple Booking is a plugin to simply add Simple Booking bar to your WordPress site
 * Version:           1.4
 * Author:            Riccardo Di Curti
 * Author URI:        https://riccardodicurti.it/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rdc_wsb
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function rdc_wsb_acf_init() {
	if ( is_admin() ) {
		require_once 'admin/settings_customfields.php';
	}
}

function rdc_wsb_get_dependencies() {
	global $post;
	$options = [];

	$wordpress_simple_booking_options = get_option( 'wordpress_simple_booking_option_name' );

	$options['mobile_theme_version'] = $wordpress_simple_booking_options['mobile_theme_version'];
	$options['license_code'] = $wordpress_simple_booking_options['default_license_code_0'];
	$options['availability_locale'] = $wordpress_simple_booking_options['default_availability_locale_1'];
	$options['language_code'] = $wordpress_simple_booking_options['default_language_code_2'];
	$options['js_bar_settings'] = $wordpress_simple_booking_options['js_bar_settings'];

	$options['prenota_url'] = __( '/prenota', 'rdc_wsb' ); 
	$options['richiedi_url'] = __( '/richiedi', 'rdc_wsb' ); 
	$options['prenota_label'] = __( 'Prenota', 'rdc_wsb' ); 
	$options['richiedi_label'] = __( 'Richiedi', 'rdc_wsb' ); 

	if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		$options['language_code'] = strtoupper( defined( 'ICL_LANGUAGE_CODE' ) );
	}

	if ( apply_filters( 'wpml_current_language', NULL ) ) {
		$options['language_code'] = strtoupper(  apply_filters( 'wpml_current_language', NULL ) );
	}

	if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
		$options['license_code']  = get_field( 'license_code', $post->ID ) ?: $options['license_code'];
		$options['language_code'] = strtoupper( get_field( 'language_code', $post->ID ) ) ?: $options['language_code'];
	}

	return $options;
}

function rdc_wsb_enqueue_dependencies() {
	$options = rdc_wsb_get_dependencies();

	if ( $options['license_code'] ) {
		wp_enqueue_style( 'rdc_wsb_style', plugin_dir_url( __FILE__ ) . 'public/css/simple_booking_style.css' );
		wp_register_script( 'rdc_wsb_scripts', plugin_dir_url( __FILE__ ) . 'public/js/simplebooking.js', [ 'jquery' ], false, true );

		wp_localize_script( 'rdc_wsb_scripts', 'options', $options );
		wp_enqueue_script( 'rdc_wsb_scripts' );
	}
}

function rdc_wsb_admin_error_notice() {
	global $pagenow;

	if ( $pagenow == 'admin.php' && isset( $_GET['page'] ) && htmlspecialchars( $_GET['page'] ) == 'wordpress-simple-booking' ) {
		$install_acf_url = get_site_url( null, '/wp-admin/plugin-install.php?s=Advanced%2520Custom%2520Fields&tab=search&type=term' );
		printf( '<div class="notice error my-acf-notice is-dismissible"><p>' . __( 'Unlock more "WordPress Simple Booking" features installing <a href="%s">Advanced Custom Fields</a>', 'rdc_wsb' ) . '.</p></div>', $install_acf_url );
	}
}

function rdc_wsb_init() {
	add_action( 'wp_enqueue_scripts', 'rdc_wsb_enqueue_dependencies' );

	if ( is_admin() ) {
		require_once 'admin/settings_menupage.php';
	} else {
		require_once 'public/shortcodes/bar_shortcode.php';
		require_once 'public/shortcodes/form_shortcode.php';
	}

	if ( ! is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
		if ( is_admin() ) {
			add_action( 'admin_notices', 'rdc_wsb_admin_error_notice' );
		}
	} else {
		add_action( 'acf/init', 'rdc_wsb_acf_init' );
	}
}

add_action( 'init', 'rdc_wsb_init' );