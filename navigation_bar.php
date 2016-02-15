<!DOCTYPE html>
<html>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">AIPA</a>
            </div>
            <ul class="nav navbar-nav">
              <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'index.php'){echo 'active'; }else { echo ''; } ?>"><a href="index.php">Transaksi</a></li>
              <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'pengembalian.php'){echo 'active'; }else { echo ''; } ?>"><a href="pengembalian.php">Pengembalian</a></li>
              <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'perbaikan.php'){echo 'active'; }else { echo ''; } ?>"><a href="perbaikan.php">Perbaikan</a></li>
              <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'peralatan.php'){echo 'active'; }else { echo ''; } ?>"><a href="peralatan.php">Peralatan</a></li>
              <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'statistik.php'){echo 'active'; }else { echo ''; } ?>"><a href="statistik.php">Statistik</a></li>
              <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'pengguna.php'){echo 'active'; }else { echo ''; } ?>"><a href="pengguna.php">Pengguna</a></li>
            </ul>
        </div>
    </nav>
</html>
