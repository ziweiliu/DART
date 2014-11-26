<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="css/UI-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>
    <link href="css/core.css" rel="stylesheet" type="text/css"/>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui-1.10.4.custom.js"></script>
    <script src="js/main.js"></script>
    <title>View Schedule</title>
    <style>
        .info {
            width: 100%;
            height: 100px;
            float: left;
            font-size: 14px;
            line-height: 25px;
            -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
            -moz-box-sizing: border-box; /* Firefox, other Gecko */
            box-sizing: border-box; /* Opera/IE 8+ */
            padding-left: 10px;
        }

        .info:hover {
            background-color: #cccccc;
        }

        .time {
            width: 100%;
            height: 60px;
            float: left;
            text-align: center;
            font-size: 14px;
            padding-top: 38px;
        }

        #timeCol1, #timeCol2 {
            width: 10%;
            float: left;
        }

        #dart1Col1, #dart2Col1, #dart1Col2, #dart2Col2 {
            width: 20%;
            float: left;
        }

        #scheduleWrapper {
            height: 2560px;
            width: 80%;
            margin: 0px auto;
            background-color: white;
        }

        label {
            width: 40px;
            float: left;
        }

    </style>
    <script>

    </script>
</head>
<body>
<div id="wrapper">
    <div id="container">
        <?php
        include('includes/header.php');
        ?>
        <div id="content">
            <div id="light"></div>
            <div id="dark" onClick="finishEdit()"></div>
            <div id="scheduleWrapper">
                <h2 id="todayTitle"></h2>

                <div id="timeCol1">
                </div>
                <div id="dart1Col1">

                </div>
                <div id="dart2Col1">

                </div>
                <div id="timeCol2">
                </div>
                <div id="dart1Col2">

                </div>
                <div id="dart2Col2">

                </div>
            </div>
        </div>
        <div id="footer">

        </div>
    </div>
</div>
<script>
    generateTimes();
    generateSchedule();
</script>
</body>
</html>