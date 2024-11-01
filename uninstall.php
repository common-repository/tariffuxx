<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

wp_pocketurl_uninstall();

function wp_pocketurl_uninstall(){
	global $table_prefix, $wpdb;

	$tblname = 'tariffuxx_twl';
	$table = $table_prefix . "$tblname";

	if (is_admin()) {
		$sql = "DROP TABLE IF EXISTS `$table`";
		$wpdb->query($sql);

		delete_option("tariffuxx_twl_version");
		delete_option("tariffuxx_partner_id");
		delete_option("tariffuxx_custom_css");
	}
}