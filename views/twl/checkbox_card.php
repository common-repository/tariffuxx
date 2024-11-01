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
<div class="card" id="card-<?php echo wp_kses_post($filter['key']) ?>">
	<?php  include( TARIFFUXX_PLUGIN_PATH . "/views/twl/card_header.php" ); ?>
	<div id="collapseFilter<?php echo wp_kses_post($filter['number']) ?>" class="collapse" role="tabpanel" aria-labelledby="headingFilter<?php echo wp_kses_post($filter['number']) ?>" data-parent="#accordionFilter<?php echo wp_kses_post($filter['parent_id']) ?>">
		<div class="card-body text-left pt-0">
			<div class="border border-light">
				<div class="md-form md-bg text-tariffuxx-blue my-3">
					<input type="checkbox" data-name="<?php echo esc_attr($filter['key']) ?>" name="<?php echo (isset($config_data->config->{$filter['key']})) ? esc_attr($filter['key']) : '' ?>"
                           value="<?php echo ( isset( $config_data->config->{$filter['key']} )) ? esc_attr($config_data->config->{$filter['key']}) : '' ?>"
                           onchange="
                     jQuery(this).attr('name', jQuery(this).data('name'));
                     jQuery('#card-<?php echo wp_kses_post($filter['key']) ?> .no_config').addClass('d-none'); jQuery('#card-<?php echo wp_kses_post($filter['key']) ?> .has_config').removeClass('d-none');
					if(jQuery(this).prop('checked')){ jQuery(this).prop('value', '1'); } else { jQuery(this).prop('value', '0');}" class="form-check-input twl-checkbox" id="<?php echo esc_attr($filter['key']) ?>" <?php echo (isset($config_data->config->{$filter['key']}) && $config_data->config->{$filter['key']})
                                    || (!isset($config_data->config->{$filter['key']}) && $filter['standard']) ? 'checked="checked"' : '' ?>>
                    <label class="form-check-label text-tariffuxx-blue" for="<?php echo esc_attr($filter['key']) ?>"><?php echo wp_kses_post($filter['label']) ?></label>
				</div>
				<div class="row">
                    <div class="col">
                        <i class="fa fa-info-circle pr-1"></i>
						<?php echo wp_kses_post($filter['description']) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
?>