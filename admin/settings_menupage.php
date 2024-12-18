<?php
/**
 * Generated by the WordPress Option Page generator at http://jeremyhixon.com/wp-tools/option-page/
 */

class WordPressSimpleBooking {
	private $wordpress_simple_booking_options;

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'wordpress_simple_booking_add_plugin_page' ] );
		add_action( 'admin_init', [ $this, 'wordpress_simple_booking_page_init' ] );
	}

	public function wordpress_simple_booking_add_plugin_page() {
		add_menu_page(
			'WordPress Simple Booking', // page_title
			'Simple Booking', // menu_title
			'manage_options', // capability
			'wordpress-simple-booking', // menu_slug
			[ $this, 'wordpress_simple_booking_create_admin_page' ], // function
			'dashicons-building', // icon_url
			65 // position
		);
	}

	public function wordpress_simple_booking_create_admin_page() {
		$this->wordpress_simple_booking_options = get_option( 'wordpress_simple_booking_option_name' ); ?>

        <div class="wrap">
            <h2><?php __( 'WORDPRESS SIMPLE BOOKING', 'wp_simple_booking' ); ?></h2>
            <p></p>
			<?php settings_errors(); ?>

            <form method="post" action="options.php">
				<?php
				settings_fields( 'wordpress_simple_booking_option_group' );
				do_settings_sections( 'wordpress-simple-booking-admin' );
				submit_button();
				?>
            </form>
        </div>
	<?php }

	public function wordpress_simple_booking_page_init() {
		register_setting(
			'wordpress_simple_booking_option_group', // option_group
			'wordpress_simple_booking_option_name', // option_name
			[ $this, 'wordpress_simple_booking_sanitize' ] // sanitize_callback
		);

		add_settings_section(
			'wordpress_simple_booking_setting_section', // id
			'Settings', // title
			[ $this, 'wordpress_simple_booking_section_info' ], // callback
			'wordpress-simple-booking-admin' // page
		);

		add_settings_field(
			'mobile_theme_version',
			'Mobile theme version',
			[ $this, 'mobile_theme_version_callback' ],
			'wordpress-simple-booking-admin',
			'wordpress_simple_booking_setting_section'
		);

		add_settings_field(
			'request_page_id',
			'Request page id',
			[ $this, 'request_page_id_callback' ],
			'wordpress-simple-booking-admin',
			'wordpress_simple_booking_setting_section'
		);

		add_settings_field(
			'default_license_code_0', // id
			'Default license code', // title
			[ $this, 'default_license_code_0_callback' ], // callback
			'wordpress-simple-booking-admin', // page
			'wordpress_simple_booking_setting_section' // section
		);

		add_settings_field(
			'default_availability_locale_1', // id
			'Default availability locale', // title
			[ $this, 'default_availability_locale_1_callback' ], // callback
			'wordpress-simple-booking-admin', // page
			'wordpress_simple_booking_setting_section' // section
		);

		add_settings_field(
			'default_language_code_2', // id
			'Default language code', // title
			[ $this, 'default_language_code_2_callback' ], // callback
			'wordpress-simple-booking-admin', // page
			'wordpress_simple_booking_setting_section' // section
		);

		add_settings_field(
			'js_bar_settings', // id
			'Javascript Bar Settings', // title
			[ $this, 'js_bar_settings_callback' ], // callback
			'wordpress-simple-booking-admin', // page
			'wordpress_simple_booking_setting_section' // section
		);
	}

	public function wordpress_simple_booking_sanitize( $input ) {
		$sanitary_values = [];

		if ( isset( $input['mobile_theme_version'] ) ) {
			$sanitary_values['mobile_theme_version'] = sanitize_text_field( $input['mobile_theme_version'] );
		}

		if ( isset( $input['request_page_id'] ) ) {
			$sanitary_values['request_page_id'] = sanitize_text_field( $input['request_page_id'] );
		}

		if ( isset( $input['default_license_code_0'] ) ) {
			$sanitary_values['default_license_code_0'] = sanitize_text_field( $input['default_license_code_0'] );
		}

		if ( isset( $input['default_availability_locale_1'] ) ) {
			$sanitary_values['default_availability_locale_1'] = sanitize_text_field( $input['default_availability_locale_1'] );
		}

		if ( isset( $input['default_language_code_2'] ) ) {
			$sanitary_values['default_language_code_2'] = sanitize_text_field( $input['default_language_code_2'] );
		}

		if ( isset( $input['js_bar_settings'] ) ) {
			$sanitary_values['js_bar_settings'] = sanitize_text_field( $input['js_bar_settings'] );
		}

		return $sanitary_values;
	}

	public function wordpress_simple_booking_section_info() {
	}

	public function mobile_theme_version_callback() {;
		$options = [
			'0' => __( 'default version', 'wp_simple_booking' ),
			'1' => __( 'deactivate', 'wp_simple_booking' ),
			'2' => __( 'buttons version', 'wp_simple_booking' ),
		];

		$placeholder = isset( $this->wordpress_simple_booking_options['mobile_theme_version'] ) ? esc_attr( $this->wordpress_simple_booking_options['mobile_theme_version'] ) : '0';

		echo "<select name='wordpress_simple_booking_option_name[mobile_theme_version]' id='mobile_theme_version'>";
			foreach( $options as $key => $value ) {
				echo '<option value="' . esc_attr( $key )  . '" ' . ( $key == $placeholder ? 'selected' : '' ) . '>' . esc_html( $value ) . '</option>';
			}
		echo '</select>';
	}	

	public function default_license_code_0_callback() {
		$placeholder = '0000';

		printf(
			'<input class="regular-text" type="text" name="wordpress_simple_booking_option_name[default_license_code_0]" id="default_license_code_0" value="%s">',
			isset( $this->wordpress_simple_booking_options['default_license_code_0'] ) ? esc_attr( $this->wordpress_simple_booking_options['default_license_code_0'] ) : esc_attr( $placeholder )
		);
	}

	public function request_page_id_callback() {
		$placeholder = '0';

		printf(
			'<input class="regular-text" type="text" name="wordpress_simple_booking_option_name[request_page_id]" id="request_page_id" value="%s">',
			isset( $this->wordpress_simple_booking_options['request_page_id'] ) ? esc_attr( $this->wordpress_simple_booking_options['request_page_id'] ) : esc_attr( $placeholder )
		);
	}

	public function default_availability_locale_1_callback() {
		$placeholder = 'VERIFICA DISPONIBILITA\'';

		printf(
			'<input class="regular-text" type="text" name="wordpress_simple_booking_option_name[default_availability_locale_1]" id="default_availability_locale_1" value="%s">',
			isset( $this->wordpress_simple_booking_options['default_availability_locale_1'] ) ? esc_attr( $this->wordpress_simple_booking_options['default_availability_locale_1'] ) : esc_attr( $placeholder )
		);
	}

	public function default_language_code_2_callback() {
		$placeholder = 'IT';

		printf(
			'<input class="regular-text" type="text" name="wordpress_simple_booking_option_name[default_language_code_2]" id="default_language_code_2" value="%s">',
			isset( $this->wordpress_simple_booking_options['default_language_code_2'] ) ? esc_attr( $this->wordpress_simple_booking_options['default_language_code_2'] ) : esc_attr( $placeholder )
		);
	}

	public function js_bar_settings_callback() {

        $placeholder = <<<EOT
        {
            "CustomColor": "#676767",
            "CustomColorHover": "#676767",
            "CustomLabelColor": "#676767",
            "CustomWidgetColor": "#676767",
            "CustomWidgetElementHoverColor": "#676767",
            "CustomWidgetElementHoverBGColor": "#676767",
            "CustomBoxShadowColor": "#ffffff",
            "CustomBoxShadowColorHover": "#ffffff",
            "CustomIntentSelectionColor": "#9f8b3e",
            "CustomIntentSelectionDaysBGColor": "#9f8b3e",
            "CustomButtonHoverBGColor": "#9f8b3e",
            "CustomLabelHoverColor": "#676767",
            "CustomButtonBGColor": "#9f8b3e",
            "CustomIconColor": "#9f8b3e",
            "CustomLinkColor": "#9f8b3e",
            "CustomBoxShadowColorFocus": "#9f8b3e",
            "CustomAddRoomBoxShadowColor": "#9f8b3e",
            "CustomAccentColor": "#9f8b3e",
            "CustomBGColor": "#e0e0e0",
            "CustomFieldBackgroundColor": "#ffffff",
            "CustomWidgetBGColor": "#ffffff",
            "CustomSelectedDaysColor": "#676767",
            "CustomCalendarBackgroundColor": "#ffffff"
        }
EOT;

		$js_bar_settings = isset( $this->wordpress_simple_booking_options['js_bar_settings'] ) && $this->wordpress_simple_booking_options['js_bar_settings'] ? esc_attr( $this->wordpress_simple_booking_options['js_bar_settings'] ) : esc_attr( $placeholder ); 

		printf(
			'<textarea class="regular-text" type="text" name="wordpress_simple_booking_option_name[js_bar_settings]" id="js_bar_settings" rows="4" cols="50">%s</textarea>',
			esc_attr( $js_bar_settings )
		);
	}
}

if ( is_admin() ) {
	$wordpress_simple_booking = new WordPressSimpleBooking();
}
