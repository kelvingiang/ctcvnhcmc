<?php

//==== FUNCTIONS  IS FOR VOTE ============================================
function VoteTotalLishi() {
    $tt = get_option('_vote_total_lishi') + 1;
    update_option('_vote_total_lishi', $tt);
    // return get_option('_vote_total_lishi');
}

function VoteTotalLishifail() {
    $tt = get_option('_vote_total_lishi_fail') + 1;
    update_option('_vote_total_lishi_fail', $tt);
    // return get_option('_vote_total_lishi');
}

function VoteTotalJianshi() {
    $tt = get_option('_vote_total_jianshi') + 1;
    update_option('_vote_total_jianshi', $tt);
    // return get_option('_vote_total_jianshi');
}

function VoteTotalJianshifail() {
    $tt = get_option('_vote_total_jianshi_fail') + 1;
    update_option('_vote_total_jianshi_fail', $tt);
    // return get_option('_vote_total_lishi');
}

function voteTotal($kid) {
    global $wpdb;
    $table = $wpdb->prefix . 'vote';
    $sql = "SELECT  sum(vote_total) as 'total' FROM $table WHERE `kid` = $kid";
    $row = $wpdb->get_row($sql, ARRAY_A);
    return $row;
}

function getVoteResult($kid) {
    global $wpdb;
    $table = $wpdb->prefix . 'vote';
    $sql = "SELECT * FROM $table WHERE `kid` = $kid AND `status` = 1 ORDER BY `number` ASC";
    $row = $wpdb->get_results($sql, ARRAY_A);
    return $row;
}

function getVoteFinalResult() {
    global $wpdb;
    $table = $wpdb->prefix . 'vote';
    $sql = "SELECT * FROM $table WHERE `position` != '0' AND `status` = 1 ORDER BY `position`, `is_order` ASC";
    $row = $wpdb->get_results($sql, ARRAY_A);
    return $row;
}

function getVoteOrder($kid) {
    global $wpdb;
    $table = $wpdb->prefix . 'vote';
    $sql = "SELECT * FROM $table WHERE `kid` = $kid AND `status` = 1 ORDER BY `vote_total` DESC";
    $row = $wpdb->get_results($sql, ARRAY_A);
    return $row;
}

function getVoteListByKid($kid) {
    global $wpdb;
    $table = $wpdb->prefix . 'vote';
    $sql = "SELECT * FROM $table WHERE `kid` = $kid AND `status` = 1";
    $row = $wpdb->get_results($sql, ARRAY_A);
    return $row;
}

function updateVoteCount($id) {
    global $wpdb;
    //PLUS VOTE COUNT
    $table = $wpdb->prefix . 'vote';
    $updateSql = "UPDATE $table SET vote_total=vote_total + 1 WHERE ID=$id";
    $wpdb->query($updateSql);
}

function userVoteSuccess() {
    global $wpdb;
    // SET USER VOTED
    $table = $wpdb->prefix . 'guests';
    $updateSql = "UPDATE $table SET check_in = 1 WHERE ID = " . $_SESSION['voteLogin']['ID'];
    $wpdb->query($updateSql);

    unset($_SESSION['voteLogin']);
}

function kid_name($id) {
    //$arr = array('1' => '理事', '2' => '監事');
    if ($id == 1) {
        $val = "理事";
    } elseif ($id == 2) {
        $val = '監事';
    }
    return $val;
}

function voteLogin($user, $pass) {
    global $wpdb;
    $table = $wpdb->prefix . 'guests';
    $sql = "SELECT ID, full_name, barcode, stt FROM $table WHERE `stt` = $user AND `barcode` = $pass AND `status` = 1 AND `check_in` = 0";
    $row = $wpdb->get_row($sql, ARRAY_A);
    if (!empty($row)) {
        $_SESSION['voteLogin'] = $row;
        wp_redirect(home_url('vote'));
    } else {
        return "登入失敗-請檢查帳號或密碼";
    }
}

// TRIM STRING BY <!--more-->
function getstrimContentByMore($id) {
    $content = get_post_meta($id, "_dp_content_" . $_SESSION['language'], true);
    $contents = explode('<!--more-->', $content);
    return $contents[0];
}

// KIEM DU LIEU CHUYEN QUA BANG PHUONG POST HAY GET
function isPost() {
    $flag = ($_SERVER['REQUEST_METHOD'] == 'POST') ? TRUE : FALSE;
    return $flag;
}

