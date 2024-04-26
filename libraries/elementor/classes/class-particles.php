<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if( !class_exists( 'Elementor_Particles_Ext_WP_Plugin_Particles' ) ) {

    class Elementor_Particles_Ext_WP_Plugin_Particles {

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

			add_action( 'elementor/element/container/section_layout/before_section_start', [ $this, 'register_section' ], 999, 2 );
			add_action( 'elementor/element/section/section_structure/after_section_end', [ $this, 'register_section' ], 999, 2 );

			add_action( 'elementor/elements/elements_registered', [ $this, 'elements_registered' ] );

			do_action( 'pefe-action/plugin/elementor/extension/particles/loaded' );
		}

		public function register_section( $element, $section_id ) {
            $tab      = Elementor\Controls_Manager::TAB_LAYOUT;
            $ele_name = $element->get_name();
            $name     = str_replace( ' ', '', ucwords( str_replace( '-', ' ', $ele_name ) ) );

			$this->_register_particles_section( $element, $name, $tab );
		}

		public function _register_particles_section( $controls_stack, $name, $tab ) {
            $controls_stack->start_controls_section( '_stack_particles_section', [
                'label' => sprintf( __( '%s : Particles', 'pefe'), $name ),
                'tab'   => $tab
            ] );
				$controls_stack->add_control( '_enable_particles', [
					'label'              => esc_html__( 'Enable Particles', 'pefe' ),
					'type'               => \Elementor\Controls_Manager::SWITCHER,
					'label_on'           => esc_html__( 'Yes', 'pefe' ),
					'label_off'          => esc_html__( 'No', 'pefe' ),
					'frontend_available' => true,
					'return_value'       => 'yes',
					'default'            => 'no',
				] );
			$controls_stack->end_controls_section();
		}

		public function elements_registered( $el_manager ){

            /**
             * Section
             */
			require_once PEFE_CONST_DIR . 'libraries/elementor/elements/class-section.php';
            $el_manager->register_element_type( new Elementor_Particles_Ext_WP_Plugin_Section_Ele() );


		}

    }

}

if( !function_exists( 'pefe_wp_plugin_elementor_particles' ) ) {

    /**
     * Returns the instance of a class.
     */
    function pefe_wp_plugin_elementor_particles() {

        return Elementor_Particles_Ext_WP_Plugin_Particles::get_instance();
    }
}

pefe_wp_plugin_elementor_particles();
/* Omit closing PHP tag to avoid "Headers already sent" issues. */