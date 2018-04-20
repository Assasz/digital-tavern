$(document).ready(function () {
    loadSessionPlayActions()
});

$(document).on('pjax:end', function () {
    loadSessionPlayActions()
});

function loadSessionPlayActions() {
    var esConn = new EventSource(playersRoute);

    esConn.onopen = function(e) {
        //console.log("Connection established!");
    };

    esConn.onmessage = function (e) {
        $('#session_players').html(JSON.parse(e.data));
        $('.list-group-item.active').prependTo($('#session_players'));
    };

    esConn.addEventListener('playersCount', function (e) {
        $('#players_count').html(JSON.parse(e.data));
    });
}