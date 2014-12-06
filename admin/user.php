<?php

session_start();
$root_DIR = "../";
include_once $root_DIR . 'includes/db_connect.php';
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
    </script>
    <title>User Management</title>
    <style>
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
        <h4>Employees:</h4>
        <table><tr><th>First Name</th><th>Last Name</th><th>USC ID</th><th>Action</th></tr>
            <?php echo admin::getEmployees(); ?>
        </table>
        <h4>Customers:</h4>
        <table><tr><th>First Name</th><th>Last Name</th><th>USC ID</th><th>Action</th></tr>
            <?php echo admin::getCustomers(); ?>
        </table>
    </div>
</div>
</div>
<?php include $root_DIR . 'includes/footer.php'; ?>
</div>

</body>
</html>