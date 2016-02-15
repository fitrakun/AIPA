<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<script type="text/javascript">
    var drawGraph = function(stat){
        $('#graph').highcharts(stat);
    }
</script>



<?php
function draw_graph($month,$year,$permintaan,$user){
    include "controller/config.php";
    $conn = connect_database();
    $waktu = $year*12+$month;
    if($permintaan =="penggunaan-alat"){
        $sql = "select nama_alat,count(*) as count from peminjaman NATURAL JOIN alat WHERE (year(tanggal_peminjaman)*12+month(tanggal_peminjaman))<=$waktu and (year(tanggal_rencana_pengembalian)*12+month(tanggal_rencana_pengembalian))>=$waktu GROUP BY nama_alat";
    }
    else if($permintaan=="perbaikan-alat"){
        $sql = "select nama_alat,count(*) as count from perbaikan NATURAL JOIN alat WHERE (year(tanggal_mulai_perbaikan)*12+month(tanggal_mulai_perbaikan))<=$waktu and (year(estimasi_selesai_perbaikan)*12+month(estimasi_selesai_perbaikan))>=$waktu GROUP BY nama_alat";
    }
    else if($permintaan=="penggunaan-alat-user"){
        $sql = "select nama_alat,count(*) as count from peminjaman NATURAL JOIN alat NATURAL JOIN user WHERE kategori_civitas = '$user' and(year(tanggal_peminjaman)*12+month(tanggal_peminjaman))<=$waktu and (year(tanggal_rencana_pengembalian)*12+month(tanggal_rencana_pengembalian))>=$waktu GROUP BY nama_alat;";
    }

    $results = mysqli_query($conn,$sql);
    if(mysqli_num_rows($results)>0){
        $categories = array();
        $jumlah = array();
        while(($row =  $results->fetch_assoc())) {
            $categories[] = $row['nama_alat'];
            $jumlah[] = intval($row['count']);
        }

        $arr = array(
            "chart" => array(
                "type" => 'column'
            ),
            "title" => array(
                "text" => $permintaan." bulan ".$month." tahun ".$year
            ),
            "xAxis" => array(
                "categories" => $categories,
                "crosshair" =>true
            ),
            "yAxis"=> array(
                "min" =>0,
                "title" =>'Jumlah Occasion'
            ),
            "plotOptions" => array(
                "column" =>array(
                    "pointPadding" =>0.2,
                    "borderWidth" =>0
                )
            ),
            "series"=> array(
                array(
                    "name" => 'penggunaan',
                    "data" => $jumlah
                )
            )
        );
        $stat=json_encode($arr);
        echo "<div id='graph' style='min-width: 310px; height: 400px; margin: 0 auto'></div>";
        echo "<script type='text/javascript'>drawGraph($stat)</script>";
    }
    else if($permintaan=="perbaikan-alat"){
        echo "Tidak ada Perbaikan pada bulan ".$month." tahun ".$year;
    }
    else{
        echo "Tidak ada Peminjaman pada bulan ".$month." tahun ".$year;
    }

    mysqli_free_result($results);
}

?>



