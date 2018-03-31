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

function rs_sgfs_enqueue_scripts() {
	wp_enqueue_style( 'rs_sgfs', RS_SGFS_URL . '/styles/rs-gravityforms.css' );
}
add_action( 'wp_enqueue_scripts', 'rs_sgfs_enqueue_scripts', 8 );

function rs_sgfs_activate_plugin() {
	// Toggle gravity form CSS setting
	update_option( 'rg_gforms_disable_css', 1 );
}
register_activation_hook( __FILE__, 'rs_sgfs_activate_plugin' );

function rs_sgfs_deactivate_plugin() {
	// Toggle gravity form CSS setting
	update_option( 'rg_gforms_disable_css', 0 );
}
register_deactivation_hook( __FILE__, 'rs_sgfs_deactivate_plugin' );
