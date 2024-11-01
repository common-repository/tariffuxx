<?php
$filters = [
	['key' => 'target_group', 'number' => '200', 'parent_id' => '1', 'title' => 'Zielgruppe', 'subtitle' => 'Vorauswahl Neuanschluss oder Tarifwechseln an einem vorhanden Anschluss', 'label' => 'Zielgruppe', 'description' => '<strong>Standard: Keine Vorauswahl, es werden Neuanschluss- und Tarifwechsler-Tarife angezeigt.</strong>', 'selects' => [
		['value' => '', 'label' => 'Egal'],
		['value' => 'new', 'label' => 'Neuanschluss'],
		['value' => 'switch', 'label' => 'Tarifwechsler'],
	], 'view' => 'select_card', 'standard' => ''],

	['key' => 'contract_period', 'number' => '201', 'parent_id' => '1', 'title' => 'Vertragslaufzeit', 'subtitle' => 'Vorauswahl der Vertragslaufzeit', 'label' => 'Telefonie', 'description' => '<strong>Standard: Alle Prepaid und Postpaid (Vertrag) Tarife werden angezeigt.</strong>', 'selects' => [
		['value' => '720', 'label' => 'Egal'],
		['value' => '30', 'label' => 'max. 1 Monat'],
		['value' => '90', 'label' => 'max. 3 Monate'],
	], 'view' => 'select_card', 'standard' => '720'],


	['key' => 'technologies', 'number' => '202', 'parent_id' => '1', 'title' => 'Technologie (DSL/Kabel/LTE/Glasfaser)', 'subtitle' => 'Vorauswahl der Technologie (DSL/Kabel/LTE/Glasfaser)', 'label' => '', 'description' => '<strong>Standard: Keine Vorauswahl der übertragungstechnologie.</strong>', 'selects' => [
		//['value' => '', 'label' => 'Alle ausgewählt'],
		['value' => 'dsl', 'label' => '(V)DSL'],
		['value' => 'cable', 'label' => 'Kabel'],
		['value' => 'lte', 'label' => 'Mobilfunk/LTE'],
		['value' => 'fiber', 'label' => 'Glasfaser'],
	], 'view' => 'select_card', 'standard' => '', 'multiselect' => true],

	['key' => 'download', 'number' => '203', 'parent_id' => '1', 'title' => 'Download Speed', 'subtitle' => 'Vorauswahl der Download-Geschwindigkeit', 'label' => 'Download', 'description' => '<strong>Standard: Keine Vorauswahl des Download Speeds.</strong>', 'selects' => [
		['value' => '0', 'label' => 'Egal'],
		['value' => '10', 'label' => 'ab 10 Mbit/s'],
		['value' => '25', 'label' => 'ab 25 Mbit/s'],
		['value' => '50', 'label' => 'ab 50 Mbit/s'],
		['value' => '100', 'label' => 'ab 100 Mbit/s'],
		['value' => '200', 'label' => 'ab 200 Mbit/s'],
		['value' => '300', 'label' => 'ab 300 Mbit/s'],
		['value' => '1000', 'label' => 'ab 1 GBit/s'],
	], 'view' => 'select_card', 'standard' => '0', 'multiselect' => false],

	['key' => 'wifi_router_req', 'number' => '204', 'parent_id' => '1', 'title' => 'WLAN-Router', 'subtitle' => 'Alle Tarife oder nur Tarife inkl. WLAN-Router anzeigen', 'label' => 'Nur mit WLAN-Router', 'description' => ' <strong>Standard: Alle Tarife auch ohne WLAN-Router.</strong>', 'view' => 'checkbox_card', 'standard' => '0'],

	['key' => 'fixed_flat_req', 'number' => '205', 'parent_id' => '1', 'title' => 'Festnetz-Flat', 'subtitle' => 'Alle Tarife oder nur Tarife inkl. Festnetz-Flat anzeigen', 'label' => 'Nur mit Festnetz-Flat', 'description' => ' <strong>Standard: Alle Tarife auch ohne Festnetz-Flat.</strong>', 'view' => 'checkbox_card', 'standard' => '0'],

	['key' => 'mobile_flat_req', 'number' => '206', 'parent_id' => '1', 'title' => 'Mobilfunk-Flat', 'subtitle' => 'Alle Tarife oder nur Tarife inkl. Mobilfunk-Flat anzeigen', 'label' => 'Nur mit Mobilfunk-Flat', 'description' => ' <strong>Standard: Alle Tarife auch ohne Mobilfunk-Flat.</strong>', 'view' => 'checkbox_card', 'standard' => '0'],

	['key' => 'tv_req', 'number' => '207', 'parent_id' => '1', 'title' => 'IPTV Anschluss', 'subtitle' => 'Alle Tarife oder nur Tarife inkl. IPTV anzeigen', 'label' => 'Nur mit IPTV', 'description' => ' <strong>Standard: Alle Tarife auch ohne IPTV.</strong>', 'view' => 'checkbox_card', 'standard' => '0'],
];

foreach ($filters as $filter) {
	if ($filter['view']) {
		include( TARIFFUXX_PLUGIN_PATH . "/views/twl/{$filter['view']}.php" );
	}
}
?>