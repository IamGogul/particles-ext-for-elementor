<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if( !class_exists( 'Elementor_Particles_Ext_WP_Plugin_Elementor' ) ) {

    class Elementor_Particles_Ext_WP_Plugin_Elementor {

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

		/**
		 * Constructor
		 */
        public function __construct() {
			if ( ! did_action( 'elementor/loaded' ) ) {
				return;
			}

			$this->load_modules();

			do_action( 'pefe-action/plugin/elementor/loaded' );
        }

        /**
         * Load the required dependencies for elementor.
         */
		public function load_modules() {

            /**
             * Particles Extension
             */
			require_once PEFE_CONST_DIR . 'libraries/elementor/classes/class-particles.php';

        }

    }

}

if( !function_exists( 'pefe_wp_plugin_elementor' ) ) {

    /**
     * Returns the instance of a class.
     */
    function pefe_wp_plugin_elementor() {

        return Elementor_Particles_Ext_WP_Plugin_Elementor::get_instance();
    }
}

pefe_wp_plugin_elementor();
/* Omit closing PHP tag to avoid "Headers already sent" issues. */