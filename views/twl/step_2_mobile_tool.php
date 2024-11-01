<?php if ($config_data->ref_product_type_id == 1 && @$config_data->product_type_mobile_tool_preselection == 4) { ?>
    <div class="card" id="card-providers">
        <div class="card-header" role="tab" id="headingFilter199">
            <a class="collapsed text-tariffuxx-blue" data-toggle="collapse"
               data-parent="#accordionFilter1" href="#collapseFilter199"
               aria-expanded="true" aria-controls="collapseFilter1">
                <h5 class="mb-0 text-left">
                    <i class="fa fa-dot-circle mr-1 no_config <?php echo (isset($config_data->config->phone)) ? 'd-none' : '' ?>" data-toggle="tooltip" title="" data-original-title="Keine individuelle Konfiguration"></i>
                    <i class="fa fa-check-circle text-success mr-1 has_config <?php echo (isset($config_data->config->phone)) ? '' : 'd-none' ?>" data-toggle="tooltip" title="" data-original-title="Individuelle Konfiguration gespeichert"></i>
                    <strong>Handy Auswahl</strong><i
                            class="fas fa-angle-down rotate-icon"></i><br>
                    <small><i>Vorauswahl eines Handys</i></small>
                </h5>
            </a>
        </div>
        <div id="collapseFilter199" class="collapse" role="tabpanel"
             aria-labelledby="headingFilter199"
             data-parent="#accordionFilter1"
             style="">
            <div class="card-body text-left pt-0">
                <div class="border border-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="select-wrapper mdb-select md-form md-bg my-3 fa-arrow">
								<?php
								$smartphones = wp_remote_get("https://www.tariffuxx.de/api/product-hardware-items/get-active.json?type=1");
								$smartphones = json_decode( wp_remote_retrieve_body( $smartphones ) );

								?>
                                <select class="mdb-select md-form md-bg my-3 fa-arrow chosen" data-name="phone" name="<?php echo (isset($config_data->config->phone)) ? 'phone' : '' ?>" id="phone" data-placeholder="Kein Handy ausgewählt"
                                        onchange="jQuery(this).attr('name', jQuery(this).data('name'));
                                        jQuery('#card-phone .no_config').addClass('d-none'); jQuery('#card-phone .has_config').removeClass('d-none');">
                                    <option value="">Alle Smartphones</option>
                                    <option value="simonly">Nur SIM-Karte</option>
									<?php foreach ($smartphones->productHardwareItems as $phone) { ?>
                                        <option data-img-src="<?php echo esc_url($phone->image) ?>" <?php echo (@$config_data->config->phone == $phone->brand_modal_identifier) ? 'selected="selected"' : '' ?> value="<?php echo esc_attr($phone->brand_modal_identifier) ?>"><?php echo wp_kses_post($phone->brand) ?> <?php echo wp_kses_post($phone->model) ?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 my-auto">
                            <button class="btn-save btn btn-tariffuxx-blue twl-multiselect waves-effect waves-light"
                                    data-id="phone" id="save-phone">
                                Auswahl speichern
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <i class="fa fa-info-circle pr-1"></i>
                            <strong>Standard: Es wird kein Handy vorausgewählt.</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

<div class="card" id="card-networks">
    <div class="card-header" role="tab" id="headingFilter1">
        <a class="collapsed text-tariffuxx-blue" data-toggle="collapse"
           data-parent="#accordionFilter1" href="#collapseFilter1"
           aria-expanded="false" aria-controls="collapseFilter1">
            <h5 class="mb-0 text-left">
                <i class="fa fa-dot-circle mr-1 no_config <?php echo (isset($config_data->config->networks)) ? 'd-none' : '' ?>" data-toggle="tooltip" title="" data-original-title="Keine individuelle Konfiguration"></i>
                <i class="fa fa-check-circle text-success mr-1 has_config <?php echo (isset($config_data->config->networks)) ? '' : 'd-none' ?>" data-toggle="tooltip" title="" data-original-title="Individuelle Konfiguration gespeichert"></i>
                <strong>Mobilfunk-Netze</strong><i
                        class="fas fa-angle-down rotate-icon"></i><br>
                <small><i>Vorauswahl der Mobilfunk-Netze anpassen</i></small>
            </h5>
        </a>
    </div>
    <div id="collapseFilter1" class="collapse" role="tabpanel"
         aria-labelledby="headingFilter1"
         data-parent="#accordionFilter1">
        <div class="card-body text-left pt-0">
            <div class="border border-light">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                            $sorted_networks = [];
                            if (@$config_data->config->networks) {
	                            foreach ( $config_data->config->networks as $n ) {
		                            $sorted_networks[ $n ] = $n;
	                            }
                            }
                        ?>
                        <div class="select-wrapper mdb-select md-form md-bg my-3 fa-arrow">
                            <select class="mdb-select md-form md-bg my-3 fa-arrow chosen" multiple="multiple" data-name="networks" name="<?php echo (isset($config_data->config->networks)) ? 'networks' : '' ?>" id="networks" data-placeholder="Alle ausgewählt"
                                    onchange="jQuery(this).attr('name', jQuery(this).data('name'));
                                                                                             jQuery('#card-networks .no_config').addClass('d-none'); jQuery('#card-networks .has_config').removeClass('d-none');">
                                <option data-img-src="https://assets.tariffuxx.de/img/v2/mobile/network/telekom_big.png" <?php echo (@$sorted_networks['d1']) ? 'selected="selected"' : '' ?> value="d1">Telekom (D1)</option>
                                <option data-img-src="https://assets.tariffuxx.de/img/v2/mobile/network/vodafone_big.png" <?php echo (@$sorted_networks['d2']) ? 'selected="selected"' : '' ?> value="d2">Vodafone (D2)</option>
                                <option data-img-src="https://assets.tariffuxx.de/img/v2/mobile/network/o2_big.png" <?php echo (@$sorted_networks['o2']) ? 'selected="selected"' : '' ?> value="o2">Telefonica/o2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <i class="fa fa-info-circle pr-1"></i>
                        <strong>Standard: Tarife in allen dt.
                            Mobilfunk-Netzen werden angezeigt.</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$filters = [
    ['key' => 'data_units', 'number' => '100', 'parent_id' => '1', 'title' => 'Internet Datenvolumen', 'subtitle' => 'Vorauswahl des Internet Datenvolumens', 'label' => 'Internet Datenvolumen', 'description' => '  <strong>Standard: Vorauswahl bei Allnet-Flat Vergleich: 3 GB, ansonsten keine Vorauswahl für Internet-Datenvolumen.</strong>','selects' => [
        ['value' => '0', 'label' => 'Egal'],
        ['value' => '500', 'label' => 'ab 500 MB'],
        ['value' => '1000', 'label' => 'ab 1 GB'],
        ['value' => '2000', 'label' => 'ab 2 GB'],
        ['value' => '3000', 'label' => 'ab 3 GB'],
        ['value' => '4000', 'label' => 'ab 4 GB'],
        ['value' => '5000', 'label' => 'ab 5 GB'],
        ['value' => '6000', 'label' => 'ab 6 GB'],
        ['value' => '7000', 'label' => 'ab 7 GB'],
        ['value' => '8000', 'label' => 'ab 8 GB'],
        ['value' => '9000', 'label' => 'ab 9 GB'],
        ['value' => '10000', 'label' => 'ab 10 GB'],
        ['value' => '12000', 'label' => 'ab 12 GB'],
        ['value' => '15000', 'label' => 'ab 15 GB'],
        ['value' => '20000', 'label' => 'ab 20 GB'],
        ['value' => '30000', 'label' => 'ab 30 GB'],
        ['value' => '50000', 'label' => 'ab 50 GB'],
        ['value' => '999999', 'label' => 'Unbegrenzt'],
    ], 'view' => 'select_card', 'standard' => '0'],
    ['key' => 'phone_units', 'number' => '101', 'parent_id' => '1', 'title' => 'Telefonie', 'subtitle' => 'Vorauswahl einer Telefon-Flat / von Telefonie-Einheiten', 'label' => 'Telefonie', 'description' => 'Standard: Keine Vorauswahl für Telefonie-Einheiten.', 'selects' => [
        ['value' => '0', 'label' => 'Egal'],
        ['value' => '1', 'label' => 'Telefon-Flat'],
        ['value' => '100', 'label' => '100 Frei-Minuten'],
        ['value' => '200', 'label' => '200 Frei-Minuten'],
        ['value' => '300', 'label' => '300 Frei-Minuten'],
    ], 'view' => 'select_card', 'standard' => '0', 'excluded_preselection_ids' => [2,6,7]],
    ['key' => 'contract_period', 'number' => '102', 'parent_id' => '1', 'title' => 'Vertragslaufzeit', 'subtitle' => 'Vorauswahl der Vertragslaufzeit', 'label' => 'Vertragslaufzeit', 'description' => '<strong>Standard: Alle Prepaid und Postpaid (Vertrag) Tarife werden angezeigt.</strong>', 'selects' => [
        ['value' => '', 'label' => 'Egal'],
        ['value' => '1', 'label' => 'keine/täglich kündbar'],
        ['value' => '30', 'label' => 'max. 1 Monat'],
        ['value' => '360', 'label' => 'max. 12 Monate'],
        ['value' => '720', 'label' => 'max. 24 Monate'],
    ], 'view' => 'select_card', 'standard' => '', 'excluded_preselection_ids' => [3,7]],
	['key' => 'payment', 'number' => '103', 'parent_id' => '1', 'title' => 'Tarifart', 'subtitle' => 'Vorauswahl ob Prepaid oder Postpaid Tarife', 'label' => 'Art', 'description' => '<strong>Standard: Alle Prepaid und Postpaid (Vertrag) Tarife werden angezeigt.</strong>', 'selects' => [
		['value' => 'alle', 'label' => 'Egal'],
		['value' => 'postpaid', 'label' => 'Nur Postpaid Tarife'],
		['value' => 'prepaid', 'label' => 'Nur Prepaid Tarife'],
	], 'view' => 'select_card', 'standard' => 'alle', 'excluded_preselection_ids' => [3,7]],
	['key' => 'download', 'number' => '104', 'parent_id' => '1', 'title' => 'Geschwindigkeit', 'subtitle' => 'Vorauswahl der Download-Geschwindigkeit', 'label' => 'Download', 'description' => ' <strong>Standard: Keine Vorauswahl des Download Speeds.</strong>', 'selects' => [
		['value' => '0', 'label' => 'Egal'],
		['value' => '20', 'label' => 'ab 20 Mbit/s'],
		['value' => '50', 'label' => 'ab 50 Mbit/s'],
		['value' => '100', 'label' => 'ab 100 Mbit/s'],
		['value' => '200', 'label' => 'ab 200 Mbit/s'],
		['value' => '300', 'label' => 'ab 300 Mbit/s'],
	], 'view' => 'select_card', 'standard' => '0'],
	['key' => 'technologies', 'number' => '105', 'parent_id' => '1', 'title' => 'LTE &amp; 5G Nutzung', 'subtitle' => 'Vorauswahl der Mobilfunk-Technologie (4G/5G Tarife)', 'label' => 'Mobilfunk-Technologie', 'description' => '<strong>Standard: Keine Vorauswahl der 4G &amp; 5G Nutzung.</strong>', 'selects' => [
		['value' => 'egal', 'label' => 'Egal'],
		['value' => '4g', 'label' => '4G Tarife'],
		['value' => '5g', 'label' => '5G Tarife'],
	], 'view' => 'select_card', 'standard' => 'egal'],
    ['key' => 'mnp_req', 'number' => '106', 'parent_id' => '1', 'title' => 'Rufnummernmitnahme', 'subtitle' => 'Vorauswahl ob Rufnummernmitnahme möglich sein soll', 'label' => 'Nur Rufnummernmitnahme-fähige Tarife', 'description' => '  <strong>Standard: Nur Tarife mit Möglichkeit zur Rufnummernmitnahme werden angezeigt.</strong>', 'view' => 'checkbox_card', 'standard' => '1', 'excluded_preselection_ids' => [6,7]],
	['key' => 'data_auto_incl', 'number' => '107', 'parent_id' => '1', 'title' => 'Datenautomatik', 'subtitle' => 'Tarife mit Datenautomatik anzeigen oder ausblenden', 'label' => 'Datenautomatik Tarife anzeigen', 'description' => '<strong>Standard: Keine Vorauswahl der Datenautomatik.</strong>', 'view' => 'checkbox_card', 'standard' => '1', 'excluded_preselection_ids' => [3]],
	['key' => 'esim_req', 'number' => '108', 'parent_id' => '1', 'title' => 'eSIM', 'subtitle' => 'Alle Tarife oder nur eSIM-fähige Tarife anzeigen', 'label' => 'Nur eSIM Tarife', 'description' => '<strong>Standard: Keine Vorauswahl für eSIM-fähige Tarife.</strong>', 'view' => 'checkbox_card', 'standard' => '0'],
	['key' => 'sms_flat_req', 'number' => '109', 'parent_id' => '1', 'title' => 'SMS-Flat', 'subtitle' => 'Alle Tarife oder nur Tarife mit SMS-Flat anzeigen', 'label' => 'Nur SMS-Flat Tarife', 'description' => ' <strong>Standard: Keine Vorauswahl zur SMS-Flat.</strong>', 'view' => 'checkbox_card', 'standard' => '0', 'excluded_preselection_ids' => [6,7]],
//	['key' => 'wifi_req', 'number' => '110', 'parent_id' => '1', 'title' => 'WLAN-Call-fähige Tarife', 'subtitle' => 'Alle Tarife oder nur WLAN-Call-fähige Tarife anzeigen', 'label' => 'Nur WLAN-Call-fähige Tarife', 'description' => ' <strong>Standard: Keine Vorauswahl für WLAN-Call-fähige Tarife.</strong>', 'view' => 'checkbox_card', 'standard' => '0'],
//	['key' => 'volte_req', 'number' => '111', 'parent_id' => '1', 'title' => 'VoLTE-fähige Tarife', 'subtitle' => 'Alle Tarife oder nur VoLTE-fähige Tarife anzeigen', 'label' => 'Nur VoLTE-fähige Tarife', 'description' => '   <strong>Standard: Keine Vorauswahl für VoLTE-fähige Tarife.</strong>', 'view' => 'checkbox_card', 'standard' => '0'],
//	['key' => 'multisim_req', 'number' => '112', 'parent_id' => '1', 'title' => 'Multi-SIM Tarife', 'subtitle' => 'Alle Tarife oder nur Tarife mit Multi-SIM Option anzeigen', 'label' => 'Nur Multi-SIM-fähige Tarife', 'description' => ' <strong>Standard: Keine Vorauswahl für Multi-SIM Optionen.</strong>', 'view' => 'checkbox_card', 'standard' => '0', 'excluded_preselection_ids' => [3]],
];

foreach ($filters as $filter) {
	if ($filter['view']) {
		include( TARIFFUXX_PLUGIN_PATH . "/views/twl/{$filter['view']}.php" );
	}
}
?>