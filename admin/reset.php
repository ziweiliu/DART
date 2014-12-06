<?php
/**
 * Created by PhpStorm.
 * User: Angela
 * Date: 12/5/2014
 * Time: 10:47 PM
 */

$root_DIR = "../";
include_once $root_DIR."includes/db_connect.php";
include_once $root_DIR."includes/email_functions.php";
session_start();
if (!isset($_SESSION['uscID'])) {//Session not started
    header("location: " . $DIR . "/index.php?message=error");
} else if ($_SESSION['isAdmin'] == false) {
    header("location: " . $DIR . "/index.php");
} else if (!isset($_GET['user_id'])){
    header("location: index.php");
}

$user_id = test_input($_GET['user_id']);
$pass = md5("123456");
$sql = "UPDATE user SET password = '$pass' WHERE user_id = '$user_id'";
if (!mysqli_query($con, $sql)){
    exit(mysqli_error($con));
}

header("location: user.php");