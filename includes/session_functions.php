<?php
/**
 * Created by PhpStorm.
 * User: Angela
 * Date: 11/23/2014
 * Time: 12:42 PM
 */

class session{
    public static function getCustomerInfo($id){
        global $con;
        $arrayInfo = [];
        $sql = "SELECT * FROM customers WHERE cust_id = $id";
        $result = mysqli_query($con, $sql);
        if (!$result){
            exit (mysqli_error($con));
        }
        $arrayInfo = mysqli_fetch_assoc($result);
        return $arrayInfo;
    }
}