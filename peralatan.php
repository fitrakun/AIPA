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
        <div id="container">
            <div id="header">
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
                          <li class="active"><a href="peralatan.php">Peralatan</a></li>
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
                <div id="list">
                    <h3 class="span1">List Peralatan</h3>
                    <div class="s-alat">
                        <form name ='form_peminjaman' action='' method = 'post'>
                            <div class="form-group">
                                <label for="namaalat" class="span1">Nama Alat</h5>
                                <div class="form-inline">
                                    <input id="namaalat" class="span1 form-control" type = 'text' name = 'namaalat' placeholder = 'Nama Alat'/>
                                    <input class='span1 btn btn-default' id='button_post' type='submit' value="Cari"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Alat</th>
                                <th>Nama Alat</th>
                                <th>Status</th>
                                <th>Lokasi</th>
                            </tr>
                            <tbody>
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
                <div id="form">
                    <h3>Tambah Peralatan</h3>
                    
                </div>
            </div>
        </div>
    </body>
</html>