<?php
session_start();
include_once '../../includes/db_connect.php';
/**
 * Created by PhpStorm.
 * User: Angela
 * Date: 11/23/2014
 * Time: 12:56 PM
 */
if (empty($_POST['timeblock_id'])) {
    header("location: index.php");
}
$cust_id = $_SESSION['id'];
$cart_id = test_input($_POST['cart_id']);
$timeblock_id = test_input($_POST['timeblock_id']);
$day_id = test_input($_POST['day_id']);
$pu_loc = substr(test_input($_POST['pu-loc']), 0, 3);
$do_loc = substr(test_input($_POST['do-loc']), 0, 3);
$type = test_input($_POST['submit_type']);

if ($type == "submit") {
    $sql = "INSERT into schedule_event (cust_id, timeblock_id, dayofweek_id, start_loc, end_loc, cart_id) VALUES ('$cust_id', '$timeblock_id', '$day_id', '$pu_loc', '$do_loc', '$cart_id')";
} else if ($type == "update") {
    $event_id = test_input($_POST['event_id']);
    if (isset($_POST['cancel'])) {
        $sql = "UPDATE schedule_event SET isActive= 0 WHERE event_id=$event_id";
    } else {
        $sql = "UPDATE schedule_event SET start_loc='$pu_loc', end_loc='$do_loc' WHERE event_id = '$event_id'";
    }
}

$result = mysqli_query($con, $sql);
if (!$result) {
    exit (mysqli_error($con));
}
header("location: index.php?day_id=$day_id");