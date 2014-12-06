<?php
session_start();
$root_DIR = "../../";
include_once $root_DIR . 'includes/db_connect.php';
include_once $root_DIR . 'includes/session_functions.php';
include_once $root_DIR . 'includes/customer_functions.php';


if (!isset($_SESSION['uscID'])) {//Session not started
    header("location: " . $DIR . "/index.php?message=error");
} else if ($_SESSION['isAdmin'] == true) {//Admin use the link to access the page
    if (empty($_GET['cust_id'])) {//catches random admin people without the GET variable
        header("location: ../index.php");
    }
    $cust_id = $_GET['cust_id'];
} else {//customers can only view themselves
    $cust_id = $_SESSION['customerInfo']['cust_id'];
}
$array_info = customer::getCustomerInfo($cust_id);
$doc_info = customer::getAlLDocuments($cust_id);
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
    <script>
        $().ready(function () {
            $("#datepicker1").datepicker({
                minDate: 0,
                dateFormat: "yy-mm-dd",
                beforeShowDay: $.datepicker.noWeekends
            });
            $("#datepicker2").datepicker({
                minDate: 0,
                maxDate: 60,
                dateFormat: "yy-mm-dd",
                beforeShowDay: $.datepicker.noWeekends
            });
        })
    </script>
    <style>
        a {
            color: inherit;
        }
    </style>
    <?php
    include_once $root_DIR . 'includes/customer_functions.php';
    ?>
    <title>Index</title>
</head>
<body>
<div id="wrapper">
    <div id="container">
        <?php
        include $root_DIR . 'includes/header.php';
        ?>
        <div id="content">
            <div id="innerContent">
                <h2>Viewing Information</h2>

                <form action="../updateCustomer/index.php" method="POST">
                    <label>Customer ID: </label><input class='readonly' type='text' value="<?php echo $array_info['cust_id'] ?>" name='cust_id' readonly/><br/>
                    <label>Salutation: </label><input type='text' value="<?php echo $array_info['salutation'] ?>" name='salutation'/><br/>
                    <label>First Name:</label> <input type='text' value="<?php echo $array_info['firstName'] ?>" name='firstName'/><br/>
                    <label>Middle Name:</label> <input type='text' value="<?php echo $array_info['middleName'] ?>" name='middleName'/><br/>
                    <label>Nick Name:</label> <input type='text' value="<?php echo $array_info['nickName'] ?>" name='nickName'/><br/>
                    <label>Last Name:</label> <input type='text' value="<?php echo $array_info['lastName'] ?>" name='lastName'/><br/>
                    <label>Classification:</label> <select value="<?php echo $array_info['classification'] ?>" name='classification'/>
                    <option value='student'>Student</option>
                    <option value='faculty'>Faculty</option>
                    <option value='staff'>Staff</option>
                    <option value='visitor'>Guest</option>
                    </select><br/>
                    <label>University ID: </label><input type='text' value="<?php echo $array_info['uscID'] ?>" name='uscID' maxlength='10' readonly class='readonly'/><br/>
                    <label>Nature of Disability: </label><textarea rows='6' cols='22' name='natureOfDisability'><?php echo $array_info['nature'] ?></textarea><br/>
                    <label>Special Needs or Requests:</label><textarea rows='6' cols='22' name='specialNeeds'><?php echo $array_info['specialNeeds'] ?></textarea><br/>
                    <label>Cell Phone:</label> <input type='text' value="<?php echo $array_info['cell'] ?>" name='cell'/><br/>
                    <label>E-mail Address:</label> <input type='text' value="<?php echo $array_info['email'] ?>" name='email'/><br/>
                    <label>Start Date:</label> <input type='text' value="<?php echo $array_info['startDate'] ?>" name='startDate' id='datepicker1'/><br/>
                    <label>End Date:</label> <input type='text' value="<?php echo $array_info['endDate'] ?>" name='endDate' id='datepicker2'/><br/>
                    <label>Street Address:</label><input type='text' value="<?php echo $array_info['street'] ?>" name='street'/><br/>
                    <label>Apartment Number: </label><input type='text' value="<?php echo $array_info['apt'] ?>" name='apt'/><br/>
                    <label>City: </label><input type='text' value="<?php echo $array_info['city'] ?>" name='city'/><br/>
                    <label>State:</label>
                    <?php
                    echo customer::generateStateSelect("state", $con);
                    ?><br/>
                    <input type='submit' value='Update Information' name='submit'/>
                    <h4>Customer Status:</h4>
                    <?php
                    $status = $array_info['isapproved'];
                    if ($_SESSION['isAdmin']==true){
                        $html = "<a href='".$DIR."/customer/approveCustomer/index.php?cust_id=".$cust_id."'>";
                    }
                    else {
                        $html = "<a>";
                    }
                    switch ($status){
                        case 0:
                            echo "$html<span style='color:blue'>Requires Approval</span></a>";
                            break;
                        case 1:
                            echo "$html<span style='color:green'>Approved</span></a>";
                            break;
                        case 2:
                            echo "$html<span style='color:red'>Denied</span></a>";
                            break;
                    }
                    ?>
                    <h4>Doctor's Notes on File</h4>
                    <?php
                    for ($i = 0; $i < sizeof($doc_info); $i++) {
                        if ($doc_info[$i]['filename'] != "") {
                            echo "<label>File Link: </label><a href='../../" . $doc_info[$i]['filename'] . "'>Document No. " . $doc_info[$i]['document_id'] . " submitted " . $doc_info[$i]['file_submit_date'] . "</a><br />";
                            echo "<label>File Status: </label>";
                            if ($_SESSION['isAdmin'] == true) {
                                echo "<a href='$DIR/document/reviewDocument/index.php?doc_id=" . $doc_info[$i]['document_id'] . "'>";
                            } else {
                                echo "<a>";
                            }
                            switch ($doc_info[$i]['review_status']) {
                                case 0:
                                    echo "<span style='color: blue'>Pending Review</span></a>";
                                    break;
                                case 1:
                                    echo "<span style='color: green'>Approved with expiration date of " . $doc_info[$i]['file_exp_date'] . "</span></a>";
                                    break;
                                case 2:
                                    echo "<span style='color: red'>Denied</span></a>";
                                    break;
                            }
                            echo "<br /><br />";
                        }
                    }

                    ?>
                    <h4>Current Schedule for Customer</h4>
                    <a href="<?php echo $DIR ?>/schedule/scheduleByCustomer/index.php?cust_id=<?php echo $cust_id ?>">Click Here to view</a>
                </form>
            </div>

        </div>
    </div>
    <?php include $root_DIR . 'includes/footer.php'; ?>
</div>

</body>
</html>