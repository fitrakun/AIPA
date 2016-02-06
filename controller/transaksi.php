<?php
	if(isset($_POST['kirim'])) {
	   transaksi();
	}

	function transaksi() {
		include "config.php";
		$conn = connect_database();
		
		$iduser = userCheck($_POST["nama"],$_POST["civitas"]);
		$kodealat = mysqli_real_escape_string($conn,$_POST["kode-alat"]);
		if(!isAvailable(kodealat,$_POST["tanggal-pinjam"],$_POST["tanggal-kembali"])) {

		}
		else {
			if(strcmp($_POST["jenis"],"peminjaman")==0) {
				$sql = "INSERT INTO `peminjaman` (`id_user`, `id_alat`, `tanggal_rencana_pengembalian`) VALUES (1,'$kodealat','".str_replace('T', ' ', $_POST["tanggal-kembali"]).":00')";
			}
			else { //booking
				$sql = "INSERT INTO `booking` (`id_user`, `id_alat`, `tanggal_rencana_peminjaman`, `tanggal_rencana_pengembalian`) VALUES (1,'$kodealat','".str_replace('T', ' ', $_POST["tanggal-pinjam"]).":00','".str_replace('T', ' ', $_POST["tanggal-kembali"]).":00')";
			}
			echo $sql;

			if(mysqli_query($conn,$sql)) {
				header("../index.php");
			}
			else {
				echo mysqli_error($conn);
			}
		}
	}

	function userCheck($name, $civitas) {
		return 1;
	}

	function isAvailable($kodealat, $tanggalmulai, $tanggalselesai) {
		return true;
	}

?>