<?php

class Admin_Check_In_Setting_Controler {

    public function __construct() {
        add_action('admin_menu', array($this, 'CheckInReportAdminMenu'));
    }

    // PHAN TAO MENU CON TRONG MENU CHA CUNG LA POST TYPE
    public function CheckInReportAdminMenu() {
        $parent_slug = 'tw_checkin';
        $page_title = '報到設定';
        $menu_title = '報到設定';
        $capability = 'manage_categories';
        $menu_slug = 'checkinsetting';
        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'));
    }

    public function dispatchActive() {
//        echo __METHOD__;
        $action = getParams('action');
        switch ($action) {
            case 'report':
                $this->exportAction();
                break;
            case 'guests':
                $this->guestsAction();
                break;
            case 'qrcode':
                $this->createQRCodeAction();
                break;
            case 'modify':
                $this->modifyFileNameAction();
                break;
            case 'reset':
                $this->resetCheckInAction();
                break;
            default :
                $this->displayPage();
                break;
        }
    }

    public function displayPage() {
        require_once ( HCM_DIR_VIEW . 'check_in_setting_view.php');
    }

    public function exportAction() {
        require_once (HCM_DIR_MODEL . 'check_in_setting_model.php');
        $model = new Admin_Check_In_Setting_model();
        $model->ExportToExcel();
    }

    public function guestsAction() {
        require_once (HCM_DIR_MODEL . 'check_in_setting_model.php');
        $model = new Admin_Check_In_Setting_model();
        $model->ExportToGuests();
    }
    
    public function createQRCodeAction(){
        require_once (HCM_DIR_MODEL.'check_in_setting_model.php');
        $model = new Admin_Check_In_Setting_model();
        $model->BatchCreateQRCode();
        
        $paged = max(1, $arrParams['paged']);
        $url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=1';
        wp_redirect($url);
    }
    
    public function modifyFileNameAction(){
        require_once (HCM_DIR_MODEL . 'check_in_setting_model.php');
        $model = new Admin_Check_In_Setting_model();
        $model->ModifyQRCodeFileName();
        
        $paged = max(1, $arrParams['paged']);
        $url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=2';
        wp_redirect($url);
    }
    
    public function resetCheckInAction(){
        require_once(HCM_DIR_MODEL.'check_in_setting_model.php');
        $model = new Admin_Check_In_Setting_model();
        $model->ResetCheckIn();
        
        $paged = max(1, $arrParams['paged']);
        $url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=3';
        wp_redirect($url);
        
    }

}
