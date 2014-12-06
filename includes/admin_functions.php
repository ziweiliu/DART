<?php
/**
 * Created by PhpStorm.
 * User: Angela
 * Date: 12/4/2014
 * Time: 12:15 PM
 */
include_once "customer_functions.php";
class admin{
    public static function customerStats($statName){
        global $con;
        $output = 0;
        $sql = "SELECT * FROM customers";
        $result = mysqli_query($con, $sql);
        $n = [];
        if (!$result){
            exit(mysqli_error($con));
        }
        while ($r = mysqli_fetch_assoc($result)){
            array_push($n, $r);
        }
        switch ($statName){
            case 'total':
                $output = sizeOf($n);
                break;
            case 'active':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    if ($n[$i]['isActive'] == 1){
                        $output ++;
                    }
                }
                break;
            case 'inactive':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    if ($n[$i]['isActive'] == 0){
                        $output ++;
                    }
                }
                break;
            case 'averageDays':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    $startDate = new DateTime($n[$i]['startDate']);
                    $endDate = new DateTime($n['endDate']);
                    $difference = $startDate -> diff($endDate);
                    $k = $difference->days;
                    $output = $output + $k;
                }
                $output = round($output / sizeOf($n));
                break;
            case 'longTerm':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    if ($n[$i]['longTerm'] == 1){
                        $output ++;
                    }
                }
                break;
            case 'notApproved':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    if ($n[$i]['isApproved'] == 0){
                        $output ++;
                    }
                }
                break;
        }
        return $output;
    }
    public static function scheduleStats($statName){
        global $con;
        $output = 0;
        $sql = "SELECT * FROM schedule_event";
        $result = mysqli_query($con, $sql);
        $n = [];
        if (!$result){
            exit(mysqli_error($con));
        }
        while ($r = mysqli_fetch_assoc($result)){
            array_push($n, $r);
        }
        switch ($statName){
            case 'total':
                $output = sizeOf($n);
                break;
            case 'active':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    if ($n[$i]['isActive'] == 1){
                        $output ++;
                    }
                }
                break;
            case 'inactive':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    if ($n[$i]['isActive'] == 0){
                        $output ++;
                    }
                }
                break;
            case 'Monday':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    if($n[$i]['dayofweek_id'] == 1 && $n[$i]['isActive']==1){
                        $output ++;
                    }
                }
                break;
            case 'Tuesday':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    if($n[$i]['dayofweek_id'] == 2&& $n[$i]['isActive']==1){
                        $output ++;
                    }
                }
                break;
            case 'Wednesday':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    if($n[$i]['dayofweek_id'] == 3&& $n[$i]['isActive']==1){
                        $output ++;
                    }
                }
                break;
            case 'Thursday':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    if($n[$i]['dayofweek_id'] == 4&& $n[$i]['isActive']==1){
                        $output ++;
                    }
                }
                break;
            case 'Friday':
                $output = 0;
                for ($i = 0; $i < sizeof($n); $i++){
                    if($n[$i]['dayofweek_id'] == 5&& $n[$i]['isActive']==1){
                        $output ++;
                    }
                }
                break;
        }
        return $output;
    }
    public static function getPendingCustomers(){
        global $con;
        global $DIR;
        $html = "";
        $n = customer::parseCustomers($con);
        for ($i = 0; $i < sizeOf($n); $i++){
            if ($n[$i]['isapproved'] == 0){
                $html .="<tr data-href='$DIR/customer/viewCustomer/?cust_id=".$n[$i]['cust_id']."'><td>".$n[$i]['firstName']."</td><td>".$n[$i]['lastName']."</td><td>".$n[$i]['uscID']."</td><td>".$n[$i]['cell']."</td><td>".$n[$i]['email']."</td><td>".$n[$i]['startDate']."</td><td>".$n[$i]['endDate']."</td>";
            }
        }
        return $html;
    }
    public static function getPendingDocuments(){
        global $con;
        global $DIR;
        $array = [];
        $html = "";
        $sql = "SELECT * FROM customers, customers_doc where customers.cust_id = customers_doc.cust_id";
        $result = mysqli_query($con, $sql);
        if (!$result){
            exit (mysqli_error($con));
        }
        while ($r = mysqli_fetch_assoc($result)){
            array_push($array, $r);
        }
        for ($i = 0; $i < sizeof($array); $i++) {
            if ($array[$i]['review_status'] == 0) {
                $html .= "<tr><td>" . $array[$i]['firstName'] . "</td><td>" . $array[$i]['lastName'] . "</td><td>" . $array[$i]['uscID'] . "</td><td><a href='$DIR/" . $array[$i]['filename'] . "'>" . $array[$i]['filename'] . "</a></td><td>" . $array[$i]['file_submit_date'] . "</td><td><a href='$DIR/document/reviewDocument/index.php?doc_id=" . $array[$i]['document_id'] . "'>Click Here to Review </a></td></td></tr>";
            }
        }
        return $html;
    }
    public static function getCustomersWithExpiringDocuments(){
        global $con;
        global $DIR;
        $array = [];
        $html = "";
        $sql = "SELECT * FROM customers, customers_doc where customers.cust_id = customers_doc.cust_id AND review_status = 1";
        $result = mysqli_query($con, $sql);
        if (!$result){
            exit (mysqli_error($con));
        }
        while ($r = mysqli_fetch_assoc($result)){
            array_push($array, $r);
        }
        for ($i = 0; $i < sizeof($array); $i++){
            $file_exp_date = date('Y-m-d', strtotime($array[$i]['file_exp_date']));
            $twoWeeks = date ('Y-m-d', strtotime("+2 weeks"));
            if ($file_exp_date < $twoWeeks){
                $html .= "<tr><td>".$array[$i]['firstName']."</td><td>".$array[$i]['lastName']."</td><td>".$array[$i]['uscID']."</td><td>".$array[$i]['endDate']."</td><td>".$array[$i]['file_exp_date']."</td><td></td><td><a href='".$DIR."/admin/sendEmail/index.php?cust_id=".$array[$i]['cust_id']."&template_id=4'>Click to send</a></td></tr>";
            }
        }
        return $html;
    }
}