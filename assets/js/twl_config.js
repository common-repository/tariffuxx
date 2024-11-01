var pickrs = {};
var delayTimer;

function twlConfigStartScripts() {
    const body = jQuery('body');
    let colorAccordion = jQuery('#accordionColor1');

    body.on('click', '.twl-color-input', function() {
        let id = jQuery(this).attr('id');
        console.log(id);
        console.log(pickrs);
        pickrs[id].show();
    });

    jQuery('#collapseThree3 .accordion').on('show.bs.collapse','.collapse', function() {
        jQuery('#collapseThree3 .accordion').find('.collapse.in').collapse('hide');
    });

    jQuery('.accordion').on('shown.bs.collapse', function () {
        let id = jQuery('#collapseThree3 .in .twl-color-picker').attr('data-id');

        if (id !== undefined) {
            let inputPickerElement = document.querySelector('#picker-' + id);

            if (pickrs[id] !== undefined) {
                pickrs[id].destory();
            }

            pickrs[id] = new Pickr({
                el: inputPickerElement,
                // useAsButton: true,
                default: jQuery('#' + id).val(),
                theme: 'nano',
                autoReposition: true,
                position: 'top-middle',
                inline: true,
                defaultRepresentation: 'HEX',
                components: {
                    preview: true,
                    hue: true,

                    interaction: {
                        hex: false,
                        input: true,
                        clear: true,
                        save: false
                    }
                },
                i18n: {
                    'btn:save': 'Übernehmen',
                    'btn:cancel': 'Abbrechen',
                    'btn:clear': 'Zurücksetzen',
                    'aria:btn:save': 'uebernehmen und schliessen',
                    'aria:btn:cancel': 'abbrechen und schliessen',
                    'aria:btn:clear': 'zuruecksetzen und schliessen'
                }
            }).on('init', pickr => {
                let inputField = jQuery('#' + id);
                let colorText = pickr.getSelectedColor().toHEXA().toString(0).replace('#', '');
                let invertedColorText = invertColor(colorText);

                pickrs[id].applyColor(colorText);

                inputField.val(colorText);
                inputField.attr('style', 'background-color:#' + colorText + ';color:#' + invertedColorText);
                inputField.prev('i').attr('style', 'color:#' + invertedColorText);
                inputField.next('label').attr('style', 'color:#' + invertedColorText);
            }).on('change', color => {
                let inputField = jQuery('#' + id);
                inputField.attr('name', inputField.data('name'));
                if (null === color) {
                    let defaultColorText = inputField.attr('data-default');
                    let invertedDefaultColor = invertColor(defaultColorText);
                    inputField.val(defaultColorText);
                    inputField.attr('style', 'background-color:#' + defaultColorText + ';color:#' + invertedDefaultColor);
                    inputField.prev('i').attr('style', 'color:#' + invertedDefaultColor);
                    inputField.next('label').attr('style', 'color:#' + invertedDefaultColor);

                    return false;
                }

                let colorText = color.toHEXA().toString(0).replace('#', '');
                let invertedColorText = invertColor(colorText);

                inputField.val(colorText);
                inputField.attr('style', 'background-color:#' + colorText + ';color:#' + invertColor(colorText));
                inputField.prev('i').attr('style', 'color:#' + invertedColorText);
                inputField.next('label').attr('style', 'color:#' + invertedColorText);
                pickrs[id].applyColor(colorText);

                clearTimeout(delayTimer);
                delayTimer = setTimeout(function() {
                    ajax_submit('form');
                }, 1000);

            }).on('clear', pickr => {
                let inputField = jQuery('#' + id);
                let defaultColorText = inputField.attr('data-default');
                let invertedDefaultColor = invertColor(defaultColorText);
                inputField.attr('name', inputField.data('name'));
                inputField.val(defaultColorText);
                inputField.attr('style', 'background-color:#' + defaultColorText + ';color:#' + invertedDefaultColor);
                inputField.prev('i').attr('style', 'color:#' + invertedDefaultColor);
                inputField.next('label').attr('style', 'color:#' + invertedDefaultColor);
                ajax_submit('form');
            });
        }
    });
    //});

    // colorAccordion.on('hide.bs.collapse', function() {
    //     pickerTxtD.destroyAndRemove();
    // });


    function getMultiselectValues(id) {
        let selectVal = '';
        let isIndividual = false;

        jQuery('#' + id + ' option:not([disabled])').each(function() {
            if (true === this.selected) {
                if (0 < selectVal.length) {
                    selectVal += '-';
                }

                selectVal += this.value;
            } else {
                isIndividual = true;
            }
        });

        return true === isIndividual ? selectVal : '';
    }

    function getMultiCheckboxValues(id) {
        let selectVal = '';
        let isIndividual = false;

        jQuery('#' + id + ' input').each(function() {
            if (true === jQuery(this).is(':checked')) {
                if (0 < selectVal.length) {
                    selectVal += '-';
                }

                selectVal += this.value;
            } else {
                isIndividual = true;
            }
        });

        return true === isIndividual ? selectVal : '';
    }

    function invertColor(hex) {
        if (hex.indexOf('#') === 0) {
            hex = hex.slice(1);
        }

        if (hex.length !== 6) {
            return '000000';
        }

        let r = parseInt(hex.slice(0, 2), 16),
            g = parseInt(hex.slice(2, 4), 16),
            b = parseInt(hex.slice(4, 6), 16);

        return (r * 0.299 + g * 0.587 + b * 0.114) > 186 ? '000000' : 'FFFFFF';
    }

    handleConfigDependencies();
}

jQuery(document).ready(function() {
    twlConfigStartScripts();
});

function handleConfigDependencies() {
    if (jQuery('#providers').length > 0 && jQuery('#providers').val().length > 0) {
        jQuery('#card-providers_excl').addClass('is_disabled');
        jQuery('#card-providers_excl .card_collapse').prop('disabled', true);
    } else {
        jQuery('#card-providers_excl').removeClass('is_disabled');
        jQuery('#card-providers_excl .card_collapse').prop('disabled', false);
    }

    if (jQuery('#providers_excl').length > 0 && jQuery('#providers_excl').val().length > 0) {
        jQuery('#card-providers').addClass('is_disabled');
        jQuery('#card-providers .card_collapse').prop('disabled', true);
    } else {
        jQuery('#card-providers').removeClass('is_disabled');
        jQuery('#card-providers .card_collapse').prop('disabled', false);
    }
}