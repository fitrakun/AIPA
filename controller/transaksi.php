<?php
	if(isset($_POST['kirim'])) {
	   transaksi();
	}

	function transaksi() {
		include "config.php";
		$conn = connect_database();

		if(userCheck($conn,$_POST['id'])){
            $kodealat = mysqli_real_escape_string($conn,$_POST["kode-alat"]);
            if(!isAvailable($kodealat,$_POST["tanggal-pinjam"],$_POST["tanggal-kembali"])) {

            }
            else {
                if(strcmp($_POST["jenis"],"peminjaman")==0) {
                    $sql = "INSERT INTO `peminjaman` (`id_user`, `id_alat`, `tanggal_rencana_pengembalian`) VALUES ('$_POST[id]','$kodealat','".str_replace('T', ' ', $_POST["tanggal-kembali"]).":00')";
                }
                else { //booking
                    $sql = "INSERT INTO `booking` (`id_user`, `id_alat`, `tanggal_rencana_peminjaman`, `tanggal_rencana_pengembalian`) VALUES ('$_POST[id]','$kodealat','".str_replace('T', ' ', $_POST["tanggal-pinjam"]).":00','".str_replace('T', ' ', $_POST["tanggal-kembali"]).":00')";
                }

                if(mysqli_query($conn,$sql)) {
                    echo "Data anda berhasil disimpan";
                    echo '<a href="../index.php"> Kembali ke halaman Transaksi</a>';
                }
                else {
                    echo mysqli_error($conn);
                    echo '<a href="../index.php"> Kembali ke halaman Transaksi</a>';
                }
            }
        }
        else{
            //tidak ada user dengan id tersebut
            echo "Maaf, user dengan ID sekian belum terdaftar. Mohon daftarkan diri Anda terlebih dahulu!";
        }
	}

	function userCheck($conn, $id) {
        $result = mysqli_query($conn, "SELECT * FROM user WHERE id_user = ".$id);
        if(mysqli_num_rows($result)>0){
            mysqli_free_result($result);
            return true;
        }
        else {
            mysqli_free_result($result);
            return false;
        }
	}

	function isAvailable($kodealat, $tanggalmulai, $tanggalselesai) {
		return true;
	}

?>