<?php

class Admin_Check_In_Report_model {

    public function __construct() {
        
    }


    public function ReportView() {
        global $wpdb;
        $table = $wpdb->prefix . 'guests';
        $sql = "SELECT * FROM $table WHERE check_in = 1 AND status = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }
    
      public function signUpTotal() {
        global $wpdb;
        $table = $wpdb->prefix . 'guests';
        $sql = "SELECT * FROM $table WHERE  status = 1";
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

    public function BarcodeInfo() {
        global $wpdb;
        $table = $wpdb->prefix . 'guests';
        $sql = "SELECT * FROM $table WHERE  status = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function ReportDetailView($guests_id) {
        global $wpdb;
        $table = $wpdb->prefix . 'guests_check_in';
        $sql = "SELECT * FROM $table WHERE guests_id = $guests_id";
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

    public function ExportToBarcode() {
        require_once HCM_DIR_CLASS . 'PHPExcel.php';
        $exExport = new PHPExcel();

        // TAO COT TITLE
        $exExport->setActiveSheetIndex(0)
                ->setCellValue('A1', '姓名')
                ->setCellValue('B1', '條嗎')
                ->setCellValue('C1', '編號');
        //   ->setCellValueExplicit('B1', '條嗎', PHPExcel_Cell_DataType::TYPE_STRING);
        // TAO NOI DUNG CHEN TU DONG 2
        $i = 2;
        $list = $this->BarcodeInfo();

        foreach ($list as $row) {
            $checkInDetail = $this->ReportDetailView($row['ID']);
            foreach ($checkInDetail as $item) {
                $checkInItem .= $item['time'] . '__' . $item['date'] . '  ';
            }

            $exExport->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $row['stt'] . '-' . $row['full_name'])
//                    ->setCellValue('B' . $i, $row['barcode']);
                    // DUA DU LIEU VE DANG TEXT DE GIU LAI SO 0 DAU DONG
                    ->setCellValueExplicit('B' . $i, $row['barcode'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('C' . $i, $row['stt'], PHPExcel_Cell_DataType::TYPE_STRING);
            $i++;
            $checkInItem = '';
        }

        // TAO FILE EXCEL VA SAVE LAI THEO PATH
        //$objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        //$full_path = EXPORT_DIR . date("YmdHis") . '_report.xlsx'; //duong dan file
        //$objWriter->save($full_path);
// TAO FILE EXCEL VA DOWN TRUC TIEP XUONG CLINET
        $filename = date("YmdHis") . '_barcode.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        ob_end_clean();
//        ob_start();
        $objWriter->save('php://output');
    }
    
    public function TitleAndWaiting($postArr){
       if(!empty($postArr)){
           update_option('_title_text', $postArr['txt_title']);
           update_option('_waiting_text', $postArr['txt_waiting']);
       }
    }
    

}


