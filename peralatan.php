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
                <?php require_once 'navigation_bar.php'?>
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
                    <form name ='form_peralatan' action='controller/peralatan.php' method = 'post'>
                        <h5>ID Alat</h5>
                        <input id="idalat" class="span4 form-control" type = 'text' name = 'idalat' placeholder = 'ID Alat'/>
                        <h5>Nama Alat</h5>
                        <input id="namaalat" class="span4 form-control" type = 'text' name = 'namaalat' placeholder = 'Nama Alat'/>
                        <h5>Status</h5>
                        <input id="status" class="span4 form-control" type = 'text' name = 'status' placeholder = 'Status'/>
                        <h5>Lokasi</h5>
                        <input id="idalat" class="span4 form-control" type = 'text' name = 'idalat' placeholder = 'ID Alat'/>
                        <input class='span1 btn btn-default btn-add' id='button_post' type='submit' value="Tambahkan"/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>