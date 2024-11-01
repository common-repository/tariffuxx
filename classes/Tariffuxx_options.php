<?php

if (!class_exists('Tariffuxx_options')) {
	class Tariffuxx_options {

		public $css_file = TARIFFUXX_PLUGIN_PATH . "assets/css/tariffuxx_custom_css.css";

		public function __construct() {
			add_action('admin_menu', [$this, 'tariffuxx_admin']);

			add_action( "wp_ajax_save_tariffuxx_options", [$this, "save_tariffuxx_options"]);
			add_action( "wp_ajax_nopriv_save_tariffuxx_options", [$this, 'save_tariffuxx_options']);
		}

		public function tariffuxx_admin(){
			$r = add_submenu_page( 'tariffuxx', 'Einstellungen', 'Einstellungen', 'manage_options', 'tariffuxx_options', [$this, 'options']);
		}

		public function save_tariffuxx_options() {
			$tariffuxx_partner_id = sanitize_text_field($_GET['tariffuxx_partner_id']);
			update_option('tariffuxx_partner_id', $tariffuxx_partner_id);

			$css = sanitize_text_field($_GET['tariffuxx_custom_css']);

			update_option('tariffuxx_custom_css', $css);

			if ($css) {
				$r = file_put_contents( $this->css_file, $css );
			} else {
				if (file_exists($this->css_file)) {
					unlink($this->css_file);
				}
			}

			$json_data['html']['callback'] = "showMessage('Einstellungen wurde gespeichert.', 'success');";
			echo include(TARIFFUXX_PLUGIN_PATH . "/views/common/json.php");
		}

		public function options() {
			include( TARIFFUXX_PLUGIN_PATH . "/views/options/options.php" );
		}

	}
	
	function init_tariffux_options() {
		global $tariffux_options;

		if ( ! isset( $tariffux_options ) ) {
			$tariffux_options = new Tariffuxx_options();
		}

		return $tariffux_options;
	}

	init_tariffux_options();
}
