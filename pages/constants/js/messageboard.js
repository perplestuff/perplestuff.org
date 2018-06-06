var scroll = 0;
var update = 0;
function refresh(){
    $.ajax({
        type: "GET",
        url: "ajax",
        dataType: "html",
        success: function(res){
            $("#scroll").html(res);
        }
    });
}
$(document).ready(function(){
    $('#autoUpdate').prop('checked', true);
    $('#autoScroll').prop('checked', true);
    $("#refresh").click(function(){refresh();});
    $('#autoUpdate').change(function(){
        if ($(this).is(':checked')) {
            startMessage();
        } else {
            endMessage();
        }
    });
    $('#autoScroll').change(function(){
        if ($(this).is(':checked')) {
            startScroll();
        } else {
            endScroll();
        }
    });
});
$("#scroll").ready(function(){
    setTimeout(function(){$("#scroll").scrollTop($("#scroll").prop("scrollHeight"));}, 50);
});
function startScroll(){scroll = setInterval(function(){$("#scroll").animate({scrollTop: $('#scroll').prop("scrollHeight")});}, 1000);}
function endScroll(){clearInterval(scroll);}
function startMessage(){update = setInterval(function(){refresh();}, 5000);}
function endMessage(){clearInterval(update);}
