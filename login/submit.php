<?php
/**
 * Created by PhpStorm.
 * User: NaNo
 * Date: 11/25/2014
 * Time: 5:07 PM
 */
session_start();
include_once('../includes/db_connect.php');
include_once('../includes/login_functions.php');
if (empty($_POST['uscID'])){
    header("location: ../index.php");
}
$uscID = test_input($_POST['uscID']);
$password = $_POST['password'];

if (login::check_login($uscID, $password)== true){
    $_SESSION['uscID']= $uscID;

}
else {
    echo "fail";
}