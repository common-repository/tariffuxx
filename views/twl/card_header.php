<div class="card-header" role="tab" id="headingFilter<?php echo esc_attr($filter['number']) ?>">
    <a class="text-tariffuxx-blue collapsed" data-toggle="collapse" data-parent="#accordionFilter<?php echo esc_attr($filter['parent_id']) ?>" href="#collapseFilter<?php echo esc_attr($filter['number']) ?>" aria-expanded="false" aria-controls="collapseFilter<?php echo esc_attr($filter['number']) ?>">
        <h5 class="mb-0 text-left">

            <i class="fa fa-dot-circle mr-1 no_config <?php echo (isset($config_data->config->{$filter['key']})) ? 'd-none' : '' ?>" data-toggle="tooltip" title="" data-original-title="Keine individuelle Konfiguration"></i>
            <i class="fa fa-check-circle text-success mr-1 has_config <?php echo (isset($config_data->config->{$filter['key']})) ? '' : 'd-none' ?>" data-toggle="tooltip" title="" data-original-title="Individuelle Konfiguration gespeichert"></i>
            <strong><?php echo wp_kses_post($filter['title']) ?> </strong><i class="fas fa-angle-down rotate-icon"></i><br>
            <small><i><?php echo wp_kses_post($filter['subtitle']) ?></i></small>
        </h5>
    </a>
</div>