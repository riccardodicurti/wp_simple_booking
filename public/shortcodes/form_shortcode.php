<?php

function create_wsb_form( $atts = [], $content = null, $tag = '' ) {
	
	// normalize attribute keys, lowercase
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );
	
    $options = rdc_wsb_get_dependencies();
	$options['thank_you_page'] = __('/thank-you-page/', 'rdc_wsb' );

    $options = shortcode_atts( $options, $atts, $tag );
	
	// echo '<!-- data: ' . json_encode( $options['thank_you_page'] ) . '-->'; 

    $options['form_name'] = $options['form_name'] ?? 'RichiestaPreventivoDaSitoWeb';
    $options['js_bar_settings'] = json_decode( json_encode( $options['js_bar_settings'] ) );
    ob_start();
    
    echo '<div id="sb-converto-container-s"></div>';
    echo '<script type="text/javascript">';
        echo '(function (i, s, o, g, r, a, m) {';
            echo 'i[\'SBSyncroBoxParam\'] = r; i[r] = i[r] || function () {';
                echo '(i[r].q = i[r].q || []).push(arguments)';
                echo '}, i[r].l = 1 * new Date(); a = s.createElement(o),';
                echo  'm = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)';
                echo "})(window, document, 'script', 'https://cdn.simplebooking.it/search-box-script.axd?IDA={$options['license_code']}','SBSyncroBox');";

        echo 'SBSyncroBox({';
            echo "CodLang: '{$options['language_code']}',";
            echo 'Reference: "sbSyncroBox",';
            echo "MainContainerId: 'sb-converto-container-s',";
            echo "Styles: {$options['js_bar_settings']},";
            echo "Converto: {";
                echo 'InPageContainerId: "sb-converto-container-s",';
                echo "ThankYouPage: '{$options['thank_you_page']}',";
                echo "FormName: '{$options['form_name']}'";
            echo "}";
        echo '});';
    echo '</script>';

    
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode('wsb_form', 'create_wsb_form');
