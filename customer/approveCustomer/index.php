<?php

session_start();
$root_DIR = "../../";
include_once $root_DIR . 'includes/db_connect.php';
include_once $root_DIR . 'includes/session_functions.php';
include_once $root_DIR . 'includes/customer_functions.php';

if (!isset($_SESSION['uscID'])) {//Session not started
    header("location: " . $DIR . "/index.php?message=error");
} else if ($_SESSION['isAdmin'] == true) {
    if (empty($_GET['cust_id'])) {//catches random admin people without the GET variable
        header("location: ../index.php");
    }
    $cust_id = $_GET['cust_id'];
} else {//non admins cannot view this page
    header("location: " . $DIR . "/index.php?message=error");
}
$customer_info = customer::getCustomerInfo($cust_id);
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
    <script>
        $(document).ready(function () {
            $("input[name='status']").change(function () {
                console.log(this);
                if ($(this).val() == 2) {
                    $("#denyReason").prop("readonly", false);
                    $("#denyReason").prop("required", true);
                    $("#denyReason").css("background-color", "inherit");
                }
                if ($(this).val() == 1) {
                    $("#denyReason").prop("readonly", true);
                    $("#denyReason").css("background-color", "gray");
                    $("#denyReason").val("");
                }
            });
        })
    </script>
    <style>
        #warning {
            color: red;
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
                <form method="POST" action="submit.php">

                    <h4>Customer Information:</h4>
                    <label>First Name: </label><?php echo $customer_info['firstName']; ?><br/>
                    <label>Nick Name: </label><?php echo $customer_info['nickName']; ?><br/>
                    <label>Last Name: </label><?php echo $customer_info['lastName']; ?><br/>
                    <label>USC ID: </label><?php echo $customer_info['uscID']; ?><br/>
                    <label>Classification: </label><?php echo $customer_info['classification']; ?><br/>
                    <label>Start Date: </label><?php echo $customer_info['startDate']; ?><br/>
                    <label>End Date: </label><span id="endDate"><?php echo $customer_info['endDate']; ?></span><br/>
                    <h4>Actions:</h4>
                    <label>Approve Customer:</label><input type="radio" name="status" value="1" required>Approve<br/>
                    <label>Deny Customer: </label><input type="radio" name="status" value="2" required>Deny<br/>
                    <label>Deny Reason: </label><textarea name="denyReason" id="denyReason"><?php echo $customer_info['deny_reason']; ?></textarea><br/>
                    <input type="hidden" name="cust_id" value="<?php echo $cust_id ?>" />
                    <input type="submit" value="Submit">
                </form>

            </div>

        </div>
    </div>
    <?php include $root_DIR . 'includes/footer.php'; ?>
</div>

</body>
</html>