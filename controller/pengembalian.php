<?php
	if(isset($_POST['kirim'])) {
		pengembalian($_POST['nama']);
	}

	function cariAlat($conn, $nama) {
		if(strcmp($nama, "semua")==0) {
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
		if(!empty($_POST["status"])) {
			foreach($_POST["status"] as $status):
				$pengembalian = explode("|", $status);
				//foreach($pengembalian as $a) echo $a."|";
				echo"<br>";
				$sql = "UPDATE `peminjaman` SET `tanggal_pengembalian` = NOW() WHERE `id_user`=".$pengembalian[0].
					" AND `id_alat`='".$pengembalian[1]."' AND `tanggal_peminjaman`='".$pengembalian[2]."'";
				//echo $sql."<br>";
				if(mysqli_query($conn,$sql)) {
					echo "Pengembalian peralatan dengan ID ".$pengembalian[1]." dengan tanggal peminjaman ".$pengembalian[2]." berhasil dilakukan.<br>";
				}
				else {
					echo mysqli_error($conn)."<br>";
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