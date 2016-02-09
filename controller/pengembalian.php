<?php
	if(isset($_POST['cari'])) {
	   cariAlat();
	}
	else(isset($_POST['kirim'])) {

	}

	function cariAlat($nama) {
		include "config.php";
		$conn = connect_database();

		if(strcmp($nama, "semua")) {
			$sql = "SELECT * FROM `peminjaman`";
		}
		else {
			$sql = "SELECT * FROM `peminjaman` WHERE nama_alat = '.$nama.'";
		}
		return mysqli_query($conn, $sql);
	}

	function queryNamaAlat() {
		include "config.php";
		$conn = connect_database();

		$sql = "SELECT DISTINCT `nama_alat` FROM `alat`";
		return mysqli_query($conn, $sql);
	}
?>