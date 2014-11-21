<?php
include_once "../../includes/db_connect.php";
include_once "../../includes/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="<?php echo $DIR ?>/css/UI-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $DIR ?>/css/core.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $DIR ?>/js/jquery.js"> </script>
    <script src="<?php echo $DIR ?>/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="<?php echo $DIR ?>/js/main.js"></script>
    <title>New Customer</title>
</head>
<body>
<?php


//this checks to see if the form was actually submitted
if (!empty($_POST['firstName'])) {
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
    $result = mysqli_query($con, "SELECT * FROM customers WHERE uscID=".$uscID."");
    if (!$result){
        exit (mysqli_error($con));
    }
    while ($row = mysqli_fetch_array($result)){
        $duplicate = true;
    }
    if($duplicate == true){
        echo "<script>alert('This USC ID has already been registered. Please contact the USC Transportation Office.')</script>";
    }
    //Actually submits the form
    else {
        //Minor edits to include pdf format and increased size
        $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        $date = date("y-m-d");

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
                if (file_exists("../../upload/" . $lastName."_".$firstName."_".$date.".".$extension)) {
                    echo "<script>alert('The file you tried to upload already exists. Please contact the USC Transportation Office');</script>";
                } else {
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        "../../upload/" . $lastName."_".$firstName."_".$date.".".$extension);
                    $fileName = "upload/" . $lastName."_".$firstName."_".$date.".".$extension;
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
            exit('Error: ' . mysqli_error($con));
        }
        $sql_cust_id = "SELECT cust_id FROM customers WHERE uscID = $uscID";
        $r = mysqli_query($con, $sql_cust_id);
        while ($row = mysqli_fetch_array($r)){
            $cust_id = $row['cust_id'];
        }
        $sqlAddr = "INSERT INTO customers_addr (cust_id, street, apt, city, state) VALUES ('$cust_id', '$streetAddr', '$aptAddr', '$cityAddr', '$stateAddr')";
        if (!mysqli_query($con,$sqlAddr)) {
            exit('Error: ' . mysqli_error($con));
        }
        $sqlDoc = "INSERT INTO customers_doc (cust_id, filename) VALUES ('$cust_id', '$fileName')";
        if (!mysqli_query($con, $sqlDoc)){
            exit ('Error:' . mysqli_error($con));
        }
        echo "<div id='wrapper'><div id='container'>";
        include_once '../../includes/header.php';
        echo "<div id='content'><div id='innerContent'><h4>Application Successful</h4><span>Your request has been submitted. Please note that it may take up to 48 hours to approve your application. You may now select a tentative schedule based on current availabilities on the next page.</span><br /><a href='selectSchedule.php'><h4>Click here to view current availabilities<h4></a></div></div></div></div>";
        include_once '../../includes/footer.php';
    }
}
else {
    header ('location: ../index.php');
}
?>

</body>
</html>
