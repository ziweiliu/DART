<?php
/**
 * Created by PhpStorm.
 * User: Angela
 * Date: 12/4/2014
 * Time: 12:15 PM
 */

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
}