$(document).on('click touchstart', '.clickable-row', function () {
    $(".container").addClass("disabled");
    $("#loader-container").show();
    window.location = $(this).data("href");
});

$('.searchform').on('keyup keypress', function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});

$(document).on('click', '.pagination a, .results>thead>tr>th a', function (e) {
    $(".container").addClass("disabled");
    $("#loader-container").show();
    e.preventDefault();
    var url = $(this).attr('href');
    getData(url);
});

$(document).on('change', '.assignee-check', function (e) {
    $(".container").addClass("disabled");
    $("#loader-container").show();
    var curl = window.location.href;
    e.preventDefault();
    var url = $(this).attr('href');
    console.log(url, curl);
    saveStatus(url, curl);
});

$('.deletefile').on('click', function (e) {
    var pid = $(this).parent().attr("id");
    var curl = window.location.href;
    e.preventDefault();
    var url = $(this).attr('href');
    deleteFile(url, pid, curl);
});


$(document).on('click', '.remove_feature', function () {
    var id = $(this).prop('id');
    var parent = $(this).closest("div").prop("id");
    var before = "";
    var label = "";

    if (confirm('Are you sure you want to remove this requirement?')) {
        switch (parent) {
            case "featurereq":
                before = "fr";
                label = "Feature";
                break;
            case "nfreq":
                before = "nf";
                label = "NFR";
                break;
            case "tsreq":
                before = "ts";
                label = "TS";
                break;
            case "scope":
                break;
        }

        $("#" + before + "-tablabel" + id).remove();
        $("#" + before + "-tablabel" + id).remove();
        $("#" + before + "-tab" + id).remove();
        $("#" + before + "-req" + id).remove();
        var removed = parseInt($('#' + before + '-removed').html()) + 1;
        $('#' + before + '-removed').html(removed);
        $('input:radio[name=' + before + '-tabsetreq]:nth(1)').attr('checked', true);
    }


});

$(document).on('click', '.tab', function () {
    var id = $(this).prop("id");
    var parent = $(this).closest("div").prop("id");
    var before = "";
    var label = "";
    switch (parent) {
        case "featurereq":
            before = "fr";
            label = "Feature";
            break;
        case "nfreq":
            before = "nf";
            label = "NFR";
            break;
        case "tsreq":
            before = "ts";
            label = "TS";
            break;
        case "scope":
            break;
    }
    var removed = $('#' + before + '-removed').html();
    var hidden = $("." + before + "-tabs:hidden").prop('id');
    var currentCount = $("." + before + "-tabs", $("#" + parent)).length + 1;
    var currentCountmin = currentCount - 1;
    var reqid = before + "-req" + currentCount;
    if ($('input#' + before + '-newreq').is(':checked')) {
        if (currentCount < 11) {
            var lastreq = $("#" + parent + " .tab-panels").children().last().prop('id').slice(6);
            currentCountRemoveed = currentCount + parseInt(removed);
            var req1 = $("#" + before + "-req1");
            var newlabel = $("<label>").text(label + ' Requirement ' + currentCount).attr({
                id: before + "-tablabel" + currentCountRemoveed,
                for: before + "-tab" + currentCountRemoveed
            });
            newlabel.append('<button class="remove_feature" id="' + currentCountRemoveed + '" type="button">×</button>').trigger('create');
            var newRadio = $(document.createElement('input'))
                .attr({
                    id: before + '-tab' + currentCountRemoveed,
                    class: before + "-tabs tab",
                    name: before + "-tabsetreq",
                    type: "radio"
                });
            newRadio.attr('aria-controls', before + "-req" + currentCountRemoveed);
            newRadio.insertAfter("#" + before + "-tablabel" + lastreq);
            newlabel.insertAfter(newRadio);

            req1.clone().appendTo("#" + parent + " .tab-panels").prop('id', before + "-req" + currentCountRemoveed).removeAttr('hidden');
            var row = $('#' + before + '-req' + currentCountRemoveed);
            row.find("input[type='text']").val("");
            row.find("input[type='hidden']").remove();
            $('#' + before + '-req1 select').clone().appendTo('#' + parent + ' .tab-panels #' + before + '-req' + currentCountRemoveed + ' .assignee').attr("name", 'assignee[' + currentCountRemoveed + '][]');
            row.find('.assignee div').remove();
            row.find('textarea').attr('name', 'requirement_description[' + currentCountRemoveed + ']').val('');
            row.find('input').attr('name', 'requirement_name[' + currentCountRemoveed + ']');
            row.find("option").removeAttr('selected');
            row.find(".assignee select").selectpicker();

            $("#" + parent + " #" + before + "-tab" + currentCountRemoveed).prop("checked", true);
            $('input#' + before + '-newreq').prop("checked", false);
        } else {
            $('#' + before + '-feature-full').removeClass('hidden');
            $("#" + parent + " #" + before + "-tab" + currentCount).prop("checked", true);
            setTimeout(function () {
                $('#' + before + '-feature-full').attr('class', 'hidden');
                $('input#' + before + '-newreq').prop("checked", false);
            }, 10000);


        }
    }
});


