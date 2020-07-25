
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function openreservation(id) {

    $('#sidebarReservation').html('<div class="col-md-12 mt-5 text-center"><div class="spinner-border text-primary" role="status">\n' +
        '                <span class="sr-only">Loading...</span>\n' +
        '            </div></div>');
    $.ajax({
        url: 'therapist/'+id,
        method: "GET",
        success: function (response) {
            if (response) {
                $('#sidebarReservation').html(response);
            }
        }
    });
    var width = '450px';
    if ($(window).width() < 420) {
        width = '300px';
    }
    $('#sidebarReservation').width(width);
    $('#sidebarReservation').show("slide", { direction: "left" }, 1000);

    setTimeout(function() {
        $('.datepicker').datepicker();
    }, 500);
}

function closereservation() {
    $('#sidebarReservation').hide("slide", { direction: "left" }, 1000);
    return false;
}

function hidealert() {
    $('#MyNotify').modal('hide');
    $('#NotifyContent').html('');
}

function alertflash(type,message) {
    var cssclass = (type == 'success')? 'success' : 'danger';
    var newalert = '<div class="modal-body alert alert-'+cssclass+' mt-2">' + message + '</div>';
    $('#NotifyContent').append(newalert);
    $('#MyNotify').modal({
        keyboard: true
    });
    // remove modal backdrop
    //$('.modal-backdrop').removeClass("modal-backdrop");

    // hide alert after 2 sec
    setTimeout('hidealert()', 2000);
}

function loadtherapist() {

    var from_send   = $('#Scroll_loader_Icon').data('from-send');
    var url         = $('#Scroll_loader_Icon').data('main-url')+'?';
    var next        = $('#Scroll_loader_Icon').data('next-page');
    var last        = $('#Scroll_loader_Icon').data('last-page');
    //console.log(next+'='+last);
    if (next < parseInt(last+1) || from_send == 'search') {
        // show loading icon
        $('#Scroll_loader_Icon').show();

        //collect url from options
        var search = $('#search_input').val();
        if (search != '' && typeof search !== 'undefined') {
            url += 'search='+search+'&';
        }
        if (from_send == 'page') {
            url += 'page='+parseInt(next);
        }
        var htmlview = '';
        $.ajax({
            url:url,
            method:"GET",
            success:function(response)
            {
                if (response.last_page) {
                    $('#Scroll_loader_Icon').data('last-page',response.last_page);
                }
                if (response.current_page) {
                    $('#Scroll_loader_Icon').data('next-page',parseInt(response.current_page+1));
                }

                if (response.data) {
                    $.each(response.data, function (index, value) {
                        var title = value.title; title = title.substr(0, 20);
                        var desc = value.description; desc = desc.substr(0, 25);
                        htmlview += '<div class="col-md-3">\n' +
                            '    <div class="card shadow-lg p-3 mb-3 bg-white rounded-0 border-white">\n' +
                            '        <div class="m-auto">\n' +
                            '            <img\n' +
                            '                class="rounded-circle card-img-top shadow"\n' +
                            '                src="/avatars/therapists/'+value.picture+'"\n' +
                            '                style="width: 150px; height: 150px;"\n' +
                            '                alt="'+value.title+'"\n' +
                            '            >\n' +
                            '            <label class="position-absolute w-25 bg-warning text-center text-white p-1 rounded-pill" style="left: calc(50% - 30px); top:142px">\n' +
                            '                <i class="fa fa-star"></i>\n' +
                            '                5\n' +
                            '            </label>\n' +
                            '        </div>\n' +
                            '        <div class="text-sm-center mt-3 mb-3">\n' +
                            '            <h5>'+title+'</h5>\n' +
                            '            <p class="text-sm-center mt-3">\n' +
                            '                '+desc+'...\n' +
                            '                <br>\n' +
                            '                Fees : '+value.price+' EGP\n' +
                            '            </p>\n' +
                            '            <button class="btn btn-primary mt-2" onclick="openreservation(\''+value.id+'\')">\n' +
                            '                Book Now\n' +
                            '            </button>\n' +
                            '        </div>\n' +
                            '    </div>\n' +
                            '</div>\n';
                    });
                }

                var viewed_before = $('#Therapist_html_view > div.col-md-3').length;
                if (viewed_before > 0 && from_send == 'page') {
                    $('#Therapist_html_view').append(htmlview);
                }
                else {
                    $('#Therapist_html_view').html(htmlview);
                }
                $('#Scroll_loader_Icon').hide();
                var viewed_after = $('#Therapist_html_view > div.col-md-3').length;
                if (viewed_after < 1) {
                    $('#Therapist_html_view').html('<div class="col-md-12"><div class="alert alert-info" role="alert">No data </div></div>');
                }
                $('#Scroll_loader_Icon').data('from-send','page');
            }
        });
    }
    else {
        return false;
    }
}

function search() {
    $('#Scroll_loader_Icon').data('from-send','search');
    loadtherapist();
    return false;
}
function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    );
}

$(document).ready(function() {
    loadtherapist();

    $(window).scroll(function() {
        if(Math.ceil($(window).scrollTop() + $(window).height()) == getDocHeight()) {
            loadtherapist();
        }
    });
});
