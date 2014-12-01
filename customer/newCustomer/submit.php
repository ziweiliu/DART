<?php
$root_DIR = "../../";
include_once $root_DIR . "includes/db_connect.php";
include_once $root_DIR . "includes/customer_functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="<?php echo $DIR ?>/css/UI-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $DIR ?>/css/core.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo $DIR ?>/js/jquery.js"></script>
    <script src="<?php echo $DIR ?>/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="<?php echo $DIR ?>/js/main.js"></script>
    <title>New Customer</title>
</head>
<body>
<?php


//this checks to see if the form was actually submitted
if (!empty($_POST['firstName'])) {
    $salutation = test_input($_POST["salutation"]);
    $firstName = test_input($_POST["firstName"]);
    $lastName = test_input($_POST["lastName"]);
    $middleName = test_input($_POST["middleName"]);
    $nickName = test_input($_POST["nickName"]);
    $uscID = test_input($_POST["USCID"]);
    $classification = test_input($_POST["classification"]);
    $email = test_input($_POST["email"]);
    $streetAddr = test_input($_POST["street"]);
    $aptAddr = test_input($_POST["apt"]);
    $cityAddr = test_input($_POST["city"]);
    $stateAddr = test_input($_POST["state"]);
    $cell = test_input($_POST["cell1"]) . test_input($_POST["cell2"]) . test_input($_POST["cell3"]);
    $nature = test_input($_POST["natureOfDisability"]);
    $specialNeeds = test_input($_POST["specialNeeds"]);
    $startDate = test_input($_POST["startDate"]);
    $endDate = test_input($_POST["endDate"]);
    $password = md5($_POST['password']);
    if (isset($_POST["longTerm"])) {
        $longTerm = 1;
    } else {
        $longTerm = 0;
    }
    //Checks if the USCID already exists in the table. USCID is a unique key.
    $duplicate = false;
    $result = mysqli_query($con, "SELECT * FROM customers WHERE uscID=" . $uscID . "");
    if (!$result) {
        exit (mysqli_error($con));
    }
    while ($row = mysqli_fetch_array($result)) {
        $duplicate = true;
    }
    if ($duplicate == true) {
        echo "<script>alert('This USC ID has already been registered. Please contact the USC Transportation Office.')</script>";
    } //Actually submits the form
    else {
        //Minor edits to include pdf format and increased size
        $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        $date = date("y-m-d-h-s");

        if (($_FILES["file"]["size"] < 80000000)
            && ($_FILES["file"]["size"] > 5)
            && in_array($extension, $allowedExts)
        ) {
            if ($_FILES["file"]["error"] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
            } else {
                if (file_exists("../../upload/" . $lastName . "_" . $firstName . "_" . $date . "." . $extension)) {
                    echo "<script>alert('The file you tried to upload already exists. Please contact the USC Transportation Office');</script>";
                } else {
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        "../../upload/" . $lastName . "_" . $firstName . "_" . $date . "." . $extension);
                    $fileName = "upload/" . $lastName . "_" . $firstName . "_" . $date . "." . $extension;
                }
            }
        } else {
            if ($_FILES["file"]["size"] > 80000000) {
                echo "<script>alert('The file size is too big to upload. Please print the note and hand deliver to the Transportation Office')</script>";
            }
        }
        //pick out the next available color
        $sql_color = "SELECT * FROM colors";
        $color_array = [];
        $color_hex = "placeholder";
        $result = mysqli_query($con, $sql_color);
        if (!$result){
            exit (mysqli_error($con));
        }
        while ($r = mysqli_fetch_assoc($result)){
            array_push($color_array, $r);
        }
        for ($i = 0; $i < sizeof($color_array); $i++){
            if ($color_array[$i]['is_taken'] == 0 && $color_hex = "placeholder"){
                $color_hex = $color_array[$i]['color_hex'];
            }
        }
        if ($color_hex == "placeholder"){
            $color_hex = $color_array[rand(0, 26)]['color_hex'];
        }
        $sql_color_update = "UPDATE colors SET is_taken = '1' WHERE color_hex = '$color_hex'";
        if (!mysqli_query($con, $sql_color_update)) {
            exit('Error: ' . mysqli_error($con));
        }
        $sql = "INSERT INTO customers (salutation, firstName, lastName, middleName, nickName, uscID, classification, email, cell, nature, specialNeeds, startDate, endDate, longTerm, color) VALUES ('$salutation', '$firstName', '$lastName', '$middleName', '$nickName', '$uscID', '$classification', '$email', '$cell', '$nature', '$specialNeeds', '$startDate', '$endDate', '$longTerm', '$color_hex')";
        if (!mysqli_query($con, $sql)) {
            exit('Error: ' . mysqli_error($con));
        }
        $sql_cust_id = "SELECT cust_id FROM customers WHERE uscID = $uscID";
        $r = mysqli_query($con, $sql_cust_id);
        while ($row = mysqli_fetch_array($r)) {
            $cust_id = $row['cust_id'];
        }
        $sqlAddr = "INSERT INTO customers_addr (cust_id, street, apt, city, state) VALUES ('$cust_id', '$streetAddr', '$aptAddr', '$cityAddr', '$stateAddr')";
        if (!mysqli_query($con, $sqlAddr)) {
            exit('Error: ' . mysqli_error($con));
        }
        $sqlUser = "INSERT INTO user (password, uscID) VALUES ('$password', '$uscID')";
        if (!mysqli_query($con, $sqlUser)) {
            exit('Error: ' . mysqli_error($con));
        }
        $sqlDoc = "INSERT INTO customers_doc (cust_id, filename) VALUES ('$cust_id', '$fileName')";
        if (!mysqli_query($con, $sqlDoc)) {
            exit ('Error:' . mysqli_error($con));
        }
        echo "<div id='wrapper'><div id='container'>";
        include $root_DIR . 'includes/header.php';
        echo "<div id='content'><div id='innerContent'><h4>Application Successful</h4><span>Your request has been submitted. Please note that it may take up to 48 hours to approve your application. You may now login to your account on the next page and select a tentative schedule.</span><br /><a href='../../index.php'><h4>Click here to go back to the home page<h4></a></div></div></div></div>";
        include $root_DIR . 'includes/footer.php';
    }
} else {
    header('location: index.php');
}
?>

</body>
</html>
