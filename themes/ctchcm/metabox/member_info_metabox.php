<?php

class Admin_Member_Metabox {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'admin-info-metabox-';
        $title = '個人資料';
        $callback = array($this, 'display');
        add_meta_box($id, $title, $callback, array('member'));
    }

    public function display($post) {
        $action = 'admin-metabox-data';
        $name = 'admin-metabox-data-nonce';
        wp_nonce_field($action, $name);

        $display = get_post_meta($post->ID, '_member_display', TRUE);
        $order = get_post_meta($post->ID, '_member_order', TRUE);
        $industry = get_post_meta($post->ID, '_member_industry', TRUE);
        $contact = get_post_meta($post->ID, '_member_contact', TRUE);
        $conpany = get_post_meta($post->ID, '_member_company', TRUE);
        $address = get_post_meta($post->ID, '_member_address', TRUE);
        $cell = get_post_meta($post->ID, '_member_cell', TRUE);
        $phone = get_post_meta($post->ID, '_member_phone', TRUE);
        $fax = get_post_meta($post->ID, '_member_fax', TRUE);
        $email = get_post_meta($post->ID, '_member_email', TRUE);
        $web = get_post_meta($post->ID, '_member_web', TRUE);
        ?>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="txt_order">顯示在會員頁</label>
                    </th>
                    <td>
                        <input id="check_display"  name="check_display" type="checkbox"  <?php echo $display == 'on' ? 'checked' : '' ?> >
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="txt_order">秩序</label>
                    </th>
                    <td>
                        <input id="txt_order" class="regular-text" name="txt_order" value="<?php echo $order != '' ? $order : 100 ?>" type="text">
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="txt_industry">經營項目</label>
                    </th>
                    <td>
                        <input id="txt_industry" class="regular-text" name="txt_industry" value="<?php echo $industry ?>" type="text">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="txt_contact">聯絡人</label>
                    </th>
                    <td>
                        <input id="txt_contact" class="regular-text" name="txt_contact" value="<?php echo $contact ?>" type="text">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="txt_company">公司名稱</label>
                    </th>
                    <td>
                        <input id="txt_company" class="regular-text" required name="txt_company" value="<?php echo $conpany ?>" type="text">
                        <label id="error_company" style="color: red; font-weight: bold"></label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="txt_address">地址</label>
                    </th>
                    <td>
                        <input id="txt_address" class="regular-text" name="txt_address" value="<?php echo $address ?>" type="text">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="txt_cell">手機</label>
                    </th>
                    <td>
                        <input id="txt_cell" class="regular-text type_phone_more" name="txt_cell" value="<?php echo $cell ?>" type="text">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="txt_phone">聯絡電話</label>
                    </th>
                    <td>
                        <input id="txt_phone" class="regular-text type_phone_more" name="txt_phone" value="<?php echo $phone ?>" type="text">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="txt_fax">傳真</label>
                    </th>
                    <td>
                        <input id="txt_fax" class="regular-text type_phone_more" name="txt_fax" value="<?php echo $fax ?>" type="text">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="txt_email">E-mail</label>
                    </th>
                    <td>
                        <input id="txt_email" class="regular-text type_email" name="txt_email" value="<?php echo $email ?>" type="text">
                        <label id="error_email" style="color: red; font-weight: bold"></label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="txt_web">網站</label>
                    </th>
                    <td>
                        <input id="txt_web" class="regular-text type_web" name="txt_web" value="<?php echo $web ?>" type="text">
                        <label id="error_web" style="color: red; font-weight: bold"></label>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
    }

    public function save($post_id) {


        // kiem thanh phan an bao mat cua wp
        // NEU HAM NAY TRA VE GIA TRI  LA TRUE THUC HIEN TIEP CAC PHAN DUOI , CON TRA VE FLASE return VE $post_id
        if (!isset($_POST['admin-metabox-data-nonce']))
            return$post_id;
        // NEU HAM NAY TRA VE GIA TRI  LA TRUE THUC HIEN TIEP CAC PHAN DUOI , CON TRA VE FLASE return VE $post_id 
        if (wp_verify_nonce('admin-metabox-data-nonce', 'admin-metabox-data'))
            return $post_id;
        // HAM TU DONG LUU KHI DE QUA LAU NEU TRA VE FLASE return $post_id
        if (define('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        if (!current_user_can('edit_post', $post_id))
            return$post_id;
        // 4 BON PHAN TREN DUNG DE BAO MAT KHI LUU METABOX TRONG WP 
//        echo '<pre>';
//        print_r($_POST);
//        echo '</pre>';
//        die();
        if (@$_POST['post_type'] == 'member') {

            if (isset($_POST['check_display'])) {
                update_post_meta($post_id, '_member_display', $_POST['check_display']);
            }else{
                update_post_meta($post_id, '_member_display', 'off');
            }
            if (isset($_POST['txt_order'])) {
                update_post_meta($post_id, '_member_order', esc_attr($_POST['txt_order']));
            }
            if (isset($_POST['txt_industry'])) {
                update_post_meta($post_id, '_member_industry', esc_attr($_POST['txt_industry']));
            }
            if (isset($_POST['txt_contact'])) {
                update_post_meta($post_id, '_member_contact', esc_attr($_POST['txt_contact']));
            }
            if (isset($_POST['txt_company'])) {
                update_post_meta($post_id, '_member_company', esc_attr($_POST['txt_company']));
//                LAY ID CUA TAXONOMI DE PHUC VU CHO VIEC SORT BY TAXONOMI
                update_post_meta($post_id, '_member_taxonomy', esc_attr($_POST['tax_input']['member_category'][1]));
            }
            if (isset($_POST['txt_address'])) {
                update_post_meta($post_id, '_member_address', esc_attr($_POST['txt_address']));
            }
            if (isset($_POST['txt_cell'])) {
                update_post_meta($post_id, '_member_cell', esc_attr($_POST['txt_cell']));
            }
            if (isset($_POST['txt_phone'])) {
                update_post_meta($post_id, '_member_phone', esc_attr($_POST['txt_phone']));
            }
            if (isset($_POST['txt_fax'])) {
                update_post_meta($post_id, '_member_fax', esc_attr($_POST['txt_fax']));
            }
            if (isset($_POST['txt_email'])) {
                update_post_meta($post_id, '_member_email', esc_attr($_POST['txt_email']));
            }
            if (isset($_POST['txt_web'])) {
                update_post_meta($post_id, '_member_web', esc_attr($_POST['txt_web']));
            }

            // CAP NHAT TITLE POST
            global $wpdb;
            $where = array('ID' => $post_id);
            $wpdb->update($wpdb->posts, array('post_title' => $_POST['txt_company']), $where);
        }
    }

}

