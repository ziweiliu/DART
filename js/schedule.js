function populateSchedule(schedule) {
    for (var i = 0; i < schedule.length; i++) {
        var timeblock = schedule[i].timeblock_id;
        var firstName = schedule[i].firstName;
        var cart_id = schedule[i].cart_id;
        var color = schedule[i].color;
        if (schedule[i].nickName != '') {
            firstName = schedule[i].nickName;
        }
        var info = "Name: " + firstName + " " + schedule[i].lastName + "<br />";
        info += "PU Loc: " + schedule[i].start_loc + "<br />";
        info += "DO Loc: " + schedule[i].end_loc + "<br />";
        info += "Cell: " + schedule[i].cell + "<br />";
        $("[data-attr='" + timeblock + "'][data-cart='" + cart_id + "']").html(info);
        $("[data-attr='" + timeblock + "'][data-cart='" + cart_id + "']").css("background-color", color);
    }
}
var template_admin = Handlebars.compile($('#overlay-template-admin').html());
var renderOverlay = function (cart_id, timeblock_id) {
        var i = 0;
        for (var k = 0; k < arraySchedule.length; k++) {
            if (arraySchedule[k]['timeblock_id'] == timeblock_id && arraySchedule[k]['cart_id'] == cart_id) {
                i = k;
            }
        }
        var html = template_admin(arraySchedule[i]);
    return html;
};
var displayOverlay = function (html) {
    $('#overlay-display').html(html);
};
$(document).ready(function () {
    $(".info").on("click", function () {
        var timeblock_id = $(this).attr('data-attr');
        var cart_id = $(this).attr('data-cart');
            $('#overlay')
                .removeClass('hidden')
                .addClass('shown');
            displayOverlay(renderOverlay(cart_id, timeblock_id));
    });
    $('#overlay-close').on('click', function () {
        console.log('clicked #overlay-close');

        $(this).parent()
            .removeClass('shown')
            .addClass('hidden');

        $('body').removeClass('no-scroll');
    });
})

