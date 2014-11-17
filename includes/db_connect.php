<?php
//Create Connection
include_once 'config.php';
$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$Dir = "https://localhost:8080/DART";