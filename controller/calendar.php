<?php
function markdate(&$booked,$results,$peminjaman){
    if($peminjaman == true) {
        foreach ($results as $result) {
            $tanggal_pinjam = intval(substr($result['tanggal_peminjaman'], 8, 2));
            $tanggal_kembali = intval(substr($result['tanggal_rencana_pengembalian'], 8, 2));

            for ($i = $tanggal_pinjam; $i <= $tanggal_kembali; $i++) {
                $booked[$i - 1] = true;
            }
        }
    }
    else{
        foreach ($results as $result) {
            $tanggal_pinjam = intval(substr($result['tanggal_rencana_peminjaman'], 8, 2));
            $tanggal_kembali = intval(substr($result['tanggal_rencana_pengembalian'], 8, 2));

            for ($i = $tanggal_pinjam; $i <= $tanggal_kembali; $i++) {
                $booked[$i - 1] = true;
            }
        }
    }
}

/* draws a calendar */
function draw_calendar($month,$year){

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
        $booked[$i] = false;
    }
    include "controller/config.php";
    $conn = connect_database();
    $result = mysqli_query($conn,"SELECT * FROM booking where id_alat = 'MIC001' and tanggal_rencana_peminjaman like '$year-$month%'");
    if(mysqli_num_rows($result)>0){
        markdate($booked,$result,false);
    }
    mysqli_free_result($result);

    $result = mysqli_query($conn,"SELECT * FROM peminjaman where id_alat = 'MIC001' and tanggal_peminjaman like '$year-$month%'");
    if(mysqli_num_rows($result)>0){
        markdate($booked,$result,true);
    }
    mysqli_free_result($result);

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
        /* add in the day number */
        if($booked[$list_day-1]==true) {
            $calendar .= '<div class="day-item"> not available </div>';
        }
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