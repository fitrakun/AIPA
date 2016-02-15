<?php 
    if(isset($_POST['Tambahkan'])) {
	   add();
	}
    function add(){
        include "config.php";
		$conn = connect_database();
        $sql = "INSERT INTO `alat` (`id_alat`, `nama_alat`, `status`, `lokasi`) VALUES ('$_POST[idalat]', '$_POST[namaalat]','$_POST[status]','$_POST[lokasi]');";
        if(mysqli_query($conn,$sql)) {
            echo "Data anda berhasil disimpan";
            echo '<a href="../peralatan.php"> Kembali ke halaman Peralatan</a>';
        }
        else {
            echo mysqli_error($conn);
            echo '<a href="../peralatan.php"> Kembali ke halaman Peralatan</a>';
        }
    }
?>