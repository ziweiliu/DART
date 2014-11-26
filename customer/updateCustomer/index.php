<?php
$root_DIR = "../../";
include_once $root_DIR . 'includes/db_connect.php';
include_once $root_DIR . 'includes/customer_functions.php';
$cust_id = test_input($_POST["cust_id"]);
$salutation = test_input($_POST["salutation"]);
$firstName = test_input($_POST["firstName"]);
$lastName = test_input($_POST["lastName"]);
$middleName = test_input($_POST["middleName"]);
$nickName = test_input($_POST["nickName"]);
$uscID = test_input($_POST["uscID"]);
$classification = test_input($_POST["classification"]);
$email = test_input($_POST["email"]);
$streetAddr = test_input($_POST["street"]);
$aptAddr = test_input($_POST["apt"]);
$cityAddr = test_input($_POST["city"]);
$stateAddr = test_input($_POST["state"]);
$cell = test_input($_POST["cell"]);
$nature = test_input($_POST["natureOfDisability"]);
$specialNeeds = test_input($_POST["specialNeeds"]);
$startDate = test_input($_POST["startDate"]);
$endDate = test_input($_POST["endDate"]);

$sql = "UPDATE customers SET salutation = '$salutation', firstName = '$firstName', lastName = '$lastName', middleName = '$middleName', uscID = '$uscID', classification = '$classification', cell = '$cell', email = '$email', nature = '$nature', specialNeeds = '$specialNeeds', startDate = '$startDate', endDate = '$endDate' WHERE cust_id = '$cust_id'";
if (!mysqli_query($con, $sql)) {
    die('Error: ' . mysqli_error($con));
}
header("Location: ../viewCustomer/?cust_id=" . $cust_id);
