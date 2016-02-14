<?php

	if(isset($_POST['cari'])) {
	   cariAlat($_POST['nama_alat']);
	}
	else if(isset($_POST['kirim'])) {
		pengembalian();
	}

	function cariAlat($conn, $nama) {
		if(strcmp($nama, "semua")||strcmp($nama, "")) {
			$sql = "SELECT * FROM `peminjaman` NATURAL JOIN `user` NATURAL JOIN `alat` WHERE `tanggal_pengembalian` IS NULL";
		}
		else {
			$sql = "SELECT * FROM `peminjaman` NATURAL JOIN `user` NATURAL JOIN `alat` WHERE `tanggal_pengembalian` IS NULL AND nama_alat = '".$nama."'";
		}
		$results = mysqli_query($conn, $sql);
		return $results;
	}

	function pengembalian($nama) {
		include "config.php";
        $conn = connect_database();

		$results = cariAlat($nama);
		foreach($results as $result):
			if(!empty($_POST["status"])) {
				foreach($_POST["status"] as $id) {
					$sql = "UPDATE `peminjaman` SET `tanggal_pengembalian` = NOW() WHERE `id_alat`=".$id;
					if(mysqli_query($conn,$sql)) {
						header("Location: ../pengembalian.php");
						exit();
					}
					else {
						echo mysqli_error($conn);
					}
				}
			}
		endforeach;	
	}

?>