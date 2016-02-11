<?php
	if(isset($_POST['kirim'])) {
	   transaksi();
	}

	function transaksi() {
		include "config.php";
		$conn = connect_database();

		if(userCheck($conn,$_POST['id'])){
            $kodealat = mysqli_real_escape_string($conn,$_POST["kode-alat"]);
            if(!isAvailable($conn, $kodealat,$_POST["tanggal-pinjam"],$_POST["tanggal-kembali"])) {
                echo "Maaf, alat pada hari tersebut tidak dapat dipinjam </br>";
            }
            else {
                if(strcmp($_POST["jenis"],"peminjaman")==0) {
                    $sql = "INSERT INTO `peminjaman` (`id_user`, `id_alat`, `tanggal_rencana_pengembalian`) VALUES ('$_POST[id]','$kodealat','".str_replace('T', ' ', $_POST["tanggal-kembali"]).":00')";
                }
                else { //booking
                    $sql = "INSERT INTO `booking` (`id_user`, `id_alat`, `tanggal_rencana_peminjaman`, `tanggal_rencana_pengembalian`) VALUES ('$_POST[id]','$kodealat','".str_replace('T', ' ', $_POST["tanggal-pinjam"]).":00','".str_replace('T', ' ', $_POST["tanggal-kembali"]).":00')";
                }

                if(mysqli_query($conn,$sql)) {
                    echo "Data anda berhasil disimpan</br>";
                }
                else {
                    echo mysqli_error($conn);
                }
            }
        }
        else{
            //tidak ada user dengan id tersebut
            echo "Maaf, user dengan ID sekian belum terdaftar. Mohon daftarkan diri Anda terlebih dahulu!";
        }

        echo '<a href="../index.php"> Kembali ke halaman Transaksi</a>';
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

	function isAvailable($conn, $kodealat, $tanggalmulai, $tanggalselesai) {
        $available = true;
        $waktumulai = intval(substr($tanggalmulai,0,4))*365+intval(substr($tanggalmulai,5,2))*30+intval(substr($tanggalmulai,8,2));
        $waktuselesai = intval(substr($tanggalselesai,0,4))*365+intval(substr($tanggalselesai,5,2))*30+intval(substr($tanggalselesai,8,2));

        if($available){
            $results = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_alat = '$kodealat'");
            if(mysqli_num_rows($results)>0){
                foreach($results as $result){
                    $mulai = intval(substr($result['tanggal_peminjaman'],0,4))*365+intval(substr($result['tanggal_peminjaman'],5,2))*30+intval(substr($result['tanggal_peminjaman'],8,2));
                    $selesai = intval(substr($result['tanggal_rencana_pengembalian'],0,4))*365+intval(substr($result['tanggal_rencana_pengembalian'],5,2))*30+intval(substr($result['tanggal_rencana_pengembalian'],8,2));

                    if((($waktumulai<$mulai) and ($waktuselesai<$mulai)) or (($waktumulai>$selesai) and ($waktuselesai>$selesai))){
                        //nothing
                    }
                    else{
                        $available = false;
                    }
                }
            }
            mysqli_free_result($results);
        }

        if($available){
            $results = mysqli_query($conn, "SELECT * FROM booking WHERE id_alat = '$kodealat'");
            if(mysqli_num_rows($results)>0){
                foreach($results as $result){
                    $mulai = intval(substr($result['tanggal_rencana_peminjaman'],0,4))*365+intval(substr($result['tanggal_rencana_peminjaman'],5,2))*30+intval(substr($result['tanggal_rencana_peminjaman'],8,2));
                    $selesai = intval(substr($result['tanggal_rencana_pengembalian'],0,4))*365+intval(substr($result['tanggal_rencana_pengembalian'],5,2))*30+intval(substr($result['tanggal_rencana_pengembalian'],8,2));

                    if((($waktumulai<$mulai) and ($waktuselesai<$mulai)) or (($waktumulai>$selesai) and ($waktuselesai>$selesai))){
                        //nothing
                    }
                    else{
                        $available = false;
                    }
                }
            }
            mysqli_free_result($results);
        }


        if($available){
            $results = mysqli_query($conn, "SELECT * FROM perbaikan WHERE id_alat = '$kodealat'");
            if(mysqli_num_rows($results)>0){
                foreach($results as $result){
                    $mulai = intval(substr($result['tanggal_mulai_perbaikan'],0,4))*365+intval(substr($result['tanggal_mulai_perbaikan'],5,2))*30+intval(substr($result['tanggal_mulai_perbaikan'],8,2));
                    $selesai = intval(substr($result['estimasi_selesai_perbaikan'],0,4))*365+intval(substr($result['estimasi_selesai_perbaikan'],5,2))*30+intval(substr($result['estimasi_selesai_perbaikan'],8,2));

                    if((($waktumulai<$mulai) and ($waktuselesai<$mulai)) or (($waktumulai>$selesai) and ($waktuselesai>$selesai))){
                        //nothing
                    }
                    else{
                        $available = false;
                    }
                }
            }
            mysqli_free_result($results);
        }
		return $available;
	}

?>