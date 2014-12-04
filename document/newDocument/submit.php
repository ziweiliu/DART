<?php
include_once "../../includes/db_connect.php";
include_once "../../includes/email_functions.php";

$cust_id = test_input($_POST['cust_id']);
$allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$date = date("y-m-d-h-s");
$firstName = test_input($_POST["firstName"]);
$lastName = test_input($_POST["lastName"]);


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
$sqlDoc = "INSERT INTO customers_doc (cust_id, filename) VALUES ('$cust_id', '$fileName')";
if (!mysqli_query($con, $sqlDoc)) {
    exit ('Error:' . mysqli_error($con));
}
email::sendCustomerEmail($cust_id, 2);

header("location: $DIR/customer/viewCustomer/index.php");
