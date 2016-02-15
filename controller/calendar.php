<?php

function getMonthString($m){
    if($m==1){
        return "Jan";
    }else if($m==2){
        return "Feb";
    }else if($m==3){
        return "Mar";
    }else if($m==4){
        return "Apr";
    }else if($m==5){
        return "May";
    }else if($m==6){
        return "Jun";
    }else if($m==7){
        return "Jul";
    }else if($m==8){
        return "Aug";
    }else if($m==9){
        return "Sep";
    }else if($m==10){
        return "Oct";
    }else if($m==11){
        return "Nov";
    }else if($m==12){
        return "Dec";
    }
}

function markdate(&$booked,$results,$num_days,$month,$pengecekkan){
    if($pengecekkan == 1) {
        foreach ($results as $result) { //cek peminjaman
            if($result['tanggal_rencana_pengembalian'] > $result['tanggal_peminjaman'] ){
                $tanggal_pinjam = intval(substr($result['tanggal_peminjaman'], 8, 2));
                $tanggal_kembali = intval(substr($result['tanggal_rencana_pengembalian'], 8, 2));

                $bulan_sekarang = intval($month);
                $bulan_pinjam = intval(substr($result['tanggal_peminjaman'], 5, 2));
                $bulan_kembali = intval(substr($result['tanggal_rencana_pengembalian'], 5, 2));

                if($bulan_pinjam< $bulan_sekarang){
                    $tanggal_pinjam = 1;
                }
                else if($bulan_kembali > $bulan_sekarang){
                    $tanggal_kembali = $num_days;
                }
                $alat = $result['id_alat'];

                for ($i = $tanggal_pinjam; $i <= $tanggal_kembali; $i++) {
                    $booked[$i - 1].= $alat.' : dipinjam <br>';
                }
            }
        }
    }
    else if($pengecekkan == 2){
        foreach ($results as $result) { //cek booking
            if ($result['tanggal_rencana_pengembalian'] > $result['tanggal_rencana_peminjaman']) {
                $tanggal_pinjam = intval(substr($result['tanggal_rencana_peminjaman'], 8, 2));
                $tanggal_kembali = intval(substr($result['tanggal_rencana_pengembalian'], 8, 2));

                $bulan_sekarang = intval($month);
                $bulan_pinjam = intval(substr($result['tanggal_rencana_peminjaman'], 5, 2));
                $bulan_kembali = intval(substr($result['tanggal_rencana_pengembalian'], 5, 2));

                if($bulan_pinjam< $bulan_sekarang){
                    $tanggal_pinjam = 0;
                }
                else if($bulan_kembali > $bulan_sekarang){
                    $tanggal_kembali = $num_days;
                }

                $alat = $result['id_alat'];

                for ($i = $tanggal_pinjam; $i <= $tanggal_kembali; $i++) {
                    $booked[$i - 1] .= $alat . ' : dibooking <br>';
                }
            }
        }
    }
    else if($pengecekkan == 3){
        foreach ($results as $result) { //cek perbaikan
            if ($result['tanggal_rencana_pengembalian'] > $result['tanggal_peminjaman']) {
                $tanggal_perbaikan = intval(substr($result['tanggal_mulai_perbaikan'], 8, 2));
                $tanggal_kembali = intval(substr($result['estimasi_selesai_perbaikan'], 8, 2));

                $bulan_sekarang = intval($month);
                $bulan_pinjam = intval(substr($result['tanggal_peminjaman'], 5, 2));
                $bulan_kembali = intval(substr($result['tanggal_rencana_pengembalian'], 5, 2));

                if($bulan_pinjam< $bulan_sekarang){
                    $tanggal_perbaikan = 0;
                }
                else if($bulan_kembali > $bulan_sekarang){
                    $tanggal_kembali = $num_days;
                }

                $alat = $result['id_alat'];

                for ($i = $tanggal_perbaikan; $i <= $tanggal_kembali; $i++) {
                    $booked[$i - 1] .= $alat . ' : diperbaiki <br>';
                }
            }
        }
    }
}

/* draws a calendar */
function draw_calendar($month,$year,$alat){

    /* draw table */
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

    /* table headings */
    $headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
    $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

    /* days and weeks vars now ... */
    $running_day = date('w',mktime(0,0,0,$month,1,$year));
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $days_in_this_week = 1;
    $day_counter = 0;

    $booked[] = $days_in_month;
    for($i = 0; $i<=$days_in_month; $i++){
        $booked[$i] = '';
    }

    $now = $month + $year *12;

    //PENGECEKKAN STATUS UNTUK KEPENTINGAN KALENDER
    include "controller/config.php";
    $conn = connect_database();
    //booking
    $result = mysqli_query($conn,"SELECT * FROM booking NATURAL JOIN alat where nama_alat = '$alat' and ((year(tanggal_rencana_peminjaman)*12 + month(tanggal_rencana_peminjaman)) <= '$now') and ((year(tanggal_rencana_pengembalian)*12 + month(tanggal_rencana_pengembalian)) >= '$now')");
    if(mysqli_num_rows($result)>0){
        markdate($booked,$result,$days_in_month,$month,2);
    }
    mysqli_free_result($result);

    //peminjaman
    $result = mysqli_query($conn,"SELECT * FROM peminjaman NATURAL JOIN alat where nama_alat = '$alat' and ((year(tanggal_peminjaman)*12 + month(tanggal_peminjaman)) <= '$now') and ((year(tanggal_rencana_pengembalian)*12 + month(tanggal_rencana_pengembalian)) >= '$now')");
    if(mysqli_num_rows($result)>0){
        markdate($booked,$result,$days_in_month,$month,1);
    }
    mysqli_free_result($result);

    //perbaikan
    $result = mysqli_query($conn,"SELECT * FROM perbaikan NATURAL JOIN alat where nama_alat = '$alat' and ((year(tanggal_mulai_perbaikan)*12 + month(tanggal_mulai_perbaikan)) <= '$now') and ((year(estimasi_selesai_perbaikan)*12 + month(estimasi_selesai_perbaikan)) >= '$now')");
    if(mysqli_num_rows($result)>0){
        markdate($booked,$result,$days_in_month,$month,3);
    }
    mysqli_free_result($result);

    //END OF PENGECEKKAN STATUS

    /* row for week one */
    $calendar.= '<tr class="calendar-row">';

    /* print "blank" days until the first of the current week */
    for($x = 0; $x < $running_day; $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):

        $calendar.= '<td class="calendar-day">';
        // add in the status
        $calendar .= '<div class="day-item">'.$booked[$list_day-1].' </div>';
        /* add in the day number */
        $calendar.= '<div class="day-number">'.$list_day.'</div>';


        /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
        $calendar.= str_repeat('<p> </p>',2);

        $calendar.= '</td>';
        if($running_day == 6):
            $calendar.= '</tr>';
            if(($day_counter+1) != $days_in_month):
                $calendar.= '<tr class="calendar-row">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++; $running_day++; $day_counter++;

    endfor;

    /* finish the rest of the days in the week */
    if($days_in_this_week < 8):
        for($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;

    /* final row */
    $calendar.= '</tr>';

    /* end the table */
    $calendar.= '</table>';

    /* all done, return result */
    return $calendar;
}

?>