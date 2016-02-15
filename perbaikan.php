
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
        <div id="container" class="special-pad">
            <div id="header">
                <?php require_once 'navigation_bar.php'?>
            </div>
            <div id="content" class="flex">

                <div class="col-sm-3">
                    <h3><b>Form Perbaikan</b></h3>
                    <h4><b>Detail Alat</b></h4>
                    <form name ='form_perbaikan' action="controller/perbaikan.php" method = 'post'>
                        <h5>ID Alat</h5>
                        <input id="idalat" pattern="[A-Z]{3}[0-9]{3}" class="span4 form-control" type = 'text' name = 'id' placeholder = 'ID Alat' required/><br/>

                        <h4><b>Detail Teknisi</b></h4>
                        <h5>Nama Institusi</h5>
                            <input id="institusi" class="span4 form-control" type = 'text' name = 'institusi' placeholder = "ex: Bengkel Wilhelm" required/>
                        <h5>Nomor Telepon</h5>
                            <input id="telepon" class="span4 form-control" type = 'number' min='0' name = 'telepon' placeholder = 'ex: 089999999999' required/>
                        <h5>Tanggal Mulai Perbaikan :</h5>
                            <input type="datetime-local" name="mulai_perbaikan" required/>
                        <h5>Estimasi Selesai Perbaikan :</h5>
                            <input class="span4 form-control" type="datetime-local" name="estimasi" />
                        <br/>
                        <input class = 'btn btn-default' id='button_post' type = 'submit' name='kirim' value='Kirim'/>
                    </form>
                </div>

               <div class="col-sm-11 list">
                    <h3><b>List Perbaikan</b></h3>
                    <div class="s-alat">

                        <?php
                            require_once 'controller/config.php'; require_once'controller/peralatan.php';
                            $conn = connect_database();
                            $results = queryNamaAlat($conn);
                            mysqli_close($conn);
                        ?>
                        <div>
                            <form name ='nama_alat' action='peralatan.php' method = 'get'>
                                <label for = "nama">Nama Alat</label>
                                <div class = "form-inline">
                                    <select class = "form-control" name="nama">
                                        <?php foreach($results as $result) : ?>
                                            <option value="<?php echo $result['nama_alat']; ?>"><?php echo $result['nama_alat']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input  class = 'form-control button' id='button_post' type = 'submit' value='Cari'/>
                                </div>
                            </form>
                        </div>

                    </div>

                    <form name="perbaikan" action="controller/perbaikan.php" method="post">
	                    <table class="table table-hover">
	                        <thead>
	                            <tr>
	                                <th>ID Alat</th>
	                                <th>Nama Institusi</th>
	                                <th>Nomor Telepon</th>
	                                <th>Tanggal Perbaikan</th>
	                                <th>Estimasi Pengembalian</th>
	                                <th>Pengembalian</th>
	                            </tr>
	                        </thead>
                            <?php
                                require_once 'controller/perbaikan.php';
                                $conn = connect_database();
                                if(isset($_GET['nama'])) {
                                    echo $_GET['nama'];
                                   $results = cariAlat($conn, $_GET['nama']);
                                } else {
                                    $results = cariAlat($conn, "semua");
                                }
                            ?>
                            <tbody> 
                            	<?php foreach($results as $res) : ?>
	                            <tr>
	                                <td><?php echo $res['id_alat']; ?></td>
	                        		<td><?php echo $res['nama_institusi']; ?></td>
	                                <td><?php echo $res['nomor_telepon']; ?></td>
	                                <td><?php echo $res['tanggal_mulai_perbaikan']; ?></td>
	                                <td><?php echo $res['estimasi_selesai_perbaikan']; ?></td>
	               					<td align="center"><input type="checkbox" name="check[]" value="<?php echo $res['id_alat']."|".$res['nama_institusi']."|".$res['tanggal_mulai_perbaikan']; ?>"></td>
	                            </tr>
	                            <?php endforeach; ?>
                                
                            </tbody>
	                    </table>
	                    <input class = 'span1 btn btn-default' id='button_post' type = 'submit' name="update" value='Update'/>
	                </form>
                </div>

            </div>
        </div>
    </body>
</html>