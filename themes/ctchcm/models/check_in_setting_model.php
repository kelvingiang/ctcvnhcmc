<?php

class Admin_Check_In_Setting_model {

    public function __construct() {
        
    }

    public function ReportView() {
        global $wpdb;
        $table = $wpdb->prefix . 'guests';
        $sql = "SELECT * FROM $table WHERE check_in = 1 AND status = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }
    
    // KET HOP 2 TABLE DE LAY DU LIEU
    public function ReportjoinView(){
         global $wpdb;
        $table_guests = $wpdb->prefix . 'guests';
        $table_check = $wpdb->prefix . 'guests_check_in';
        $sql = "SELECT * FROM $table_guests  LEFT JOIN  $table_check ON $table_guests.ID  = $table_check.guests_id 
                  WHERE $table_guests.check_in = 1 AND $table_guests.status = 1
                      GROUP BY $table_check.guests_id
                  ORDER BY $table_check.time DESC
                 ";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function GuestsInfo() {
        global $wpdb;
        $table = $wpdb->prefix . 'guests';
        $sql = "SELECT * FROM $table WHERE  status = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function ReportDetailView($guests_id) {
        global $wpdb;
        $table = $wpdb->prefix . 'guests_check_in';
        // LAY GIA TRI CU NHAT TRONG GROUP BY
        $sql = "SELECT * FROM $table WHERE guests_id = $guests_id AND ID IN(SELECT MAX(ID) FROM $table  GROUP BY guests_id)";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function ExportToExcel() {
        require_once HCM_DIR_CLASS . 'PHPExcel.php';
        $exExport = new PHPExcel();

        // TAO COT TITLE
        $exExport->setActiveSheetIndex(0);
        $sheet = $exExport->getActiveSheet()->setTitle("check in");
          $sheet->setCellValue('A1', '編號');
          $sheet->setCellValue('B1', '姓名');
          $sheet->setCellValue('C1', '職稱');
          $sheet->setCellValue('D1', '公司名稱');
          $sheet->setCellValue('E1', '聯絡電話');
          $sheet->setCellValue('F1', '報到時間');
        
        // set kich thuoc cot  
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(12);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        
             // set chieu cao cua dong
        $sheet->getRowDimension('1')->setRowHeight(30);
        // set to dam chu
        $sheet->getStyle('A')->getFont()->setBold(TRUE);
        $sheet->getStyle('A1:F1')->getFont()->setBold(TRUE);
        // set nen backgroup cho dong
        $sheet->getStyle('A1:F1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('0008bdf8');
        // set chu canh giua
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:F1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


        // TAO NOI DUNG CHEN TU DONG 2
        $i = 2;
        $list = $this->ReportView();

        foreach ($list as $row) {
            $checkInDetail = $this->ReportDetailView($row['ID']);
            
            foreach ($checkInDetail as $item) {
                $checkInItem = $item['time'] . '__' . $item['date'] . '  ';
            }

            $exExport->setActiveSheetIndex(0)
                    ->setCellValueExplicit('A' . $i, $row['stt'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $row['full_name'])
                    ->setCellValue('C' . $i, $row['position'])
                    ->setCellValue('D' . $i, $row['company'])
                    ->setCellValueExplicit('E' . $i, $row['phone'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('F' . $i, $checkInItem);
            $i++;
                    // phan set border 
            $styleArray = array('borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            //cho tat ca 
              $sheet->getStyle('A1:'.'F'.($i-1))->applyFromArray($styleArray); 
            $checkInItem = '';
        }

        // TAO FILE EXCEL VA SAVE LAI THEO PATH
        //$objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        //$full_path = EXPORT_DIR . date("YmdHis") . '_report.xlsx'; //duong dan file
        //$objWriter->save($full_path);
// TAO FILE EXCEL VA DOWN TRUC TIEP XUONG CLINET
        $filename = 'hcmc_checkin_'.date("ymdHis") . '.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        ob_end_clean();
//        ob_start();
        $objWriter->save('php://output');
    }

    public function ExportToGuests() {
        require_once HCM_DIR_CLASS . 'PHPExcel.php';
        $exExport = new PHPExcel();

        // TAO COT TITLE
        $exExport->setActiveSheetIndex(0);
        $sheet = $exExport->getActiveSheet()->setTitle("開會-會員");
        $sheet->setCellValue('A1', '會員編號');
        $sheet->setCellValue('B1', '條碼');
        $sheet->setCellValue('C1', '公司');
        $sheet->setCellValue('D1', '姓名');
        $sheet->setCellValue('E1', '職稱');
        $sheet->setCellValue('F1', 'E-mail');
        $sheet->setCellValue('G1', '電話');
        $sheet->setCellValue('H1', '備註');
        //   ->setCellValueExplicit('B1', '條嗎', PHPExcel_Cell_DataType::TYPE_STRING);
        //     // set kich thuoc cot  
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(14);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        
             // set chieu cao cua dong
        $sheet->getRowDimension('1')->setRowHeight(30);
        // set to dam chu
        $sheet->getStyle('A')->getFont()->setBold(TRUE);
        $sheet->getStyle('A1:H1')->getFont()->setBold(TRUE);
        // set nen backgroup cho dong
        $sheet->getStyle('A1:H1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('0008bdf8');
        // set chu canh giua
        $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:H1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        // TAO NOI DUNG CHEN TU DONG 2
        $i = 2;
        $list = $this->GuestsInfo();
        foreach ($list as $row) {
            $exExport->setActiveSheetIndex(0)
                     ->setCellValueExplicit('A' . $i, $row['stt'], PHPExcel_Cell_DataType::TYPE_STRING)
                    // DUA DU LIEU VE DANG TEXT DE GIU LAI SO 0 DAU DONG
                    ->setCellValueExplicit('B' . $i, $row['barcode'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('C' . $i, $row['company'])
                    ->setCellValue('D'.$i, $row['full_name'])
                    ->setCellValue('E'.$i, $row['position'])
                    ->setCellValue('F'.$i, $row['email'])
                    ->setCellValueExplicit('G'.$i, $row['phone'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('H'.$i, $row['note']);
            $i++;
             // phan set border 
            $styleArray = array('borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            //cho tat ca 
              $sheet->getStyle('A1:'.'F'.($i-1))->applyFromArray($styleArray); 
            $checkInItem = '';
        }

        // TAO FILE EXCEL VA SAVE LAI THEO PATH
        //$objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        //$full_path = EXPORT_DIR . date("YmdHis") . '_report.xlsx'; //duong dan file
        //$objWriter->save($full_path);
// TAO FILE EXCEL VA DOWN TRUC TIEP XUONG CLINET
        $filename = date("YmdHis") . '_guests.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        ob_end_clean();
//        ob_start();
        $objWriter->save('php://output');
    }
    
    public function BatchCreateQRCode(){
        global $wpdb;
        $table = $wpdb->prefix . 'guests';
        $sql = "SELECT full_name, barcode FROM $table";
        $row = $wpdb->get_results($sql, ARRAY_A);

        // XOA HET CAC FILE QRCODE .png CO TRONG FOLDER
        $files = glob(HCM_DIR_IMAGES .'qrcode/'.'*.png'); //get all file names
        foreach($files as $file){
              if(is_file($file))
                   unlink($file); //delete file
        }
   
        // TAO TAT CA CAC FILE QRCODE MOI
        require_once ( HCM_DIR_CLASS . 'qrcode/qrlib.php');
        foreach ($row as $item) {
            $filePath = HCM_DIR_IMAGES .'qrcode/'. $item['barcode'] . '.png';
            $errorCorrectionLevel = "L";
            $matrixPointSize = 3;
            QRcode::png($item['barcode'], $filePath, $errorCorrectionLevel, $matrixPointSize, 2);

            // DOI TEN FILE THEO KIEU CHU HOA
            // $newName = iconv('UTF-8', 'BIG5', WB_DIR_IMAGES_BARCODE . $item['full_name'] . '-' . $item['barcode'] . '.png');
            // $oldName = iconv('UTF-8', 'BIG5', $filePath);
            // rename($oldName, $newName);
        }
    }

    public function ModifyQRCodeFileName(){
        global $wpdb;
   // xoa cac file cu
        $files = glob(rtrim(HCM_DIR_IMAGES_QRCODE_SERIAL .'*.png')); //get all file names
        foreach ($files as $file) {
                unlink($file); //delete file
        }
   //  copy tat ca file trong thu muc barcode den thu muc name_barcode  
       $copyfiles = glob(trim(HCM_DIR_IMAGES_QRCODE . '*.png')); //get all file names
       foreach ($copyfiles as $item) {
            if (is_file($item)) {
                $ff = explode(DS, $item);
                $lastItem = end($ff); // lay phan tu cuoi cung trong array
                $newfile = HCM_DIR_IMAGES_QRCODE_SERIAL. $lastItem;
                copy($item, $newfile); // chuyen sang folden moi;
            }
        }
 // doi ten them ten thanh vien vao ten file
        $table = $wpdb->prefix . 'guests';
        $sql = "SELECT stt, barcode, full_name FROM $table";
        $rows = $wpdb->get_results($sql, ARRAY_A);
     
        foreach ($rows as $row) {
            // DOI TEN FILE THEO KIEU CHU HOA
            $oldName = HCM_DIR_IMAGES_QRCODE_SERIAL. $row['barcode'] . '.png';
            $newName = iconv('UTF-8', 'BIG5', HCM_DIR_IMAGES_QRCODE_SERIAL. $row['stt'] . '-'.$row['full_name']. '-' . $row['barcode'] . '.png');
            rename($oldName, $newName);
    }
}

    public function ResetCheckIn(){
        global $wpdb;
        $table = $wpdb->prefix . 'guests';
       // $table1 = $wpdb->prefix . 'member';
        $table2 = $wpdb->prefix . 'guests_check_in';
        //RESET ALL CHECK 
        $updateSql = "UPDATE $table SET check_in=0 WHERE 1=1";
        $wpdb->query($updateSql);

//        $updateSql1 = "UPDATE $table1 SET check_in=0 WHERE 1=1";
//        $wpdb->query($updateSql1);
        // XOA GUESTS CHECK IN
        $deleteSql = "DELETE FROM $table2";
        $wpdb->query($deleteSql);
        // TRA ID LAI MUT BAT DAU BAT DAU BANG 1
        $sql = "ALTER TABLE $table2 AUTO_INCREMENT = 1";
        $wpdb->query($sql);
    }
}

?>
