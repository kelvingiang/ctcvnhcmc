<?php

// add them custom post member
require_once (HCM_DIR_CUSTOME . 'member.php');
new ADMIN_MEMBER_POST();

require_once (HCM_DIR_METABOX . 'member_info_metabox.php');
new Admin_Member_Metabox();

require_once (HCM_DIR_CUSTOME . 'hoitruong.php');
new ADMIN_HOITRUONG_POST();

require_once (HCM_DIR_CUSTOME . 'hoivien.php');
new ADMIN_HOIVIEN_POST();

require_once (HCM_DIR_METABOX . 'supervisor_info_metabox.php');
new Admin_Supervisor_Metabox();

require_once (HCM_DIR_CONTROLER . 'thongtin_controler.php');
new ADMIN_THONGTIN_MENU();

require_once (HCM_DIR_CUSTOME . 'friendlink.php');
new ADMIN_FRIEND_LINK_POST();

require_once (HCM_DIR_METABOX . 'friend_link_metabox.php');
new Admin_Friend_Link_Metabox();

require_once (HCM_DIR_CUSTOME . 'silder.php');
new ADMIN_SIlDER_POST();

require_once ( HCM_DIR_CONTROLER . 'check_in_controler.php');
new Admin_Check_In_Controler();

require_once (HCM_DIR_CONTROLER.'check_in_report_controler.php');
new Admin_Check_In_Report_Controler();

/*=== ADD IN 08-05-2020============================================ */

require_once (HCM_DIR_CONTROLER.'vote_controler.php');
new Admin_Vote_Controler();

require_once (HCM_DIR_CONTROLER.'vote_setting_controler.php');
new Admin_Vote_Setting_Controler();

require_once (HCM_DIR_METABOX.'seo_metabox.php');

$login = wp_get_current_user();
if ($login->ID == 1) {
    require_once (HCM_DIR_CONTROLER .'check_in_setting_controler.php');
    new Admin_Check_In_Setting_Controler();
}
/*require_once (HCM_DIR_CONTROLER . 'my_role_controler.php');
new ADMIN_MY_ROLE_CONTROLER(); */