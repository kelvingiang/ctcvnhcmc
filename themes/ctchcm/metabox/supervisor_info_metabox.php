<?php

class Admin_Supervisor_Metabox {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'supervisor-info-metabox-';
        $title = '個人資料';
        $callback = array($this, 'display');
        add_meta_box($id, $title, $callback, array('hoivien', 'hoitruong'));
    }

    public function display($post) {
        $action = 'admin-metabox-data';
        $name = 'admin-metabox-data-nonce';
        wp_nonce_field($action, $name);

        $order = get_post_meta($post->ID, '_supervisor_order', TRUE);
        $term = get_post_meta($post->ID, '_supervisor_term', TRUE);
        $position = get_post_meta($post->ID, '_supervisor_position', TRUE);
        $fullname = get_post_meta($post->ID, '_supervisor_full_name', TRUE);
        $conpany = get_post_meta($post->ID, '_supervisor_company', TRUE);
        $address = get_post_meta($post->ID, '_supervisor_address', TRUE);
        $cell = get_post_meta($post->ID, '_supervisor_cell', TRUE);
        $phone = get_post_meta($post->ID, '_supervisor_phone', TRUE);
        $fax = get_post_meta($post->ID, '_supervisor_fax', TRUE);
        $email = get_post_meta($post->ID, '_supervisor_email', TRUE);
        //$web = get_post_meta($post->ID, '_supervisor_web', TRUE);
        ?>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="txt_order">秩序</label>
                    </th>
                    <td>
                        <input id="txt_order" class="regular-text" name="txt_order" value="<?php echo $order != '' ? $order : 100 ?>" type="text">
                    </td>
                </tr>
        <?php if (getParams('post_type') == 'hoitruong' || $post->post_type == "hoitruong") { ?>
                    <tr>
                        <th scope="row">
                            <label for="txt_term">屆次</label>
                        </th>
                        <td>
                            <input id="txt_term" class="regular-text" name="txt_term" value="<?php echo $term ?>" type="text">
                        </td>
                    </tr>
        <?php } ?>
                <tr>
                    <th scope="row">
                        <label for="txt_position">職稱</label>
                    </th>
                    <td>
                        <input id="txt_position" class="regular-text" name="txt_position" value="<?php echo $position ?>" type="text">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="txt_full_name">姓名</label>
                    </th>
                    <td>
                        <input id="txt_full_name" class="regular-text" name="txt_full_name" value="<?php echo $fullname ?>" type="text">
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

  $arrPost = array('hoitruong','hoivien');
        if (in_array(@$_POST['post_type'] , $arrPost)) {

            if (isset($_POST['txt_order'])) {
                update_post_meta($post_id, '_supervisor_order', esc_attr($_POST['txt_order']));
            }
            if (isset($_POST['txt_term'])) {
                update_post_meta($post_id, '_supervisor_term', esc_attr($_POST['txt_term']));
            }
            if (isset($_POST['txt_position'])) {
                update_post_meta($post_id, '_supervisor_position', esc_attr($_POST['txt_position']));
            }
            if (isset($_POST['txt_full_name'])) {
                update_post_meta($post_id, '_supervisor_full_name', esc_attr($_POST['txt_full_name']));
            }
            if (isset($_POST['txt_company'])) {
                update_post_meta($post_id, '_supervisor_company', esc_attr($_POST['txt_company']));
//                LAY ID CUA TAXONOMI DE PHUC VU CHO VIEC SORT BY TAXONOMI
               // update_post_meta($post_id, '_member_taxonomy', esc_attr($_POST['tax_input']['member_category'][1]));
            }
            if (isset($_POST['txt_address'])) {
                update_post_meta($post_id, '_supervisor_address', esc_attr($_POST['txt_address']));
            }
            if (isset($_POST['txt_cell'])) {
                update_post_meta($post_id, '_supervisor_cell', esc_attr($_POST['txt_cell']));
            }
            if (isset($_POST['txt_phone'])) {
                update_post_meta($post_id, '_supervisor_phone', esc_attr($_POST['txt_phone']));
            }
            if (isset($_POST['txt_fax'])) {
                update_post_meta($post_id, '_supervisor_fax', esc_attr($_POST['txt_fax']));
            }
            if (isset($_POST['txt_email'])) {
                update_post_meta($post_id, '_supervisor_email', esc_attr($_POST['txt_email']));
            }
            if (isset($_POST['txt_web'])) {
                update_post_meta($post_id, '_supervisor_web', esc_attr($_POST['txt_web']));
            }

            // CAP NHAT TITLE POST
            global $wpdb;
            $where = array('ID' => $post_id);
            $wpdb->update($wpdb->posts, array('post_title' => $_POST['txt_full_name']), $where);
        }
    }

}

