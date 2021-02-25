<?php

class ADMIN_THONGTIN_MENU {

    public function __construct() {
   add_action('admin_menu', array($this, 'InfoAdminMenu'));
    }
     // PHAN TAO MENU CON TRONG MENU CHA CUNG LA POST TYPE
    public function InfoAdminMenu() {
//        $parent_slug = 'ctcvnhcmc-setting';
        $page_title = __('商會信息');
        $menu_title = __('商會信息');
        $capability = 'manage_categories';
        $menu_slug = 'daithuong_setting';
        add_menu_page($page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'),'',12);
    }
  
    
    // SET THEO ACTION MA CHUYEN HUONG TRANG 
    public function dispatchActive() {
//        echo __METHOD__;
        $action = getParams('action');
        switch ($action) {
            case 'add':
            case 'edit':
                $this->saveAction();
                break;
            default :
                $this->displayPage();
                break;
        }
    }

    public function displayPage() {
        if (isPost()) {
            require_once (HCM_DIR_MODEL. 'thongtin-model.php');
            $model = new ADMIN_THONGTIN_MODEL();
            $model->SaveItem($_POST);
         
            // SAU KHI UPDATE XONG CHUYEN VE TRANG SHOW
           // $url = 'admin.php?page=digiwin-staff&msg=1';
           // wp_redirect($url);
        }
        require_once (HCM_DIR_VIEW . 'thongtin-view.php');

    }


}