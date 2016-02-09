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
            <?php
                require_once 'controller/peralatan.php'; 
                $results = queryNamaAlat();
            ?>
            <select name="nama_alat" form="alat">
                <?php foreach($results as $result) : ?>
                    <option value="<?php echo $result['nama_alat']; ?>"><?php echo $result['nama_alat']; ?></option>
                <?php endforeach; ?>
            </select>
            <form name ='nama_alat' action='controller/pengembalian.php' method = 'post'>
                <input class = 'button' id='button_post' type = 'submit' name='cari' value='Kirim'/>
            </form>


        </div>
    </body>
</html>