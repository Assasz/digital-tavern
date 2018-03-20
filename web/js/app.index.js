$(document).ready(function () {
    loadIndexActions();
});

$(document).on('pjax:end', function () {
    loadIndexActions();
});

function loadIndexActions() {
    $(document).on('keyup', '.form-control', function () {
        $(this).parent().find('.floating-label').toggleClass('float', $(this).val().length > 0);
    });

    $(document).on('focus', '.form-control', function () {
        $(this).removeAttr('readonly');
    });
}