<?php
/**
 * @var array $twls
 */
?>
<main role="main" id="html">
    <div class="container pt-3">
        <section class="text-center mx-2 my-3" id="twl">
            <div class="modal-dialog modal-xl cascading-modal">
                <div class="modal-content">
                    <div class="modal-header tariffuxx-blue-color white-text">
                        <h4 class="title">Vergleiche &amp; Widgets</h4>
                    </div>
                    <div class="modal-body">
                        <a href="/wp-admin/admin.php?page=tariffuxx_twl" class="btn btn-lg btn-success waves-effect waves-light"><i class="fas fa-plus"></i> Vergleich / Widget erstellen</a>

                        <?php
                        if ($twls) { ?>
                            <h5 class="mt-5">Deine Vergleiche &amp; Widgets</h5>
                            <table class="table table-striped text-left">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Sub-ID</th>
                                        <th>Kategorie</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($twls as $twl) { ?>
                                        <tr>
                                            <td>
                                                <span id="description_<?php echo esc_attr($twl->id) ?>"><span class="value pr-1"><?php echo wp_kses_post($twl->description) ?></span><a href="javascript:void(0)" onclick="jQuery('#description_<?php echo wp_kses_post($twl->id) ?>').addClass('d-none'); jQuery('#edit_description_<?php echo wp_kses_post($twl->id) ?>').removeClass('d-none');"><i class="fas fa-pencil"></i></a></span>
                                                <div id="edit_description_<?php echo esc_attr($twl->id) ?>" class="md-form md-bg text-tariffuxx-blue d-none" data-action="/wp-admin/admin-ajax.php">
                                                    <input type="text" name="edit_field_value" class="edit_field_value form-control text-tariffuxx-blue" required="required" value="<?php echo esc_attr($twl->description) ?>">
                                                    <label for="description" class="active">Name</label>
                                                    <input type='hidden' name='edit_field' value='description'>
                                                    <input type='hidden' name='action' value='save_twl_data'>
                                                    <input type='hidden' name='twl_id' value='<?php echo esc_attr($twl->id) ?>'>
                                                    <button class="btn btn-success" onclick="ajax_submit('#edit_description_<?php echo wp_kses_post($twl->id) ?>'); jQuery('#description_<?php echo wp_kses_post($twl->id) ?>').removeClass('d-none');
                                                            jQuery('#edit_description_<?php echo wp_kses_post($twl->id) ?>').addClass('d-none');
                                                            jQuery('#description_<?php echo wp_kses_post($twl->id) ?> .value').text(jQuery('#edit_description_<?php echo wp_kses_post($twl->id) ?> .edit_field_value').val());
                                                            ">speichern</button>
                                                </div>
                                            </td>
                                            <td>
                                                <span id="sub_id_<?php echo esc_attr($twl->id) ?>"><span class="value pr-1"><?php echo wp_kses_post($twl->sub_id) ?></span><a href="javascript:void(0)" onclick="jQuery('#sub_id_<?php echo wp_kses_post($twl->id) ?>').addClass('d-none'); jQuery('#edit_sub_id_<?php echo wp_kses_post($twl->id) ?>').removeClass('d-none');"><i class="fas fa-pencil"></i></a></span>
                                                <div id="edit_sub_id_<?php echo esc_attr($twl->id) ?>" class="md-form md-bg text-tariffuxx-blue d-none" data-action="/wp-admin/admin-ajax.php">
                                                    <input type="text" name="edit_field_value" class="form-control text-tariffuxx-blue edit_field_value" required="required" value="<?php echo esc_attr($twl->sub_id) ?>">
                                                    <label for="sub_id" class="active">Name</label>
                                                    <input type='hidden' name='edit_field' value='sub_id'>
                                                    <input type='hidden' name='action' value='save_twl_data'>
                                                    <input type='hidden' name='twl_id' value='<?php echo esc_attr($twl->id) ?>'>
                                                    <button class="btn btn-success" onclick="ajax_submit('#edit_sub_id_<?php echo wp_kses_post($twl->id) ?>'); jQuery('#sub_id_<?php echo wp_kses_post($twl->id) ?>').removeClass('d-none'); jQuery('#edit_sub_id_<?php echo wp_kses_post($twl->id) ?>').addClass('d-none'); jQuery('#sub_id_<?php echo wp_kses_post($twl->id) ?> .value').text(jQuery('#edit_sub_id_<?php echo wp_kses_post($twl->id) ?> .edit_field_value').val());">speichern</button>
                                                </div>
                                            </td>
                                            <td><?php echo twl_get_id_name('ref_product_type_id', $twl->ref_product_type_id); ?></td>
                                            <td class="text-right">
                                                <a href="javascript:void(0)" onclick="jQuery('#twl_id').val(<?php echo wp_kses_post($twl->id) ?>); jQuery('#twl-iframe-preview').attr('src', '/?tariffuxx_konfigurator_script=<?php echo wp_kses_post($twl->id) ?>');" class="btn btn-tariffuxx-blue btn-sm pr-1" data-toggle="modal" data-target="#previewModal"><i class="fas fa-eye"></i></a>
                                                <a href="/wp-admin/admin.php?page=tariffuxx_twl&twl_id=<?php echo wp_kses_post($twl->id) ?>&step=3" class="btn btn-tariffuxx-blue btn-sm pr-1" data-toggle="tooltip" data-placement="bottom" title="Shortcode einbinden"><i class="fas fa-code"></i></a>
                                                <a href="/wp-admin/admin.php?page=tariffuxx_twl&twl_id=<?php echo wp_kses_post($twl->id) ?>&step=2" class="btn btn-warning btn-sm pr-1 mx-2" data-toggle="tooltip" data-placement="bottom" title="Widget konfigurieren"><i class="fas fa-cogs"></i></a>
                                                <a href="/wp-admin/admin.php?page=tariffuxx&clone_twl_id=<?php echo wp_kses_post($twl->id) ?>" onclick="if (confirm('Vergleich kopieren?')) { return true; } else { return false; }" class="btn btn-info btn-sm pr-1" data-toggle="tooltip" data-placement="bottom" title="Kopieren"><i class="fa fa-copy"></i></a>
                                                <a href="/wp-admin/admin.php?page=tariffuxx&delete_twl_id=<?php echo wp_kses_post($twl->id) ?>" onclick="if (confirm('Vergleich wirklich unwiderruflich löschen?')) { return true; } else { return false; }" class="btn btn-danger btn-sm pr-1" data-toggle="tooltip" data-placement="bottom" title="Löschen"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include( TARIFFUXX_PLUGIN_PATH . "/views/common/previewModal.php" ); ?>