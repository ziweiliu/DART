<?php
include_once "../../includes/db_connect.php";
include_once "../../includes/email_functions.php";

$cust_id = test_input($_POST['cust_id']);
$date = date("y-m-d-h-s");
$firstName = test_input($_POST["firstName"]);
$lastName = test_input($_POST["lastName"]);
$status = test_input($_POST['status']);
$deny_reason = test_input($_POST['deny_reason']);

$sql = "UPDATE customers SET isapproved = '$status' WHERE cust_id = '$cust_id'";
if (!mysqli_query($con, $sql)) {
    exit ('Error:' . mysqli_error($con));
}
if ($status == 1){
    email::sendCustomerEmail($cust_id, 5);
}
else if ($status == 2){
    email::sendCustomerEmail($cust_id, 6, $deny_reason);
}


header("location: $DIR/customer/viewCustomer/index.php?cust_id=$cust_id");
