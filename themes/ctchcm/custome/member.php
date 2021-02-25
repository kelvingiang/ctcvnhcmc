<?php

class ADMIN_MEMBER_POST {

    function __construct() {
        add_action('init', array($this, 'Register_Custom_Member_Post'));
        add_action('init', array($this, 'create_member_category_taxonomies'));
        add_action('manage_edit-member_columns', array($this, 'Member_Manage_cols'));
        add_action('manage_member_posts_custom_column', array($this, 'member_render_cols'));
        add_filter('manage_edit-member_sortable_columns', array($this, 'member_post_column_views_sortable'));
        add_filter('request',  array( $this,'sort_views_column'));
    }

    // DANG KY POST CUSTOM
    public function Register_Custom_Member_Post() {
        $labels = array(
            'name' => _x('會員', 'suite'),
            'singular_name' => _x('會員', 'suite'),
            'add_new' => _x('新增會員', 'suite'),
            'add_new_item' => _x('新增會員', 'suite'),
            'edit_item' => _x('修改資料', 'suite'),
            'new_item' => _x('New Forum', 'suite'),
            'all_items' => _x('所有會員', 'suite'),
            'view_item' => _x('View Post', 'suite'),
            'search_items' => _x('查詢', 'suite'),
            'not_found' => _x('No slides found.', 'suite'),
            'not_found_in_trash' => _x('No Forum found in Trash.', 'suite'),
            'parent_item_colon' => '',
            'name_admin_bar' => _x('會員', 'suite'),
            'menu_name' => _x('會員', 'suite')
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
                'slug' => 'member',
                'cate' => true,
                'with_front' => false,
                'feed' => true,
                'pages' => true
            ),
            'menu_icon' => HCM_URI_ICON . 'staff-icon.png',
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            'supports' => array('thumbnail'),
        );
        register_post_type('member', $args);
        flush_rewrite_rules(FALSE); // chuyen den trang single cua custom post
    }

    // DANG KY TAXONOMI NHOM
    function create_member_category_taxonomies() {
        $labels = array(
            'name' => _x('行業分類', 'suite'),
            'singular_name' => _x('行業分類', 'suite'),
            'search_items' => _x('查詢行業', 'suite'),
            'all_items' => _x('所有行業', 'suite'),
            'parent_item' => _x('父類', 'suite'),
            'parent_item_colon' => _x('父類:', 'suite'),
            'edit_item' => _x('修改分類', 'suite'),
            'update_item' => _x('更新分類', 'suite'),
            'add_new_item' => _x('新增行業', 'suite'),
            'new_item_name' => _x('新增行業', 'suite'),
            'menu_name' => _x('行業分類', 'suite')
        );
        register_taxonomy('member_category', 'member', array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'taxonomy' => 'category',
            'rewrite' => array(
                'slug' => 'member_category',
                'hierarchical' => true,
            )
        ));
    }

    // QUAN LY CAC COLUMUNS
    public function Member_Manage_cols($columns) {

        // $title_label = _x('member Name', 'suite');
        $date_label = _x('Create Date', 'suite');

        unset($columns['title']); // cho an cot title mac dinh;
        unset($columns['date']); // an cot ngay mac dinh
        // them cot vao bang 
        $columns['member_logo'] = _x('Logo', 'suite');
        $columns['title'] = _x('公司', 'suite');
        $columns['member_contact'] = _x('聯絡人', 'suite');
        $columns['member_industry'] = _x('行業類', 'suite');
        $columns['member_phone'] = _x('電 話', 'suite');
        $columns['member_email'] = _x('Email', 'suite');
        $columns['member_taxonomi'] = _('loai', 'suite');
        return $columns;
    }

    public function member_render_cols($columns) {
        global $post;
        $ee = wp_get_post_terms($post->ID, 'member_category');
//        echo '<pre>';
//        print_r($ee);
//        echo '</pre>';
        switch ($columns) {
            /* If displaying the 'genre' column. */
            case 'member_logo':
                echo '<span>' . the_post_thumbnail(array(50, 50)) . '</span>';
                break;
            case 'member_contact' :
                echo '<span>' . get_post_meta($post->ID, '_member_contact', true) . '</span>';
                break;
            case 'member_industry' :
                echo '<span>' . $ee['0']->name . '</span>';
                break;
            case 'member_phone' :
                echo '<span>' . get_post_meta($post->ID, '_member_phone', true) . '</span>';
                break;
            case 'member_email' :
                echo '<span>' . get_post_meta($post->ID, '_member_email', true) . '</span>';
                break;
            /* Just break out of the switch statement for everything else. */
            default :
                break;
        }
    }

    public function member_post_column_views_sortable($newcolumn) {
        $newcolumn['member_industry'] = 'member_industry';
        return $newcolumn;
    }

    public function sort_views_column($vars) {
        if (isset($vars['orderby']) && 'member_industry' == $vars['orderby']) {
            $vars = array_merge($vars, array(
                'meta_key' => '_member_taxonomy', //Custom field key
                'orderby' => '_member_taxonomy' //Custom field value (number)
                    )
            );
        };
        return $vars;
    }

}
