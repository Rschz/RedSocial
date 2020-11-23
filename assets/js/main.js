$(function() {
    console.log("ready!");
    $('#staticBackdrop').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var content = button.data('whatever');
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-body input#edited-publish').val(content);
        modal.find('.modal-body input#id-publish').val(id);
    });
});