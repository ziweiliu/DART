<?php
include_once 'db_connect.php';
class schedule {
    public static function generateTimes($col){
        global $con;
        $html = "<div class='time' style='height:19px; padding: 0px;'></div>";
        $time_block = [];
        $sql = "SELECT timeblock_id, TIME_FORMAT(start_time, '%H:%i') as start_time FROM schedule_timeblock";
        $result = mysqli_query($con, $sql);
        if (!$result){
            exit (mysqli_error($con));
        }
        while ($r = mysqli_fetch_assoc($result)) {
            array_push($time_block, $r);
        }
        $max = ($col-1)*12 + 12;
        $start = ($col-1)*12;
        for ($i = $start; $i < $max; $i++){
            $html = $html . "<div class = 'time'>".$time_block[$i]['start_time']."</div>";
        }
        return $html;
    }
    public static function generateLayout($cart_id, $col){
        $html = "<div class = 'info' style='height:20px'>DART $cart_id</div>";
        $max = ($col-1)*12 + 12;
        $start = ($col-1)*12;
        for ($i = $start; $i < $max; $i++){
            $timeblock_id = $i + 1;
            $html = $html . "<div data-attr = '$timeblock_id' data-cart = '$cart_id' class='info'></div>";
        }
        return $html;
    }
    public static function getSchedule($day_id){
        global $con;
        $schedule = [];
        $sql = "SELECT event_id, schedule_event.cust_id, timeblock_id, start_loc, end_loc, cart_id, firstName, lastName, nickName, cell FROM schedule_event, customers WHERE dayofweek_id = $day_id AND customers.cust_id = schedule_event.cust_id";
        $result = mysqli_query($con, $sql);
        if (!$result){
            exit (mysqli_error($con));
        }
        while ($r = mysqli_fetch_assoc($result)){
            array_push($schedule, $r);
        }
        return $schedule;
    }
    public static function to_JS($schedule){
        $schedule_json = json_encode($schedule);
        ?>
        <script>
            var arraySchedule = <?php echo $schedule_json; ?>;
            console.log(arraySchedule);
        </script>
        <?php
    }
}