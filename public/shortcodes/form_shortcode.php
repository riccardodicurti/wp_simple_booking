<?php

function create_wp_simple_booking_form( $atts = [], $content = null, $tag = '' ) {
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );
	
    $options = wp_simple_booking_get_dependencies();
	$options['thank_you_page'] = __('/thank-you-page/', 'wp_simple_booking' );

    $options = shortcode_atts( $options, $atts, $tag );

    $options['form_name'] = $options['form_name'] ?? 'RichiestaPreventivoDaSitoWeb';
    $options['js_bar_settings'] = json_decode( $options['js_bar_settings'] );

    ob_start();
    
    echo '<div id="sb-form-converto-container-s"></div>';
    echo '<script type="text/javascript">';
        echo '(function (i, s, o, g, r, a, m) {';
            echo 'i[\'SBSyncroBoxParam\'] = r; i[r] = i[r] || function () {';
                echo '(i[r].q = i[r].q || []).push(arguments)';
                echo '}, i[r].l = 1 * new Date(); a = s.createElement(o),';
                echo  'm = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)';
                echo "})(window, document, 'script', 'https://cdn.simplebooking.it/search-box-script.axd?IDA=" . esc_attr( $options['license_code'] ) . "','SBSyncroBox');";

        echo 'SBSyncroBox({';
            echo "CodLang: '" . esc_attr( $options['language_code'] ) . "',";
            echo 'Reference: "sbSyncroBox",';
            echo "MainContainerId: 'sb-form-converto-container-s,";
            echo "Styles: " . wp_json_encode( $options['js_bar_settings'], JSON_UNESCAPED_UNICODE ) . ",";
            echo "Converto: {";
                echo 'InPageContainerId: "sb-converto-container-s",';
                echo "ThankYouPage: '" . esc_url( $options['thank_you_page'] ) . "',";
                echo "FormName: '" . esc_attr( $options['form_name'] ) . "'";
            echo "}";
        echo '});';
    echo '</script>';

    
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode('wsb_form', 'create_wp_simple_booking_form');
