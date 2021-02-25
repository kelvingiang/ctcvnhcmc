<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php' );
date_default_timezone_set('Asia/Ho_Chi_Minh');

$a_barcode = $_POST['id'];

if (!empty($a_barcode)) {
    global $wpdb;
    $table = $wpdb->prefix . 'guests';
    $table2 = $wpdb->prefix . 'guests_check_in';
    $sql = "SELECT * FROM $table WHERE barcode = $a_barcode";
    $row = $wpdb->get_row($sql, ARRAY_A);
    // add 11/10/2017 =======================================================================================  
    $sql2 = "SELECT time, date,  (SELECT COUNT(*) FROM $table2 WHERE guests_id =" . $row['ID'] . ") as count FROM $table2 WHERE guests_id =" . $row['ID'] . " ORDER BY time DESC LIMIT 1";
    $row2 = $wpdb->get_row($sql2, ARRAY_A);
    // end ================================================================================================      

    if (!empty($row) && $row['status'] == 1) {
        $data = array('check_in' => 1);
        $where = array('ID' => $row['ID']);
        $wpdb->update($table, $data, $where);

        $data2 = array(
            'guests_id' => $row['ID'],
            'time' => date('H:i:s'),
            'date' => date('m-d-Y'),
        );
        $wpdb->insert($table2, $data2);
        // $_SESSION['checkinID'] = $row['ID'];
        if (!empty($row['img'])) {
            $img = "<img id='guest-pic'  name='guest-pic' src= '" . get_guests_img($row['img']) . "'/>";
        } else {
            $img = "<img id= 'guest-pic' name = 'guest-pic' src ='" . get_img('ctcvnhcmc_logo.png') . "'/>";
            //        $img = "<img id= 'guest-pic' name = 'guest-pic' src ='" . get_img('merry-2.jpg') . "'/>";
        }

        $info = array(
            'FullName' => $row['full_name'],
            'MemberCode' => $row['stt'],
            'Position' => $row['position'],
            'Company' => $row['company'],
            'Email' => $row['email'],
            'Phone' => $row['phone'],
            'Note' => $row['note'],
            'Img' => $img,
            'TotalTimes' => $row2['count'],
            'LastCheckIn' => $row2['date'] . ' / ' . $row2['time']
        );

        $response = array('status' => 'done', 'message' => $row['ID'], 'info' => $info);
    } elseif ((!empty($row) && $row['status'] == 0)) {
        $response = array('status' => 'unactive', 'message' => 'tai khoan chua kich hoat');
    } else {
        // $_SESSION['checkinID'] = '0000';
        $response = array('status' => 'error', 'message' => 'ma code sai hoac khong ton tai');
    }
}else{
           $response = array('status' => 'error', 'message' => 'ma qrcode bi loi hay khong ton tai '); 
}
echo json_encode($response);






