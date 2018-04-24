$(document).ready(function () {
    function onSessionOpen(session) {
        var data = {
            user: user,
            event: 'join'
        };

        session.publish(channel, JSON.stringify(data));

        session.subscribe(channel, function (topic, event) {
            if (event.msg.length > 0) {
                $('#message_container').prepend(event.msg);
            }
        });

        $(document).on('submit', '#session_message_form', function (e) {
            e.preventDefault();

            var input = $('#message'),
                data = {
                user: user,
                content: input.val(),
                event: 'default'
            };

            session.publish(channel, JSON.stringify(data));

            input.val('').removeClass('is-valid').removeAttr('aria-invalid');
            input.closest('label').removeClass('float');
        });

        $(document).on('click', '[data-action="quit-session"]', function (e) {
            var data = {
                user: user,
                event: 'quit'
            };

            session.publish(channel, JSON.stringify(data));
        });
    }

    function onError(code, reason, detail) {
        console.warn('Error:', code, reason, detail);
    }

    ab.connect('ws://localhost:8888/session', onSessionOpen, onError);

    var esConn = new ReconnectingEventSource(streamRoute),
        active = true;

    esConn.addEventListener('playersCount', function (e) {
        $('#players_count').html(JSON.parse(e.data));
    });

    esConn.addEventListener('players', function (e) {
        $('#session_players').html(JSON.parse(e.data));
        $('.list-group-item.active').prependTo($('#session_players'));
    });

    esConn.addEventListener('end', function (e) {
        if(active && !isGm){
            $('#leave_modal').modal({
                backdrop: 'static'
            });
            active = false;
        }
    });

    $("#session_message_form").validate({
        rules: {
            message: {
                required: true,
                maxlength: 2000,
                normalizer: function(value) {
                    return $.trim(value);
                }
            }
        },
        onkeyup: false,
        errorClass: "is-invalid",
        validClass: "is-valid",
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo( element.parent() );
        }
    });
});
