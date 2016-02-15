<?php
    $month = intval(date("m"));
    $year = date("Y");
    $permintaan = "penggunaan-alat";
    $user = "mahasiswa";
?>
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
            function myFunction() {
                var x = document.getElementById("stats").value;
                if(x=="penggunaan-alat-user") {
                    document.getElementById("civitas").disabled = false;
                }
                else{
                    document.getElementById("civitas").disabled = true;
                }
            }
        </script>

    </head>
    <body>
        <div id = "container" class="special-pad">
            <div id  = "header">
                <?php $page = 'index'; require_once 'navigation_bar.php'?>
            </div>

            <div id="content" >
                <div class="col-sm-3">
                    <form name ='form_statistik' action='<?php echo $_SERVER['PHP_SELF'];?>' method = 'post'>
                        <h3 class="span1"><b>Form Statistik</b></h3>
                        <div class="form-group">
                            <h4><b>Periode</b></h4>
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
                            <h4><b>Jenis Statistik</b></h4>
                            <select id="stats" class="span1 form-control" onchange= "myFunction()" name="stats">
                                <option value = "penggunaan-alat" selected>Penggunaan peralatan</option>
                                <option value = "perbaikan-alat">Perbaikan alat</option>
                                <option value = "penggunaan-alat-user">Pengunaan alat oleh user</option>
                            </select>
                            <br/>
                            <h4><b>Civitas Peminjam</b></h4>
                            <h6>(berlaku untuk statistik dengan kelompok user tertentu)<h6>
                            <select id="civitas" class="span1 form-control" name="civitas" disabled="disabled">
                                <option value = "mahasiswa" selected>Mahasiswa</option>
                                <option value = "dosen">Dosen</option>
                                <option value = "institusi">Institusi</option>
                            </select>
                            <br/>
                            <input class='span1 btn btn-default' id='button_post' type='submit' name="Tampilkan" value="Tampilkan"/>
                        </div>
                    </form>
                </div>

                <div class="col-sm-9">
                    <?php
                    require 'controller/statistik1.php';
                    if(isset($_POST['Tampilkan'])){
                        $month = $_POST['month'];
                        $year = $_POST['year'];
                        $permintaan = $_POST['stats'];
                        if(isset($_POST['civitas']))
                            $user = $_POST['civitas'];
                    }
                    draw_graph($month,$year,$permintaan,$user);
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>