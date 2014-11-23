<?php
session_start();
$_SESSION['id'] = 27; //placeholder
$root_DIR = "../../";
include_once $root_DIR.'includes/db_connect.php';
include_once $root_DIR . 'includes/schedule_functions.php';
include_once $root_DIR . 'includes/session_functions.php';
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script type="text/javascript" src="<?php echo $DIR; ?>/js/handlebars-v2.0.0.js"></script>
    <link href="<?php echo $DIR ?>/css/core.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $DIR ?>/css/schedule.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $DIR ?>/css/UI-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo $DIR ?>/js/jquery.js"> </script>
    <script src="<?php echo $DIR ?>/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="<?php echo $DIR ?>/js/main.js"></script>
    <title>View Schedule</title>
</head>
<body>
<div id="overlay" class="hidden">
    <div id="overlay-close"></div>
    <div id="overlay-display">
        <?php include $root_DIR.'includes/overlay-template.php'; ?>
    </div>
</div>
<script src="<?php echo $DIR ?>/js/selectSchedule.js"></script>
<div id="wrapper">
    <div id="container">
        <?php
        include $root_DIR.'includes/header.php';
        schedule::time_to_JS(schedule::getTimes(1));
        schedule::to_JS(schedule::getSchedule(1));
        schedule::location_to_JS(schedule::generateLocation());
        ?>
        <div id="content">
            <h2 id="todayTitle"></h2>
            <div id="scheduleWrapper">

                <div class="time-wrapper">
                    <?php echo schedule::generateTimes(1);?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(1, 1);?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(2, 1);?>
                </div>
                <div class="time-wrapper">
                    <?php echo schedule::generateTimes(2);?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(1, 2);?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(2, 2);?>
                </div>
                <div class="time-wrapper">
                    <?php echo schedule::generateTimes(3);?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(1, 3);?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(2, 3);?>
                </div>
                <div class="time-wrapper">
                    <?php echo schedule::generateTimes(4);?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(1, 4);?>
                </div>
                <div class="info-wrapper">
                    <?php echo schedule::generateLayout(2, 4);?>
                </div>
            </div>
        </div>
        <div id="footer">

        </div>
    </div>
</div>
<script>
    var id = <?php echo $_SESSION['id'] ?>;
    displayUnavailableSlots(arraySchedule, id);
</script>
</body>
</html>