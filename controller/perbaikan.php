<?php

    if(isset($_POST['cari'])) {
       perbaikan();
    }
    if(isset($_POST['kirim'])) {
       
    }

	function perbaikan($nama) {
		include "config.php";
		$conn = connect_database();

        if(strcmp($nama, "semua")) {
            $sql = "SELECT * FROM `perbaikan`";
        } else {
            $sql = "SELECT * FROM `alat` NATURAL JOIN `perbaikan` WHERE `tanggal_selesai_perbaikan` IS NOT NULL AND nama_alat = '.$nama.'";
        }
    
        return mysqli_query($conn, $sql);
	}

    function queryNamaAlat() {
        include "config.php";
        $conn = connect_database();

        $sql = "SELECT DISTINCT `nama_alat` FROM `alat`";
        return mysqli_query($conn, $sql);
    }

    function tambahPerbaikan($id, $institusi, $nomor_telepon, $mulai_perbaikan, $estimasi) {
        include "config.php";
        $conn = connect_database();

        $sql1 = "INSERT INTO `teknisi` (`nama_institusi`, `nomor_telepon`) VALUES ('$_POST[institusi]', '$_POST[nomor_telepon]');";
        $sql = "INSERT INTO `perbaikan` (`nama_institusi`, `id_alat`, `tanggal_mulai_perbaikan`, `tanggal_selesai_perbaikan`, `estimasi_selesai_perbaikan`) VALUES ('$_POST[institusi]', '$_POST[id]','$_POST[mulai_perbaikan]',NULL,'$_POST[estimasi]');";
        if(mysqli_query($conn,$sql1) && mysqli_query($conn,$sql2)) {
            echo "Data anda berhasil disimpan";
            echo '<a href="../perbaikan.php"> Kembali ke halaman Peralatan</a>';
        }
        else {
            echo mysqli_error($conn);
            echo '<a href="../perbaikan.php"> Kembali ke halaman Peralatan</a>';
        }
    }
?>