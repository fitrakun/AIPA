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
                <nav class="navbar navbar-default navbar-fixed-top">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">AIPA</a>
                        </div>
                        <ul class="nav navbar-nav">
                          <li><a href="#">Peminjaman</a></li>
                          <li><a href="#">Pengembalian</a></li>
                          <li><a href="#">Booking</a></li>
                          <li><a href="#">Perbaikan</a></li>
                          <li><a href="peralatan.php">Peralatan</a></li>
                          <li><a href="#">Statistik</a></li>
                        </ul>
                        <div class="nav navbar-header navbar-right">
                            <ul class="span1 nama">
                                <li><a href="#">Pipin</a></li>
                                <li><a href="#" class="small8">Admin Duktek</a></li>
                            </ul>
                        </div>
                        <div class="navbar-right">
                            <img class="ava" src="img/ava.png">
                        </div>
                    </div>
                </nav>
            </div>

            <div id="content">
                <div id = "calendar">
                    <?php
                        require 'calendar.php';
                        $month = date("m");
                        $Month = date("M");
                        $year = date("Y");
                        echo '<h2>'.$Month.' '.$year.'</h2>';
                        echo draw_calendar($month,$year);
                    ?>
                </div>

                <div id ="form">
                    <h3>Form Peminjaman</h3>
                    <form name ='form_peminjaman' action='' method = 'post'>
                        <h5>Nama Peminjam :</h5>
                        <input type = 'text' name = 'nama' placeholder = 'Nama Peminjam'/>
                        <h5>Civitas :</h5>
                        <select name = 'civitas'>
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Dosen">Dosen</option>
                            <option value="Institusi">Institusi</option>
                        </select>
                        <h5>Nama Alat :</h5>
                        <select name = 'alat'>
                            <option value="1 Microphone">1 Microphone</option>
                        </select>
                        <h5>Tanggal Peminjaman :</h5>

                        <h5>Rencana Pengembalian :</h5>
                        <input class = 'button' id='button_post' type = 'submit' value='Kirim'/>
                    </form>
                </div>
            </div>
    </body>
</html>