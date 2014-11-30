<?php
$root_DIR = "../../";
include_once $root_DIR . 'includes/db_connect.php';
include_once $root_DIR . '/includes/customer_functions.php';
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
        $(document).ready(function () {
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

    </style>
    <title>New Customer</title>
</head>
<body>
<?php
include('../../includes/header.php');
?>
<div id="wrapper">
    <div id="container">
        <div id="content">
            <div id="form">
                <h2>New Customer Registration</h2>

                <form name="newCustomer" method="POST" action="submit/index.php" enctype="multipart/form-data">
                    <label>Salutations:</label>
                    <select name="salutation">
                        <option value="Ms">Ms.</option>
                        <option value="Mrs">Mrs.</option>
                        <option value="Mr">Mr.</option>
                    </select><br/>
                    <label>First Name:</label>
                    <input type="text" name="firstName" required/><br/>
                    <label>Last Name:</label>
                    <input type="text" name="lastName" required/><br/>
                    <label>Middle Name:</label>
                    <input type="text" name="middleName"><br/>
                    <label>NickName:</label>
                    <input type="text" name="nickName"><br/>
                    <label>USC ID Number:</label>
                    <input type="text" maxlength="10" name="USCID" required/><br/>
                    <label>Password:</label>
                    <input type="password" name="password" required title="Must be at least 6 characters long"
                           pattern=".{6,}"/><br/>
                    <label>Customer Classification:</label>
                    <select name="classification">
                        <option value="student">Student</option>
                        <option value="faculty">Faculty</option>
                        <option value="staff">Staff</option>
                        <option value="visitor">Guest</option>
                    </select><br/>
                    <label>Preferred E-mail Address:</label>
                    <input type="email" name="email" required/><br/>
                    <label>Street Address:</label>
                    <input type="text" name="street" required/><br/>
                    <label>Apartment/Suite Number:</label>
                    <input type="text" name="apt"><br/>
                    <label>City:</label>
                    <input type="text" name="city" required/><br/>
                    <label>State:</label>
                    <?php
                    echo customer::generateStateSelect("state", $con);
                    ?><br/>
                    <label>Zipcode:</label>
                    <input type="text" name="zip" maxlength="5" required/><br/>
                    <label>Cell Number:</label>
                    (<input type="text" name="cell1" maxlength="3" size="2" required/>)<input type="text" name="cell2"
                                                                                              size="2" maxlength="3"
                                                                                              required/>-<input
                        type="text" name="cell3" size="3" maxlength="4" required/> <br/>
                    <label>Nature of Disability:</label>
                    <textarea row="4" col="100" maxlength="200" name="natureOfDisability" required/></textarea><br/>
                    <label>Special Needs or Requests:</label>
                    <textarea row="4" col="100" maxlength="200" name="specialNeeds"></textarea><br/>
                    <label>Start Date of Service: </label>
                    <input type="text" name="startDate" id="datepicker1" required/><br/>
                    <label>End Date of Service:</label>
                    <input type="text" name="endDate" id="datepicker2"/> <br/>
                    <input type="checkbox" name="longTerm" value="1"/>This request is for longer than 60 days and I have
                    explained the situation under Speical Needs or Requests.<br/>
                    <span class="warning">All customers are required to submit a valid Doctor's certification. It can be attached electronically here or hand-delivered to the office within five business days of the initial request for services."</span><br/>
                    <label for="file">Filename:</label>
                    <input type="file" name="file" id="file"><br/>
                    <input type="checkbox" name="confirm" required/>
                    <span class="warning">I understand that this application does not guarantee service at my requested times and that it might take up to 48 hours for review and approval.</span><br/><br/>
                    <input type="submit" name="submit" value="Submit"/>
                </form>
            </div>
        </div>
        <div id="footer">
            <?php include $root_DIR . '/includes/footer.php'; ?>

        </div>
    </div>
</div>


</body>
</html>