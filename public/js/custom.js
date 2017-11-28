$(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});


$('.searchform').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});

$('.search').bind('keyup change', function (e) {
    var postData = $('.searchform').serializeArray();
    var _token = document.getElementsByName("_token")[0].value;;
    var url = $('.searchform').attr('action');
    console.log(url);
    $.ajax({
        url: url,
        type: 'POST',
        data: { data:postData, _token: _token},

        success: function (result) {
            $('.bigtable').remove();
            $('.container').append(result);
            var jobCount = $('table tbody tr').length;
            var type = $('.contenttype').text();
            switch(type){
                case 'Projects':
                    type = 'Project';
                    break;
                case 'Project':
                    type = 'Project';
                    break;
                case 'Client':
                    type = 'Client';
                    break;
                case 'Clients':
                    type = 'Client';
                    break;
            }
            if(jobCount == 1) {
                $('.contenttype').text(type);
            }else{
                $('.contenttype').text(type+'s');
            }
            $('.counter').text(jobCount);
        },
    });
    window.history.pushState("", "", url);
});