<?php
//Create Connection
include_once 'config.php';
$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function test_input($data)
{
    global $con;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($con, $data);
    return $data;
}

//$DIR = "http://localhost:8080/DART";
$DIR = "http://ziweiliu.student.uscitp.com/DART";//live