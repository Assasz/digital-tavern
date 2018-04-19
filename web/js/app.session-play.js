$(document).ready(function () {
    loadSessionPlayActions()
});

$(document).on('pjax:end', function () {
    loadSessionPlayActions()
});

function loadSessionPlayActions() {
    $('.list-group-item.active').prependTo($('#session_players'));
}