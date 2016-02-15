<?php 
        include "controller/config.php";
        $conn = connect_database();

        if(isset($_POST["Cari"]))
        {
            $namaalat = mysql_real_escape_string($_POST['namaalat2']);
            $sql = "SELECT * FROM `alat` WHERE nama_alat LIKE '%" . $namaalat . "%';";
            
        }
        else
            $sql="SELECT * FROM `alat`";
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
        <div id="container" class="special-pad">
            <div id="header">
                <?php require_once 'navigation_bar.php'?>
            </div>
            <div id="content">
                <div class="col-sm-9 list">
                    <h3 class="span1">List Peralatan</h3>
                    <div class="s-alat">
                        <form name ='form_peralatan' action='<?php echo $_SERVER['PHP_SELF'];?>' method = 'post'>
                            <div class="form-group">
                                <label for="namaalat" class="span1">Nama Alat</label>
                                <div class="form-inline">
                                    <input id="namaalat2" class="span1 form-control" type = 'text' name = 'namaalat2' placeholder = 'Nama Alat'/>
                                    <input class='span1 btn btn-default' id='button_post' type='submit' name="Cari" value="Cari"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Alat</th>
                                <th>Nama Alat</th>
                                <th>Status</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                            <tbody> 
                                <?php
                                if ($result->num_rows > 0)
                                {
                                    while ($row = $result->fetch_assoc())
                                    {
                                        echo "<tr> <td>" . $row["id_alat"] . "</td> <td>" . $row["nama_alat"] . "</td> <td>" . $row["status"] . "</td> <td>" . $row ["lokasi"] . "</td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                    </table>
                </div>
                <div class="col-sm-3">
                    <h3>Tambah Peralatan</h3>
                    <form id='form_peralatan' action='controller/peralatan.php' method = 'post'>
                        <h5>ID Alat</h5>
                        <input id="idalat" pattern="[A-Z]{3}[0-9]{3}" class="span4 form-control" type = 'text' name = 'idalat' placeholder = 'ID Alat'/>
                        <h5>Nama Alat</h5>
                        <input id="namaalat" maxlength="50" class="span4 form-control" type = 'text' name = 'namaalat' placeholder = 'Nama Alat'/>
                        <h5>Status</h5>
                            <select class="form-control" name="status" id="status">
                                <option value="normal">normal</option>
                                <option value="rusak">rusak</option>
                            </select>
                        <h5>Lokasi</h5>
                        <input id="lokasi" maxlength="20" class="span4 form-control" type = 'text' name = 'lokasi' placeholder = 'Lokasi'/>
                        <input class='span1 btn btn-default btn-add' id='button_post' type='submit' value="Tambahkan" name="Tambahkan"/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>