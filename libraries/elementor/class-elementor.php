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

            add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ], 9  );
			add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'load_editor_assets' ]);

			$this->load_modules();

			do_action( 'pefe-action/plugin/elementor/loaded' );
        }

		public function register_scripts() {
            if ( ! wp_script_is( 'pefe-particles', 'enqueued' ) ) {
                wp_register_script( 'pefe-particles',
					PEFE_CONST_URL . 'assets/js/particles' . PEFE_CONST_DEBUG_SUFFIX . '.js',
                    [ 'jquery' ],
                    PEFE_CONST_VERSION,
                    true
                );
			}

			wp_register_script( 'pefe-elementor',
				PEFE_CONST_URL . 'assets/js/script' . PEFE_CONST_DEBUG_SUFFIX . '.js',
				[ 'jquery' ],
				PEFE_CONST_VERSION,
				true
			);

			wp_register_style( 'pefe-elementor',
				PEFE_CONST_URL . 'assets/css/style' . PEFE_CONST_DEBUG_SUFFIX . '.css',
				[],
				PEFE_CONST_VERSION,
				'all'
			);
		}

		public function load_editor_assets() {
			wp_enqueue_style(
				'pefe-elementor-editor',
				PEFE_CONST_URL . 'assets/css/elementor-editor' . PEFE_CONST_DEBUG_SUFFIX . '.css'
			);
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