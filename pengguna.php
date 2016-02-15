<?php 
        include "controller/config.php";
        $conn = connect_database();    
        if(isset($_POST["Cari"]))
        {
            $namauser = mysql_real_escape_string($_POST['namauser2']);    
            $sql = "SELECT * FROM `user` WHERE nama_user LIKE '%" . $namauser . "%';";
            
        }
        else
            $sql="SELECT * FROM `user`";
        $result = $conn->query($sql);
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
        
    </head>
    <body>
        <div id = "container" class="special-pad">
            <div id  = "header">
                <?php require_once 'navigation_bar.php'?>
            </div>

            <div id="content">
                <div class="col-sm-9 list">
                    <h3 class="span1">List Pengguna</h3>
                    <div class="s-alat">
                        <form name ='form_pengguna' action='<?php echo $_SERVER['PHP_SELF'];?>' method = 'post'>
                            <div class="form-group">
                                <label for="namauser" class="span1">Nama Pengguna</label>
                                <div class="form-inline">
                                    <input id="namauser2" class="span1 form-control" type = 'text' name = 'namauser2' placeholder = 'Nama Pengguna' required/>
                                    <input class='span1 btn btn-default' id='button_post' type='submit' name="Cari" value="Cari"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Pengguna</th>
                                <th>Nama Pengguna</th>
                                <th>Kategori Civitas</th>
                            </tr>
                        </thead>
                            <tbody> 
                                <?php
                                if ($result->num_rows > 0)
                                {
                                    while ($row = $result->fetch_assoc())
                                    {
                                        echo "<tr> <td>" . $row["id_user"] . "</td> <td>" . $row["nama_user"] . "</td> <td>" . $row["kategori_civitas"] . "</td>";
                                    }
                                }
                                ?>
                            </tbody>
                    </table>
                </div>
                 <div class="col-sm-3">
                    <h3>Tambah Pengguna</h3>
                    <form name ='form_tambah_pengguna' action='controller/pengguna.php' method = 'post'>
                        <h4>ID Pengguna</h4>
                        <super>Nomor Identitas Pengguna</super>
                        <input id="iduser" class="span4 form-control" type = 'number' name = 'iduser' placeholder = 'ID Pengguna' required/>
                        <h4>Nama Pengguna</h4>
                        <super>Nama pengguna/nama institusi</super>
                        <input id="namauser" class="span4 form-control" type = 'text' name = 'namauser' placeholder = 'Nama Pengguna' required/>
                        <h4>Kategori Civitas</h4>
                            <select class="form-control" name="kategori" id="kategori">
                                <option value="mahasiswa">mahasiswa</option>
                                <option value="dosen">dosen</option>
                                <option value="institusi">institusi </option>
                            </select>
                        <input class='span1 btn btn-default btn-add' id='button_post' type='submit' value="Tambahkan" name="Tambahkan"/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>