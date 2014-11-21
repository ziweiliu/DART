<?php
//Create Connection
include_once 'config.php';
$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_error()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$DIR = "http://localhost:8080/DART";