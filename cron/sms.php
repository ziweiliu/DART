<?php
/**
 * Created by PhpStorm.
 * User: Angela
 * Date: 12/5/2014
 * Time: 9:34 AM
 */


$to = "2135509117@vtext.com";
$message = "[DO NOT REPLY]This is an automatic reminder that you have a DART pick up in 10 minutes at 9:50am";
$subject = "cron test";
//
//echo phpversion();
mail($to, "", $message, "From: USC DART<ziwei.a.liu@gmail.com>");
