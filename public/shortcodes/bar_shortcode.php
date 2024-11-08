<?php

function create_wp_simple_booking_bar( $atts = [], $content = null, $tag = '' ) {
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );

    $options = wp_simple_booking_get_dependencies();
    
    $options = shortcode_atts( $options, $atts, $tag );

    $options['js_bar_settings'] = json_encode( json_decode( $options['js_bar_settings'] ), JSON_UNESCAPED_UNICODE );

    ob_start();
    
    echo '<div id="sb-container-s"></div>';
    echo '<script type="text/javascript">';
        echo '(function (i, s, o, g, r, a, m) {';
            echo 'i[\'SBSyncroBoxParam\'] = r; i[r] = i[r] || function () {';
                echo '(i[r].q = i[r].q || []).push(arguments)';
                echo '}, i[r].l = 1 * new Date(); a = s.createElement(o),';
                echo  'm = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)';
                echo "})(window, document, 'script', 'https://cdn.simplebooking.it/search-box-script.axd?IDA={$options['license_code']}','SBSyncroBox');";

        echo 'SBSyncroBox({';
            echo "CodLang: '{$options['language_code']}',";
            echo "MainContainerId: 'sb-container-s',";
            echo "Styles: {$options['js_bar_settings']},";
        echo '});';
    echo '</script>';

    
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode('wsb_bar', 'create_wp_simple_booking_bar');
