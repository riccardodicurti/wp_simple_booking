<?php

/**
 * Plugin Name:       WordPress Simple Booking
 * Plugin URI:        https://github.com/riccardodicurti/wp_simple_booking
 * GitHub Plugin URI: riccardodicurti/wp_simple_booking
 * Description:       WordPress 
 * Version:           20200318
 * Author:            Riccardo Di Curti
 * Author URI:        https://riccardodicurti.it/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rdc_wsb
 * Domain Path:       /languages
 */

function rdc_wsb_enqueue_dependencies() {
    global $post;

    wp_enqueue_style( 'rdc_wsb_style', plugin_dir_url( __FILE__ ) . 'public/css/simple_booking_style.css');
    
    if( get_field('license_code', $post->ID) ){
        wp_register_script( 'rdc_wsb_scripts', plugin_dir_url( __FILE__ ) . 'public/js/simplebooking.js', array( 'jquery' ), false, true);

        $options = get_option( 'rdc_wsb_options' );
        $availability_locale = __( 'CHECK AVAILABILITY', 'genpress' );
        
        if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
            $language_code = strtoupper(ICL_LANGUAGE_CODE);
        } else {
            $language_code = strtoupper(get_field('language_code', $post->ID));
        } 

        $options['codice'] = get_field('license_code', $post->ID);
        $options['availability_locale'] = $availability_locale;
        $options['language_code'] = $language_code;

        update_option( 'rdc_wsb_options', $options );

        wp_localize_script( 'rdc_wsb_scripts', 'options', $options );
        wp_enqueue_script( 'rdc_wsb_scripts' );
    }  
}
add_action( 'wp_enqueue_scripts', 'rdc_wsb_enqueue_dependencies');


// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', plugin_dir_path( __FILE__ ) . '/admin/advanced-custom-fields/' );
define( 'MY_ACF_URL', plugin_dir_url( __FILE__ )  . '/admin/advanced-custom-fields/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    // TODO: rimettere a true appena finito di sviluppare.
    return false;
}

if( class_exists('acf') ) {
	include_once(plugin_dir_path( __FILE__ ) . '/admin/acf.php');
}