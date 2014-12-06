<?php
/**
 * Created by PhpStorm.
 * User: Angela
 * Date: 12/4/2014
 * Time: 3:19 PM
 */

$to = "ziwei.a.liu@gmail.com";
$message = "testing test test";
$subject = "cron test";
//
//echo phpversion();
mail($to, $subject, $message);
