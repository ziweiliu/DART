<?php
$root_DIR = "../../";
include_once $root_DIR.'includes/db_connect.php';
include_once $root_DIR . 'includes/schedule_functions.php';
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script type="text/javascript" src="<?php echo $DIR; ?>/js/handlebars-v2.0.0.js"></script>
    <link href="<?php echo $DIR ?>/css/core.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $DIR ?>/css/schedule.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $DIR ?>/js/jquery.js"> </script>
    <script src="<?php echo $DIR ?>/js/main.js"></script>
    <script src="<?php echo $DIR ?>/js/selectSchedule.js"></script>
    <title>View Schedule</title>
</head>
<body>
<div id="overlay" class="hidden">
    <div id="overlay-close"></div>
    <div id="overlay-display">
        <?php include $root_DIR.'includes/overlay-template.php'; ?>
    </div>
</div>
<div id="wrapper">
    <div id="container">
        <?php
        include $root_DIR.'includes/header.php';
        schedule::to_JS(schedule::getSchedule(1));

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
    displayUnavailableSlots(arraySchedule);
</script>
</body>
</html>