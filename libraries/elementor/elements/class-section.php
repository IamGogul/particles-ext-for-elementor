<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

class Elementor_Particles_Ext_WP_Plugin_Section_Ele extends  \Elementor\Element_Section {

	public function after_render() {
        printf( '</div> %2$s </%1$s>', $this->get_html_tag(), $this->_get_particles_section() );
    }

    public function _get_particles_section() {
        $settings = $this->get_settings_for_display();

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