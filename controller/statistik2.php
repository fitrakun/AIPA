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
        $sql = "select id_alat,nama_alat, tanggal_peminjaman as mulai, tanggal_rencana_pengembalian as selesai from peminjaman NATURAL JOIN alat WHERE (year(tanggal_peminjaman)*12+month(tanggal_peminjaman))<=$waktu and (year(tanggal_rencana_pengembalian)*12+month(tanggal_rencana_pengembalian))>=$waktu;";
    }
    else if($permintaan=="perbaikan-alat"){
        $sql = "select id_alat,nama_alat,  tanggal_mulai_perbaikan as mulai, estimasi_selesai_perbaikan as selesai from perbaikan NATURAL JOIN alat WHERE (year(tanggal_mulai_perbaikan)*12+month(tanggal_mulai_perbaikan))<=$waktu and (year(estimasi_selesai_perbaikan)*12+month(estimasi_selesai_perbaikan))>=$waktu;";
    }
    else if($permintaan=="penggunaan-alat-user"){
        $sql = "select id_alat,nama_alat,tanggal_peminjaman as mulai, tanggal_rencana_pengembalian as selesai from peminjaman NATURAL JOIN alat NATURAL JOIN user WHERE kategori_civitas = '$user' and(year(tanggal_peminjaman)*12+month(tanggal_peminjaman))<=$waktu and (year(tanggal_rencana_pengembalian)*12+month(tanggal_rencana_pengembalian))>=$waktu;";
    }

    $results = mysqli_query($conn,$sql);
    if(mysqli_num_rows($results)>0){

        while(($row =  $results->fetch_assoc())) {

        }

        $arr = array(
            "chart" => array(
                "type" => 'column'
            ),
            "title" => array(
                "text" => $permintaan." bulan ".$month." tahun ".$year
            ),
            "xAxis" => array(
                "type" =>"category"
            ),
            "yAxis"=> array(
                "min" =>0,
                "title" =>'Jumlah Occasion'
            ),
            "legend"=> array(
                "enabled" =>false
            ),
            "plotOptions" => array(
                "series" =>array(
                    "borderWidth" =>0,
                    "dataLabels" => array(
                        "enabled" =>true,
                        "format" =>'{point.y:.1f}%'
                    )
                )
            ),
            "tooltip"=> array(
                "headerFormat"=> "<span style='font-size:11px'>{series.name}</span><br>",
                "pointFormat" => "<span style='color:{point.color}'>{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>"
            ),
            "series"=> array(
                array(
                    "name" => 'penggunaan',
                    "colorByPoint" => true,
                    "data" => array(),
                    "drilldown" => array(
                        "serries" => array()
                    )
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



