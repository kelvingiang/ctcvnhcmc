<?php

class Admin_Friend_Link_Metabox {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'admin-friend-link-metabox-';
        $title = '網站';
        $callback = array($this, 'display');
        add_meta_box($id, $title, $callback, array('friend-link'));
    }

    public function display($post) {
        $action = 'admin-metabox-data';
        $name = 'admin-metabox-data-nonce';
        wp_nonce_field($action, $name);

        $order = get_post_meta($post->ID, '_friendlink_order', TRUE);
        $fullname= get_post_meta($post->ID, '_friendlink_name', TRUE);
        $web = get_post_meta($post->ID, '_friendlink_web', TRUE);
    
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
                <tr>
                    <th scope="row">
                        <label for="txt_name">名稱</label>
                    </th>
                    <td>
                        <input id="txt_name" class="regular-text" required name="txt_name" value="<?php echo $fullname ?>" type="text">
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

        $arrPost = array('friend-link');
        if (in_array(@$_POST['post_type'], $arrPost)) {

            if (isset($_POST['txt_order'])) {
                update_post_meta($post_id, '_friendlink_order', esc_attr($_POST['txt_order']));
            }
            if (isset($_POST['txt_name'])) {
                update_post_meta($post_id, '_friendlink_name', esc_attr($_POST['txt_name']));
            }
            if (isset($_POST['txt_web'])) {
                update_post_meta($post_id, '_friendlink_web', esc_attr($_POST['txt_web']));
            }

            // CAP NHAT TITLE POST
            global $wpdb;
            $where = array('ID' => $post_id);
            $wpdb->update($wpdb->posts, array('post_title' => $_POST['txt_name']), $where);
        }
    }

}
