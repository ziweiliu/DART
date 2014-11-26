<?php
/**
 * Created by PhpStorm.
 * User: NaNo
 * Date: 11/25/2014
 * Time: 4:50 PM
 */
class login {
    public static function encrypt_password($password){
        $password = md5($password);
        return $password;
    }
    public static function check_login($id, $password){
        global $con;
        $sql = "SELECT password FROM user WHERE uscID = $id";
        $result = mysqli_query($con, $sql);
        if (!$result){
            exit (mysqli_error($con));
        }
        $row = mysqli_fetch_array($result);
        if ($row['password'] == md5($password)){
            return true;
        }
        else {
            return false;
        }
    }
    public static function is_admin($id){
        global $con;
        $sql = "SELECT isAdmin FROM user WHERE userID = $id";
        $result = mysqli_query($con, $sql);
        if (!$result){
            exit (mysqli_error($con));
        }
        $row = mysqli_fetch_array($result);
        if ($row['isAdmin']== 1){
            return true;
        }
        else {
            return false;
        }
    }
}