<?php 
    if(isset($_POST['Tambahkan'])) {
	   add();
	}
    function add(){
        include "config.php";
		$conn = connect_database();
        $sql = "INSERT INTO `user` (`id_user`, `nama_user`, `kategori_civitas`) VALUES ('$_POST[iduser]', '$_POST[namauser]','$_POST[kategori]');";
        if(mysqli_query($conn,$sql)) {
            echo "Data anda berhasil disimpan";
            echo '<a href="../pengguna.php"> Kembali ke halaman Pengguna</a>';
        }
        else {
            echo mysqli_error($conn);
            echo '<a href="../pengguna.php"> Kembali ke halaman Pengguna</a>';
        }
    }
    function queryNamaAlat($conn) {
        $sql = "SELECT DISTINCT `nama_user` FROM `user`";
        $results = mysqli_query($conn, $sql);
        return $results;
    }
?>