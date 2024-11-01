<div class="card" id="card-<?php echo esc_attr($filter['key']) ?>">
	<?php  include( TARIFFUXX_PLUGIN_PATH . "/views/twl/card_header.php" ); ?>
    <div id="collapseFilter<?php echo esc_attr($filter['number']) ?>" class="collapse" role="tabpanel" aria-labelledby="headingFilter<?php echo esc_attr($filter['number']) ?>" data-parent="#accordionFilter<?php echo esc_attr($filter['parent_id']) ?>">
        <div class="card-body text-left pt-0">
            <div class="border border-light">
                <div class="md-form color-picker-wrapper  text-tariffuxx-blue my-3">
                        <span class="before-color-picker">#</span>
                        <input type="text" data-name="<?php echo esc_attr($filter['key']) ?>" name="<?php echo (isset($config_data->config->{$filter['key']})) ? esc_attr($filter['key']) : '' ?>" id="<?php echo esc_attr($filter['key']) ?>" class="form-control twl-color-input" value="<?php echo (isset($config_data->config->{$filter['key']})) ? esc_attr($config_data->config->{$filter['key']}) : esc_attr($filter['standard']) ?>" data-default="<?php echo esc_attr($filter['standard']) ?>" onchange="
                                       jQuery('#card-<?php echo wp_kses_post($filter['key']) ?> .no_config').addClass('d-none');
                                       jQuery('#card-<?php echo wp_kses_post($filter['key']) ?> .has_config').removeClass('d-none');">

                    <div class="twl-color-picker"
                         id="picker-<?php echo esc_attr($filter['key']) ?>"
                         data-id="<?php echo esc_attr($filter['key']) ?>"></div>
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