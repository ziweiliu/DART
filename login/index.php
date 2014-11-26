<?php
/**
 * Created by PhpStorm.
 * User: NaNo
 * Date: 11/25/2014
 * Time: 4:45 PM
 */
$root_DIR = "../";
include_once $root_DIR . 'includes/db_connect.php';
include_once $root_DIR . 'includes/login_functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="<?php echo $DIR ?>/css/core.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo $DIR ?>/js/jquery.js"></script>
    <script src="<?php echo $DIR ?>/js/main.js"></script>
    <title>Index</title>
    <style>
        label {
            width: 100px;
        }

        form {
            margin: 0px auto;
            width: 300px;
        }

        #submit {
            text-align: center;
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
                <h2>Please login:</h2>

                <form action="submit.php" method="POST">
                    <label>USC ID</label><input type="text" maxlength="10" required name="uscID"/><br/>
                    <label>Password</label><input type="password" pattern=".{6,}" title="6 characters minimum" required
                                                  name="password"/><br/><br/>

                    <div id="submit"><input type="submit" value="Login"/></div>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>