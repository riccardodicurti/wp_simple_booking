<?php

/**
 * Plugin Name:       Simple Booking for WordPress
 * Plugin URI:        https://github.com/riccardodicurti/wp_simple_booking
 * Description:       Simple Booking for WordPress is a plugin to simply add Simple Booking bar to your site
 * Version:           1.5
 * Author:            Riccardo Di Curti
 * Author URI:        https://riccardodicurti.it/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp_simple_booking
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function wp_simple_booking_acf_init() {
	if ( is_admin() ) {
		require_once 'admin/settings_customfields.php';
	}
}

function wp_simple_booking_get_sburl_by_license_code( $license_code, $language ) {
	return "https://www.simplebooking.it/ibe/search?hid={$license_code}&lang={$language}&cur=#";
}

function wp_simple_booking_get_richiediurl_by_license_code( $page_id, $language ) {
	return apply_filters( 'wpml_permalink', get_the_permalink( $page_id ), strtolower( $language ) );
}

function wp_simple_booking_get_dependencies() {
	global $post;
	$options = [];

	$wordpress_simple_booking_options = get_option( 'wordpress_simple_booking_option_name' );

	$options['mobile_theme_version'] = $wordpress_simple_booking_options['mobile_theme_version'] ?? '';
	$options['license_code'] = apply_filters( 'wp_simple_booking/wp_simple_booking_get_dependencies/default_license_code_0', $wordpress_simple_booking_options['default_license_code_0'] ?? '0000' );
	$options['availability_locale'] = $wordpress_simple_booking_options['default_availability_locale_1'] ?? '';
	$options['language_code'] = $wordpress_simple_booking_options['default_language_code_2'] ?? '';
	$options['js_bar_settings'] = $wordpress_simple_booking_options['js_bar_settings'] ?? '';

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

	$options['prenota_url'] = wp_simple_booking_get_sburl_by_license_code( $wordpress_simple_booking_options['default_license_code_0'], $options['language_code'] ); 
	$options['richiedi_url'] = wp_simple_booking_get_richiediurl_by_license_code( $wordpress_simple_booking_options['request_page_id'], $options['language_code'] ); 
	$options['prenota_label'] = __( 'Prenota', 'wp_simple_booking' ); 
	$options['richiedi_label'] = __( 'Richiedi', 'wp_simple_booking' );

	return $options;
}

function wp_simple_booking_enqueue_dependencies() {
	$options = wp_simple_booking_get_dependencies();
	$plugin_data = get_plugin_data(  __FILE__ ); 

	if ( $options['license_code'] != '0000' ) {
		wp_enqueue_style( 'wp_simple_booking_style', plugin_dir_url( __FILE__ ) . 'public/css/simple_booking_style.css', [] , $plugin_data['Version'] );
		wp_register_script( 'wp_simple_booking_scripts', plugin_dir_url( __FILE__ ) . 'public/js/simplebooking.js', [ 'jquery' ], $plugin_data['Version'], [ 'strategy'  => 'defer', 'in_footer' => true ] );

		wp_localize_script( 'wp_simple_booking_scripts', 'options', $options );
		wp_enqueue_script( 'wp_simple_booking_scripts' );
	}
}

function wp_simple_booking_admin_error_notice() {
	global $pagenow;

	if ( $pagenow == 'admin.php' && isset( $_GET['page'] ) && htmlspecialchars( wp_unslash( $_GET['page'] ) ) == 'wordpress-simple-booking' ) {
		$install_acf_url = get_site_url( null, '/wp-admin/plugin-install.php?s=Advanced%2520Custom%2520Fields&tab=search&type=term' );
		// translators: placeholder contain the acf plugin url
		printf( '<div class="notice error my-acf-notice is-dismissible"><p>' . __( 'Unlock more "WordPress Simple Booking" features installing <a href="%s">Advanced Custom Fields</a>', 'wp_simple_booking' ) . '.</p></div>', esc_url( $install_acf_url ) );
	}
}

function wp_simple_booking_init() {
	add_action( 'wp_enqueue_scripts', 'wp_simple_booking_enqueue_dependencies' );

	if ( is_admin() ) {
		require_once 'admin/settings_menupage.php';
	} else {
		require_once 'public/shortcodes/bar_shortcode.php';
		require_once 'public/shortcodes/form_shortcode.php';
	}

	if ( ! is_plugin_active( 'advanced-custom-fields/acf.php' ) && 
		 ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
		if ( is_admin() ) {
			add_action( 'admin_notices', 'wp_simple_booking_admin_error_notice' );
		}
	} else {
		add_action( 'acf/init', 'wp_simple_booking_acf_init' );
	}
}

add_action( 'init', 'wp_simple_booking_init' );
