<div id="header">
    <span style="color: #ffcc00; margin-left: 20px;">USC</span>Transportation
    <br style="clear:both"/>
</div>
<!--Menu for Customer Side-->
<div id="menu">
    <ul>
        <li>
            <a href="<?php echo $DIR ?>/index.php">Home</a>
        </li>
        <li>
            <a href="<?php echo $DIR ?>/customer/index.php">Customer</a>
            <ul>
                <li>
                    <a href="<?php echo $DIR?>/customer/newCustomer/index.php">New Customer</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?php echo $DIR ?>/schedule/index.php">Schedule</a>
            <ul>
                <li>
                    <a href="#">Select Schedule</a>
                    <ul>
                        <li>
                            <a href="<?php echo $DIR?>/schedule/selectSchedule/index.php?day_id=1">Monday</a>
                        </li>
                        <li>
                            <a href="<?php echo $DIR?>/schedule/selectSchedule/index.php?day_id=2">Tuesday</a>
                        </li>
                        <li>
                            <a href="<?php echo $DIR?>/schedule/selectSchedule/index.php?day_id=3">Wednesday</a>
                        </li>
                        <li>
                            <a href="<?php echo $DIR?>/schedule/selectSchedule/index.php?day_id=4">Thursday</a>
                        </li>
                        <li>
                            <a href="<?php echo $DIR?>/schedule/selectSchedule/index.php?day_id=5">Friday</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>
<br style="clear:both" />