function saveStatus(url, curl) {
    var _token = document.getElementsByName("_token")[0].value;
    var formData = new Array();

    $(".assignee-check").each(function () {
        var json = JSON.parse($(this).val());
        formData.push(json);
    });

    $.ajax({
        url: url,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': _token},
        data: {data: formData},
        success: function (result) {
            $('.requirement-results').remove();
            $('.container').append(result);

            $(".container").removeClass("disabled");
            $("#loader-container").hide();
        }
    });
    window.history.pushState("", "", curl);
}

function deleteFile(url, pid, curl) {
    var _token = document.getElementsByName("_token")[0].value;
    $.ajax({
        url: url,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': _token},
        data: {},
        success: function (result) {
            $('#' + pid).remove();

            if (!$(".download")[0]) {
                $('.uploaded').remove();
            }

        },
    });
    window.history.pushState("", "", curl);
}

function getData(url) {
    var url = new URL(url);
    var page = url.searchParams.get("page");
    var sort = url.searchParams.get("sort");
    var order = url.searchParams.get("order");

    if (page !== null) {
        document.getElementById("page").value = page;
    } else {
        document.getElementById("page").value = "1";
    }

    if (sort !== null) {
        document.getElementById("sort").value = sort;
    }

    if (order !== null) {
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
        data: {search: search, client: client, status: status, sort: sort, order: order, page: page},

        success: function (result) {
            $('.bigtable').remove();
            $('.container').append(result);
            var jobCount = $('#new-count').text();
            var type = $('.contenttype').text();
            switch (type) {
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
            if (jobCount == 1) {
                $('.contenttype').text(type);
            } else {
                $('.contenttype').text(type + 's');
            }
            $('.counter').text(jobCount);
            $('#new-count').remove();

        },
    });
    url = url + "?sort=" + sort + "&order=" + order + "&page=" + page;
    window.history.pushState("", "", url);
    $(".container").removeClass("disabled");
    $("#loader-container").hide();
}

var typingTimer;
var doneTypingInterval = 500;

//on keyup, start the countdown
$('.search').bind('keyup change', function (e) {
    var keyCode = e.which;
    clearTimeout(typingTimer); // doesn't matter if it's 0
    if ( !( (keyCode >= 48 && keyCode <= 57)
        ||(keyCode >= 65 && keyCode <= 90)
        || (keyCode >= 97 && keyCode <= 122) )
        && keyCode != 8 && keyCode != 32) {
        e.preventDefault();
    } else{
        typingTimer = setTimeout(searchdoneTyping, doneTypingInterval);
        $(".bigtable").addClass("disabled");
        $("#loader-container").show();
    }
});

$('.dropdown-search').on('change', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(searchdoneTyping, doneTypingInterval);
    $(".bigtable").addClass("disabled");
    $("#loader-container").show();
});

//on keydown, clear the countdown
$('.search').bind('keydown', function () {
    clearTimeout(typingTimer);
});

function searchdoneTyping(){
    var url = $('.searchform').attr('action');
    getData(url);
    if (document.readyState === 'complete') {
        setTimeout(2000);
        $(".bigtable").removeClass("disabled");
        $("#loader-container").hide();
        $('.container').focus();
    }
}


function projectDetailsDown() {
    document.getElementById("block-hidden").classList.toggle("show");
    if (document.getElementById('black-button-down').classList.contains('black-button-up')) {
        document.getElementById("black-button-down").classList.remove('black-button-up');
        document.getElementById('project-details').style.height = '209px';
        document.getElementById('block-show').style.height = '127px';
        document.getElementById('project-details').style.paddingBottom = '0px';
        document.getElementById('button-top').style.marginTop = '2px';
        document.getElementById('no-buttons').classList.remove('pull-right');

    } else {
        document.getElementById("black-button-down").classList.add('black-button-up');
        document.getElementById('project-details').style.height = 'auto';
        document.getElementById('project-details').style.paddingBottom = '70px';
        document.getElementById('block-show').style.height = 'auto';
        document.getElementById('button-top').style.marginTop = '5px';
        document.getElementById('no-buttons').classList.add('pull-right');
    }
}

function showTS() {
    document.getElementById('ts-arrow').classList.toggle('arrow-down');
    document.getElementById('tstable').classList.toggle('display');

}

function showScope() {
    document.getElementById('scope-arrow').classList.toggle('arrow-down');
    document.getElementById('scopetable').classList.toggle('display');
}

function showNF() {
    document.getElementById('nf-arrow').classList.toggle('arrow-down');
    document.getElementById('nftable').classList.toggle('display');
}

