<script id="overlay-template-others" type="template">
    <?php
    $customer_info = session::getCustomerInfo($_SESSION['uscID']);
    $firstName = $customer_info['firstName'];
    if ($customer_info['nickName'] != "") {
        $firstName = $customer_info['nickName'];
    }
    ?>
    <div id="overlay-info">
        <form method="POST" action="submit.php">
            <h3>Adding to the schedule for:</h3>
            <label>Name: </label><?php echo $firstName . " " . $customer_info['lastName']; ?>
            <br/>
            <label>Cart Number: </label>DART <input type="text" readonly class="readonly" name="cart_id"
                                                    value="{{cart_id}}"/>
            <br/>
            <label>Day of the Week: </label><input type="text" readonly class="readonly" value="{{day_desc}}"/><input
                type="hidden" name="day_id" value="{{day_id}}"/>
            <br/>
            <label>Pick-up Time: </label><input type="text" readonly class="readonly" value="{{start_time}}"/><input
                type="hidden" name="timeblock_id" value="{{timeblock_id}}"/>
            <br/>
            <label>Drop-off Time: </label><input type="text" readonly class="readonly" value="{{end_time}}"/>
            <br/>
            <label>Pick-up Location:</label><input name="pu-loc" id="pu-loc" size="30"/>
            <br/>
            <label>Drop-off Location:</label><input name="do-loc" id="do-loc" size="30"/>
            <br/>
            <input type="hidden" name="submit_type" value="submit"/>
            <input type="submit" value="Submit Request"/>
        </form>
    </div>

    <div class="clear"></div>
</script>
<script id="overlay-template-self" type="template">
    <?php
    $customer_info = session::getCustomerInfo($_SESSION['uscID']);
    $firstName = $customer_info['firstName'];
    if ($customer_info['nickName'] != "") {
        $firstName = $customer_info['nickName'];
    }
    ?>
    <div id="overlay-info">
        <form method="POST" action="submit.php">
            <h3>Modifying the schedule for:</h3>
            <label>Name: </label><?php echo $firstName . " " . $customer_info['lastName']; ?>
            <br/>
            <label>Cart Number: </label>DART <input type="text" readonly class="readonly" name="cart_id"
                                                    value="{{cart_id}}"/>
            <br/>
            <label>Day of the Week: </label><input type="text" readonly class="readonly" value="{{day_desc}}"/><input
                type="hidden" name="day_id" value="{{day_id}}"/>
            <br/>
            <label>Pick-up Time: </label><input type="text" readonly class="readonly" value="{{start_time}}"/><input
                type="hidden" name="timeblock_id" value="{{timeblock_id}}"/>
            <br/>
            <label>Drop-off Time: </label><input type="text" readonly class="readonly" value="{{end_time}}"/>
            <br/>
            <label>Pick-up Location:</label><input name="pu-loc" id="pu-loc" value="{{start_loc}}" size="30"/>
            <br/>
            <label>Drop-off Location:</label><input name="do-loc" id="do-loc" value="{{end_loc}}" size="30"/>
            <br/>
            <label>Cancel Pickup:</label><input type="checkbox" id="cancel" name="cancel"/>I choose to cancel this
            pick-up
            <br/>
            <input type="hidden" name="submit_type" value="update"/>
            <input type="hidden" name="event_id" value="{{event_id}}"/>
            <input type="submit" value="Update Request"/>
        </form>
    </div>
    <div class="clear"></div>
</script>
<script id="overlay-template-admin" type="template">

    <div id="overlay-info">
        <form method="POST" action="submit.php">
            <h3>Modifying the schedule for:</h3>
            <label>Name: </label>{{firstName}} {{lastName}}
            <br/>
            <label>Cart Number: </label>DART <input type="text" readonly class="readonly" name="cart_id"
                                                    value="{{cart_id}}"/>
            <br/>
            <label>Day of the Week: </label><input type="text" readonly class="readonly" value="{{day_desc}}"/><input
                type="hidden" name="day_id" value="{{day_id}}"/>
            <br/>
            <label>Pick-up Time: </label><input type="text" readonly class="readonly" value="{{start_time}}"/><input
                type="hidden" name="timeblock_id" value="{{timeblock_id}}"/>
            <br/>
            <label>Drop-off Time: </label><input type="text" readonly class="readonly" value="{{end_time}}"/>
            <br/>
            <label>Pick-up Location:</label><input name="pu-loc" id="pu-loc" value="{{start_loc}}" size="30"/>
            <br/>
            <label>Drop-off Location:</label><input name="do-loc" id="do-loc" value="{{end_loc}}" size="30"/>
            <br/>
            <label>Cancel Pickup:</label><input type="checkbox" id="cancel" name="cancel"/>Cancel this
                                        pick-up
            <br/>
            <input type="hidden" name="submit_type" value="update"/>
            <input type="hidden" name="event_id" value="{{event_id}}"/>
            <input type="submit" value="Update Request"/>
        </form>
    </div>
    <div class="clear"></div>
</script>
<script>
    $("#overlay").on("click", "#pu-loc", function () {
        $(this).autocomplete({
            source: arrayLocation,
            change: function (event, ui) {
                if (ui.item == null) {
                    $("#pu-loc").val('');
                    $("#pu-loc").focus();
                }
            }
        })
    });
    $("#overlay").on("click", "#do-loc", function () {
        $(this).autocomplete({
            source: arrayLocation,
            change: function (event, ui) {
                if (ui.item == null) {
                    $("#do-loc").val('');
                    $("#do-loc").focus();
                }
            }
        })
    });
    $("#overlay").on("click", "#cancel", function () {
        if ($("#cancel").prop('checked') == true) {
            alert("Please note that once a pick-up is cancelled, you might not be able to request service in the same timeslot in the future.");
        }

    });
</script>