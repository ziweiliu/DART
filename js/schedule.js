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


