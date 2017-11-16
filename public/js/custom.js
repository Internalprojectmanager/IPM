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

/* SEARCH FUNCTION */
$(document).ready(function() {
    $(".search").keyup(function () {
        var searchTerm = $(".search").val();
        var listItem = $('.results tbody').children('tr');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('");

        $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
            return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });

        $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','false');
        });

        $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','true');
        });

        var jobCount = $('.results tbody tr[visible="true"]').length;
        $('.counter').text(jobCount + ' Projects');

        if(jobCount == '1') {
            $('.results tbody tr[visible="true"]').length;
            $('.counter').text(jobCount + ' Project');
        }

        if(jobCount == '0') {$('.no-result').show();}
        else {$('.no-result').hide();}
    });
});