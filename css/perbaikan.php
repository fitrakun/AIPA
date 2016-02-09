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
                <div id="form">
                    <h3>Form Perbaikan</h3>
                    
                    <h4>Detail Alat</h4>
                    <form name ='form_perbaikan' action='controller/perbaikan.php' method = 'post'>
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