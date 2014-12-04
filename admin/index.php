<?php
session_start();
$root_DIR = "../";
include_once $root_DIR . 'includes/db_connect.php';
include_once $root_DIR . 'includes/session_functions.php';
include_once $root_DIR . 'includes/admin_functions.php';

if (!isset($_SESSION['uscID'])) {//Session not started
    header("location: " . $DIR . "/index.php?message=error");
} else if ($_SESSION['isAdmin'] == false) {
    header("location: " . $DIR . "/index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="<?php echo $DIR ?>/css/UI-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $DIR ?>/css/core.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo $DIR ?>/js/jquery.js"></script>
    <script src="<?php echo $DIR ?>/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="<?php echo $DIR ?>/js/main.js"></script>
    <script>
        $().ready(function () {
            $("#datepicker1").datepicker({
                minDate: 0,
                dateFormat: "yy-mm-dd",
                beforeShowDay: $.datepicker.noWeekends
            });
            $("#datepicker2").datepicker({
                minDate: 0,
                maxDate: 60,
                dateFormat: "yy-mm-dd",
                beforeShowDay: $.datepicker.noWeekends
            });
        })
    </script>
    <title>Index</title>
    <style>
        label{
            width: 300px;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="container">
        <?php
        include $root_DIR . 'includes/header.php';
        ?>
        <div id="content">
            <div id="innerContent">
                <h2>Admin Interface</h2>
                <h3>Statistics:</h3>
                <h4>Customers:</h4>
                <label>Total Number of Riders:</label><?php echo admin::customerStats('total') ?><br />
                <label>Number of Active Riders:</label><?php echo admin::customerStats('active') ?><br />
                <label>Number of Inactive Riders:</label><?php echo admin::customerStats('inactive') ?><br />
                <label>Average Number of Days Requested:</label><?php echo admin::customerStats('averageDays') ?><br />
                <label>Total Number of Riders Not Approved:</label><?php echo admin::customerStats('notApproved') ?><br />
                <label>Total Number of Long-Term Requests:</label><?php echo admin::customerStats('longTerm') ?><br />
                <h4>Schedule:</h4>
                <label>Total Number of Scheduled Rides:</label><?php echo admin::scheduleStats('total') ?><br />
                <label>Total Number of Active Rides:</label><?php echo admin::scheduleStats('active') ?><br />
                <label>Total Number of Inactive Rides:</label><?php echo admin::scheduleStats('inactive') ?><br />
                <label>Total Number Active - Monday:</label><?php echo admin::scheduleStats('Monday') ?><br />
                <label>Total Number Active - Monday:</label><?php echo admin::scheduleStats('Tuesday') ?><br />
                <label>Total Number Active - Monday:</label><?php echo admin::scheduleStats('Wednesday') ?><br />
                <label>Total Number Active - Monday:</label><?php echo admin::scheduleStats('Thursday') ?><br />
                <label>Total Number Active - Monday:</label><?php echo admin::scheduleStats('Friday') ?><br />
            </div>
        </div>
    </div>
    <?php include $root_DIR . 'includes/footer.php'; ?>
</div>

</body>
</html>