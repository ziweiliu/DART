<script id="overlay-template" type="template">
    <?php
    $customer_info = session::getCustomerInfo($_SESSION['id']);
    $firstName = $customer_info['firstName'];
    if ($customer_info['nickName']!= ""){
        $firstName = $customer_info['nickName'];
    }
    ?>
    <div id="overlay-info">
        <form method="POST" action="submit.php">
            <h3>Adding to the schedule for:</h3>
            <label>Name: </label><?php echo $firstName." ".$customer_info['lastName']; ?>
            <br />
            <label>Cart Number: </label>DART <input type="text" readonly class="readonly" name="cart_id" value="{{cart_id}}" />
            <br />
            <label>Day of the Week: </label><input type="text" readonly class="readonly" value="{{day_desc}}" /><input type="hidden" name="day_id" value="{{day_id}}" />
            <br />
            <label>Pick-up Time: </label><input type="text" readonly class="readonly" value="{{start_time}}" /><input type="hidden" name="timeblock_id" value="{{timeblock_id}}" />
            <br />
            <label>Drop-off Time: </label><input type="text" readonly class="readonly" value="{{end_time}}" />
            <br />
            <label>Pick-up Location:</label><input name = "pu-loc" id="pu-loc" size="30"/>
            <br />
            <label>Drop-off Location:</label><input name = "do-loc" id="do-loc" size="30"/>
            <br />
            <input type="submit" value="Submit Request" />
        </form>
    </div>

    <div class="clear"></div>
</script>
<script>
    $("#overlay").on("click", "#pu-loc", function(){
        $(this).autocomplete({
            source: arrayLocation,
            change: function(event,ui)
            {
                if (ui.item==null)
                {
                    $("#pu-loc").val('');
                    $("#pu-loc").focus();
                }
            }
        })
    });
    $("#overlay").on("click", "#do-loc", function(){
        $(this).autocomplete({
            source: arrayLocation,
            change: function(event,ui)
            {
                if (ui.item==null)
                {
                    $("#do-loc").val('');
                    $("#do-loc").focus();
                }
            }
        })
    });
</script>