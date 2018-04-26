$(document).ready(function () {
    $('#search').keyup(function () {
        var form = $('#user_search_form');

        $.ajax({
            url: form.attr('action'),
            dataType: 'json',
            method: 'POST',
            data: form.serialize(),
            success: function (response) {
                $('#users_container').html(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});