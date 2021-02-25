<?php

class ADMIN_SIlDER_POST {

    public function __construct() {
        add_action('init', array($this, 'Register_Custom_Silder_Post'));
        add_action('manage_edit-silder_columns', array($this, 'Silder_Manage_cols'));
        add_action('manage_silder_posts_custom_column', array($this, 'Silder_render_cols'));
    }

    public function Register_Custom_Silder_Post() {
        $labels = array(
            'name' => _x('幻燈照片', 'suite'),
            'singular_name' => _x('幻燈照片', 'suite'),
            'add_new' => _x('新增幻燈照片', 'suite'),
            'add_new_item' => _x('新增幻燈照片', 'suite'),
            'edit_item' => _x('修改資料', 'suite'),
            'new_item' => _x('New Forum', 'suite'),
            'all_items' => _x('所有幻燈照片', 'suite'),
            'view_item' => _x('View Post', 'suite'),
            'search_items' => _x('查詢', 'suite'),
            'not_found' => _x('No slides found.', 'suite'),
            'not_found_in_trash' => _x('No Forum found in Trash.', 'suite'),
            'parent_item_colon' => '',
            'name_admin_bar' => _x('幻燈照片', 'suite'),
            'menu_name' => _x('幻燈片 994 x 300 ', 'suite')
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
                'slug' => 'silder',
                'cate' => true,
                'with_front' => false,
                'feed' => true,
                'pages' => true
            ),
            'menu_icon' => HCM_URI_ICON . 'slider-icon.png',
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 8,
            'supports' => array('title', 'thumbnail'),
        );
        register_post_type('silder', $args);
        flush_rewrite_rules(FALSE); // chuyen den trang single cua custom post
    }

    // QUAN LY CAC COLUMUNS
    public function Silder_Manage_cols($columns) {

        //$date_label = _x('Create Date', 'suite');

        unset($columns['title']); // cho an cot title mac dinh;
        unset($columns['date']); // an cot ngay mac dinh
        $columns['title'] = _x('名稱', 'suite');
        $columns['img'] = _x('照片', 'suite');

        return $columns;
    }

    public function Silder_render_cols($columns) {
        global $post;
        switch ($columns) {
            case 'img' :
                echo '<span>' . the_post_thumbnail(array(100, 100)) . '</span>';
                break;
            /* Just break out of the switch statement for everything else. */
            default :
                break;
        }
        ?>
        <style type="text/css">
            .wp-post-image{
                width: 250px;
                height: 90px;
            }
        </style>
        <?php

    }

}