<?php
function draw_graph($month,$year,$permintaan,$user){
    include "controller/config.php";
    $conn = connect_database();
    $waktu = $year*12+$month;
    if($permintaan =="penggunaan-alat"){
        $sql = "select nama_alat,count(*) from peminjaman NATURAL JOIN alat WHERE (year(tanggal_peminjaman)*12+month(tanggal_peminjaman))<=$waktu and (year(tanggal_rencana_pengembalian)*12+month(tanggal_rencana_pengembalian))>=$waktu GROUP BY nama_alat";
    }
    else if($permintaan=="perbaikan-alat"){
        $sql = "select nama_alat,count(*) from perbaikan NATURAL JOIN alat WHERE (year(tanggal_mulai_perbaikan)*12+month(tanggal_mulai_perbaikan))<=$waktu and (year(estimasi_selesai_perbaikan)*12+month(estimasi_selesai_perbaikan))>=$waktu GROUP BY nama_alat";
    }
    else if($permintaan=="penggunaan-alat-user"){
        $sql = "select nama_alat,count(*) from peminjaman NATURAL JOIN alat NATURAL JOIN user WHERE kategori_civitas = '$user' and(year(tanggal_peminjaman)*12+month(tanggal_peminjaman))<=$waktu and (year(tanggal_rencana_pengembalian)*12+month(tanggal_rencana_pengembalian))>=$waktu GROUP BY nama_alat;";
    }

    $results = mysqli_query($conn,$sql);
    if(mysqli_num_rows($results)>0){
        foreach($results as $result){

        }
    }
    mysqli_free_result($results);
}

?>