<?php

    if(isset($_POST['kirim'])) {
       tambahPerbaikan();
    }

	function perbaikan() {
		include "config.php";
		$conn = connect_database();
        
        $namaalat = mysql_real_escape_string($_POST['namaalat2']);
        if(isset($_POST["cari"])) {
            $sql = "SELECT * FROM `perbaikan` NATURAL JOIN `teknisi` WHERE `tanggal_selesai_perbaikan` IS NOT NULL AND nama_alat = '.$namaalat.'";
        } else {
            $sql = "SELECT * FROM `perbaikan` NATURAL JOIN `teknisi`";
        }
    
        $result = mysqli_query($conn, $sql);
        return $result;
	}

    function queryNamaAlat() {
        include "config.php";
        $conn = connect_database();

        $sql = "SELECT DISTINCT `nama_alat` FROM `alat`";
        return mysqli_query($conn, $sql);
    }

    function tambahPerbaikan() {
        include "config.php";
        $conn = connect_database();

        $sql1 = "INSERT INTO `perbaikan` (`nama_institusi`, `id_alat`, `tanggal_mulai_perbaikan`, `tanggal_selesai_perbaikan`, `estimasi_selesai_perbaikan`) VALUES ('$_POST[institusi]', '$_POST[id]','$_POST[mulai_perbaikan]',NULL,'$_POST[estimasi]');";
        $sql2 = "INSERT INTO `teknisi` (`nama_institusi`, `nomor_telepon`) VALUES ('$_POST[institusi]', '$_POST[telepon]');";
        if(mysqli_query($conn,$sql1) && mysqli_query($conn,$sql2)) {
            echo "Data anda berhasil disimpan";
            echo "<script> window.open('index.php', '_self') </script>";
        }
        else {
            echo mysqli_error($conn);
            echo '<a href="../perbaikan.php"> Kembali ke halaman Peralatan</a>';
        }
    }
?>