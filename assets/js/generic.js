function showMessage(text, type = 'success') {
    let options = {
        "closeButton": true,
        "newestOnTop": true,
        "progressBar": true,
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": 0,
        "hideDuration": 0,
        "timeOut": 2000,
        "extendedTimeOut": 2000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    if ('error' === type) {
        toastr.error(text, 'Fehler!', options);
    }

    if ('success' === type) {
        toastr.success(text, 'Erfolgreich!', options);
    }
    console.log(text);
}

function initForm() {
    // jQuery('input.form-control').each(function() {
    //     jQuery(this).trigger('change');
    // });
    jQuery('[data-toggle="tooltip"]').tooltip();
}

function set_ref_product_type_id_1(uncheck_subs = true) {
    jQuery('#product-type-mobile-tool-preselection').removeClass('d-none');
    jQuery('#product-type-fixed-line-tool-preselection').addClass('d-none');
    jQuery('#product-type-mobile-data-tool-preselection').addClass('d-none');
    jQuery('#awaiting-product-type-selection').remove();
    if (uncheck_subs) {
        jQuery("button[type='submit']").attr('disabled', 'disabled');
        jQuery("input[name='product_type_mobile_tool_preselection']").prop('checked', false);
        jQuery("input[name='product_type_fixed_line_tool_preselection']").prop('checked', false);
        jQuery("input[name='product_type_mobile_data_tool_preselection']").prop('checked', false);
    }
}

function set_ref_product_type_id_2(uncheck_subs = true) {
    jQuery('#product-type-mobile-tool-preselection').addClass('d-none');
    jQuery('#product-type-fixed-line-tool-preselection').removeClass('d-none');
    jQuery('#product-type-mobile-data-tool-preselection').addClass('d-none');
    jQuery('#awaiting-product-type-selection').remove();
    if (uncheck_subs) {
        jQuery("button[type='submit']").attr('disabled', 'disabled');
        jQuery("input[name='product_type_mobile_tool_preselection']").prop('checked', false);
        jQuery("input[name='product_type_fixed_line_tool_preselection']").prop('checked', false);
        jQuery("input[name='product_type_mobile_data_tool_preselection']").prop('checked', false);
    }
}

function set_ref_product_type_id_3(uncheck_subs = true) {
    jQuery('#product-type-mobile-tool-preselection').addClass('d-none');
    jQuery('#product-type-fixed-line-tool-preselection').addClass('d-none');
    jQuery('#product-type-mobile-data-tool-preselection').removeClass('d-none');
    jQuery('#awaiting-product-type-selection').remove();
    if (uncheck_subs) {
        jQuery("button[type='submit']").attr('disabled', 'disabled');
        jQuery("input[name='product_type_mobile_tool_preselection']").prop('checked', false);
        jQuery("input[name='product_type_fixed_line_tool_preselection']").prop('checked', false);
        jQuery("input[name='product_type_mobile_data_tool_preselection']").prop('checked', false);
    }
}

function startScripts() {
    if (0 < jQuery('input.form-control').length) {
        initForm();
    }

    console.log('CHOSEN!');
    jQuery('.chosen').chosen(
        {
            width:  "100%",
            allow_single_deselect: true
        }
    );

    jQuery("#ref-product-type-id-1").click(function() {
        if (false === jQuery(this).is(':checked')) {
            return false;
        }

        set_ref_product_type_id_1();
    });

    jQuery("#ref-product-type-id-2").click(function() {
        if (false === jQuery(this).is(':checked')) {
            return false;
        }
        set_ref_product_type_id_2();
    });


    jQuery("#ref-product-type-id-3").click(function() {
        if (false === jQuery(this).is(':checked')) {
            return false;
        }
        set_ref_product_type_id_3();
    });

    var ref_product_type_id_val = jQuery("input[name='ref_product_type_id']").val();
    if (ref_product_type_id_val !== undefined && ref_product_type_id_val > 0) {
        if (ref_product_type_id_val === '1') {
            set_ref_product_type_id_1(false);
        } else if (ref_product_type_id_val === '2') {
            set_ref_product_type_id_2(false);
        } else if (ref_product_type_id_val === '3') {
            set_ref_product_type_id_3(false);
        }
    }

    jQuery("input[name='product_type_mobile_tool_preselection'] + label").click(function () {
        jQuery("button[type='submit']").removeAttr('disabled');
    })

    jQuery("input[name='product_type_fixed_line_tool_preselection'] + label").click(function () {
        jQuery("button[type='submit']").removeAttr('disabled');
    })

    jQuery("input[name='product_type_mobile_data_tool_preselection'] + label").click(function () {
        jQuery("button[type='submit']").removeAttr('disabled');
    })

    jQuery(".click-and-copy").click(function() {
        jQuery(this).select();
        document.execCommand('copy');
        showMessage("Code wurde in die Zwischenablage kopiert.", "success")
    });
}

jQuery(document).ready(function() {
   startScripts();
});

function hide_current_nav_selection() {
    jQuery('.wp-has-submenu li').removeClass('current');
}


function fixedPreviewButton() {
    var mybutton = document.getElementById("fixedPreviewButton");
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
}


