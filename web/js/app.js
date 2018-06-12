$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('.scrollbar-macosx').scrollbar();

    $(document).on('keyup', '.form-control', function () {
        $(this).parent().find('.floating-label').toggleClass('float', $(this).val().length > 0);
    });

    $('.form-control[value]:not([value=""])').parent().find('.floating-label').toggleClass('float');

    $(document).on('focus', '.form-control', function () {
        $(this).removeAttr('readonly');
    });
});
