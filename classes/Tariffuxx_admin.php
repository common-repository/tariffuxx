<?php

if (!class_exists('Tariffuxx_admin')) {
	class Tariffuxx_admin {

		public function __construct() {
			add_action('admin_menu', [$this, 'tariffuxx_admin']);

			add_action('init', [$this, 'init_iframe_shortcode']);

			add_action( "wp_ajax_save_twl_data", [$this, "save_twl_data"]);
			add_action( "wp_ajax_nopriv_save_twl_data", [$this, 'save_twl_data']);
		}

		public function save_twl_data() {
			$action = sanitize_text_field($_GET['action']);
			$twl_id = sanitize_text_field($_GET['twl_id']);
			$edit_field = sanitize_text_field($_GET['edit_field']);

			if ($action && $twl_id && $edit_field) {
				global $table_prefix, $wpdb;
				$tblname = 'tariffuxx_twl';
				$table = $table_prefix . "$tblname";

				$wpdb->update($table, [$edit_field => sanitize_text_field($_GET['edit_field_value']), 'modified' => date('Y-m-d H:i:s'), 'modifier' => wp_get_current_user()->data->ID], ['id' => $twl_id]);

				$json_data['html']['callback'] = "showMessage('Erfolgreich gespeichert.', 'success');";
				echo include(TARIFFUXX_PLUGIN_PATH . "/views/common/json.php");
			}
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

		public function tariffuxx_admin(){
			add_menu_page( 'Vergleiche & Widgets', 'Vergleiche & Widgets', 'manage_options', 'tariffuxx', [$this, 'admin_page'],
				TARIFFUXX_PLUGIN_URL . 'assets/tariffuxx-icon.png');
		}

		public function admin_page() {
			global $table_prefix, $wpdb;
			$tblname = 'tariffuxx_twl';
			$table = $table_prefix . "$tblname";

			$delete_twl_id = sanitize_text_field(@$_GET['delete_twl_id']);
			$clone_twl_id = sanitize_text_field(@$_GET['clone_twl_id']);

			if ($delete_twl_id) {
				$twl = new Tariffuxx_twl();
				$twl->delete_twl($delete_twl_id);
			}

			if ($clone_twl_id) {
				$twl = new Tariffuxx_twl();
				$twl->clone_twl($clone_twl_id);
			}

			$twls = $wpdb->get_results("SELECT * from $table");

			include( TARIFFUXX_PLUGIN_PATH . "/views/dashboard/dashboard.php" );
		}

	}
	
	function init_tariffux_admin() {
		global $tariffux_admin;

		if ( ! isset( $tariffux_admin ) ) {
			$tariffux_admin = new Tariffuxx_admin();
		}

		return $tariffux_admin;
	}

	init_tariffux_admin();
}
