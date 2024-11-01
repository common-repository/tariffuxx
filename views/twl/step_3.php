<?php
$type = 'product_type_mobile_tool_preselection';
$id   = $config_data->product_type_mobile_tool_preselection;

if ($config_data->ref_product_type_id == 2 ) {
	$type = 'product_type_fixed_line_tool_preselection';
	$id   = $config_data->product_type_fixed_line_tool_preselection;
}

if ($config_data->ref_product_type_id == 3 ) {
	$type = 'product_type_mobile_data_tool_preselection';
	$id   = $config_data->product_type_mobile_data_tool_preselection;
}
?>
<main role="main" id="html">
    <div class="container pt-3">
        <?php include(TARIFFUXX_PLUGIN_PATH . "/views/twl/stepper.php"); ?>
        <section class="text-center mx-2 my-3" id="twl">
            <div>
                <div class="modal-content">
                    <div class="modal-header tariffuxx-blue-color white-text">
                        <h4 class="title"><i class="fa fa-code"></i> "<?php echo twl_get_id_name($type, $id); ?>" einbinden</h4>
                    </div>
                    <div class="modal-body">
                        <div class="md-form md-outline mt-0">
                            <h2 class="mt-4">WordPress-Shortcode</h2>
                            <div class="form-group shadow-textarea">
                                <textarea class="form-control click-and-copy z-depth-1 text-tariffuxx-blue" id="shortcode" rows="1">[tariffuxx_configurator id="<?php echo wp_kses_post($config_data->id) ?>"]</textarea>
                            </div>
                        </div>
                        <hr>
                        <h2 class="mt-4">Vorschau</h2>
	                    <?php include( TARIFFUXX_PLUGIN_PATH . "/views/twl/script.php" ); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        hide_current_nav_selection();
    });
</script>