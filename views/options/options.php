<main role="main" id="html">
	<div class="container pt-3">
		<section class="text-center mx-2 my-3" id="twl">
			<div class="modal-dialog modal-xl cascading-modal">
				<div class="modal-content">
					<div class="modal-header tariffuxx-blue-color white-text">
						<h4 class="title">TARIFFUXX-Einstellungen</h4>
					</div>
					<div class="modal-body">
                        <a href="https://www.tariffuxx.de/nutzer/partner-register?ref_partner_details_category_id=2&website=<?php echo wp_kses_post(urlencode(get_bloginfo('name'))) ?>&url=<?php echo wp_kses_post(urlencode(get_bloginfo('url'))) ?>" target="_blank" id="anmelde_link" class="btn btn-lg btn-tariffuxx-blue my-3"><i class="fas fa-user-plus pr-1"></i> zur Partner-Anmeldung</a>
                        <div class="mb-2 mt-3 max-width-600" data-action="/wp-admin/admin-ajax.php" id="partner_id_form">
                            <div class="row">
                                <div class="col">
                                    <div class="md-form md-bg text-tariffuxx-blue my-3">
                                        <input type="text" name="tariffuxx_partner_id" class="form-control text-tariffuxx-blue" required="required" maxlength="50" value="<?php echo wp_kses_post(get_option('tariffuxx_partner_id')) ?>" id="tariffuxx_partner_id">
                                        <label for="description" class="active">TARIFFUXX-Partner-ID</label>
                                    </div>
                                </div>
                                <div class="col-auto my-auto">
                                    <i class="fa fa-info-circle help" data-toggle="tooltip" data-placement="right" title="" data-original-title="Trage hier deine TARIFFUXX-Partner-ID ein."></i>
                                </div>
                            </div>
<?php /*
                            <div class="row">
                                <div class="col">
                                    <div class="md-form md-bg text-tariffuxx-blue my-3">
                                        <textarea type="text" name="tariffuxx_custom_css" rows="20" class="form-control md-textarea text-tariffuxx-blue"  id="tariffuxx_custom_css"><?php echo wp_kses_post(get_option('tariffuxx_custom_css')) ?></textarea>
                                        <label for="description" class="active">Individuelles CSS</label>
                                    </div>
                                </div>
                                <div class="col-auto my-auto">
                                    <i class="fa fa-info-circle help" data-toggle="tooltip" data-placement="right" title="" data-original-title="Trage hier dein individuelles CSS ein."></i>
                                </div>
                            </div>
*/ ?>
                            <input type='hidden' name='action' value='save_tariffuxx_options'>
                            <button onclick="ajax_submit('#partner_id_form'); hide_anmelde_link();" class="btn btn-success">speichern</button>
                        </div>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>

<script>
    function hide_anmelde_link() {
        if (jQuery('#tariffuxx_partner_id').val().length > 0) {
            jQuery('#anmelde_link').addClass('d-none');
        } else {
            jQuery('#anmelde_link').removeClass('d-none');
        }
    }

    document.addEventListener("DOMContentLoaded", function(event) {
        hide_anmelde_link();
    });
</script>