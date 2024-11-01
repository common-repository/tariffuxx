<?php

function twl_ausgeben($d) {
	echo "<pre>";
	print_r($d);
	echo "</pre>";
}

function twl_requireToVar($file, $vars = []) {
	ob_start();
	twl_requireWith($file, $vars);
	return ob_get_clean();
}

function twl_requireWith($file, $vars, $flags=EXTR_OVERWRITE, $prefix=null)
{
	extract($vars, $flags, $prefix);
	require $file;
}

function twl_get_id_name($type, $id) {
	$data = [
		'ref_product_type_id' => [
			1 => 'Handytarife',
			2 => 'Festnetz',
			3 => 'Datentarife',
		],
		'product_type_mobile_tool_preselection' => [
			1 => 'Alle Handytarife',
			2 => 'Allnet Flat Tarife',
			3 => 'Prepaid Tarife',
			4 => 'Handytarife & Smartphone Bundle',
		],
		'product_type_fixed_line_tool_preselection' => [
			5 => 'Festnetz Tarife',
		],
		'product_type_mobile_data_tool_preselection' => [
			6 => 'Mobile Daten-Flat Tarife',
			7 => 'Mobile Daten-Prepaid Tarife',
		]
	];

	return @$data[$type][$id];
}

function twl_get_twl_script($config_data) {
	$url = "https://www.tariffuxx.de/tools/view";
	$url_param = ($config_data->ref_product_type_id == 1 || $config_data->ref_product_type_id == 3) ? "twl-mobile" : "twl-fixed";
	unset($config_data->config->tariffuxx_twl_id);

	if ($config_data->config) {
		$config_data->config->subid = $config_data->sub_id;

		foreach ($config_data->config as $k => $conf) {
			if (is_array($conf)) {
				$config_data->config->$k = implode('-', $conf);
			}

			$config_data->config->$k = str_replace('#', '', $config_data->config->$k);
		}

		$final_url = "$url/$url_param?twl_wp_id=$config_data->id&" . @http_build_query($config_data->config);
	} else {
		$final_url = "$url/$url_param?twl_wp_id=$config_data->id";
	}

	$partner_id = get_option('tariffuxx_partner_id');
	if ($partner_id) {
		$final_url .= "&r=$partner_id";
	}

	$custom_css = get_option('tariffuxx_custom_css');
	if ($custom_css) {
		$final_url .= "&is_custom_css=1";
	}

	$script_tag = wp_get_script_tag(
		array(
			'id'        => "twl-wp-$config_data->id",
			'src'       => $final_url,
		)
	);

	$html = "<!-- START TARIFFUXX VERGLEICHSTABELLEN -->
   $script_tag
    <noscript>Bitte aktivieren Sie JavaScript, um den Tarifvergleich zu nutzen.</noscript>
    <!-- ENDE TARIFFUXX VERGLEICHSTABELLEN -->";

	return $html;
}