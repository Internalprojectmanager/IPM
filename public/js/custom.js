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

$('body').on('click', '.pagination a, .results>thead>tr>th a', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    getData(url);
});


function getData(url) {
    var url = new URL(url);

    console.log(url);
    var page = url.searchParams.get("page");
    var sort = url.searchParams.get("sort");
    var order = url.searchParams.get("order");

    if(page !== null){
        document.getElementById("page").value = page;
    } else {
        document.getElementById("page").value = "1";
    }

    if(sort !== null){
        document.getElementById("sort").value = sort;
    }

    if(order !== null){
        document.getElementById("order").value = order;
    }

    sort = document.getElementById("sort").value;
    order = document.getElementById("order").value;
    page = document.getElementById("page").value;

    var search = "";
    var client = "";
    var status = "";

    search = $('#searchfield').val();
    client = $('#client').val();
    status = $('#status').val();

    var _token = document.getElementsByName("_token")[0].value;
    var url = $('.searchform').attr('action');
    $.ajax({
        url: url,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': _token},
        data: { search:search, client:client, status:status, sort: sort, order:order, page:page},

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
    url = url+"?sort="+sort+"&order="+order+"&page="+page;
    window.history.pushState("", "", url);
}

$('.search').bind('keyup change', function (e) {
    e.preventDefault();
    var url = $('.searchform').attr('action');
    getData(url);
});

<!-- MODAL BOX -->
// Get the modal
var modal = document.getElementById('addClientModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("modal-close")[0];
var a = document.getElementsByClassName("modal-cancel")[0];

// When the user clicks the button, open the modal
btn.onclick = function () {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}
a.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

function projectDetailsDown() {
    document.getElementById("block-hidden").classList.toggle("show");
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
