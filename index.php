<?php
session_start();
include_once 'includes/session_functions.php';
include_once 'includes/db_connect.php';
session::init();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/core.css" rel="stylesheet" type="text/css"/>
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <title>Index</title>
</head>
<body>
<div id="wrapper">
    <div id="container">
        <?php
        include 'includes/header.php';
        ?>
        <div id="content">
            <?php
            if (!empty($_GET['message'])) {
                ?>
                <script>alert('You must login to view this page, you will now be redirected to the home page');</script>
            <?php
            }
            ?>
            <div id="innerContent">
                <img src="images/gate-2.jpg" style="width: 100%"/>

                <h1>Disability Access to Road Transportation</h1>

                <h3>Program Overview</h3>

                <p>DART is a free service provided by USC Transportation to assist USC students, faculty and staff with
                    temporary mobility issues in getting around campus. Service is available at UPC during the Fall and
                    Spring semesters only, between the hours of 9:00am-5:00pm, Monday-Friday.</p>

                <p><strong>Program Rules/Guidelines</strong>
                <ul>
                    <li>DART program vehicles are not city-street legal, and therefore cannot leave campus. Service is
                        not available to off-campus housing, the University Parking Center, etc.
                    </li>
                    <li>Anyone registering for DART service should be able to independently get in and out of a standard
                        golf cart on their own. Additionally, due to liability concerns, drivers cannot provide
                        assistance lifting or carrying any medical equipment, including crutches, wheelchairs, etc.
                    </li>
                    <li>Due to high demand for the program, drivers will not wait more than five (5) minutes past a
                        scheduled pick-up time. If you are not ready at your assigned location/time, the driver may
                        leave without you to continue their other assignments. If you no longer require a scheduled
                        pickup, please call in advance to cancel the ride.
                    </li>
                    <li>Service will be automatically terminated after five (5) consecutive missed pick-ups. If service
                        is no longer needed, please contact the DART program at 213-740-3575 to be removed from the
                        schedule.
                    </li>
                </ul>
                <h3>How to Request DART Service</h3>

                <p>If this is your first time here, please fill out the <a href="customer/newCustomer/index.php">new
                        customer application</a> and create an account. Otherwise, you may
                    <a href="login/index.php">login</a>
                    here to view and edit your schedule.</p>

                <p>Please note that your application is not complete and will not be considered unless we also receive a
                    valid doctor’s note specifying the temporary disability (including expected duration of the
                    disability). Notes may be submitted separately to USC Transportation by mail (send to: DART program,
                    620 McCarthy Way, PSX100, Los Angeles, CA 90089), via fax (to: 213-740-2625), or in person at our
                    UPC office (first floor of PSX).</p>
            </div>

        </div>
    </div>
</div>

</body>
</html>