<?php
/*
Plugin Name: wpPERFORM.com Custom Stylesheet Loader
Description: Loads up to 5 custom stylesheets.
Version: 0.3
License: GPL
Author: The wpPERFORM.com Team
Author URI: http://wpperform.com

*/

// set defaults
$defaults = array(
  'stylesheet-1' => '',
  'stylesheet-2' => '',
  'stylesheet-3' => '',
  'stylesheet-4' => '',
  'stylesheet-5' => ''
);
$wpp_custom_sheets = wp_parse_args(get_option('wpp-custom-stylesheets'), $defaults);

// get the options from the wpp-custom-stylesheets array in the options table
$wpp_stylesheet_1 = $wpp_custom_sheets['stylesheet-1'];
$wpp_stylesheet_2 = $wpp_custom_sheets['stylesheet-2'];
$wpp_stylesheet_3 = $wpp_custom_sheets['stylesheet-3'];
$wpp_stylesheet_4 = $wpp_custom_sheets['stylesheet-4'];
$wpp_stylesheet_5 = $wpp_custom_sheets['stylesheet-5'];

add_action( 'wp_enqueue_scripts', 'wpp_enqueue_custom_styles' );

function wpp_enqueue_custom_styles() {

	global $wpp_stylesheet_1;
	global $wpp_stylesheet_2;
	global $wpp_stylesheet_3;
	global $wpp_stylesheet_4;
	global $wpp_stylesheet_5;

	if (!empty($wpp_stylesheet_1)) {
		wp_enqueue_style( 
			'stylesheet-1', 
			$wpp_stylesheet_1, 
			array(), 
			PARENT_THEME_VERSION 
		);
	}

	if (!empty($wpp_stylesheet_2)) {
		wp_enqueue_style( 
			'stylesheet-2', 
			$wpp_stylesheet_2, 
			array(), 
			PARENT_THEME_VERSION 
		);
	}

	if (!empty($wpp_stylesheet_3)) {
		wp_enqueue_style( 
			'stylesheet-3', 
			$wpp_stylesheet_3, 
			array(), 
			PARENT_THEME_VERSION 
		);
	}

	if (!empty($wpp_stylesheet_4)) {
		wp_enqueue_style( 
			'stylesheet-4', 
			$wpp_stylesheet_4, 
			array(), 
			PARENT_THEME_VERSION 
		);
	}

	if (!empty($wpp_stylesheet_5)) {
		wp_enqueue_style( 
			'stylesheet-5', 
			$wpp_stylesheet_5, 
			array(), 
			PARENT_THEME_VERSION 
		);
	}

}

// put the plugin settings on the settings menu
// for security reasons, only available to super admins
add_action( 'admin_menu', 'wpp_custom_styles_admin_menu' );
function wpp_custom_styles_admin_menu() {
    add_options_page( 'wpPERFORM.com Custom Styles', 'wpPERFORM.com Custom Styles', 'manage_network', 'wpp-custom-styles', 'wpp_styles_options' );
}

// Add settings link on plugin page
function wpp_custom_styles_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=wpp-custom-styles">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'wpp_custom_styles_settings_link' );

// use WP settings API
add_action( 'admin_init', 'wpp_custom_styles_admin_init' );
function wpp_custom_styles_admin_init() {
    register_setting( 'wpp-styles-settings-group', 'wpp-custom-stylesheets' );
    add_settings_section( 'wpp_styles_section-one', 'Stylesheets', 'wpp_styles_section_one_callback', 'wpp-custom-styles' );
    add_settings_field( 'stylesheet-1', 'Stylesheet 1', 'wpp_styles_field_one_callback', 'wpp-custom-styles', 'wpp_styles_section-one' );
    add_settings_field( 'stylesheet-2', 'Stylesheet 2', 'wpp_styles_field_two_callback', 'wpp-custom-styles', 'wpp_styles_section-one' );
    add_settings_field( 'stylesheet-3', 'Stylesheet 3', 'wpp_styles_field_three_callback', 'wpp-custom-styles', 'wpp_styles_section-one' );
    add_settings_field( 'stylesheet-4', 'Stylesheet 4', 'wpp_styles_field_four_callback', 'wpp-custom-styles', 'wpp_styles_section-one' );
    add_settings_field( 'stylesheet-5', 'Stylesheet 5', 'wpp_styles_field_five_callback', 'wpp-custom-styles', 'wpp_styles_section-one' );
}

function wpp_styles_section_one_callback() {
    echo '
		Specify protocol-agnostic URLs to locate and load up to 5 custom stylesheets.  That is, omit the http: or https:<br /><br />
		Example: //fonts.googleapis.com/css?family=Open+Sans:400,700<br /><br />
		The above example will load 2 weights (400, 700) of the Google font Open Sans.<br /><br />
		Stylesheets will be enqueued for all media starting with Stylesheet 1, and each sheet will be given a handle in the form of <i>stylesheet-1-css</i><br /><br />
		See the <a href="http://codex.wordpress.org/Function_Reference/wp_enqueue_style" target="_blank">WordPress Codex on enqueuing stylesheets</a> for more background.<br />
	';
}

function wpp_styles_field_one_callback() {

	global $defaults;
	$settings = (array) wp_parse_args(get_option('wpp-custom-stylesheets'), $defaults);
	$wpp_stylesheet_1 = esc_attr( $settings['stylesheet-1'] );
	echo "<input type='text' size='100' name='wpp-custom-stylesheets[stylesheet-1]' value='$wpp_stylesheet_1' />";
}

function wpp_styles_field_two_callback() {

	global $defaults;
	$settings = (array) wp_parse_args(get_option('wpp-custom-stylesheets'), $defaults);
	$wpp_stylesheet_2 = esc_attr( $settings['stylesheet-2'] );
	echo "<input type='text' size='100' name='wpp-custom-stylesheets[stylesheet-2]' value='$wpp_stylesheet_2' />";
}

function wpp_styles_field_three_callback() {

	global $defaults;
	$settings = (array) wp_parse_args(get_option('wpp-custom-stylesheets'), $defaults);
	$wpp_stylesheet_3 = esc_attr( $settings['stylesheet-3'] );
	echo "<input type='text' size='100' name='wpp-custom-stylesheets[stylesheet-3]' value='$wpp_stylesheet_3' />";
}

function wpp_styles_field_four_callback() {

	global $defaults;
	$settings = (array) wp_parse_args(get_option('wpp-custom-stylesheets'), $defaults);
	$wpp_stylesheet_4 = esc_attr( $settings['stylesheet-4'] );
	echo "<input type='text' size='100' name='wpp-custom-stylesheets[stylesheet-4]' value='$wpp_stylesheet_4' />";
}

function wpp_styles_field_five_callback() {

	global $defaults;
	$settings = (array) wp_parse_args(get_option('wpp-custom-stylesheets'), $defaults);
	$wpp_stylesheet_5 = esc_attr( $settings['stylesheet-5'] );
	echo "<input type='text' size='100' name='wpp-custom-stylesheets[stylesheet-5]' value='$wpp_stylesheet_5' />";
}

function wpp_styles_options() {
    ?>
    <div class="wrap">
        <h2>wpPERFORM.com Custom Styles</h2>
        <form action="options.php" method="POST">
            <?php settings_fields( 'wpp-styles-settings-group' ); ?>
            <?php do_settings_sections( 'wpp-custom-styles' ); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
