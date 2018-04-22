$(document).ready(function () {
    $(document).pjax('a', '#pjax-container', {
        'timeout': 5000
    });

    $(document).on('submit', 'form[data-pjax]', function(event) {
        $.pjax.submit(event, '#pjax-container');
    });

    $(document).on('pjax:send', function () {
        NProgress.start();

        if(wsConn instanceof autobahn){
            wsConn = null;
        }
    });

    $(document).on('pjax:end', function () {
        NProgress.done();
    });

    loadGlobalActions();
});

$(document).on('pjax:end', function () {
    loadGlobalActions();
});

function loadGlobalActions() {
    $('[data-toggle="tooltip"]').tooltip();

    $('.scrollbar-macosx').scrollbar();

    $(document).on('keyup', '.form-control', function () {
        $(this).parent().find('.floating-label').toggleClass('float', $(this).val().length > 0);
    });

    $(document).on('focus', '.form-control', function () {
        $(this).removeAttr('readonly');
    });
}