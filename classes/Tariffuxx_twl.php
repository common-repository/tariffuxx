<?php

if (!class_exists('Tariffuxx_twl')) {
	class Tariffuxx_twl {

		public function __construct() {
			add_action('admin_menu', [$this, 'tariffuxx_admin']);
			
			add_action( "wp_ajax_save_step_1", [$this, "save_step_1"]);
			add_action( "wp_ajax_nopriv_save_step_1", [$this, 'save_step_1']);

			add_action( "wp_ajax_save_step_2", [$this, "save_step_2"]);
			add_action( "wp_ajax_nopriv_save_step_2", [$this, 'save_step_2']);

			add_action("init", [$this, 'konfigurator_iframe']);
		}

		public function tariffuxx_admin(){
			$title = '1. Erstellen';
			$step = (sanitize_text_field(@$_GET['step'])) ?: 1;

			if (2 === (int)$step) {
				$title = '2. Konfigurieren';
			}

			if (3 === (int)$step) {
				$title = '3. Einbinden';
			}

			add_submenu_page( 'tariffuxx', $title, 'Erstellen', 'manage_options', 'tariffuxx_twl', [$this, 'twl_konfigurator']);
		}

		public function konfigurator_iframe() {
			$id = sanitize_text_field(@$_GET['tariffuxx_konfigurator_script']);
			if ($id) {
				$twl = new Tariffuxx_twl();
				$config_data = $twl->get_config_data( $id );
				include( TARIFFUXX_PLUGIN_PATH . "/views/twl/iframe_script.php" );
				die;
			}
		}

		public function twl_konfigurator() {
			$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;
			$twl_id = isset($_GET['twl_id']) ? (int)$_GET['twl_id'] : null;

			if (null !== $twl_id) {
				$config_data = $this->get_config_data($twl_id);
			}

			include(TARIFFUXX_PLUGIN_PATH . "/views/twl/step_$step.php");
		}

		public function save_step_1() {
			global $table_prefix, $wpdb;
			$tblname = 'tariffuxx_twl';
			$table = $table_prefix . "$tblname";

			$twl_id = sanitize_text_field(@$_GET['twl_id']);

			$data = [
				'description'                                => sanitize_text_field($_GET['description']),
				'sub_id'                                     => sanitize_text_field($_GET['subid']),
				'ref_product_type_id'                        => sanitize_text_field($_GET['ref_product_type_id']),
				'product_type_mobile_tool_preselection'      => (sanitize_text_field($_GET['ref_product_type_id']) == 1) ? sanitize_text_field($_GET['product_type_mobile_tool_preselection']) : 0,
				'product_type_fixed_line_tool_preselection'  => (sanitize_text_field($_GET['ref_product_type_id']) == 2) ? sanitize_text_field($_GET['product_type_fixed_line_tool_preselection']) : 0,
				'product_type_mobile_data_tool_preselection' => (sanitize_text_field($_GET['ref_product_type_id']) == 3) ? sanitize_text_field($_GET['product_type_mobile_data_tool_preselection']) : 0,
			];

			if ($twl_id) {
				$wpdb->update( $table, array_merge( $data, [
					'modified' => date( 'Y-m-d H:i:s' ),
					'modifier' => wp_get_current_user()->data->ID
				] ), ['id' => $twl_id] );

				$data['twl_id'] = $twl_id;
			} else {
				$config = [];
				if ($data['product_type_mobile_tool_preselection'] == 2) {
					$config['phone_units'] = 1;
					$config['data_units'] = 3000;
				} else if ($data['product_type_mobile_tool_preselection'] == 3) {
					$config['payment'] = 'prepaid';
				} else if ($data['product_type_mobile_tool_preselection'] == 4) {
					$config['incl_bundles'] = 1;
				} else if ($data['product_type_mobile_data_tool_preselection'] == 6) {
					$config['mobile_data_only'] = 1;
				} else if ($data['product_type_mobile_data_tool_preselection'] == 7) {
					$config['mobile_data_only'] = 1;
					$config['payment'] = 'prepaid';
				}

				if ($config) {
					$data['config'] = json_encode($config);
				}

				$wpdb->insert($table, array_merge( $data, [
					'created' => date( 'Y-m-d H:i:s' ),
					'creator' => wp_get_current_user()->data->ID,
					'modified' => date( 'Y-m-d H:i:s' ),
					'modifier' => wp_get_current_user()->data->ID
				] ) );

				$data['twl_id'] = $wpdb->insert_id;
			}
			$data['step'] = 2;
			$data['config_data'] = $this->get_config_data($data['twl_id']);
			$data['ajax'] = true;

			$json_data['html']['html']['#html'] = twl_requireToVar(TARIFFUXX_PLUGIN_PATH . "/views/twl/step_2.php", $data);
			echo include(TARIFFUXX_PLUGIN_PATH . "/views/common/json.php");
			die;
		}

		public function save_step_2()
		{
			global $table_prefix, $wpdb;
			$tblname = 'tariffuxx_twl';
			$table = $table_prefix . "$tblname";

			$queryParams = array();

			foreach ($_GET as $key => $value) {
				if (true === in_array($key, $this->getTextQueryParamsWhitelist()) && 0 < strlen($sanitizedValue = sanitize_text_field($value))) {
					$queryParams[$key] = $sanitizedValue;
				}

				if (true === in_array($key, $this->getArrayQueryParamsWhitelist())) {
					$queryParams[$key] = map_deep( $value, 'sanitize_text_field' );
				}
			}


			$id = $queryParams['tariffuxx_twl_id'];
			$existing_data = $this->get_config_data($id);

			if ($existing_data->ref_product_type_id == 1) {
				if ($existing_data->product_type_mobile_tool_preselection == 2) {
					$queryParams['phone_units'] = '1';
				} else if ($existing_data->product_type_mobile_tool_preselection == 3) {
					$queryParams['payment'] = 'prepaid';
				} else if ($existing_data->product_type_mobile_tool_preselection == 4) {
					$queryParams['incl_bundles'] = '1';
				}
			}

			if ($existing_data->ref_product_type_id == 3) {
				if ($existing_data->product_type_mobile_data_tool_preselection == 6) {
					$queryParams['mobile_data_only'] = '1';
				} else if ($existing_data->product_type_mobile_data_tool_preselection == 7) {
					$queryParams['mobile_data_only'] = '1';
					$queryParams['payment'] = 'prepaid';
				}
			}


			$wpdb->update($table, ['config' => json_encode($queryParams), 'modified' => date('Y-m-d H:i:s'), 'modifier' => wp_get_current_user()->data->ID], ['id' => $id]);

			$json_data['html']['callback'] = "showMessage('Der Tarifvergleich wurde erfolgreich aktualisiert.', 'success'); 
			jQuery('#twl-iframe-preview').attr('src', '/?tariffuxx_konfigurator_script=$id');  handleConfigDependencies();";
			echo include(TARIFFUXX_PLUGIN_PATH . "/views/common/json.php");
		}

		public function get_config_data($id) {
			global $table_prefix, $wpdb;
			$tblname = 'tariffuxx_twl';
			$table = $table_prefix . "$tblname";

			$data = @$wpdb->get_results("SELECT * from $table where id = '$id'")[0];

			if (@$data->config) {
				$data->config = json_decode($data->config);
			}

			return $data;
		}

		public function delete_twl($id) {
			global $table_prefix, $wpdb;
			$tblname = 'tariffuxx_twl';
			$table = $table_prefix . "$tblname";

			$data = $wpdb->delete($table, ['id' => $id]);
		}

		public function clone_twl($id) {
			global $table_prefix, $wpdb;
			$tblname = 'tariffuxx_twl';
			$table = $table_prefix . "$tblname";

			$data = $wpdb->get_row("SELECT * from $table where id = '$id'", ARRAY_A);
			unset($data['id']);
			$data['description'] = 'Kopie: ' . $data['description'];

			$wpdb->insert($table, $data);

			echo '<script type="text/javascript">window.location = "' . admin_url('admin.php?page=tariffuxx') . '";</script>';
			exit();
		}

		private function getTextQueryParamsWhitelist()
		{
			return array(
				'tariffuxx_twl_id',
				'com_only',
				'filter',
				'filter_pos',
				'start',
				'count',
				'is_load_more_btn',
				'phone',
				'data_units',
				'phone_units',
				'contract_period',
				'payment',
				'download',
				'mnp_req',
				'data_auto_incl',
				'esim_req',
				'sms_flat_req',
				'wifi_req',
				'volte_req',
				'multisim_req',
				'target_group',
				'wifi_router_req',
				'fixed_flat_req',
				'mobile_flat_req',
				'tv_req',
				'content_border_radius',
				'button_border_radius',
				'c_bg',
				'c_brdr',
				'c_txt_d',
				'c_txt_h',
				'c_btn_bg_d',
				'c_btn_txt_d',
				'c_btn_bg_h',
				'c_btn_txt_h',
				'c_prm_lbl',
				'c_prm_bg',
			);
		}

		private function getArrayQueryParamsWhitelist()
		{
			return array(
				'providers',
				'providers_excl',
				'networks',
				'technologies'
			);
		}
	}
	
	function init_tariffux_twl() {
		global $tariffux_twl;

		if ( ! isset( $tariffux_twl ) ) {
			$tariffux_twl = new Tariffuxx_twl();
		}

		return $tariffux_twl;
	}

	init_tariffux_twl();
}
