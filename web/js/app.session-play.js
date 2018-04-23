$(document).ready(function () {
    function onSessionOpen(session) {
        var data = {
            user: user,
            event: 'join'
        };

        session.publish(channel, JSON.stringify(data));

        session.subscribe(channel, function (topic, event) {
            if (event.msg.length > 0) {
                switch (event.type) {
                    case 'sessionNotification':
                        $('.session-chat').prepend('<p>' + event.msg + '</p>');
                        break;
                    default:
                        $('.session-chat').prepend('<p>' + event.ign + ': ' + event.msg + '</p>');
                        break;
                }
            }
        });

        $(document).on('keyup', '#test', function (e) {
            if(e.keyCode === 13){
                e.preventDefault();

                var data = {
                    user: user,
                    msg: $(this).val(),
                    event: 'default'
                };

                session.publish(channel, JSON.stringify(data));

                $(this).val('');
            }
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
        if(active){
            $('#leave_modal').modal({
                backdrop: 'static'
            });
            active = false;
        }
    });
});
