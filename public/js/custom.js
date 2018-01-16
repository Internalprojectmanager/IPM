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

$(document).on('click', '.pagination a, .results>thead>tr>th a', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    getData(url);
});

$(document).on('change', '.assignee-check', function (e) {
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

$(document).on('click', '.remove_feature', function(){
    var id = $(this).prop('id');
    var parent = $(this).closest("div").prop("id");
    var before = "";
    var label = "";
    switch (parent){
        case "featurereq":
            before = "fr";
            label = "Feature";
            break;
        case "nfrreq":
            before = "nfr";
            label = "NFR";
            break;
        case "tsreq":
            before = "ts";
            label = "TS";
            break;
        case "scope":
            break;
    }

        $("#"+ parent+" #"+before+ "-req"+id+" input").val("");
        $("#"+ parent+" #"+before+ "-req"+id+" textarea").val("");
        $("#"+ parent+" #"+before+ "-req"+id+" option").removeAttr("selected");
        $("#"+ parent+" #"+before+ "-req"+id+" select").selectpicker("refresh");
        $("#"+before+"-tablabel"+id).empty();
        $("#"+before+"-tablabel"+id).append(label+' Requirement '+ id +' <button class="remove_feature" id="'+id+'" type="button">×</button>');
        $("#"+before+"-tablabel"+id).css('display', 'none');
        $("#"+before+"-tab"+id).css('display', 'none');
        $("#"+before+"-req"+id).css('display', 'none');
        $("#"+parent+" #"+before+"-tab1").prop("checked", true);


});

$('.tab').on('click', function(){
    var id = $(this).prop("id");
    var parent = $(this).closest("div").prop("id");
    var before = "";
    var label = "";
    switch (parent){
        case "featurereq":
            before = "fr";
            label = "Feature";
            break;
        case "nfrreq":
            before = "nfr";
            label = "NFR";
            break;
        case "tsreq":
            before = "ts";
            label = "TS";
            break;
        case "scope":
            break;
    }

    var currentCount = $("."+before+"-tabs", $("#"+ parent)).length + 1;
    var currentCountmin = currentCount - 1;
    var reqid = before+"-req"+currentCount;
    if ($('input#'+before+'-newreq').is(':checked')) {
        if(currentCount < 11){
            if($("#"+before+"-req"+currentCount).length === 1){
                console.log($("#"+reqid).length);
                $("#"+before+"-tablabel"+id).css('display', 'block');
                $("#"+before+"-tab"+id).css('display', 'block');
                $("#"+parent+" #"+before+"-tab1").prop("checked", true);
            }else{
                console.log(currentCountmin);


                var req1 =  $("#"+before+"-req1");

                var newlabel = $("<label>").text(label+' Requirement '+currentCount).attr({id: before+"-tablabel"+currentCount, for: before+"-tab"+currentCount});
                newlabel.append('<button class="remove_feature" id="'+currentCount+'" type="button">×</button>').trigger('create');
                var newRadio = $(document.createElement('input'))
                    .attr({id: before+'-tab' + currentCount, class:before+"-tabs tab", name: before+"-tabsetreq", type: "radio"});
                newRadio.attr('aria-controls', reqid);
                console.log(newRadio);
                newRadio.insertAfter("#"+ before+"-tablabel"+currentCountmin);
                newlabel.insertAfter("#"+ before+"-tab"+currentCount);


                req1.clone().appendTo("#"+parent+" .tab-panels").prop('id', reqid).removeAttr('hidden');
                var row = $('#'+ before+ '-req' + currentCount);
                row.find("input[type='text']").val("");
                $('#'+ before+'-req1 select').clone().appendTo('#'+parent+' .tab-panels #'+before+'-req' + currentCount+' .assignee').attr("name", 'assignee['+currentCount+'][]');
                row.find('.assignee div').remove();
                row.find('textarea').attr('name', 'description['+currentCount+']').val('');
                row.find('input').attr('name', 'requirement_name['+currentCount+']');
                row.find("option").removeAttr('selected');
                row.find(".assignee select").selectpicker();

                $("#"+parent+" #"+before+"-tab" + currentCount).prop("checked", true);
                $('input#'+before+'-newreq').prop("checked", false);
            }
        }else{
            $("#"+parent+" .tab-panels #"+before+"-req" + currentCount).css("display", "block");
            $('#'+before+'-feature-full').removeClass('hidden');
            $("#"+parent+" #"+before+"-tab" + currentCount).prop("checked", true);
            setTimeout(function () {
                $('#'+before+'-feature-full').attr('class', 'hidden');
                $('input#'+before+'-newreq').prop("checked", false);
            }, 10000);


        }
    }
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

