<?php

/**
 * Created by PhpStorm.
 * User: Angela
 * Date: 11/23/2014
 * Time: 12:42 PM
 */
class session
{
    public static function init()
    {
        if (isset($_SESSION['uscID'])) {
            $uscID = $_SESSION['uscID'];
            if ($_SESSION['isAdmin'] == false) {
                $arrayInfo = session::getCustomerInfo($uscID);
                $_SESSION['firstName'] = $arrayInfo['firstName'];
                if ($arrayInfo['nickName'] != "") {
                    $_SESSION['firstName'] = $arrayInfo['nickName'];
                }
                $_SESSION['lastName'] = $arrayInfo['lastName'];
                $_SESSION['customerInfo'] = session::getCustomerInfo($uscID);
            } else {
                $arrayInfo = session::getEmployeeInfo($uscID);
                $_SESSION['firstName'] = $arrayInfo['firstName'];
                $_SESSION['lastName'] = $arrayInfo['lastName'];
                $_SESSION['employeeInfo'] = session::getEmployeeInfo($uscID);

            }

        }
    }

    public static function getCustomerInfo($id)
    {
        global $con;
        $sql = "SELECT * FROM customers WHERE uscID = $id";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            exit (mysqli_error($con));
        }
        $arrayInfo = mysqli_fetch_assoc($result);
        return $arrayInfo;
    }

    public static function getEmployeeInfo($id)
    {
        global $con;
        $sql = "SELECT * FROM employees WHERE uscID = $id";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            exit (mysqli_error($con));
        }
        $arrayInfo = mysqli_fetch_assoc($result);
        return $arrayInfo;
    }
}