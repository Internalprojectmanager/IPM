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

$('body').on('change', '.assignee-check', function (e) {
    var curl = window.location.href;
    e.preventDefault();
    var url = $(this).attr('href');
    saveStatus(url, curl);
});

$('.deletefile').on( 'click', function (e) {
    var pid = $(this).parent().attr("id");
    var curl = window.location.href;
    e.preventDefault();
    var url = $(this).attr('href');
    deleteFile(url, pid, curl);
});



function saveStatus(url, curl){
    var _token = document.getElementsByName("_token")[0].value;
    var formData = new Array();

    $("input:checkbox").each(function() {
        var json = $(this).val();
        if($(this.checked).length > 0){
            var result = $.extend(JSON.parse(json), {"checked":1});
        }else{
            var result = $.extend(JSON.parse(json), {"checked":0});
        }

        formData.push(result);
    });
    console.log(formData);

    $.ajax({
        url: url,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': _token},
        data: {data: formData},
        success: function (result) {
            $('.requirement-results').remove();
            $('.container').append(result);
        }
    });
    window.history.pushState("", "", curl);
}
function deleteFile(url, pid, curl) {
    var _token = document.getElementsByName("_token")[0].value;
    console.log(url);
    $.ajax({
        url: url,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': _token},
        data: {},
        success: function (result) {
            $('#'+pid).remove();

            if(!$(".download")[0]){
                $('.uploaded').remove();
            }

        },
    });
    window.history.pushState("", "", curl);
}

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



function projectDetailsDown() {
    document.getElementById("block-hidden").classList.toggle("show");
    if(document.getElementById('black-button-down').classList.contains('black-button-up')){
        document.getElementById("black-button-down").classList.remove('black-button-up');
        document.getElementById('project-details').style.height = '209px';
        document.getElementById('block-show').style.height = '127px';
        document.getElementById('project-details').style.paddingBottom = '0px';
        document.getElementById('button-top').style.marginTop = '2px';
        document.getElementById('no-buttons').classList.remove('pull-right');

    }else{
        document.getElementById("black-button-down").classList.add('black-button-up');
        document.getElementById('project-details').style.height = 'auto';
        document.getElementById('project-details').style.paddingBottom = '70px';
        document.getElementById('block-show').style.height = 'auto';
        document.getElementById('button-top').style.marginTop = '5px';
        document.getElementById('no-buttons').classList.add('pull-right');
    }
}

function showTS(){
    document.getElementById('ts-arrow').classList.toggle('arrow-down');
    document.getElementById('tstable').classList.toggle('display');

}

function showScope(){
    document.getElementById('scope-arrow').classList.toggle('arrow-down');
    document.getElementById('scopetable').classList.toggle('display');
}

function showNF(){
    document.getElementById('nf-arrow').classList.toggle('arrow-down');
    document.getElementById('nftable').classList.toggle('display');
}



