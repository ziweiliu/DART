<?php
session_start();
$root_DIR = "../../";
include_once $root_DIR . 'includes/db_connect.php';
include_once $root_DIR . 'includes/session_functions.php';


if (!isset($_SESSION['uscID'])) {//Session not started
    header("location: " . $DIR . "/index.php?message=error");
} else if ($_SESSION['isAdmin'] == true) {//Admin can't use this page
    header("location: " . $DIR . "/document/index.php");
} else {//customers can only view themselves
    $cust_id = $_SESSION['customerInfo']['cust_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="<?php echo $DIR ?>/css/UI-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $DIR ?>/css/core.css" rel="stylesheet" type="text/css"/>
    <title>New Document</title>
</head>
<body>
<?php
include $root_DIR."includes/header.php";
?>
<div id="wrapper">
    <div id="container">
        <div id="content">
            <div id="form">
                <h2>Uploading new documentation</h2>
                <form method="POST" action="submit.php" enctype="multipart/form-data">
                    <input type="hidden" name="cust_id" value="<?php echo $cust_id ?>" />
                    <input type="hidden" name="firstName" value="<?php echo $_SESSION['customerInfo']['firstName']?>" />
                    <input type="hidden" name="lastName" value="<?php echo $_SESSION['customerInfo']['lastName']?>" />
                    <label for="file">Filename:</label>
                    <input type="file" name="file" id="file" /><br/>
                    <input type="checkbox" name="confirm" required/>
                    <span class="warning">I understand that it may take up to 48 hours to review the documentation, and that my schedule is not guaranteed until such time the documentation is approved. </span><br/><br/>
                    <input type="submit" name="submit" value="Submit"/>
                </form>
            </div>
        </div>
        <div id="footer">
            <?php include $root_DIR . '/includes/footer.php'; ?>

        </div>
    </div>
</div>


</body>
</html>