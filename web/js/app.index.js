$(document).ready(function () {
    $('.form-control').keyup(function () {
        $(this).parent().find('.floating-label').toggleClass('float', $(this).val().length > 0);
    });

    $('.form-control').focus(function () {
       $(this).removeAttr('readonly');
    });
});