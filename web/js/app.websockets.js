$(document).ready(function () {
    loadWebsockets();
});

$(document).on('pjax:end', function () {
    loadWebsockets();
});

function loadWebsockets() {
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