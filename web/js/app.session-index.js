$(document).ready(function () {
    $('#search').keyup(function () {
        $.ajax({
            url: $('#session_search').attr('action'),
            dataType: 'json',
            method: 'POST',
            data: $('#session_search').serialize(),
            success: function (response) {
                $('#sessions_container').html(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $(document).on('click', '[data-action="join-private"]', function (e) {
        e.preventDefault();

        var modal = $('#join_private_modal');

        modal.find('.modal-title').html('Join ' + $(this).data('name') + ' session');
        modal.find('form').attr('action', $(this).data('path'));

        modal.modal();
    });
});