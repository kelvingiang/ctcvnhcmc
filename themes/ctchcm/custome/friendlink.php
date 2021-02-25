<?php

class ADMIN_FRIEND_LINK_POST {

    public function __construct() {
        add_action('init', array($this, 'Register_Custom_Friend_Link_Post'));
        add_action('manage_edit-friend-link_columns', array($this, 'Friend_link_Manage_cols'));
        add_action('manage_friend-link_posts_custom_column', array($this, 'Friend_link_render_cols'));
    }

    public function Register_Custom_Friend_Link_Post() {
        $labels = array(
            'name' => _x('友誼連接', 'suite'),
            'singular_name' => _x('友誼連接', 'suite'),
            'add_new' => _x('新增友誼連接', 'suite'),
            'add_new_item' => _x('新增友誼連接', 'suite'),
            'edit_item' => _x('修改資料', 'suite'),
            'new_item' => _x('New Forum', 'suite'),
            'all_items' => _x('所有友誼連接', 'suite'),
            'view_item' => _x('View Post', 'suite'),
            'search_items' => _x('查詢', 'suite'),
            'not_found' => _x('No slides found.', 'suite'),
            'not_found_in_trash' => _x('No Forum found in Trash.', 'suite'),
            'parent_item_colon' => '',
            'name_admin_bar' => _x('友誼連接', 'suite'),
            'menu_name' => _x('友誼連接', 'suite')
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
                'slug' => 'friendlink',
                'cate' => true,
                'with_front' => false,
                'feed' => true,
                'pages' => true
            ),
            'menu_icon' => HCM_URI_ICON . 'web-icon.png',
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 7,
            'supports' => array(''),
        );
        register_post_type('friend-link', $args);
        flush_rewrite_rules(FALSE); // chuyen den trang single cua custom post
    }
    
        // QUAN LY CAC COLUMUNS
    public function Friend_Link_Manage_cols($columns) {

        //$date_label = _x('Create Date', 'suite');

        unset($columns['title']); // cho an cot title mac dinh;
        unset($columns['date']); // an cot ngay mac dinh
        $columns['title'] = _x('名稱', 'suite');
        $columns['web_link'] = _x('網站', 'suite');
        $columns['order'] = _x('秩序', 'suite');    
        return $columns;
    }

    public function Friend_Link_render_cols($columns) {
        global $post;
        switch ($columns) {
            case 'web_link' :
                echo '<span>' .  get_post_meta($post->ID, '_friendlink_web', true) . '</span>';
                break;
            case'order':
                echo '<span>' .  get_post_meta($post->ID, '_friendlink_order', true) . '</span>';
                break;
            /* Just break out of the switch statement for everything else. */
            default :
                break;
        }
    }

}