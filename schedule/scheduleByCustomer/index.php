<?php
/**
 * Created by PhpStorm.
 * User: NaNo
 * Date: 11/26/2014
 * Time: 10:53 AM
 */
session_start();
$root_DIR = "../../";
include_once $root_DIR . 'includes/db_connect.php';
include_once $root_DIR . 'includes/session_functions.php';
include_once $root_DIR . 'includes/schedule_functions.php';


if (!isset($_SESSION['uscID'])) {//Session not started
    header("location: " . $DIR . "/index.php?message=error");
} else if ($_SESSION['isAdmin'] == true) {//Admin use the link to access the page
    if (empty($_GET['cust_id'])) {//catches random admin people without the GET variable
        header("location: ../index.php");
    }
    $cust_id = $_GET['cust_id'];
} else {//customers can only view themselves
    $cust_id = $_SESSION['customerInfo']['cust_id'];
}
$arrayInfo = schedule::getAllSchedule($cust_id);
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
    <title>Index</title>
</head>
<body>
<div id="wrapper">
    <div id="container">
        <?php
        include $root_DIR . 'includes/header.php';
        ?>
        <div id="content">
            <div id="innerContent">
                <h2>Viewing all scheduled services:</h2>
                <table>
                    <tr><th>Event ID</th><th>Day</th><th>Start Time</th><th>End Time</th><th>Start Location:</th><th>End Location</th></tr>
                    <?php
                    for ($i = 0; $i < sizeof($arrayInfo); $i++){
                        echo "<tr>";
                        echo "<td>".$arrayInfo[$i]['event_id']."</td><td>".$arrayInfo[$i]['day_description']."</td><td>".$arrayInfo[$i]['start_time']."</td><td>".$arrayInfo[$i]['end_time']."</td><td>".$arrayInfo[$i]['start_loc']."</td><td>".$arrayInfo[$i]['end_loc']."</td>";
                        echo "</tr>";
                    }
                    ?>

                </table>

            </div>

        </div>
    </div>
    <?php include $root_DIR . 'includes/footer.php'; ?>
</div>

</body>
</html>