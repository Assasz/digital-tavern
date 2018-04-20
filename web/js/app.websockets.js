$(document).ready(function () {
    loadWebSocketsActions();
});

$(document).on('pjax:end', function () {
    loadWebSocketsActions();
});

var wsConn;

function loadWebSocketsActions() {

    if(!(wsConn instanceof WebSocket)) {
        wsConn = new WebSocket('ws://localhost:8888');
    }

    wsConn.onopen = function(e) {
        console.log("Connection established!");
    };

    wsConn.onmessage = function(e) {
        console.log(e.data);
    };
}