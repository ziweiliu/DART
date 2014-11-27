<?php
session_start();
$root_DIR = "../../";
include_once $root_DIR . 'includes/db_connect.php';
include_once $root_DIR . 'includes/schedule_functions.php';
include_once $root_DIR . 'includes/session_functions.php';
if (empty($_GET['day_id'])) {//Empty request
    header("location: " . $DIR . "/index.php");
}
$day_id = test_input($_GET['day_id']);
if (!isset($_SESSION['uscID'])) {//Session not started
    header("location: " . $DIR . "/index.php?message=error");
} else if ($_SESSION['isAdmin'] == true) {//Admin should not be looking at this page...
    header("location: " . $DIR . "/schedule/viewSchedule/index.php?day_id=$day_id");
} else {
    $cust_id = $_SESSION['customerInfo']['cust_id'];
}


?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script type="text/javascript" src="<?php echo $DIR; ?>/js/handlebars-v2.0.0.js"></script>
    <link href="<?php echo $DIR ?>/css/core.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $DIR ?>/css/schedule.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $DIR ?>/css/UI-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo $DIR ?>/js/jquery.js"></script>
    <script src="<?php echo $DIR ?>/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="<?php echo $DIR ?>/js/main.js"></script>
    <title>View Schedule</title>
</head>
<body>
<div id="overlay" class="hidden">
    <div id="overlay-close"></div>
    <div id="overlay-display">
        <?php include $root_DIR . 'includes/overlay-template.php'; ?>
    </div>
</div>
<script src="<?php echo $DIR ?>/js/selectSchedule.js"></script>
<div id="wrapper">
    <div id="container">
        <?php
        include $root_DIR . 'includes/header.php';

        $arrayDays = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
        $day_desc = $arrayDays[$day_id - 1];
        schedule::time_to_JS(schedule::getTimes($day_id));
        schedule::to_JS(schedule::getSchedule($day_id));
        schedule::location_to_JS(schedule::generateLocation());
        ?>
        <div id="content">
            <h2 id="todayTitle"><?php echo $day_desc ?></h2>

            <div id="scheduleWrapper">

                <div class="time-wrapper">
                    <?php echo schedule::generateTimes(1); ?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(1, 1); ?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(2, 1); ?>
                </div>
                <div class="time-wrapper">
                    <?php echo schedule::generateTimes(2); ?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(1, 2); ?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(2, 2); ?>
                </div>
                <div class="time-wrapper">
                    <?php echo schedule::generateTimes(3); ?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(1, 3); ?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(2, 3); ?>
                </div>
                <div class="time-wrapper">
                    <?php echo schedule::generateTimes(4); ?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(1, 4); ?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(2, 4); ?>
                </div>
            </div>
        </div>
        <div id="footer">

        </div>
    </div>
</div>
<script>
    var id = <?php echo $cust_id ?>;
    console.log(id);
    displayUnavailableSlots(arraySchedule, id);
</script>
</body>
</html>