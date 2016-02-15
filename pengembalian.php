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
        <div id = "container" class="special-pad">
            <div id  = "header">
                <?php $page = 'index'; require_once 'navigation_bar.php' ?>
            </div>
            <div id = "content">
                <?php
                    require_once 'controller/config.php'; require_once'controller/peralatan.php';
                    $conn = connect_database();

                    $results = queryNamaAlat($conn);

                    mysqli_close($conn);
                ?>
                <div>
                    <form name ='nama_alat' action='pengembalian.php' method = 'get'>
                        <label for = "nama">Nama Alat</label>
                        <div class = "form-inline">
                            <select class = "form-control" name="nama">
                                <?php foreach($results as $result) : ?>
                                    <option value="<?php echo $result['nama_alat']; ?>"><?php echo $result['nama_alat']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input  class = 'form-control button' id='button_post' type = 'submit' value='cari'/>
                        </div>
                    </form>
                </div>

                <div>
                    <form name="pengembalian" action="controller/pengembalian.php" method="post">
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
                                $conn = connect_database();
                                if(isset($_GET['nama'])) {
                                   $results = cariAlat($conn, $_GET['nama']);
                                } else {
                                    $results = cariAlat($conn, "semua");
                                }
                            ?>
                            <tbody>
                                <?php foreach($results as $result) : ?>
                                <tr>
                                    <td><?php echo $result['id_alat']; ?></td>
                                    <td><?php echo $result['nama_alat']; ?></td>
                                    <td><?php echo $result['nama_user']; ?></td>
                                    <td><?php echo $result['kategori_civitas']; ?></td>
                                    <td><?php echo $result['tanggal_peminjaman']; ?></td>
                                    <td><?php echo $result['tanggal_rencana_pengembalian']; ?></td>
                                    <td><input type="checkbox" name="status[]" value="<?php echo $result['id_user']."|".$result['id_alat']."|".$result['tanggal_peminjaman']; ?>"></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="nama" value="<?php if(isset($_GET['nama'])) echo $_GET['nama']; else echo "semua";?>">
                        <input class = 'btn btn-default' id='button_post' type = 'submit' name="kirim" value='Kirim'/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>