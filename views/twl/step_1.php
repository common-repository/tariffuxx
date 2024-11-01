<?php
/**
 * @var mixed $config_data
 */
?>

<main role="main" id="html">
    <div class="container pt-3">
        <?php include(TARIFFUXX_PLUGIN_PATH . "/views/twl/stepper.php"); ?>
        <section class="text-center mx-2 my-3" id="twl">
            <div>
                <div class="modal-content">
                    <div class="modal-header tariffuxx-blue-color white-text">
                        <h4 class="title"><i class="fa fa-star"></i> Vergleich / Widget erstellen</h4>
                    </div>
                    <div class="modal-body">

                        <form method="post" accept-charset="utf-8" onsubmit="return ajax_submit(this);" data-action="/wp-admin/admin-ajax.php">
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <div class="md-form md-bg text-tariffuxx-blue my-3"><input type="text"
                                                                                                       name="description"
                                                                                                       class="form-control text-tariffuxx-blue"
                                                                                                       required="required"
                                                                                                       maxlength="50"
                                                                                                       value="<?php echo esc_attr(@$config_data->description) ?>"
                                                                                                       id="description"><label
                                                    for="description" class="active">Name des Tarifvergleichs</label>
                                            </div>
                                        </div>
                                        <div class="col-auto my-auto">
                                            <i class="fa fa-info-circle help" data-toggle="tooltip"
                                               data-placement="right" title=""
                                               data-original-title="Bitte vergib einen Namen für deinen Tarifvergleich"></i>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <div class="md-form md-bg text-tariffuxx-blue my-3"><input type="text"
                                                                                                       name="subid"
                                                                                                       value="<?php echo esc_attr(@$config_data->sub_id) ?>"
                                                                                                       class="form-control text-tariffuxx-blue"
                                                                                                       id="subid"><label
                                                    for="subid" class="active">Sub-ID (optional)</label></div>
                                        </div>
                                        <div class="col-auto my-auto">
                                            <i class="fa fa-info-circle help" data-toggle="tooltip"
                                               data-placement="right" data-html="true" title=""
                                               data-original-title="Für dein persönliches Tracking von Provisionen kannst du eine Sub-ID vergeben. Erlaubte Zeichen: Groß- und Kleinbuchstaben, Zahlen und der Bindestrich"></i>
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <div class="col-12 text-left my-1">
                                            <label for="ref-product-type-id">Kategorie</label> <i
                                                class="fa fa-info-circle help float-right" data-toggle="tooltip"
                                                data-placement="right" data-html="true" title=""
                                                data-original-title="Entscheide dich für eine Kategorie um einen Tarifvergleich oder ein Widget zu erstellen."></i>
                                        </div>
                                        <input type="hidden" name="ref_product_type_id" value="<?php echo esc_attr(@$config_data->ref_product_type_id) ?>">

                                        <?php $categories = [
                                                ['name' => twl_get_id_name('ref_product_type_id', 1), 'value' => '1', 'icon' => 'fa-mobile'],
	                                            ['name' => twl_get_id_name('ref_product_type_id', 2), 'value' => '2', 'icon' => 'fa-network-wired'],
	                                            ['name' => twl_get_id_name('ref_product_type_id', 3), 'value' => '3', 'icon' => 'fa-tablet-alt'],
                                          ];

                                        foreach ($categories as $category) { ?>
                                            <div class="col-md-4 <?php echo (@$config_data->id) ? 'is_disabled' : '' ?>"><input type="radio" class="d-none" name="ref_product_type_id" <?php echo (@$config_data->id) ? 'disabled' : '' ?>
                                                                         data-value="<?php echo esc_attr($category['value']) ?>" value="<?php echo (@$config_data->ref_product_type_id && @$config_data->ref_product_type_id == $category['value']) ? esc_attr($config_data->ref_product_type_id) : 0 ?>" onchange="jQuery('input[name=ref_product_type_id]').val(jQuery(this).data('value'));"
		                                            <?php echo (@$config_data->ref_product_type_id && @$config_data->ref_product_type_id == $category['value']) ? 'checked="checked"' : '' ?>
                                                                         id="ref-product-type-id-<?php echo esc_attr($category['value']) ?>"><label class="w-100"
                                                                                                           for="ref-product-type-id-<?php echo wp_kses_post($category['value']) ?>">
                                                    <div class="p-2 border  rounded"><i class="fa <?php echo wp_kses_post($category['icon']) ?> fa-5x mb-3"></i><br><span class="h5 mt-3"></span>
	                                                    <?php echo wp_kses_post($category['name']) ?>
                                                    </div>
                                                </label>
                                            </div>
                                       <?php } ?>
                                    </div>

                                    <div class="row my-4 d-none" id="product-type-mobile-tool-preselection">
                                        <div class="col-12 text-left  my-1">
                                            <div class="col-12 text-left">
                                                <label class="pl-2" for="product-type-mobile-tool-preselection">Vorauswahl</label>
                                                <i class="fa fa-info-circle help float-right" data-toggle="tooltip"
                                                   data-placement="right" data-html="true" title=""
                                                   data-original-title="Mit der Vorauswahl übernimmst du mehrere Einstellungen mit einem Klick. Du kannst im nächsten Schritt die Konfiguration individuell anpassen."></i>
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_type_mobile_tool_preselection" value="">
	                                    <?php $mobile_tools = [
		                                    ['name' => twl_get_id_name('product_type_mobile_tool_preselection', 4), 'value' => '4', 'type_color' => 'secondary', 'type' => 'Mit Handy', 'text' => 'Widgets und Vergleiche für alle Handytarife und Smartphone Bundles'],
		                                    ['name' => twl_get_id_name('product_type_mobile_tool_preselection', 1), 'value' => '1', 'type_color' => 'primary', 'type' => 'SIM-Karte', 'text' => 'Allgemeiner Tarifvergleich für Mobilfunktarife ohne voreingestellte Filter'],
		                                    ['name' => twl_get_id_name('product_type_mobile_tool_preselection', 2), 'value' => '2', 'type_color' => 'primary', 'type' => 'SIM-Karte', 'text' => 'Nur Tarife mit Allnet Flat in alle dt. Netze und einer Internet-Flat'],
		                                    ['name' => twl_get_id_name('product_type_mobile_tool_preselection', 3), 'value' => '3', 'type_color' => 'primary', 'type' => 'SIM-Karte', 'text' => 'Nur Prepaid-Tarife bzw. SIM-Karten ohne Vertrag'],
	                                    ];

	                                    foreach ($mobile_tools as $tool) { ?>
                                            <div class="col-12 text-left my-1 <?php echo (@$config_data->id) ? 'is_disabled' : '' ?>"><input type="radio" class="d-none" <?php echo (@$config_data->id) ? 'disabled' : '' ?> name="product_type_mobile_tool_preselection" onchange="jQuery('input[name=product_type_mobile_tool_preselection]').val(jQuery(this).data('value'));"
		                                            <?php echo (@$config_data->product_type_mobile_tool_preselection && $config_data->product_type_mobile_tool_preselection == $tool['value']) ? "checked='checked'" : "" ?> data-value="<?php echo esc_attr($tool['value']) ?>" value="<?php echo esc_attr(@$config_data->product_type_mobile_tool_preselection) ?>"
                                                                                      id="product-type-mobile-tool-preselection-<?php echo esc_attr($tool['value']) ?>">
                                                <label class="w-100" for="product-type-mobile-tool-preselection-<?php echo esc_attr($tool['value']) ?>">
                                                    <div class="p-2 border rounded"><span class="h4"><span class="badge badge-<?php echo wp_kses_post($tool['type_color']) ?>"><?php echo wp_kses_post($tool['type']) ?></span> <?php echo wp_kses_post($tool['name']) ?></span><br><span><?php echo wp_kses_post($tool['text']) ?></span></div>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="row my-4 d-none" id="product-type-fixed-line-tool-preselection">
                                        <div class="col-12 text-left my-1">
                                            <div class="col-12 text-left">
                                                <label class="pl-2" for="product-type-fixed-line-tool-preselection">Vorauswahl</label>
                                                <i class="fa fa-info-circle help float-right" data-toggle="tooltip"
                                                   data-placement="right" data-html="true" title=""
                                                   data-original-title="Mit der Vorauswahl übernimmst du mehrere Einstellungen mit einem Klick. Du kannst im nächsten Schritt die Konfiguration individuell anpassen."></i>
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_type_fixed_line_tool_preselection" value="">
                                        <div class="col-12 text-left <?php echo (@$config_data->id) ? 'is_disabled' : '' ?>"><input type="radio" class="d-none" <?php echo (@$config_data->id) ? 'disabled' : '' ?>
                                                                             name="product_type_fixed_line_tool_preselection"
		                                        <?php echo (@$config_data->product_type_fixed_line_tool_preselection && $config_data->product_type_fixed_line_tool_preselection == 5) ? "checked='checked'" : "" ?>
                                                                             value="5"
                                                                             id="product-type-fixed-line-tool-preselection-5"><label
                                                class="w-100" for="product-type-fixed-line-tool-preselection-5">
                                            <div class="p-2 border  rounded"><span class="h4"><?php echo twl_get_id_name('product_type_fixed_line_tool_preselection', 5) ?></span><br><span>Tarifvergleich für DSL- und Kabel-Internet Tarife</span>
                                            </div>
                                        </label></div>
                                        <label class="form-check-label d-block"></label>
                                    </div>
                                    <div class="row my-4 d-none" id="product-type-mobile-data-tool-preselection">
                                        <div class="col-12 text-left  my-1">
                                            <div class="col-12 text-left">
                                                <label class="pl-2" for="product-type-mobile-data-tool-preselection">Vorauswahl</label>
                                                <i class="fa fa-info-circle help float-right" data-toggle="tooltip"
                                                   data-placement="right" data-html="true" title=""
                                                   data-original-title="Mit der Vorauswahl übernimmst du mehrere Einstellungen mit einem Klick. Du kannst im nächsten Schritt die Konfiguration individuell anpassen."></i>
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_type_mobile_data_tool_preselection" value="">
		                                <?php $mobile_tools = [
			                                ['name' => twl_get_id_name('product_type_mobile_data_tool_preselection', 6), 'value' => '6', 'text' => 'Tarifvergleich für mobile Flatrate Datentarife'],
			                                ['name' => twl_get_id_name('product_type_mobile_data_tool_preselection', 7), 'value' => '7', 'text' => 'Prepaid Datentarife Vergleich für mobiles Internet'],
		                                ];

		                                foreach ($mobile_tools as $tool) { ?>
                                            <div class="col-12 text-left my-1 <?php echo (@$config_data->id) ? 'is_disabled' : '' ?>"><input type="radio" class="d-none" <?php echo (@$config_data->id) ? 'disabled' : '' ?> name="product_type_mobile_data_tool_preselection" onchange="jQuery('input[name=product_type_mobile_data_tool_preselection]').val(jQuery(this).data('value'));"
					                                <?php echo (@$config_data->product_type_mobile_data_tool_preselection && $config_data->product_type_mobile_data_tool_preselection == $tool['value']) ? "checked='checked'" : "" ?> data-value="<?php echo esc_attr($tool['value']) ?>" value="<?php echo esc_attr(@$config_data->product_type_mobile_data_tool_preselection) ?>"
                                                                                                                                             id="product-type-mobile-data-tool-preselection-<?php echo esc_attr($tool['value']) ?>">
                                                <label class="w-100" for="product-type-mobile-data-tool-preselection-<?php echo esc_attr($tool['value']) ?>">
                                                    <div class="p-2 border rounded"><span class="h4"><?php echo wp_kses_post($tool['name']) ?></span><br><span><?php echo wp_kses_post($tool['text']) ?></span></div>
                                                </label>
                                            </div>
		                                <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-lg btn-tariffuxx-blue waves-effect waves-light" <?php echo (@$config_data->ref_product_type_id) ? '' : 'disabled="disabled"' ?> type="submit">
                                    Speichern
                                </button>
                            </div>
                            <input type='hidden' name='action' value='save_step_1'>
                            <input type='hidden' name="twl_id" value="<?php echo esc_attr(@$config_data->id) ?>">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>