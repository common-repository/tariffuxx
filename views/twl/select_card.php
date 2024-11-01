<?php if (!@$filter['excluded_preselection_ids'] ||
          (
          ($config_data->ref_product_type_id == 1  && !in_array(@$config_data->product_type_mobile_tool_preselection, $filter['excluded_preselection_ids']))
            ||
          ($config_data->ref_product_type_id == 2  && !in_array(@$config_data->product_type_fixed_line_tool_preselection, $filter['excluded_preselection_ids']))
            ||
          ($config_data->ref_product_type_id == 3  && !in_array(@$config_data->product_type_mobile_data_tool_preselection, $filter['excluded_preselection_ids']))
          )
) {
    ?>
<div class="card" id="card-<?php echo esc_attr($filter['key']) ?>">
	<?php  include( TARIFFUXX_PLUGIN_PATH . "/views/twl/card_header.php" ); ?>
    <div id="collapseFilter<?php echo esc_attr($filter['number']) ?>" class="collapse card_collapse" role="tabpanel"
         aria-labelledby="headingFilter<?php echo esc_attr($filter['number']) ?>"
         data-parent="#accordionFilter<?php echo esc_attr($filter['parent_id']) ?>" style="height: 0px;">
        <div class="card-body text-left pt-0">
            <div class="border border-light px-3 pb-3">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                            $k = @$filter['key'];
                            $sorted_values = [];

                            if (is_array(@$config_data->config->$k)) {
                                foreach ($config_data->config->$k as $v) {
	                                $sorted_values[$v] = $v;
                                }
                            }
                        ?>
                        <div class="select-wrapper mdb-select md-form md-bg my-3 fa-arrow">
                            <select class="mdb-select md-form md-bg my-3 fa-arrow initialized <?php echo (@$filter['multiselect']) ? 'chosen' : '' ?>" <?php echo (@$filter['multiselect']) ? 'multiple="multiple"' : '' ?> data-placeholder="Alle ausgewählt" data-name="<?php echo esc_attr($filter['key']) ?>" name="<?php echo (isset($config_data->config->{$filter['key']}) || $sorted_values) ? esc_attr($filter['key']) : '' ?>"
                                    id="<?php echo esc_attr($filter['key']) ?>"
                                    onchange="jQuery(this).attr('name', jQuery(this).data('name'));
                                            jQuery('#card-<?php echo wp_kses_post($filter['key']) ?> .no_config').addClass('d-none'); jQuery('#card-<?php echo wp_kses_post($filter['key']) ?> .has_config').removeClass('d-none');">
                                <?php foreach ($filter['selects'] as $select) { ?>
                                    <option value="<?php echo esc_attr($select['value']) ?>" <?php echo (
                                    (isset($config_data->config->{$filter['key']}) && $config_data->config->{$filter['key']} == $select['value']) ||
                                    (@$sorted_values[$select['value']])
                                    || (!isset($config_data->config->{$filter['key']}) && $select['value'] == $filter['standard'])) ? 'selected="selected"' : '' ?> data-fas="">
                                        <?php echo wp_kses_post($select['label']) ?>
                                    </option>
                                <?php } ?>
                            </select><label for="<?php echo esc_attr($filter['key']) ?>" class="active"><?php echo wp_kses_post($filter['label']) ?></label>
                        </div>

                    </div>
                    <div class="col-md-6 my-auto">
                        <button class="btn-save btn btn-tariffuxx-blue twl-select waves-effect waves-light"
                                data-id="filter_pos"
                                id="save-filter_pos">
                            Auswahl speichern
                        </button>
                    </div>
                </div>

                <hr class="mt-1">
                <div class="row">
                    <div class="col-auto my-auto">
                        <i class="fa fa-info-circle pr-1"></i>
                    </div>
                    <div class="col">
						<?php echo wp_kses_post($filter['description']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>