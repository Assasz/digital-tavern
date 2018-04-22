$(document).ready(function () {
    loadSessionPlayActions()
});

$(document).on('pjax:end', function () {
    loadSessionPlayActions()
});

function loadSessionPlayActions() {
    var esConn = new ReconnectingEventSource(playersRoute);

    esConn.addEventListener('playersCount', function (e) {
        $('#players_count').html(JSON.parse(e.data));
    });

    esConn.addEventListener('players', function (e) {
        $('#session_players').html(JSON.parse(e.data));
        $('.list-group-item.active').prependTo($('#session_players'));
    });

    function onSessionOpen(session) {
        session.subscribe(channel, function (topic, event) {
            if(event.msg.length > 0) {
                switch(event.type){
                    case 'sessionNotification':
                        $('.session-chat').prepend('<p>' + event.msg + '</p>');
                        break;
                    case 'playersChange':
                        $('#session_players').html(event.msg);
                        $('.list-group-item.active').prependTo($('#session_players'));
                        $('#players_count').html(event.count);
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

        $(document).on('click', '[data-action="quit-session"]', function () {
            var data = {
                user: user,
                event: 'quit'
            };

            session.publish(channel, JSON.stringify(data));

            playersRoute = null;
            esConn.close();

            channel = null;
        });
    }

    function onError(code, reason, detail) {
        console.warn('Error:', code, reason, detail);
    }

    var wsConn = ab.connect('ws://localhost:8888/session', onSessionOpen, onError);
}