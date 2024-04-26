<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if( !class_exists( 'Elementor_Particles_Ext_WP_Plugin_Admin' ) ) {

    final class Elementor_Particles_Ext_WP_Plugin_Admin {

		/**
		 * A reference to an instance of this class.
		 */
		private static $instance = null;

		/**
		 * Returns the instance.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
            }

			return self::$instance;
		}

        public function __construct() {
            $this->load_modules();

			do_action( 'pefe-action/plugin/admin/loaded' );
        }

        public function load_modules() {
            require_once PEFE_CONST_DIR . 'libraries/admin/class-action-links.php';
        }
	}

}

if( !function_exists( 'pefe_wp_plugin_admin' ) ) {
    /**
     * Returns instance of the class.
     */
    function pefe_wp_plugin_admin() {
        return Elementor_Particles_Ext_WP_Plugin_Admin::get_instance();
    }
}

pefe_wp_plugin_admin();
/* Omit closing PHP tag to avoid "Headers already sent" issues. */