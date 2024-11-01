<?php
/*
Plugin Name: TARIFFUXX
Description: TARIFFUXX-Plugin für hochwertige Vergleiche & Widgets von Mobilfunk- und DSL-Tarifen in Deutschland mit Kostenloser und einfacher Integration. Verdiene Provision für die Vermittlung von Tarifen, schaffe Mehrwert für deine Besucher und erhöhe die Verweildauer auf deiner Website.
Version: 1.4
Author: TARIFFUXX
Author URI: https://www.tariffuxx.de
*/

if (!class_exists('Tariffuxx')) {
    class Tariffuxx {
        const VERSION = '1.4';

        public function __construct() {}

        public function initialize()
        {
            define('TARIFFUXX_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
	        define('TARIFFUXX_PLUGIN_URL', plugin_dir_url( __FILE__ ));

			if (is_admin()) {
		        include_once(TARIFFUXX_PLUGIN_PATH.'lib/mh-6_lib.php');
		        include_once(TARIFFUXX_PLUGIN_PATH.'classes/Tariffuxx_admin.php');
		        include_once(TARIFFUXX_PLUGIN_PATH.'classes/Tariffuxx_twl.php');
		        include_once(TARIFFUXX_PLUGIN_PATH.'classes/Tariffuxx_options.php');
		        include_once(TARIFFUXX_PLUGIN_PATH.'classes/Tariffuxx_infos.php');

				register_activation_hook( __FILE__, [$this, 'create_plugin_database_table']);
				add_action('admin_init', [$this, 'update_plugin_database_table_when_plugin_updating']);
				add_action("admin_enqueue_scripts", [$this, 'twl_reg_css_js']);
			} else {
				include_once(TARIFFUXX_PLUGIN_PATH.'lib/mh-6_lib.php');
				include_once(TARIFFUXX_PLUGIN_PATH.'classes/Tariffuxx_twl.php');
				include_once(TARIFFUXX_PLUGIN_PATH.'classes/Tariffuxx_public.php');
			}

        }

	    public function twl_reg_css_js()
	    {
		    $current_screen = get_current_screen();

		    if (false === strpos($current_screen->base, 'tariffuxx')) {
			    return;
		    } else {
			    wp_enqueue_style( 'mdb-css', plugins_url( '/assets/css/mdb.min.css', __FILE__ ), array(), Tariffuxx::VERSION, 'all' );
			    wp_enqueue_style( 'toastr-css', plugins_url( '/assets/css/toastr.min.css', __FILE__ ), array(), Tariffuxx::VERSION, 'all' );
			    wp_enqueue_style( 'fontawesome-css', plugins_url( '/assets/css/fontawesome.min.css', __FILE__ ), array(), Tariffuxx::VERSION, 'all' );
			    wp_enqueue_style( 'chosen-css', plugins_url( '/assets/css/chosen.min.css', __FILE__ ), array(), Tariffuxx::VERSION, 'all' );
			    wp_enqueue_style( 'pickr-nano-css', plugins_url( '/assets/css/pickr_nano.min.css', __FILE__ ), array(), Tariffuxx::VERSION, 'all' );
			    wp_enqueue_style( 'image-select-css', plugins_url( '/assets/css/ImageSelect.css', __FILE__ ), array(), Tariffuxx::VERSION, 'all' );
			    wp_enqueue_style( 'tariffuxx-css', plugins_url( '/assets/css/style.css', __FILE__ ), array(), Tariffuxx::VERSION, 'all' );

			    wp_enqueue_script( 'ajax-js', plugins_url( '/assets/js/ajax.js', __FILE__ ), false, Tariffuxx::VERSION, true);
			    wp_enqueue_script( 'bootstrap-tooltip-js', plugins_url( '/assets/js/bootstrap-tooltip.js', __FILE__ ), false, Tariffuxx::VERSION, true);
			    wp_enqueue_script( 'bootstrap-collapse-js', plugins_url( '/assets/js/bootstrap-collapse.js', __FILE__ ), false, Tariffuxx::VERSION, true);
			    wp_enqueue_script( 'bootstrap-modal-js', plugins_url( '/assets/js/bootstrap-modal.js', __FILE__ ), false, Tariffuxx::VERSION, true);
			    wp_enqueue_script( 'toastr-js', plugins_url( '/assets/js/toastr.min.js', __FILE__ ), false, Tariffuxx::VERSION, true);
			    wp_enqueue_script( 'chosen-js', plugins_url( '/assets/js/chosen.jquery.min.js', __FILE__ ), false, Tariffuxx::VERSION, true);
			    wp_enqueue_script( 'pickr-js', plugins_url( '/assets/js/pickr.min.js', __FILE__ ), false, Tariffuxx::VERSION, true);
			    wp_enqueue_script( 'generic-js', plugins_url( '/assets/js/generic.js', __FILE__ ), false, Tariffuxx::VERSION, true);
			    wp_enqueue_script( 'twl-js', plugins_url( '/assets/js/twl.js', __FILE__ ), false, Tariffuxx::VERSION, true);
			    wp_enqueue_script( 'twl_config-js', plugins_url( '/assets/js/twl_config.js', __FILE__ ), false, Tariffuxx::VERSION, true);
			    wp_enqueue_script( 'image-select-js', plugins_url( '/assets/js/ImageSelect.jquery.js', __FILE__ ), false, Tariffuxx::VERSION, true);
		    }
	    }

	    public function create_plugin_database_table()
        {
		    global $table_prefix, $wpdb;

		    $tblname = 'tariffuxx_twl';
		    $table = $table_prefix . "$tblname";

		    if ($wpdb->get_var("show tables like '$table'") != $table) {
			    $sql = "CREATE TABLE `$table` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`description` varchar(200) DEFAULT NULL,
					`sub_id` varchar(200) DEFAULT NULL,
					`ref_product_type_id` int(11) DEFAULT NULL,
					`product_type_mobile_tool_preselection` int(11) DEFAULT NULL,
					`product_type_fixed_line_tool_preselection` int(200) DEFAULT NULL,
					`config` text,
					`created` datetime DEFAULT NULL,
					`modified` datetime DEFAULT NULL,
					`creator` varchar(200) DEFAULT NULL,
					`modifier` varchar(200) DEFAULT NULL,
					PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

			    require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
			    dbDelta($sql);
		        update_option('tariffuxx_twl_version', '1.0');
		    }
	    }

		public function update_plugin_database_table_when_plugin_updating()
		{
			global $table_prefix, $wpdb;
			$oldVersion = get_option('tariffuxx_twl_version', '1.0');
			$tblname = 'tariffuxx_twl';
			$table = $table_prefix . "$tblname";

			if (!(version_compare($oldVersion, self::VERSION) < 0) || $wpdb->get_var("show tables like '$table'") != $table) {
				return false;
			}

			$sql = "ALTER TABLE `$table` 
    			ADD `product_type_mobile_data_tool_preselection` int(11) DEFAULT NULL AFTER `product_type_fixed_line_tool_preselection`,
    			MODIFY COLUMN `product_type_fixed_line_tool_preselection` int(11) DEFAULT NULL;";
			$wpdb->query($sql);
			update_option('tariffuxx_twl_version', self::VERSION);
		}
    }

    function init_tariffuxx()
    {
        global $tariffuxx;

        if( !isset($tariffuxx) ) {
	        $tariffuxx = new Tariffuxx();
	        $tariffuxx->initialize();
        }
        return $tariffuxx;
    }

	init_tariffuxx();
}
