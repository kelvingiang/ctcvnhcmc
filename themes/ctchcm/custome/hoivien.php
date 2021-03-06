<?php

class ADMIN_HOIVIEN_POST {

    public function __construct() {
        add_action('init', array($this, 'Register_Custom_Hoivien_Post'));
        add_action('manage_edit-hoivien_columns', array($this, 'Hoivien_Manage_cols'));
        add_action('manage_hoivien_posts_custom_column', array($this, 'Hoivien_render_cols'));
    }

    public function Register_Custom_Hoivien_Post() {
        $labels = array(
            'name' => _x('理監事', 'suite'),
            'singular_name' => _x('理監事', 'suite'),
            'add_new' => _x('新增理監事', 'suite'),
            'add_new_item' => _x('新增理監事', 'suite'),
            'edit_item' => _x('修改資料', 'suite'),
            'new_item' => _x('New Forum', 'suite'),
            'all_items' => _x('所有理監事', 'suite'),
            'view_item' => _x('View Post', 'suite'),
            'search_items' => _x('查詢', 'suite'),
            'not_found' => _x('No slides found.', 'suite'),
            'not_found_in_trash' => _x('No Forum found in Trash.', 'suite'),
            'parent_item_colon' => '',
            'name_admin_bar' => _x('理監事', 'suite'),
            'menu_name' => _x('理監事', 'suite')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'hoivien',
                'cate' => true,
                'with_front' => false,
                'feed' => true,
                'pages' => true
            ),
            'menu_icon' => HCM_URI_ICON . 'staff-icon.png',
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 7,
            'supports' => array(''),
        );
        register_post_type('hoivien', $args);
        flush_rewrite_rules(FALSE); // chuyen den trang single cua custom post
    }
    
        // QUAN LY CAC COLUMUNS
    public function Hoivien_Manage_cols($columns) {

        // $title_label = _x('member Name', 'suite');
        $date_label = _x('Create Date', 'suite');

        unset($columns['title']); // cho an cot title mac dinh;
        unset($columns['date']); // an cot ngay mac dinh
        // them cot vao bang 
//        $columns['super_img'] = _x('照片', 'suite');
        $columns['title'] = _x('姓名', 'suite');
        $columns['super_position'] = _x('商會職稱', 'suite');
        $columns['super_company'] = _x('公司名稱', 'suite');
        $columns['super_phone'] = _x('聯絡電話', 'suite');
        $columns['super_cell'] = _x('手機', 'suite');
        $columns['super_email'] = _x('Email', 'suite');
        return $columns;
    }

    public function Hoivien_render_cols($columns) {
        global $post;
        $ee = wp_get_post_terms($post->ID, 'member_category');
//        echo '<pre>';
//        print_r($ee);
//        echo '</pre>';
        switch ($columns) {
            /* If displaying the 'genre' column. */
          //  case 'super_img':
//                echo '<span>' . the_post_thumbnail(array(50, 50)) . '</span>';
            //    break;
            case 'super_position' :
                echo '<span>' . get_post_meta($post->ID, '_supervisor_position', true) . '</span>';
                break;
            case 'super_company' :
                echo '<span>' . get_post_meta($post->ID, '_supervisor_company', true) . '</span>';
                break;
            case 'super_phone' :
                echo '<span>' . get_post_meta($post->ID, '_supervisor_phone', true) . '</span>';
                break;
                case 'super_cell' :
                echo '<span>' . get_post_meta($post->ID, '_supervisor_cell', true) . '</span>';
                break;
            case 'super_email' :
                echo '<span>' . get_post_meta($post->ID, '_supervisor_email', true) . '</span>';
                break;
            /* Just break out of the switch statement for everything else. */
            default :
                break;
        }
    }

}