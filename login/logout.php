<?php
/**
 * Created by PhpStorm.
 * User: Angela
 * Date: 11/25/2014
 * Time: 8:26 PM
 */
session_start();
include_once('../includes/db_connect.php');
include_once('../includes/login_functions.php');

session_destroy();
header("location:../index.php");