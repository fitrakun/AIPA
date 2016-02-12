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
                <?php $page = 'index'; require_once 'navigation_bar.php' ?>
            </div>
            <div id = "content">
                <?php
                    require_once 'controller/config.php'; require_once'controller/peralatan.php';
                    $conn = connect_database();

                    $results = queryNamaAlat($conn);
                ?>
                <div class="form-group form-group-sm">
                    <select class = "span4 form-control" name="nama_alat" form="alat">
                        <?php foreach($results as $result) : ?>
                            <option value="<?php echo $result['nama_alat']; ?>"><?php echo $result['nama_alat']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <form name ='nama_alat' action='controller/pengembalian.php' method = 'post'>
                        <input  class = 'span4 form-control button' id='button_post' type = 'submit' name='cari' value='cari'/>
                    </form>
                </div>


                <form name="pengembalian" action="controller/pengembalian.php">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Alat</th>
                                <th>Nama Alat</th>
                                <th>Nama Peminjam</th>
                                <th>Civitas</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Estimasi Pengembalian</th>
                                <th>Pengembalian</th>
                            </tr>
                        </thead>
                        <?php 
                            require_once 'controller/pengembalian.php';
                            if(isset($_GET['nama'])) {
                               $results = cariAlat($conn, $_GET['nama']);
                            } else {
                                $results = cariAlat($conn, "semua"); 
                            }
                        ?>
                        <tbody>
                            <tr>
                                <?php while($result = mysqli_fetch_assoc($results)) { ?>
                                <td><?php echo $result['id_alat']; ?></td>
                                <td><?php echo $result['nama_alat']; ?></td>
                                <td><?php echo $result['nama_user']; ?></td>
                                <td><?php echo $result['kategori_civitas']; ?></td>
                                <td><?php echo $result['tanggal_peminjaman']; ?></td>
                                <td><?php echo $result['tanggal_rencana_pengembalian']; ?></td>
                                <td><input type="checkbox" name="status[]" value="<?php echo $result['id_user']."|".$result['id_alat']."|".$result['tanggal_peminjaman']; ?>"></td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                    <input class = 'button' id='button_post' type = 'submit' name='kirim' value='Kirim'/>
                </form>
            </div>
        </div>
    </body>
</html>