<!DOCTYPE html>
<html>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">AIPA</a>
            </div>
            <ul class="nav navbar-nav">
              <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'index.php'){echo 'active'; }else { echo ''; } ?>"><a href="index.php">Transaksi</a></li>
              <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'pengembalian.php'){echo 'active'; }else { echo ''; } ?>"><a href="#">Pengembalian</a></li>
              <li <?php if(basename($_SERVER['SCRIPT_NAME']) == 'perbaikan.php'){echo 'active'; }else { echo ''; } ?>><a href="#">Perbaikan</a></li>
              <li <?php if(basename($_SERVER['SCRIPT_NAME']) == 'peralatan.php'){echo 'active'; }else { echo ''; } ?>><a href="peralatan.php">Peralatan</a></li>
              <li <?php if(basename($_SERVER['SCRIPT_NAME']) == 'statistik.php'){echo 'active'; }else { echo ''; } ?>><a href="#">Statistik</a></li>
              <li <?php if(basename($_SERVER['SCRIPT_NAME']) == 'pengguna.php'){echo 'active'; }else { echo ''; } ?>><a href="#">Pengguna</a></li>
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
</html>
