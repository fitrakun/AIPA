<?php
	if(isset($_POST['kirim'])) {
	   perbaikan();
	}

	function perbaikan() {
		include "config.php";
		$conn = connect_database();

		if(cekAlat($conn,$_POST['nama'])){
            
        }
        else{
            //tidak ada user dengan id tersebut
            echo "Maaf, user dengan ID sekian belum terdaftar. Mohon daftarkan diri Anda terlebih dahulu!";
        }
	}

    function cekAlat($conn, $nama) {
        $result = mysqli_query($conn, "SELECT * FROM alat NATURAL JOIN perbaikan WHERE tanggal_selesai_perbaikan IS NOT NULL AND nama_alat = ".$nama);
        if(mysqli_num_rows($result)>0){
            mysqli_free_result($result);
            return true;
        }
        else {
            mysqli_free_result($result);
            return false;
        }
    }

?>