<?php
    include_once('includes/db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
        <?php
            include_once('includes/functions.php');
        ?>
    <title>Index</title>
</head>
<body>
<div id="wrapper">
    <div id="container">
        <?php
            include('includes/menu.php');
        ?>
        <div id="content">
            <div id="innerContent">
                <h2>Current DART Customers</h2>
                <div id="searchCustomer" style="float: right; text-align: right; border: 0px;">
                    <span>Type any fields to search</span><br />
                    <input type="text" onKeyUp="displayCustomers(parseCustomers())" id="inputSearchCustomer" size="30" /><br />
                    <span>Show non-current Customers</span><br />
                    <input type="checkbox" onClick="displayCustomers(parseCustomers())" id="inputDisplayPast" />
                </div>
                <div id="displayCustomers">
                    <script>
                    displayCustomers(parseCustomers());
                    </script>
                    
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>