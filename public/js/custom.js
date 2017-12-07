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

function projectDetailsDown() {
    document.getElementById("project-description").classList.toggle("show");
    document.getElementById("description-project").classList.toggle("show");
    document.getElementById("contact-person").classList.toggle("show");
    document.getElementById("user-icon").classList.toggle("show");
    document.getElementById("contact-name").classList.toggle("show");
    document.getElementById("phone-icon").classList.toggle("show");
    document.getElementById("contact-phone").classList.toggle("show");
    document.getElementById("email-icon").classList.toggle("show");
    document.getElementById("contact-email").classList.toggle("show");


    if(document.getElementById('project-details').style.height == '292px'){
        document.getElementById("black-button-down").classList.remove('black-button-up');
        document.getElementById('project-details').style.height = '209px';
        document.getElementById('button-files').style.top = '277px';
        document.getElementById('button-people').style.top = '277px';
        document.getElementById('button-pdf').style.top = '277px';
    }else{
        document.getElementById("black-button-down").classList.add('black-button-up');
        document.getElementById('project-details').style.height = '292px';
        document.getElementById('button-files').style.top = '361px';
        document.getElementById('button-people').style.top = '361px';
        document.getElementById('button-pdf').style.top = '361px';
    }
}
