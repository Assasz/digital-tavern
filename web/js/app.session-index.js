$(document).ready(function () {
    $('#search').keyup(function () {
        var form = $('#session_search_form');

        $.ajax({
            url: form.attr('action'),
            dataType: 'json',
            method: 'POST',
            data: form.serialize(),
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