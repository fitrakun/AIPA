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

        <script>
            function peminjaman() {
                document.getElementById("tanggal-pinjam").disabled = true;
            }
            function booking() {
                document.getElementById("tanggal-pinjam").disabled = false;
            }
        </script>

    </head>
    <body>
        <div id = "container">
            <div id  = "header">
                <?php require_once 'navigation_bar.php'?>
            </div>

            <div id="content" class="flex">
                <div id = "calendar">
                    <?php
                    require 'controller/calendar.php';
                    $month = date("m");
                    $Month = date("M");
                    $year = date("Y");
                    $alat = 'Microphone';
                    ?>
                    <form name = 'form_navigasi' action="index.php" method ='POST'>
                        <div class = "form-inline">
                            <h4>Pencarian Ketersediaan Alat</h4>
                            <select class = "span4 form-control" name = 'month'>
                                <option selected = "selected" value="1">Jan</option><option value="2">Feb</option><option value="3">Mar</option>
                                <option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option>
                                <option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option>
                                <option value="4">Oct</option><option value="10">Nov</option><option value="12">Dec</option>
                            </select>
                            <select class = "span4 form-control" name = 'year'>
                                <option value="<?php echo $year-2 ?>"><?php echo $year-2 ?></option>
                                <option value="<?php echo $year-1 ?>"><?php echo $year-1 ?></option>
                                <option selected = "selected" value="<?php echo $year ?>"><?php echo $year ?></option>
                                <option value="<?php echo $year+1 ?>"><?php echo $year+1 ?></option>
                                <option value="<?php echo $year+2 ?>"><?php echo $year+2 ?></option>
                            </select>
                            <input class = "span4 form-control" type ='text' name = 'alat' placeholder="nama alat"/>
                            <input class = 'span4 form-control button' name = 'refresh' type = 'submit' value = 'Refresh'/>
                        </div>
                    </form>
                    <?php
                    if(isset($_POST['refresh'])) {
                        $month = $_POST['month'];
                        $Month = getMonthString($_POST['month']);
                        $year = $_POST['year'];
                        $alat = $_POST['alat'];
                    }

                    echo '<h2>' . $Month . ' ' . $year . '</h2>';
                    echo '<h4>Nama Alat : ' .$alat. '</h4>';
                    echo draw_calendar($month, $year, $alat);
                    ?>
                </div>

                <div id ="form">
                    <h3>Form Peminjaman</h3>
                    <form name ='form_peminjaman' action='controller/transaksi.php' onsubmit="return validateDate()" method = 'post'>
                        <h5>ID Peminjam :</h5>
                        <input type = 'number' min='0' name = 'id' placeholder = 'NIM / NIK Peminjam' required/>
                        <h5>Kode Alat :</h5>
                        <input type = 'text' pattern="[A-Z]{3}[0-9]{3}" name = 'kode-alat' placeholder = 'Kode Alat' required/>
                        <h5>Tanggal Peminjaman :</h5>
                            <input id="tanggal-pinjam" class="form-control" disabled = "true" type="datetime-local" name="tanggal-pinjam" />
                        <h5>Rencana Pengembalian :</h5>
                            <input id="tanggal-kembali" type="datetime-local" class="form-control" name="tanggal-kembali" required/>
                        <br />
                            <label class="radio-inline"><input type="radio" onclick="peminjaman()" name="jenis" value="peminjaman" checked>Peminjaman</label>
                            <label class="radio-inline"><input type="radio" name="jenis" onclick="booking()" value="booking">Booking</label>
                        </br>
                        </br>
                        <input class = 'btn btn-default' id='button_post' type = 'submit' name='kirim' value='Kirim'/>
                    </form>
                </div>
            </div>
        </div>
        <script src="js/validation.js"></script>
    </body>
</html>