// GET  A THAM SO TREN THANH URL
function getParams($name = null) {
    if ($name == null || empty($name)) {
        return $_REQUEST; // TRA VE GIA TRI REQUEST
    } else {
// TRUONG HOP name DC CHUYEN VAO 
// KIEM TRA name CO TON TAI TRA VE name NGUOI ''
        $val = (isset($_REQUEST[$name])) ? $_REQUEST[$name] : ' ';
        return $val;
    }
}

function get_img($name = '') {
    return get_template_directory_uri() . '/images/' . $name;
}

function get_icon($name = '') {
    return get_template_directory_uri() . '/images/icon/' . $name;
}

function get_guests_img($img = '') {
    return get_template_directory_uri() . '/images/guests/' . $img;
}

function get_vote_img($img = '') {
    return get_template_directory_uri() . '/images/vote/' . $img;
}

function get_barcode_img($barcode = '') {
    return get_template_directory_uri() . '/images/qrcode/' . $barcode . '.png';
}

function seo() {
    if (is_home() == true) {
        echo '<title>' . get_option("website_name_cn") . '</title>';
        echo '<meta name="description" content="' . get_option("website_name_cn") . ' 地址： ' . get_option("website_address") . ' 電話 :' . get_option("website_phone") . '傳真 :' . get_option("website_fax") . '電子郵件 :' . get_option("website_email") . '" />';
        echo '<meta name="keywords" content= "台灣商會|胡志明市分會|越南台灣商會|越南胡志明市台灣商會" />';
    } else if (is_single() || is_page()) {
        global $post;
        $strSeoTitle = get_post_meta($post->ID, 'seo_title', true);
        $strSeoDescription = get_post_meta($post->ID, 'seo_description', true);
        $strSeoKeywords = get_post_meta($post->ID, 'seo_keywords', true);

        if (empty($strSeoTitle) != false) {
            $strTitle = get_option("website_name_cn");
        } else {
            $strTitle = ' 越南胡志明市台灣商會 - ' . $strSeoTitle;
        }

        echo '<title>' . $strTitle . '</title>';
        echo '<meta name="description" content="' . $strSeoDescription . '" />';
        echo '<meta name="keywords" content="' . $strSeoKeywords . '" />';
    } else if (is_tax() || is_tag() || is_category()) {

        global $taxonomy, $term;

        $term = get_term_by('slug', $term, $taxonomy);
        $term_id = $term->term_id;
        $term_meta = get_option("taxonomy_$term_id");

        $strSeoTitle = $term_meta['txtTitleSeo'];
        $strSeoDescription = $term_meta['strDescriptionSeo'];
        $strSeoKeywords = $term_meta['seo_keywords'];

        if (empty($strSeoTitle) != false) {
            $strTitle = $suite['txtTitleSeo'];
        } else {
            $strTitle = $suite['txtTitleSeo'] . ' - ' . $strSeoTitle;
        }

        echo '<title>' . $strTitle . '</title>';
        echo '<meta name="description" content="' . $strSeoDescription . '" />';
        echo '<meta name="keywords" content="' . $strSeoKeywords . '" />';
    }
    echo '<meta name="robots" content="INDEX,FOLLOW" />';
    echo '<meta http-equiv="REFRESH" content="1800" />';
}

// START  NGON NGU
global $language;
$language = getLanguage();

class Common {

    public static $_langDefault = 'zh_TW';
    public static $_langSite = 'language';

}

function getLanguage() {

    $type = Common::$_langDefault;
    if (isset($_SESSION[Common::$_langSite])) {
        $type = $_SESSION[Common::$_langSite];
    }
    list($language, $country) = explode('_', $type);
    return $language;
}

//if (!is_admin()) {

//function change_translate_text($translated) {
//    global $language;
//    $file = dirname(dirname(dirname(dirname(__FILE__)))) . "/languages/{$language}/data.php";
//    include_once $file;
//
//    $data = getTranslate();
//    if (isset($data[$translated])) {
//        return $data[$translated];
//    }
//    return $translated;
//}

//add_filter('gettext', 'change_translate_text', 20);
//}
// AND NGON NGU

if (basename($_SERVER["REQUEST_URI"]) == 'checkout' || basename($_SERVER["REQUEST_URI"]) == 'contact') {
    require HCM_DIR_CLASS . 'captcha/CaptchaCls.php';

    $objCaptcha = new CaptchaCls(5, true);
}