function displayUnavailableSlots(schedule){
    for (var i = 0; i < schedule.length; i++){
        var timeblock = schedule[i].timeblock_id;
        var cart_id = schedule[i].cart_id;
        $("[data-attr='" + timeblock + "'][data-cart='" + cart_id + "']").css("background-color", "gray");
        $("[data-attr='" + timeblock + "'][data-cart='" + cart_id + "']").attr("data-avail", "false");
    }
}
$(document).ready(function(){
    $(".info").on("click", function(){
        console.log($(this).attr("data-avail"));
        if ($(this).attr("data-avail")== "false"){
            alert("Sorry, this slot is already taken, please select another one.");
        }
        else {
            $('#overlay')
                .removeClass('hidden')
                .addClass('shown');

            $('body').addClass('no-scroll');
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
