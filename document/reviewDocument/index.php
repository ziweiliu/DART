<?php

session_start();
$root_DIR = "../../";
include_once $root_DIR . 'includes/db_connect.php';
include_once $root_DIR . 'includes/session_functions.php';
include_once $root_DIR . 'includes/customer_functions.php';

if (!isset($_SESSION['uscID'])) {//Session not started
    header("location: " . $DIR . "/index.php?message=error");
} else if ($_SESSION['isAdmin'] == true) {
    if (empty($_GET['doc_id'])) {//catches random admin people without the GET variable
        header("location: ../index.php");
    }
    $doc_id = $_GET['doc_id'];
} else {//non admins cannot view this page
    header("location: " . $DIR . "/index.php?message=error");
}
$doc_info = customer::getDocumentInfo($doc_id);
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
    <title>Index</title>
    <script>
        $(document).ready(function () {
            $("input[name='status']").change(function () {
                console.log(this);
                if ($(this).val() == 2) {
                    $("#denyReason").prop("readonly", false);
                    $("#denyReason").prop("required", true);
                    $("#denyReason").css("background-color", "inherit");
                }
                if ($(this).val() == 1) {
                    $("#denyReason").prop("readonly", true);
                    $("#denyReason").css("background-color", "gray");
                    $("#denyReason").val("");
                }
            });
            $("#expDate").datepicker({
                minDate: 0,
                dateFormat: "yy-mm-dd",
                beforeShowDay: $.datepicker.noWeekends
            });
            $("#expDate").change(function () {
                var customerEndDate = new Date($("#endDate").html());
                var documentEndDate = new Date($(this).val());
                if (documentEndDate < customerEndDate) {
                    $("#warning").html("Note that the document expires before the customer-specified end date. The customer will be notified via email to submit a new document once this current document expires.")
                }
                else {
                    $("#warning").html("");
                }
            })
        })
    </script>
    <style>
        #warning {
            color: red;
        }
    </style>

</head>
<body>
<div id="wrapper">
    <div id="container">
        <?php
        include $root_DIR . 'includes/header.php';
        ?>
        <div id="content">
            <div id="innerContent">
                <form method="POST" action="submit.php">

                    <h4>Customer Information:</h4>
                    <label>Document ID:</label><input type="text" name = "doc_id" class="readonly" readonly value="<?php echo $doc_id ?>"><br/>
                    <label>First Name: </label><?php echo $doc_info['firstName']; ?><br/>
                    <label>Nick Name: </label><?php echo $doc_info['nickName']; ?><br/>
                    <label>Last Name: </label><?php echo $doc_info['lastName']; ?><br/>
                    <label>USC ID: </label><?php echo $doc_info['uscID']; ?><br/>
                    <label>Classification: </label><?php echo $doc_info['classification']; ?><br/>
                    <label>Start Date: </label><?php echo $doc_info['startDate']; ?><br/>
                    <label>End Date: </label><span id="endDate"><?php echo $doc_info['endDate']; ?></span><br/>
                    <h4>File Information:</h4>
                    <label>File:</label><a
                        href="<?php echo $DIR . "/" . $doc_info['filename'] ?>"><?php echo $doc_info['filename'] ?></a><br/>
                    <label>Date Submitted: </label><?php echo $doc_info['file_submit_date']; ?><br/>
                    <label>Review Status:</label><?php
                    switch ($doc_info['review_status']){
                        case 0:
                            echo "Needs Review";
                            break;
                        case 1:
                            echo "<span style='color: green'>Approved</span>";
                            break;
                        case 2:
                            echo "<span style='color: red'>Denied</span>";
                            break;
                    }
                    ?><br />
                    <label>Review Date:</label><?php echo $doc_info['review_date'];?><br />
                    <h4>Actions:</h4>
                    <label>Approve Document:</label><input type="radio" name="status" value="1" required>Approve<br/>
                    <label>Deny Document: </label><input type="radio" name="status" value="2" required>Deny<br/>
                    <label>Deny Reason: </label><textarea name="denyReason" id="denyReason"><?php echo $doc_info['deny_reason']; ?></textarea><br/>
                    <label>Comment(optional): </label><textarea name="comment"><?php echo $doc_info['comment']; ?></textarea><br/>
                    <label>Document Expiration Date: </label><input type="text" name="expDate" id="expDate" value="<?php echo $doc_info['file_exp_date']?>"/><br/>
                    <input type="hidden" name="cust_id" value="<?php echo $doc_info['cust_id']?>" />
                    <span id="warning"></span>
                    <input type="submit" value="Submit">
                </form>

            </div>

        </div>
    </div>
    <?php include $root_DIR . 'includes/footer.php'; ?>
</div>

</body>
</html>