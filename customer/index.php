<?php
$root_DIR = "../";
include_once $root_DIR.'includes/db_connect.php';
include_once $root_DIR.'includes/functions.php';
to_JS(parseCustomers($con));
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
        $(document).ready(function(){
            $('#inputSearchCustomer').on("keyup", function(){
                displayCustomers(arrayCustomers);
            });
            $('#inputDisplayPast').on("click", function(){
                displayCustomers(arrayCustomers);
            });
            $("tr").on("click", function(){
                console.log("clicked");
                if ($(this).data('href') !== undefined){
                    document.location = $(this).data('href');
                };
            });
        })
    </script>
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
                <h2>Current DART Customers</h2>
                <div id="searchCustomer" style="float: right; text-align: right; border: 0px;">
                    <span>Type any fields to search</span><br />
                    <input type="text" id="inputSearchCustomer" size="30" /><br />
                    <span>Show non-current Customers</span><br />
                    <input type="checkbox" id="inputDisplayPast" />
                </div>
                <div id="displayCustomers">
                    <script>
                        displayCustomers(arrayCustomers);
                    </script>

                </div>
            </div>

        </div>
    </div>
    <?php include $root_DIR.'includes/footer.php';?>
</div>

</body>
</html>