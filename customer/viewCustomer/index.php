<?php
$root_DIR = "../../";
include_once $root_DIR.'includes/db_connect.php';
if (empty($_GET['cust_id'])){
    header ("location: ../index.php");
}
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
    <script>
        $().ready(function(){
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
    <?php
    include_once $root_DIR . 'includes/customer_functions.php';
    ?>
    <title>Index</title>
</head>
<body>
<div id="wrapper">
    <div id="container">
        <?php
        include $root_DIR.'includes/header.php';
        ?>
        <div id="content">
            <div id="innerContent">
                <h2>Viewing Information</h2>
                <form name = "updateCustomer" action ="../updateCustomer/index.php" method ="POST">
                    <?php
                    $cust_id = $_GET['cust_id'];
                    $sql = "SELECT * FROM customers WHERE cust_id = $cust_id";
                    $r = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($r)){
                        echo "<label>Customer ID: </label><input class = 'readonly' type='text' value = '".$row['cust_id']."' name='cust_id' readonly /><br />";
                        echo "<label>Salutation: </label><input type='text' value = '".$row['salutation']."' name='salutation' /><br />";
                        echo "<label>First Name:</label> <input type='text' value = '".$row['firstName']."' name='firstName' /><br />";
                        echo "<label>Middle Name:</label> <input type='text' value = '".$row['middleName']."' name='middleName' /><br />";
                        echo "<label>Nick Name:</label> <input type='text' value = '".$row['nickName']."' name='nickName' /><br />";
                        echo "<label>Last Name:</label> <input type='text' value = '".$row['lastName']."' name='lastName' /><br />";
                        echo "<label>Classification:</label> <select value = '".$row['classification']."' name='classification' /><option value='student'>Student</option><option value='faculty'>Faculty</option><option value='staff'>Staff</option><option value='visitor'>Guest</option></select><br />";
                        echo "<label>University ID: </label><input type='text' value = '".$row['uscID']."' name='uscID' maxlength='10' /><br />";
                        echo "<label>Nature of Disability: </label><textarea rows='6' cols='22' name='natureOfDisability'>".$row['nature']."</textarea><br />";
                        echo "<label>Special Needs or Requests:</label><textarea rows='6' cols='22' name='specialNeeds'>".$row['specialNeeds']."</textarea><br />";
                        echo "<label>Cell Phone:</label> <input type='text' value = '".$row['cell']."' name='cell' /><br />";
                        echo "<label>E-mail Address:</label> <input type='text' value = '".$row['email']."' name='email' /><br />";
                        echo "<label>Start Date:</label> <input type='text' value = '".$row['startDate']."' name='startDate' id='datepicker1' /><br />";
                        echo "<label>End Date:</label> <input type='text' value = '".$row['endDate']."' name='endDate' id='datepicker2' /><br />";
                    }
                    $sqlAddr = "SELECT * FROM customers_addr WHERE cust_id = $cust_id";
                    $r2 = mysqli_query($con, $sqlAddr);
                    if (!$r2){
                        exit (mysqli_error($con));
                    }
                    while ($row2 = mysqli_fetch_array($r2)){
                        echo "<label>Street Address:</label><input type='text' value = '".$row2['street']."' name='street' /><br />";
                        echo "<label>Apartment Number: </label><input type='text' value = '".$row2['apt']."' name='apt' /><br />";
                        echo "<label>City: </label><input type='text' value = '".$row2['city']."' name='city' /><br />";
                        echo "<label>State: </label><input type='text' value = '".$row2['state']."' name='state' /><br />";
                    }
                    echo "<br /><input type='submit' value='Update Customer Information' name='submit' />";
                    echo "<h4>Doctor's Notes on File</h4>";
                    $sqlFile = "SELECT * FROM customers_doc WHERE cust_id = $cust_id";
                    $r3 = mysqli_query($con, $sqlFile);
                    while ($row3 = mysqli_fetch_array($r3)){
                        echo "<label>File Link: </label><a href='".$row3['filename']."'>Document No. ".$row3['document_id']." submitted on ".$row3['file_submit_date']."</a><br />";
                        if ($row3['review_status'] == 1){
                            echo "<label>File Status: </label><span style='color: green'>Approved with expiration date of ".$row3['file_exp_date']."</span><br />";
                        }
                        else {
                            echo "<label>File Status:</label><a href='reviewNote.php?document_id=".$row3['document_id']."'><span style='color: red'>Pending, click here to review</span></a>";
                        }
                    }

                    ?>
                </form>
            </div>

        </div>
    </div>
    <?php include $root_DIR.'includes/footer.php';?>
</div>

</body>
</html>