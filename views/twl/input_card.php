<div class="card" id="card-<?php echo esc_attr($filter['key']) ?>">
	<?php  include( TARIFFUXX_PLUGIN_PATH . "/views/twl/card_header.php" ); ?>
    <div id="collapseFilter<?php echo esc_attr($filter['number']) ?>" class="collapse" role="tabpanel" aria-labelledby="headingFilter<?php echo esc_attr($filter['number']) ?>" data-parent="#accordionFilter<?php echo esc_attr($filter['parent_id']) ?>">
        <div class="card-body text-left pt-0">
            <div class="row border border-light">
				<div class="col-6 form-group text-tariffuxx-blue my-3">
                    <label for="<?php echo esc_attr($filter['key']) ?>"><?php echo wp_kses_post($filter['label']) ?></label>
					<input type="text" data-name="<?php echo esc_attr($filter['key']) ?>" name="<?php echo (isset($config_data->config->{$filter['key']})) ? esc_attr($filter['key']) : '' ?>"
                           value="<?php echo ( isset( $config_data->config->{$filter['key']} )) ? esc_attr($config_data->config->{$filter['key']}) : wp_kses_post($filter['standard']) ?>"
                           onchange="
                     jQuery(this).attr('name', jQuery(this).data('name'));
                     jQuery('#card-<?php echo wp_kses_post($filter['key']) ?> .no_config').addClass('d-none'); jQuery('#card-<?php echo wp_kses_post($filter['key']) ?> .has_config').removeClass('d-none');" class="form-control" id="<?php echo esc_attr($filter['key']) ?>">
				</div>
                <div class="col-6 mt-auto mb-3">
                    <div class="btn btn-tariffuxx-blue">Speichern</div>
                </div>
                <hr class="mt-1">
                <div class="row">
                    <div class="col-auto my-auto">
                        <i class="fa fa-info-circle pr-1"></i>
						<?php echo wp_kses_post($filter['description']) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>