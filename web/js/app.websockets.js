$(document).ready(function () {
    loadPageActions();
});

$(document).on('pjax:end', function () {
    loadPageActions();
});

function loadPageActions() {
    if(typeof conn === 'undefined') {
        var conn = new WebSocket('ws://localhost:8888');
    }

    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        console.log(e.data);
    };
}