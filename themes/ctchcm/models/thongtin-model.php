<?php

class ADMIN_THONGTIN_MODEL {

    public function SaveItem($post) {
         $errors = array();

//         echo '<pre>';
//         print_r($post);
//         echo '</pre>';
//         
//         die();
//         
        if (!empty($_FILES['img_logo']['name'])) {
            $file_trim = ((explode('.', $_FILES['img_logo']['name'])));
//            $trim_name = strtolower($file_trim[0]);
            $trim_type = strtolower($file_trim[1]);

            $extensions = array("jpeg", "jpg", "png");
            if (in_array($trim_type, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($_FILES['img_logo']['size'] > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }
            if (empty($errors)) {
                move_uploaded_file($_FILES['img_logo']['tmp_name'], HCM_DIR_IMAGES.$_FILES['img_logo']['name']);
                update_option('website_logo', $_FILES['img_logo']['name']);
            }
        }

        update_option('website_name_cn', $_POST['txt_name_cn']);
        update_option('website_name_vn', $_POST['txt_name_vn']);
        update_option('website_address', $_POST['txt_address']);
        update_option('website_phone', $_POST['txt_phone']);
        update_option('website_fax', $_POST['txt_fax']);
        update_option('website_email', $_POST['txt_email']);
        update_option('website_list_title', $_POST['txt_list_title']);
        update_post_meta(1, '_web_about', $_POST['about']);
    }

}
