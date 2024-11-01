jQuery(document).ready(function() {
    const body = jQuery('body');
    const toolEntry = jQuery('#tool-entry');

    toolEntry.on('show.bs.modal', function (e) {
        let modal = jQuery(this);
        let button = jQuery(e.relatedTarget);
        let url = window.txUrls.editTool + '/' + button.attr('data-content');

        jQuery.ajax({
            url: url
        }).done(function(data) {
            modal.find('.modal-content').html(data);
            initForm();
        }).fail(function () {
            showMessage('Der Tarifvergleich konnte nicht geladen werden.', 'error');
        });
    });

    toolEntry.on('hidden.bs.modal', function () {
        jQuery(this).find('.modal-content').html('');
    });

});