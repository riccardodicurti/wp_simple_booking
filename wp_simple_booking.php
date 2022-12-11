<?php

/**
 * Plugin Name:       WordPress Simple Booking
 * Plugin URI:        https://github.com/riccardodicurti/wp_simple_booking
 * GitHub Plugin URI: riccardodicurti/wp_simple_booking
 * Description:       WordPress Simple Booking è un plugin per aggiungere comodamente la barra di Simple Booking al tuo sito WordPress
 * Version:           1.0.1
 * Author:            Riccardo Di Curti
 * Author URI:        https://riccardodicurti.it/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rdc_wsb
 * Domain Path:       /languages
 */

function rdc_wsb_init()
{
    add_action('wp_enqueue_scripts', 'rdc_wsb_enqueue_dependencies');

    if (is_admin()) {
        require_once 'admin/settings.php';
    }
}


function rdc_wsb_enqueue_dependencies()
{
    global $post;

    if (get_field('license_code', $post->ID)) {
        wp_enqueue_style('rdc_wsb_style', plugin_dir_url(__FILE__) . 'public/css/simple_booking_style.css');
        wp_register_script('rdc_wsb_scripts', plugin_dir_url(__FILE__) . 'public/js/simplebooking.js', array('jquery'), false, true);

        $options = get_option('rdc_wsb_options');
        $availability_locale = __('Check availability', 'rdc_wsb');

        if (defined('ICL_LANGUAGE_CODE')) {
            $language_code = strtoupper(ICL_LANGUAGE_CODE);
        } else {
            $language_code = strtoupper(get_field('language_code', $post->ID));
        }

        $options['license_code'] = get_field('license_code', $post->ID);
        $options['availability_locale'] = $availability_locale;
        $options['language_code'] = $language_code;

        // update_option('rdc_wsb_options', $options);

        wp_localize_script('rdc_wsb_scripts', 'options', $options);
        wp_enqueue_script('rdc_wsb_scripts');
    }
}

function rdc_wsb_admin_error_notice()
{
    $install_acf_url = get_site_url(null, '/wp-admin/plugin-install.php?s=Advanced%2520Custom%2520Fields&tab=search&type=term');
    printf('<div class="notice error my-acf-notice is-dismissible"><p>' . __('"WordPress Simple Booking" needs <a href="%s">Advanced Custom Fields</a> attivo per funzionare', 'rdc_wsb') . ' to work.</p></div>', $install_acf_url);
}

if (!is_plugin_active('advanced-custom-fields/acf.php')) {

    if (is_admin()) {
        add_action('admin_notices', 'rdc_wsb_admin_error_notice');
    }

} else {
    add_action('acf/init', 'rdc_wsb_init');
}
