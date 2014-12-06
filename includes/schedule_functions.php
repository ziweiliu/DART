<?php
include_once 'db_connect.php';

class schedule
{
    public static function generateTimes($col)
    {
        global $con;
        $html = "<div class='time' style='height:19px; padding: 0px;'></div>";
        $time_block = [];
        $sql = "SELECT timeblock_id, TIME_FORMAT(start_time, '%H:%i') as start_time FROM schedule_timeblock";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            exit (mysqli_error($con));
        }
        while ($r = mysqli_fetch_assoc($result)) {
            array_push($time_block, $r);
        }
        $max = ($col - 1) * 12 + 12;
        $start = ($col - 1) * 12;
        for ($i = $start; $i < $max; $i++) {
            $html = $html . "<div class = 'time'>" . $time_block[$i]['start_time'] . "</div>";
        }
        return $html;
    }

    public static function getTimes($day_id)
    {
        global $con;
        $time_block = [];
        $days_array = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
        $day_desc = $days_array[$day_id - 1];
        $sql = "SELECT timeblock_id, TIME_FORMAT(start_time, '%H:%i') as start_time, TIME_FORMAT(end_time, '%H:%i') as end_time FROM schedule_timeblock";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            exit (mysqli_error($con));
        }
        while ($r = mysqli_fetch_assoc($result)) {
            for ($k = 1; $k < 3; $k++) {
                $array_info = array('day_id' => $day_id, 'cart_id' => $k, 'day_desc' => $day_desc);
                array_push($time_block, array_merge($r, $array_info));
            }
        }
        return $time_block;
    }

    public static function time_to_JS($time_block)
    {
        $times_json = json_encode($time_block);
        ?>
        <script>
            var arrayTimes = <?php echo $times_json; ?>;
        </script>
    <?php
    }

    public static function generateLayout($cart_id, $col)
    {
        $html = "<div class = 'info' style='height:20px'>DART $cart_id</div>";
        $max = ($col - 1) * 12 + 12;
        $start = ($col - 1) * 12;
        for ($i = $start; $i < $max; $i++) {
            $timeblock_id = $i + 1;
            $html = $html . "<div data-attr = '$timeblock_id' data-cart = '$cart_id' class='info'></div>";
        }
        return $html;
    }

    public static function getSchedule($day_id)
    {
        global $con;
        $schedule = [];
        $days_array = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
        $day_desc = $days_array[$day_id - 1];
        $sql = "SELECT event_id, schedule_event.cust_id, schedule_timeblock.timeblock_id, start_loc, end_loc, cart_id, firstName, lastName, nickName, cell, color, TIME_FORMAT(start_time, '%H:%i') as start_time, TIME_FORMAT(end_time, '%H:%i') as end_time FROM schedule_event, customers, schedule_timeblock WHERE dayofweek_id = $day_id AND customers.cust_id = schedule_event.cust_id AND schedule_timeblock.timeblock_id = schedule_event.timeblock_id AND schedule_event.isActive = 1";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            exit (mysqli_error($con));
        }
        while ($r = mysqli_fetch_assoc($result)) {
            $array_info = array('day_id' => $day_id, 'day_desc' => $day_desc);
            array_push($schedule, array_merge($r, $array_info));
        }
        return $schedule;
    }

    public static function to_JS($schedule)
    {
        $schedule_json = json_encode($schedule);
        ?>
        <script>
            var arraySchedule = <?php echo $schedule_json; ?>;
        </script>
    <?php
    }

    public static function generateLocation()
    {
        global $con;
        $arrayLocations = [];
        $sql = "SELECT * FROM building_locations";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            exit (mysqli_error($con));
        }
        while ($r = mysqli_fetch_array($result)) {
            array_push($arrayLocations, $r['location_abbr'] . "-" . $r['location_desc']);
        }
        return $arrayLocations;
    }

    public static function location_to_JS($arrayLocation)
    {
        $location_json = json_encode($arrayLocation);
        ?>
        <script>
            var arrayLocation = <?php echo $location_json; ?>;
        </script>
    <?php
    }

    public static function getAllSchedule($cust_id)
    {
        global $con;
        $arrayInfo = [];
        $sql = "SELECT event_id, schedule_event.timeblock_id, schedule_event.dayofweek_id, start_loc, end_loc, cart_id, start_date, end_date, day_description, TIME_FORMAT(start_time, '%H:%i') as start_time, TIME_FORMAT(end_time, '%H:%i') as end_time FROM schedule_event, schedule_timeblock, schedule_daysofweek WHERE schedule_daysofweek.dayofweek_id=schedule_event.dayofweek_id AND schedule_timeblock.timeblock_id = schedule_event.timeblock_id AND cust_id=$cust_id";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            exit (mysqli_error($con));
        }
        while ($r = mysqli_fetch_assoc($result)) {
            array_push($arrayInfo, $r);
        }
        return $arrayInfo;
    }
    public static function getDayDesc($day_id){
        $days_array = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
        $day_desc = $days_array[$day_id - 1];
        return $day_desc;
    }
}