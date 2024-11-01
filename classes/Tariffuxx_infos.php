<?php

if (!class_exists('Tariffuxx_infos')) {
	class Tariffuxx_infos {

		public function __construct() {
			add_action('admin_menu', [$this, 'tariffuxx_admin']);
		}

		public function tariffuxx_admin(){
			$r = add_submenu_page( 'tariffuxx', 'Über TARIFFUXX', 'Über TARIFFUXX', 'manage_options', 'tariffuxx_infos', [$this, 'infos']);
		}

		public function infos() {
			include( TARIFFUXX_PLUGIN_PATH . "/views/infos/infos.php" );
		}

	}
	
	function init_tariffux_infos() {
		global $tariffux_infos;

		if ( ! isset( $tariffux_infos ) ) {
			$tariffux_infos = new Tariffuxx_infos();
		}

		return $tariffux_infos;
	}

	init_tariffux_infos();
}
