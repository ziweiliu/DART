<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/UI-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
    <link href="css/core.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js"> </script>
    <script src="js/jquery-ui-1.10.4.custom.js"></script>
    <script src="js/main.js"></script>
    <script>
        $().ready(function(){
            $("#datepicker1").datepicker({
                minDate: 0,
                dateFormat: "yy-mm-dd"
            });
            $("#datepicker2").datepicker({
                minDate: 0,
                maxDate: 60,
                dateFormat: "yy-mm-dd"
            });
        })


    </script>
    <style>
        #form{
            background-color: white;
            padding: 20px;
            margin: 20px auto;
            width: 60%;

        }
        h2{
            text-align: center;
        }
        .warning{
            color: #990000;
        }
        div.ui-datepicker {
            font-size: 16px;
        }
    </style>
    <title>New Customer</title>
</head>
<body>
<?php
include_once("includes/db_connect.php");
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//this checks to see if the form was actually submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $salutation= test_input($_POST["salutation"]);
    $firstName= test_input($_POST["firstName"]);
    $lastName= test_input($_POST["lastName"]);
    $middleName= test_input($_POST["middleName"]);
    $nickName= test_input($_POST["nickName"]);
    $uscID= test_input($_POST["USCID"]);
    $classification= test_input($_POST["classification"]);
    $email= test_input($_POST["email"]);
    $streetAddr= test_input($_POST["street"]);
    $aptAddr= test_input($_POST["apt"]);
    $cityAddr= test_input($_POST["city"]);
    $stateAddr= test_input($_POST["state"]);
    $cell= test_input($_POST["cell1"]).test_input($_POST["cell2"]).test_input($_POST["cell3"]);
    $nature= test_input($_POST["natureOfDisability"]);
    $specialNeeds= test_input($_POST["specialNeeds"]);
    $startDate = test_input($_POST["startDate"]);
    $endDate = test_input($_POST["endDate"]);
    if (isset($_POST["longTerm"])){
        $longTerm = 1;
    }
    else {
        $longTerm = 0;
    }
    //Checks if the USCID already exists in the table. USCID is a unique key.
    $duplicate = false;
    $result = mysqli_query($con, "SELECT * FROM Customers WHERE uscID=".$uscID."");
    while ($row = mysqli_fetch_array($result)){
        $duplicate = true;
    }
    if($duplicate == true){
        echo "<script>alert('This USC ID has already been registered. Please contact the USC Transportation Office.')</script>";
    }
    //Actually submits the form
    else {
        
        //Code for file upload, credit w3schools.com
        //Minor edits to include pdf format and increased size
        $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);

        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "application/pdf"))
        && ($_FILES["file"]["size"] < 800000)
        && ($_FILES["file"]["size"] > 5)
        && in_array($extension, $allowedExts)) {
          if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
          } else {
            if (file_exists("upload/" . $lastName."_".$firstName."_".$_FILES["file"]["name"])) {
              echo "<script>alert('The file you tried to upload already exists. Please contact the USC Transportation Office');</script>";
            } else {
              move_uploaded_file($_FILES["file"]["tmp_name"],
              "upload/" . $lastName."_".$firstName."_".$_FILES["file"]["name"]);
              $fileName = "upload/" . $lastName."_".$firstName."_".$_FILES["file"]["name"];
            }
          }
        }
        else {
            if ($_FILE["file"]["size"] > 800000){
                echo "<script>alert('The file size is too big to upload. Please print the note and hand deliver to the Transportation Office');";
            }
        }
        $sql = "INSERT INTO customers (salutation, firstName, lastName, middleName, nickName, uscID, classification, email, cell, nature, specialNeeds, startDate, endDate, longTerm, fileName) VALUES ('$salutation', '$firstName', '$lastName', '$middleName', '$nickName', '$uscID', '$classification', '$email', '$cell', '$nature', '$specialNeeds', '$startDate', '$endDate', '$longTerm', '$fileName')";
        if (!mysqli_query($con,$sql)) {
            die('Error: ' . mysqli_error($con));
        }
        $sql_uid = "SELECT uid FROM customers WHERE uscID = '".$uscID."'";
        $r = mysqli_query($con, $sql_uid);
        while ($row = mysqli_fetch_array($r)){
            $uid = $row['uid'];
        }
        $sqlAddr = "INSERT INTO customers_addr (uid, street, apt, city, state) VALUES ('$uid', '$streetAddr', '$aptAddr', '$cityAddr', '$stateAddr')";
        if (!mysqli_query($con,$sqlAddr)) {
            die('Error: ' . mysqli_error($con));
        }
        echo "<div id='wrapper'><div id='container'>";
        include_once('includes/header.php');
        echo "<div id='content'><div id='innerContent'><h4>Application Successful</h4><span>Your request has been submitted. Please note that it may take up to 48 hours to approve your application. You may now select a tentative schedule based on current availabilities on the next page.</span><br /><a href='selectSchedule.php'><h4>Click here to view current availabilities<h4></a></div></div></div></div>";
        include_once ('includes/footer.php');
    }
}
else {
    include('newCustomerForm.php');
}
?>

</body>
</html>