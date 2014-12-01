<?php
/**
 * Created by PhpStorm.
 * User: Angela
 * Date: 11/30/2014
 * Time: 3:03 PM
 */
include_once '../../includes/db_connect.php';
if (empty($_POST['doc_id'])) {
    header("location: index.php");
}
$doc_id = test_input($_POST['doc_id']);
$status = test_input($_POST['status']);
$exp_date = test_input($_POST['expDate']);
$deny_reason = test_input($_POST['denyReason']);
$comment= test_input($_POST['comment']);


$sql = "UPDATE customers_doc SET file_exp_date = '$exp_date', review_status = '$status', review_date = CURRENT_DATE, deny_reason = '$deny_reason', comment = '$comment' WHERE document_id = '$doc_id'";
if (!mysqli_query($con, $sql)){
    exit (mysqli_error($con));
}

header("location: index.php?doc_id=$doc_id");