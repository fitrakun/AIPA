<?php

    if(isset($_POST['kirim'])) {
       tambahPerbaikan();
    } else if (isset($_POST['update'])) {
        pengembalian();
    }

    function cariAlat($conn, $nama) {
        include "config.php";
        $conn = connect_database();

        if(strcmp($nama, "semua")==0) {
            $sql = "SELECT * FROM `perbaikan` NATURAL JOIN `teknisi`";
        }
        else {
            $sql = "SELECT * FROM `perbaikan` NATURAL JOIN `teknisi` WHERE `tanggal_selesai_perbaikan` IS NOT NULL AND nama_alat = '".$namaalat."'";
        }
        $results = mysqli_query($conn, $sql);
        return $results;
    }

    function tambahPerbaikan() {
        include "config.php";
        $conn = connect_database();

        $sql = "SELECT * FROM `teknisi` WHERE `nama_institusi`='".$_POST['institusi']."'";
        $sql1 = "INSERT INTO `perbaikan` (`nama_institusi`, `id_alat`, `estimasi_selesai_perbaikan`) VALUES ('$_POST[institusi]', '$_POST[id]','$_POST[estimasi]');";
        $sql2 = "INSERT INTO `teknisi` (`nama_institusi`, `nomor_telepon`) VALUES ('$_POST[institusi]', '$_POST[telepon]');";
        $sql3 = "UPDATE `alat` SET `status`='".'rusak'. "' WHERE `id_alat`='".$_POST['id']."'";


        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            if (mysqli_query($conn,$sql1) && mysqli_query($conn,$sql3)) {
                echo "Data anda berhasil disimpan";
                echo "<script> window.open('../index.php', '_self') </script>";
            }
            else {
                echo "usa"; 
                echo mysqli_error($conn);
                echo '<a href="../perbaikan.php"> Kembali ke halaman Peralatan</a>';
            }
        }
        else {
            if(mysqli_query($conn,$sql3) && mysqli_query($conn,$sql2) && mysqli_query($conn,$sql1)) {
            echo "Data anda berhasil disimpan";
            echo "<script> window.open('../perbaikan.php', '_self') </script>";
            } else {
                echo mysqli_error($conn);
                echo '<a href="../perbaikan.php"> Kembali ke halaman Peralatan</a>';
            }
        }
    }

    function pengembalian() {
        include "config.php";
        $conn = connect_database();

        if(!empty($_POST["check"])) {

            foreach($_POST["check"] as $check):
                $perbaikan = explode("|", $check);
               
                echo"<br>";

                $sql = "UPDATE `perbaikan` SET `tanggal_selesai_perbaikan` = NOW() WHERE `id_alat`='".$perbaikan[0].
                    "' AND `nama_institusi`='".$perbaikan[1]."' AND `tanggal_mulai_perbaikan`='".$perbaikan[2]."'";
                $sql1 = "UPDATE `alat` SET `status`='".'normal'. "' WHERE `id_alat`='".$perbaikan[0]. "'";

                //echo $sql."<br>";
                if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql1)) {
                    echo "Pengembalian perbaikan alat dengan ID ".$perbaikan[0]." dengan tanggal mulai perbaikan ".$perbaikan[2]." berhasil dilakukan.<br>";
                }
                else {
                    //echo mysqli_query($conn,$sql);
                    echo mysqli_error($conn)."<br>";
                    echo "masuk";
                    exit();
                }
            endforeach;
        }
        else {
            echo "Tidak ada peralatan yang dikembalikan.<br>";
        }
        echo '<a href="../pengembalian.php"> Kembali ke halaman Pengembalian</a>';
    }
?>