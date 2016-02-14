<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AIPA</title>
        <meta name="description" content="Using for PPL task">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <div id = "container">
            <div id  = "header">
                <?php $page = 'index'; require_once 'navigation_bar.php'?>
            </div>

            <div id="content">
                <div id = "calendar">
                    <?php
                        require 'controller/calendar.php';
                        $month = date("m");
                        $Month = date("M");
                        $year = date("Y");
                        echo '<h2>'.$Month.' '.$year.'</h2>';
                        echo draw_calendar($month,$year);
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>