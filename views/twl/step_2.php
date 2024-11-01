<?php
/**
 * @var mixed $config_data
 * @var mixed $twl_id
 * @var mixed $ajax
 */
$type = 'product_type_mobile_tool_preselection';
$id = $config_data->product_type_mobile_tool_preselection;
$providerTypeId = 1;

if ($config_data->ref_product_type_id == 2) {
	$type = 'product_type_fixed_line_tool_preselection';
	$id = $config_data->product_type_fixed_line_tool_preselection;
	$providerTypeId = 2;
}

if ($config_data->ref_product_type_id == 3) {
	$type = 'product_type_mobile_data_tool_preselection';
	$id = $config_data->product_type_mobile_data_tool_preselection;
	$providerTypeId = 1;
}
?>

<main role="main" id="html">
    <div class="container pt-3">
		<?php include( TARIFFUXX_PLUGIN_PATH . "/views/twl/stepper.php" ); ?>
        <section class="text-center mx-2 my-3" id="twl">
            <div class="row mb-3">
                <div class="col-12 text-center">
                    <button class="btn btn-tariffuxx-blue m-0 px-5 waves-effect waves-light" data-toggle="modal"
                            data-target="#previewModal"><i class="fa fa-external-link-square-alt pr-1"></i>Vorschau
                    </button>
                </div>
            </div>
            <div>
                <div class="modal-content">
                    <div class="modal-header tariffuxx-blue-color white-text">
                        <h4 class="title">
                            <i class="fa fa-cogs mr-1"></i><strong>"<?php echo twl_get_id_name($type, $id); ?>"</strong> konfigurieren
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form onchange="return ajax_submit(this);" data-action="/wp-admin/admin-ajax.php">
                            <input type='hidden' name='action' value='save_step_2'>
                            <input type='hidden' name="tariffuxx_twl_id" value="<?php echo esc_attr(@$twl_id )?>">
                            <div class="accordion md-accordion" id="accordionEx" role="tablist"
                                 aria-multiselectable="true">
                                <div class="card border-top border-bottom-0 border-left border-right border-light">
                                    <div class="card-header border-bottom border-light" role="tab" id="headingOne1">
                                        <a data-toggle="collapse" class="card_collapse" data-parent="#accordionEx" href="#collapseOne1"
                                           aria-expanded="true" aria-controls="collapseOne1">
                                            <h4 class="black-text font-weight-normal mb-0 text-left">
                                                <i class="fa fa-wrench mr-1"></i><strong>Allgemeine Einstellungen</strong>
                                                <i class="fas fa-angle-down rotate-icon"></i>
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="collapseOne1" class="collapse show in" role="tabpanel"
                                         aria-labelledby="headingOne1" data-parent="#accordionEx">
                                        <div class="card-body">
                                            <div class="accordion md-accordion" id="accordionGeneral1" role="tablist"
                                                 aria-multiselectable="true">

                                                <div class="card" id="card-providers">
                                                    <div class="card-header" role="tab" id="headingGeneral1">
                                                        <a class="collapsed text-tariffuxx-blue" data-toggle="collapse"
                                                           data-parent="#accordionGeneral1" href="#collapseGeneral1"
                                                           aria-expanded="true" aria-controls="collapseGeneral1">
                                                            <h5 class="mb-0 text-left">
                                                                <i class="fa fa-dot-circle mr-1 no_config <?php echo (isset($config_data->config->providers)) ? 'd-none' : '' ?>" data-toggle="tooltip" title="" data-original-title="Keine individuelle Konfiguration"></i>
                                                                <i class="fa fa-check-circle text-success mr-1 has_config <?php echo (isset($config_data->config->providers)) ? '' : 'd-none' ?>" data-toggle="tooltip" title="" data-original-title="Individuelle Konfiguration gespeichert"></i>
                                                                <strong>Anbieter Auswahl</strong><i
                                                                        class="fas fa-angle-down rotate-icon"></i><br>
                                                                <small><i>Wähle einen oder mehrere Anbieter für einen
                                                                        Tarifvergleich oder eine Tarifübersicht
                                                                        aus.</i></small>
                                                            </h5>
                                                        </a>
                                                    </div>
                                                    <div id="collapseGeneral1" class="collapse" role="tabpanel"
                                                         aria-labelledby="headingGeneral1"
                                                         data-parent="#accordionGeneral1"
                                                         style="">
                                                        <div class="card-body text-left pt-0">
                                                            <div class="border border-light px-3 pb-3">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="select-wrapper mdb-select md-form md-bg my-3 fa-arrow">
                                                                        <?php
                                                                            $providers = wp_remote_get(esc_url("https://www.tariffuxx.de/api/providers/get-active.json?type=$providerTypeId"));
                                                                            $providers = json_decode( wp_remote_retrieve_body( $providers ) );

                                                                            $sorted_choosen_providers = [];
                                                                            if (@$config_data->config->providers) {
                                                                                foreach ($config_data->config->providers as $p) {
	                                                                                $sorted_choosen_providers[$p] = $p;
                                                                                }
                                                                            }

                                                                        ?>
                                                                        <select class="mdb-select md-form md-bg my-3 fa-arrow chosen" multiple="multiple" data-name="providers" name="<?php echo (isset($config_data->config->providers)) ? 'providers' : '' ?>" id="providers" data-placeholder="Alle ausgewählt"
                                                                                 onchange="jQuery(this).attr('name', jQuery(this).data('name'));
                                                                                         jQuery('#card-providers .no_config').addClass('d-none'); jQuery('#card-providers .has_config').removeClass('d-none');">
                                                                            <?php foreach ($providers->providers as $provider) { ?>
                                                                                <option data-img-src="<?php echo esc_url($provider->logo) ?>" <?php echo (@$sorted_choosen_providers[$provider->linkname]) ? 'selected="selected"' : '' ?> value="<?php echo esc_attr($provider->linkname) ?>"><?php echo wp_kses_post($provider->name) ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 my-auto">
                                                                        <button class="btn-save btn btn-tariffuxx-blue twl-multiselect waves-effect waves-light"
                                                                                data-id="providers" id="save-providers">
                                                                            Auswahl speichern
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <hr class="mt-4">
                                                                <div class="row">
                                                                    <div class="col-auto my-auto">
                                                                        <i class="fa fa-info-circle fa-2x"></i>
                                                                    </div>
                                                                    <div class="col">
                                                                        <strong>Standard: Es werden alle Anbieter ausgewählt.</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card" id="card-providers_excl">
                                                    <div class="card-header" role="tab" id="headingGeneral2">
                                                        <a class="collapsed text-tariffuxx-blue card_collapse" data-toggle="collapse"
                                                           data-parent="#accordionGeneral1" href="#collapseGeneral2"
                                                           aria-expanded="false" aria-controls="collapseGeneral2">
                                                            <h5 class="mb-0 text-left">
                                                                <i class="fa fa-dot-circle mr-1 no_config <?php echo (isset($config_data->config->providers_excl)) ? 'd-none' : '' ?>" data-toggle="tooltip" title="" data-original-title="Keine individuelle Konfiguration"></i>
                                                                <i class="fa fa-check-circle text-success mr-1 has_config <?php echo (isset($config_data->config->providers_excl)) ? '' : 'd-none' ?>" data-toggle="tooltip" title="" data-original-title="Individuelle Konfiguration gespeichert"></i>
                                                                <strong>Anbieter ausschließen</strong><i class="fas fa-angle-down rotate-icon"></i><br>
                                                                <small><i>Schließe einen oder mehrere Anbieter aus dem Tarifvergleich aus.</i></small>
                                                            </h5>
                                                        </a>
                                                    </div>
                                                    <div id="collapseGeneral2" class="collapse" role="tabpanel"
                                                         aria-labelledby="headingGeneral2"
                                                         data-parent="#accordionGeneral1">
                                                        <div class="card-body text-left pt-0">
                                                            <div class="border border-light px-3 pb-3">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="select-wrapper mdb-select md-form md-bg my-3 fa-arrow">
                                                                            <?php
                                                                            $sorted_excl_providers = [];
                                                                            if (@$config_data->config->providers_excl) {
	                                                                            foreach ($config_data->config->providers_excl as $p) {
		                                                                            $sorted_excl_providers[$p] = $p;
	                                                                            }
                                                                            }
                                                                            ?>

                                                                            <select class="mdb-select md-form md-bg my-3 fa-arrow chosen" multiple="multiple" data-name="providers_excl" name="<?php echo (isset($config_data->config->providers_excl)) ? 'providers_excl' : '' ?>" id="providers_excl" data-placeholder="Alle ausgewählt"
                                                                                    onchange="jQuery(this).attr('name', jQuery(this).data('name'));
                                                                                         jQuery('#card-providers_excl .no_config').addClass('d-none'); jQuery('#card-providers_excl .has_config').removeClass('d-none');">
				                                                                <?php foreach ($providers->providers as $provider) { ?>
                                                                                    <option data-img-src="<?php echo esc_url($provider->logo) ?>" <?php echo (@$sorted_excl_providers[$provider->linkname]) ? 'selected="selected"' : '' ?> value="<?php echo esc_attr($provider->linkname) ?>"><?php echo wp_kses_post($provider->name) ?></option>
				                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 my-auto">
                                                                        <button class="btn-save btn btn-tariffuxx-blue twl-multiselect waves-effect waves-light" data-id="providers_excl" id="save-providers-excl">Auswahl speichern</button>
                                                                    </div>
                                                                </div>
                                                                <hr class="mt-4">
                                                                <div class="row">
                                                                    <div class="col-auto my-auto">
                                                                        <i class="fa fa-info-circle fa-2x"></i>
                                                                    </div>
                                                                    <div class="col">
                                                                        <strong>Standard: Es werden keine Anbieter ausgeschlossen.</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                                    $filters = [
                                                        ['key' => 'com_only', 'number' => '3', 'parent_id' => '1', 'title' => 'Provision Einstellung', 'subtitle' => 'Nur Tarife mit Provision oder alle Tarife anzeigen', 'label' => 'Zeige nur Tarife mit Provision', 'description' => 'Standard: Es werden nur Tarife mit Provisionsvergütung angezeigt.</strong><br> Du kannst den Haken der Checkbox entfernen, um deinen Nutzern einen transparent alle Tarife anzuzeigen. Tarife ohne Provision werden mit "nicht verfügbar" dargestellt.', 'view' => 'checkbox_card', 'standard' => '1'],
                                                        ['key' => 'filter', 'number' => '4', 'parent_id' => '1', 'title' => 'Filter Darstellung', 'subtitle' => 'Zeige oder verstecke den Tarif-Filter', 'label' => 'Zeige Tarif-Filter', 'description' => '<strong>Standard: Der Tarif-Filter wird angezeigt.</strong><br> Für einfache Tarifübersichten ohne Vergleichsmöglichkeit kann der Tarif-Filter versteckt werden (Haken entfernen).<br> <u><i class="fa fa-exclamation-triangle pr-1"></i>Achtung:</u> Bei einem versteckten Tarif-Filter werden Tarif-Ergebnisse immer angezeigt.', 'view' => 'checkbox_card', 'standard' => '1', 'excluded_preselection_ids' => [5]],
	                                                    ['key' => 'filter_pos', 'number' => '5', 'parent_id' => '1', 'title' => 'Filter-Position', 'subtitle' => 'Filter links oder über den Tarif-Ergebnissen', 'label' => 'Filter-Position', 'description' => ' <strong>Standard: Der Tarif-Filter wird links neben den Tarif-Ergebnissen angezeigt.</strong><br><ul><li>Links: Optimal für Seiten mit viel Platz in der Breite</li><li>Oben: Optimal für schmale Seiten bzw. geringe Bereite im Content-Bereich </li></ul> Die Einstellung ist unabhängig von Responsive Design', 'view' => 'select_card', 'selects' =>
                                                            [
                                                                ['value' => 'left', 'label' => 'Links'],
		                                                        ['value' => 'top', 'label' => 'Oben']
                                                            ], 'standard' => 'left', 'excluded_preselection_ids' => [5]],
	                                                    ['key' => 'start', 'number' => '6', 'parent_id' => '1', 'title' => 'Tarif-Ergebnisse', 'subtitle' => 'Zeige oder verstecke die Tarif-Ergebnisse', 'label' => 'Zeige Tarif-Ergebnisse beim Start', 'description' => '<strong>Standard: Tarif-Ergebnisse werden sofort angezeigt.</strong><br>
                                                                        Zeige deinem Nutzer Tarif-Ergebnisse passend zur hier vorgenommenen Konfiguration des Tarifvergleichs. Blende die Tarif-Ergebnisse aus um
                                                                        zunächst über einen reduzierten Tarif-Filter die individuellen Bedürfnisse deines Nutzers abzufragen.<br>
                                                                        <u><i class="fa fa-exclamation-triangle pr-1"></i>Achtung:</u>
                                                                        Wenn Tarif-Ergebnisse nicht direkt beim Start angezeigt werden sollen, ist die Darstellung des Tarif-Filters erforderlich.', 'view' => 'checkbox_card', 'standard' => '1'],
	                                                    ['key' => 'count', 'number' => '7', 'parent_id' => '1', 'title' => 'Anzahl Tarife', 'subtitle' => 'Anzahl der Tarif-Ergebnisse die angezeigt werden', 'label' => 'Anzahl', 'description' => ' <strong>Standard: Es werden 10 Tarife angezeigt.</strong><br>
                                                                        Weitere Tarife werden bei Bedarf des Nutzers mit Klick auf "Weitere Tarife anzeigen" dargestellt.<br>
                                                                        <u><i class="fa fa-exclamation-triangle pr-1"></i>Achtung:</u>
                                                                        Mit jedem Klick auf "Weitere Tarife anzeigen" werden maximal so viele Tarife geladen wie hier ausgewählt.
                                                                        Das heißt, wenn du dich für 5 Tarife entscheidest, werden mit jedem Klick weitere 5 Tarife angezeigt.', 'view' => 'select_card', 'selects' => [
                                                                                ['value' => '1', 'label' => '1 Tarif'],
		                                                                        ['value' => '2', 'label' => '2 Tarife'],
                                                                                ['value' => '3', 'label' => '3 Tarife'],
                                                                                ['value' => '5', 'label' => '5 Tarife'],
                                                                                ['value' => '10', 'label' => '10 Tarife'],
                                                                                ['value' => '15', 'label' => '15 Tarife'],
                                                                                ['value' => '20', 'label' => '20 Tarife'],
                                                                                ['value' => '25', 'label' => '25 Tarife'],
                                                        ], 'standard' => '10'],
	                                                    ['key' => 'is_load_more_btn', 'number' => '8', 'parent_id' => '1', 'title' => '"Mehr Tarife" Button', 'subtitle' => 'Zeige oder verstecke den Button "Mehr Tarife"', 'label' => 'Zeige Button "Mehr Tarife"', 'description' => '<strong>Standard: Button "Mehr Tarife" wird angezeigt.</strong><br>
                                                                        Mit dem Button "Mehr Tarife" können Nutzer weitere Tarife passend zur Filter-Einstellung nachladen.<br>
                                                                        <u>Tipp:</u> Für Tarifübersichten mit einer festen Anzahl an Tarifen empfehlen wir den Button zu deaktivieren.', 'view' => 'checkbox_card', 'standard' => '1'],
                                                    ];

                                                    foreach ($filters as $filter) {
                                                        if ($filter['view']) {
	                                                        include( TARIFFUXX_PLUGIN_PATH . "/views/twl/{$filter['view']}.php" );
                                                        }
                                                    }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border-bottom-0 border-left border-right border-light">
                                    <div class="card-header border-bottom border-light" role="tab" id="headingTwo2">
                                        <a data-toggle="collapse" data-parent="#accordionEx"
                                           href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                            <h4 class="black-text font-weight-normal mb-0 text-left">
                                                <i class="fa fa-filter mr-1"></i><strong>Filter Einstellungen</strong>
                                                <i class="fas fa-angle-down rotate-icon"></i>
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="collapseTwo2" class="collapse show in" role="tabpanel"
                                         aria-labelledby="headingTwo2"
                                         data-parent="#accordionEx">

                                        <div class="card-body">
                                            <div class="accordion md-accordion" id="accordionFilter1" role="tablist" aria-multiselectable="true">
                                                <?php if ($providerTypeId == 1) {
	                                                include( TARIFFUXX_PLUGIN_PATH . "/views/twl/step_2_mobile_tool.php" );
                                                } else if ($providerTypeId == 2) {
	                                                include( TARIFFUXX_PLUGIN_PATH . "/views/twl/step_2_fixed_line.php" );
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border border-left border-right border-light">
                                    <div class="card-header border-bottom border-light" role="tab" id="headingThree3">
                                        <a data-toggle="collapse" data-parent="#accordionEx"
                                           href="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                            <h4 class="black-text font-weight-normal mb-0 text-left">
                                                <i class="fa fa-palette mr-1"></i><strong>Darstellung &amp; Farben</strong> <i class="fas fa-angle-down rotate-icon"></i>
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="collapseThree3" class="collapse show in" role="tabpanel"
                                         aria-labelledby="headingThree3" data-parent="#accordionEx">
                                        <div class="card-body">
                                            <div class="accordion md-accordion" id="accordionFilter3" role="tablist"
                                                 aria-multiselectable="true">

	                                            <?php
	                                            $filters = [
                                                    ['key' => 'content_border_radius', 'number' => '300', 'parent_id' => '3', 'title' => 'Abgerundete Ecken: Buttons', 'subtitle' => 'Ecken von Rahmen und Hintergründen werden mehr oder weniger abgerundet.', 'label' => 'Abrundung Rahmen und Hintergründe', 'description' => '<strong>Standard: 5 Pixel</strong>', 'view' => 'input_card', 'standard' => '5'],
                                                    ['key' => 'button_border_radius', 'number' => '301', 'parent_id' => '3', 'title' => 'Abgerundete Ecken: Buttons', 'subtitle' => 'Ecken von Buttons werden mehr oder weniger abgerundet.', 'label' => 'Abrundung Buttons', 'description' => '<strong>Standard: 5 Pixel</strong>', 'view' => 'input_card', 'standard' => '5'],
                                                    ['key' => 'c_bg', 'number' => '302', 'parent_id' => '3', 'title' => 'Hintergrund Farbe', 'subtitle' => 'Ausgewählte Bereiche im Hintergrund werden in dieser Farbe dargestellt', 'label' => 'Hintergrund Farbe', 'description' => '<strong>Standard: Helles Grau (#f9f9f9)</strong>', 'view' => 'color_picker_card', 'standard' => '#f9f9f9'],
                                                    ['key' => 'c_brdr', 'number' => '303', 'parent_id' => '3', 'title' => 'Rahmen Farbe', 'subtitle' => 'Rahmen werden in dieser Farbe dargestellt', 'label' => 'Rahmen Farbe', 'description' => '<strong>Standard: Helles Grau-Blau (#dbe3ed)</strong>', 'view' => 'color_picker_card', 'standard' => '#dbe3ed'],
                                                    ['key' => 'c_txt_d', 'number' => '304', 'parent_id' => '3', 'title' => 'Standard Text Farbe', 'subtitle' => 'Alle Standardtexte werden in dieser Farbe dargestellt', 'label' => 'Standard Text Farbe', 'description' => '<strong>Standard: Anthrazit (#333333)</strong>', 'view' => 'color_picker_card', 'standard' => '#333333'],
		                                            ['key' => 'c_txt_h', 'number' => '305', 'parent_id' => '3', 'title' => 'Highlight Text Farbe', 'subtitle' => 'Alle Highlight-Texte werden in dieser Farbe dargestellt', 'label' => 'Highlight Text Farbe', 'description' => ' <strong>Standard: Blau (#006699)</strong>', 'view' => 'color_picker_card', 'standard' => '#006699'],
		                                            ['key' => 'c_btn_bg_d', 'number' => '306', 'parent_id' => '3', 'title' => 'Standard-Button Hintergrund Farbe', 'subtitle' => 'Alle Standard-Buttons werden mit dieser Hintergrundfarbe dargestellt', 'label' => 'Standard-Button Hintergrund Farbe', 'description' => ' <strong>Standard: Dezentes Grau (#f0f0f0)</strong>', 'view' => 'color_picker_card', 'standard' => '#f0f0f0'],
		                                            ['key' => 'c_btn_txt_d', 'number' => '307', 'parent_id' => '3', 'title' => 'Standard-Button Text Farbe', 'subtitle' => 'Alle Standard-Buttons werden mit dieser Text-Farbe dargestellt', 'label' => 'Standard-Button Text Farbe', 'description' => ' <strong>Standard: Schwarz (#000000)</strong>', 'view' => 'color_picker_card', 'standard' => '#000000'],
		                                            ['key' => 'c_btn_bg_h', 'number' => '308', 'parent_id' => '3', 'title' => 'Highlight-Button Hintergrund Farbe', 'subtitle' => 'Alle Highlight-Buttons werden mit dieser Hintergrundfarbe dargestellt', 'label' => 'Highlight-Button Hintergrund Farbe', 'description' => ' <strong>Standard: Blau (#006699)</strong>', 'view' => 'color_picker_card', 'standard' => '#006699'],
		                                            ['key' => 'c_btn_txt_h', 'number' => '309', 'parent_id' => '3', 'title' => 'Highlight-Button Text Farbe', 'subtitle' => 'Alle Highlight-Buttons werden mit dieser Text-Farbe dargestellt', 'label' => 'Highlight-Button Text Farbe', 'description' => '<strong>Standard: Weiß (#ffffff)</strong>', 'view' => 'color_picker_card', 'standard' => '#ffffff'],
                                                    ['key' => 'c_prm_lbl', 'number' => '310', 'parent_id' => '3', 'title' => 'Tarif-Tipp Hintergrund Farbe', 'subtitle' => 'Das Tarif-Tipp Aktionslabel wird mit dieser Hintergrund Farbe dargestellt', 'label' => 'Tarif-Tipp Hintergrund Farbe', 'description' => '<strong>Standard: Gelb (#ffcc00)</strong>', 'view' => 'color_picker_card', 'standard' => '#ffcc00'],
		                                            ['key' => 'c_prm_bg', 'number' => '311', 'parent_id' => '3', 'title' => 'Tarif-Tipp Text Farbe', 'subtitle' => 'Das Tarif-Tipp Aktionslabel wird mit dieser Text Farbe dargestellt', 'label' => 'Tarif-Tipp Text Farbe', 'description' => 'Standard: Weiß (#ffffff)', 'view' => 'color_picker_card', 'standard' => '#FFFFFF'],
	                                            ];

	                                            foreach ($filters as $filter) {
		                                            if ($filter['view']) {
			                                            include( TARIFFUXX_PLUGIN_PATH . "/views/twl/{$filter['view']}.php" );
		                                            }
	                                            }
	                                            ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <a href="/wp-admin/admin.php?page=tariffuxx_twl&twl_id=<?php echo wp_kses_post($twl_id) ?>&step=3" class="btn btn-tariffuxx-blue waves-effect waves-light"><i class="fa fa-code pr-1"></i> 3. HTML-Code einbinden</a>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include( TARIFFUXX_PLUGIN_PATH . "/views/common/previewModal.php" ); ?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        hide_current_nav_selection();
    });
    setTimeout(function(){
        fixedPreviewButton();
    }, 2000);
    <?php if (@$ajax) { ?>
        startScripts();
        twlConfigStartScripts();
    <?php } ?>
</script>

<button class="btn btn-tariffuxx-blue m-0 px-5 waves-effect waves-light" data-toggle="modal"
        data-target="#previewModal" id="fixedPreviewButton"><i class="fa fa-external-link-square-alt pr-1"></i>Vorschau
</button>