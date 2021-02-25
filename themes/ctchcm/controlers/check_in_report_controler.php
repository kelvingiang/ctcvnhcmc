<?php

class Admin_Check_In_Report_Controler {

    public function __construct() {
        add_action('admin_menu', array($this, 'CheckInReportAdminMenu'));
    }

    // PHAN TAO MENU CON TRONG MENU CHA CUNG LA POST TYPE
    public function CheckInReportAdminMenu() {
        $parent_slug = 'tw_checkin';
        $page_title = '報到報表';
        $menu_title = '報到報表';
        $capability = 'manage_categories';
        $menu_slug = 'checkinreport';
        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'));
    }

    public function dispatchActive() {
//        echo __METHOD__;
        $action = getParams('action');
        switch ($action) {
            case 'export':
                $this->exportAction();
                break;
            case 'barcode':
                $this->barcodrAction();
                break;
            case 'waiting':
                $this->WaitingAction();
                break;
            default :
                $this->displayPage();
                break;
        }
    }

    public function displayPage() {
        require_once ( HCM_DIR_VIEW . 'check_in_report_view.php');
    }

    public function exportAction() {
        require_once (HCM_DIR_MODEL . 'check_in_report_model.php');
        $model = new Admin_Check_In_Report_model();
        $model->ExportToExcel();
    }

    public function barcodrAction() {
        require_once (HCM_DIR_MODEL . 'check_in_report_model.php');
        $model = new Admin_Check_In_Report_model();
        $model->ExportToBarcode();
    }
    
    public function WaitingAction(){
        if(isPost()){
            require_once (HCM_DIR_MODEL . 'check_in_report_model.php');
            $model = new Admin_Check_In_Report_model();
            $model->TitleAndWaiting($_POST);
                 
           $paged = max(1, $arrParams['paged']);
           $url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=2';
           wp_redirect($url);
        }else{
            require_once (HCM_DIR_VIEW.'check_in_waiting_view.php');
        }
    }

}
