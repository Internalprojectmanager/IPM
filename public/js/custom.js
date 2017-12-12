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
            var jobCount = $('#new-count').text();
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
            $('#new-count').remove();
        },
    });
    window.history.pushState("", "", url);
});

<!-- MODAL BOX -->
// Get the modal
var modal = document.getElementById('addClientModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function () {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

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
