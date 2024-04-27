<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

class Elementor_Particles_Ext_WP_Plugin_Container_Ele extends  \Elementor\Includes\Elements\Container {

	public function after_render() {
		$settings = $this->get_settings_for_display();

        printf(
            '%1$s %2$s %3$s',
            $this->is_boxed_container( $settings ) ? '</div>' : '',
            $this->_get_particles_section( $settings ),
            $this->print_html_tag()
        );
    }

    public function _get_particles_section( $settings = [] ) {
        if( isset( $settings['_enable_particles'] ) && $settings['_enable_particles'] == 'yes' ) {
            $html = sprintf(
                '<div id="section-pefe-particles-%1$s" class="pefe-particles"></div>',
                $this->get_id()
            );
            return $html;
        }

        return;
    }

}