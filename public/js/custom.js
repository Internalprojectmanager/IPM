$('body').on('click', '.feature a', function (e) {
    e.preventDefault();
    console.log('click');

    var url = $(this).attr('href');
    getPage(url);
    window.history.pushState("", "", url);
});

function getPage(url) {
    $.ajax({
        url: url
    }).done(function (data) {
        $('.feature').html(data);
    }).fail(function () {
        alert('Cards could not be loaded.');
    });
}

$(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});