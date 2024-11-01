<?php

if (!class_exists('Tariffuxx_public')) {
	class Tariffuxx_public {

		public function __construct() {
			add_action('init', [$this, 'init_iframe_shortcode']);
		}


		public function init_iframe_shortcode() {
			add_shortcode( 'tariffuxx_configurator', [$this, 'iframe_shortcode'] );
		}

		public function iframe_shortcode($atts = []) {
			$twl = new Tariffuxx_twl();
			$data['config_data'] = $twl->get_config_data(@$atts['id']);

			if ($data['config_data']) {
				return twl_requireToVar(  TARIFFUXX_PLUGIN_PATH . "/views/twl/script.php", $data);
			} else {
				return twl_requireToVar(  TARIFFUXX_PLUGIN_PATH . "/views/twl/no_configurator.php", $data);
			}
		}
	}
	
	function init_tariffuxx_public() {
		global $tariffuxx_public;

		if ( ! isset( $tariffuxx_public ) ) {
			$tariffuxx_public = new Tariffuxx_public();
		}

		return $tariffuxx_public;
	}

	init_tariffuxx_public();
}
