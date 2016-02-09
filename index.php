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
                <?php require_once 'navigation_bar.php'?>
            </div>

            <div id="content">
                <div id = "calendar">
                    <form name = 'form_navigasi' action="index.php" method ='POST'>
                        <div class = "form-inline">
                            <input class = "span4 form-control" type ='text' name = 'month' placeholder="bulan"/>
                            <input class = "span4 form-control" type ='text' name = 'year' placeholder="tahun"/>
                            <input class = "span4 form-control" type ='text' name = 'alat' placeholder="nama alat"/>
                            <input class = 'span4 form-control button' name = 'refresh' type = 'submit' value = 'Refresh'/>
                        </div>
                    </form>
                    <?php
                    require 'controller/calendar.php';
                    $month = date("m");
                    $Month = date("M");
                    $year = date("Y");
                    $alat = 'Microphone';
                    if(isset($_POST['refresh'])) {
                        $month = intval($_POST['month']);
                        $Month = getMonthString($_POST['month']);
                        $year = $_POST['year'];
                        $alat = $_POST['alat'];
                    }

                    echo '<h2>' . $Month . ' ' . $year . '</h2>';
                    echo draw_calendar($month, $year, $alat);
                    ?>
                </div>

                <div id ="form">
                    <h3>Form Peminjaman</h3>
                    <form name ='form_peminjaman' action='controller/transaksi.php' method = 'post'>
                        <h5>ID Peminjam :</h5>
                        <input type = 'text' name = 'id' placeholder = 'NIM / NIK Peminjam'/>
                        <h5>Kode Alat :</h5>
                        <input type = 'text' name = 'kode-alat' placeholder = 'Kode Alat'/>
                        <h5>Tanggal Peminjaman :</h5>
                            <input type="datetime-local" name="tanggal-pinjam" />
                        <h5>Rencana Pengembalian :</h5>
                            <input type="datetime-local" name="tanggal-kembali" />
                        <br />
                        <div class="row">
                            <div class="col-sm-6"><input type="radio" name="jenis" value="booking" checked>Booking</div>
                            <div class="col-sm-6"><input type="radio" name="jenis" value="peminjaman">Peminjaman</div>
                        </div>
                        <input class = 'button' id='button_post' type = 'submit' name='kirim' value='Kirim'/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>