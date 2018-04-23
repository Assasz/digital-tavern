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
});