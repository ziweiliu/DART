function displayUnavailableSlots(schedule, id){
    for (var i = 0; i < schedule.length; i++){
        var timeblock = schedule[i].timeblock_id;
        var cart_id = schedule[i].cart_id;
        $("[data-attr='" + timeblock + "'][data-cart='" + cart_id + "']").css("background-color", "gray");
        $("[data-attr='" + timeblock + "'][data-cart='" + cart_id + "']").attr("data-avail", "false");
        if (schedule[i].cust_id == id){
            var firstName = schedule[i].firstName;
            if (schedule[i].nickName != ''){
                firstName = schedule[i].nickName;
            }
            var info = "Name: " + firstName + " " + schedule[i].lastName + "<br />";
            info += "PU Loc: " + schedule[i].start_loc + "<br />";
            info += "DO Loc: " + schedule[i].end_loc + "<br />";
            info += "Cell: " + schedule[i].cell + "<br />";
            $("[data-attr='" + timeblock + "'][data-cart='" + cart_id + "']").html(info);
            $("[data-attr='" + timeblock + "'][data-cart='" + cart_id + "']").css("background-color", "yellow");
        }

    }
}

var template = Handlebars.compile($('#overlay-template').html());
var renderOverlay = function(cart_id,timeblock_id){
    var html = "";
    var i = 0;
    for (var k = 0; k < arrayTimes.length; k++){
        if (arrayTimes[k]['timeblock_id'] == timeblock_id && arrayTimes[k]['cart_id'] == cart_id){
            var i = k;
        }
    }
    html = template(arrayTimes[i]);
    return html;
}
var displayOverlay = function(html){
    $('#overlay-display').html(html);
}
$(document).ready(function(){
    $(".info").on("click", function(){
        if ($(this).attr("data-avail")== "false"){
            alert("Sorry, this slot is already taken, please select another one.");
        }
        else {
            $('#overlay')
                .removeClass('hidden')
                .addClass('shown');

            $('body').addClass('no-scroll');
            var timeblock_id = $(this).attr('data-attr');
            var cart_id = $(this).attr('data-cart');
            displayOverlay(renderOverlay(cart_id, timeblock_id));
        }
    });
    $('#overlay-close').on('click', function() {
        console.log('clicked #overlay-close');

        $(this).parent()
            .removeClass('shown')
            .addClass('hidden');

        $('body').removeClass('no-scroll');
    });
})