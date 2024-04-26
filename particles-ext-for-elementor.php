<?php
/**
 * Particles extension for Elementor
 *
 *
 * Plugin Name: Particles extension for Elementor
 * Plugin URI:  https://wordpress.org/plugins/particles-ext-for-elementor
 * Description: A simple extension for elementor page builder to add particles using particles.js
 * Version: 1.0.0
 * Author: M Gogul Saravanan
 * Author URI: https://profiles.wordpress.org/iamgogul/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: pefe
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Debug
 */
if( !function_exists( 'pefe_debug' ) ) {
	function pefe_debug( $arg = NULL ) {
		echo '<pre>';
		var_dump( $arg );
		echo '</pre>';
	}
}

/**
 * Check whether a plugin installed.
 */
if( !function_exists( 'pefe_is_plugin_active' ) ) {
	function pefe_is_plugin_active( $plugin_file_path = NULL ) {
		$plugins = get_plugins();
		return isset( $plugins[ $plugin_file_path ] );
	}
}