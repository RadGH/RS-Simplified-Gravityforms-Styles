<?php
/*
Plugin Name: RS Simplified Gravity Forms Styles
Plugin URI: http://radleysustaire.com/
Description: Replaces the Gravity Forms stylesheets with a single stylesheet with reduced specificity and no !important rules.
Author: Radley Sustaire
Version: 1.1.0
Author URI: https://radleysustaire.com/
*/

define( 'RS_SGFS_URL', untrailingslashit(plugin_dir_url( __FILE__ )) );
define( 'RS_SGFS_PATH', dirname(__FILE__) );

// Add our stylesheet
function rs_sgfs_enqueue_scripts() {
	wp_enqueue_style( 'rs_sgfs', RS_SGFS_URL . '/styles/rs-gravityforms.css' );
}
add_action( 'wp_enqueue_scripts', 'rs_sgfs_enqueue_scripts', 8 );

// Add a default tabindex value if none is given in the shortcode to prevent tabbing to the wrong element
// Start at 20, and add 20 for each form thereafter.
function rs_sgfs_add_tabindex( $out, $pairs, $atts, $shortcode ) {
	// Only apply when a value isn't given by the shortcode.
	if ( !isset($atts['tabindex']) ) {
		static $increment = 0;
		$increment += 20;
		
		$out['tabindex'] = $increment;
	}
	
	return $out;
}
add_filter( 'shortcode_atts_gravityforms', 'rs_sgfs_add_tabindex', 10, 4 );

// Disable Gravity Forms CSS in the options menu when the plugin is activated
function rs_sgfs_activate_plugin() {
	// Toggle gravity form CSS setting
	update_option( 'rg_gforms_disable_css', 1 );
}
register_activation_hook( __FILE__, 'rs_sgfs_activate_plugin' );

// Re-enable Gravity Forms CSS in the options menu when the plugin is activated
function rs_sgfs_deactivate_plugin() {
	// Toggle gravity form CSS setting
	update_option( 'rg_gforms_disable_css', 0 );
}
register_deactivation_hook( __FILE__, 'rs_sgfs_deactivate_plugin' );
