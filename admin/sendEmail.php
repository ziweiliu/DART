<?php
/**
 * Created by PhpStorm.
 * User: Angela
 * Date: 12/5/2014
 * Time: 10:06 PM
 */
session_start();
if (!isset($_SESSION['uscID'])) {//Session not started
    header("location: " . $DIR . "/index.php?message=error");
} else if ($_SESSION['isAdmin'] == false) {
    header("location: " . $DIR . "/index.php");
} else if (!isset($_GET['cust_id'])||!isset($_GET['template_id'])){
    header("location: index.php");
}

$root_DIR = "../";
include_once $root_DIR."includes/db_connect.php";
include_once $root_DIR."includes/email_functions.php";



$cust_id = test_input($_GET['cust_id']);
$template_id = test_input($_GET['template_id']);
email::sendCustomerEmail($cust_id, $template_id);

header("location: index.php");