<div id="header">
    <span style="color: #ffcc00; margin-left: 20px;">USC</span>Transportation
    <div id="login">
        <?php
        if (isset($_SESSION['uscID'])) {
            echo "Welcome, " . $_SESSION['firstName'] . " " . $_SESSION['lastName'];
        } else {
            echo "<a href='" . $DIR . "/login/index.php'>Login</a>";
        }
        ?>
    </div>

    <?php
    if (isset($_SESSION['uscID'])) {
        if ($_SESSION['isAdmin'] == false) {//Menu for customers
            ?>
            <div id="menu">
                <ul>
                    <li>
                        <a href="<?php echo $DIR ?>/index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo $DIR ?>/customer/viewCustomer/index.php">Customer</a>
                        <ul>
                            <li>
                                <a href="<?php echo $DIR ?>/customer/viewCustomer/index.php">Edit My Information</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo $DIR ?>/document/index.php">Document</a>
                        <ul>
                            <li>
                                <a href="<?php echo $DIR ?>/document/newDocument/index.php">Upload a new Document</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo $DIR ?>/schedule/scheduleByCustomer/index.php"">Schedule</a>
                        <ul>
                            <li>
                                <a href="<?php echo $DIR ?>/schedule/scheduleByCustomer/index.php">View Schedule</a>
                            </li>
                            <li>
                                <a href="#">Select Schedule</a>
                                <ul>
                                    <li>
                                        <a href="<?php echo $DIR ?>/schedule/selectSchedule/index.php?day_id=1">Monday</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $DIR ?>/schedule/selectSchedule/index.php?day_id=2">Tuesday</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $DIR ?>/schedule/selectSchedule/index.php?day_id=3">Wednesday</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $DIR ?>/schedule/selectSchedule/index.php?day_id=4">Thursday</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $DIR ?>/schedule/selectSchedule/index.php?day_id=5">Friday</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo $DIR ?>/login/logout.php">Log out</a>
                    </li>
                </ul>
            </div>
        <?php
        } else {//Menu for admin
            ?>
            <div id="menu">
                <ul>
                    <li>
                        <a href="<?php echo $DIR ?>/index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo $DIR ?>/customer/index.php">Customer</a>
                        <ul>
                            <li>
                                <a href="<?php echo $DIR ?>/customer/index.php">View Customers</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo $DIR ?>/schedule/index.php">Schedule</a>
                        <ul>
                            <li>
                                <a href="#">View Schedule</a>
                                <ul>
                                    <li>
                                        <a href="<?php echo $DIR ?>/schedule/viewSchedule/index.php?day_id=1">Monday</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $DIR ?>/schedule/viewSchedule/index.php?day_id=2">Tuesday</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $DIR ?>/schedule/viewSchedule/index.php?day_id=3">Wednesday</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $DIR ?>/schedule/viewSchedule/index.php?day_id=4">Thursday</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $DIR ?>/schedule/viewSchedule/index.php?day_id=5">Friday</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo $DIR ?>/admin/index.php">Admin</a>
                        <ul>
                            <li>
                                <a href="<?php echo $DIR ?>/admin/index.php">Dashboard</a>
                            </li>
                            <li>
                                <a href="<?php echo $DIR ?>/admin/user.php">User Management</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo $DIR ?>/login/logout.php">Log out</a>
                    </li>
                </ul>
            </div>
        <?php
        }
    } else {//For guests
        ?>
        <div id="menu">
            <ul>
                <li>
                    <a href="<?php echo $DIR ?>/index.php">Home</a>
                </li>
                <li>
                    <a href="<?php echo $DIR ?>/customer/newCustomer/index.php">Register</a>
                </li>
            </ul>
        </div>
    <?php
    }
    ?>
</div>
<br style="clear:both"/>