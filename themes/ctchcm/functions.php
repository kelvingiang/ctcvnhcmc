<?php
if (!isset($_SESSION)) {
    session_start();
}

define('THEME_URL', get_stylesheet_directory());  // hang lay path thu muc theme
define('DS', DIRECTORY_SEPARATOR);  // phan nay thay doi dau / theo he dieu hanh khac nhau giua window va linx
define('HCM_DIR_HELPER', THEME_URL . DS . 'helper' . DS); // tro den thu muc class chua cac lop 

require_once (HCM_DIR_HELPER . 'define.php');
require_once (HCM_DIR_HELPER . 'style.php');
require_once (HCM_DIR_HELPER . 'require.php');
require_once (HCM_DIR_HELPER . 'function.php');

register_nav_menu('primary-menu', __('Primary name', 'suite')); // goi menu de show
register_nav_menu('mobile-menu', __('Mobile name', 'suite')); // goi menu de show
//  START==============================================THEM RULE REWRITE CUA MINH 

function add_rule_rewrite() {
//      $regex2 = '([^/]*)/page/?([^/]*)/?$';
//    $redirect2 = 'index.php?p=$matches[1]&paged=$matches[2]';
////    ?p=202&paged=3
//    add_rewrite_rule($regex2, $redirect2, 'top');
// CAC REWRITE CUNG PHAI THEO THU TU RO NEU SAI THU TU CO THE SE KHONG HIEN THI DUOC
    // KIEM TRA TA CO1 DUNG $wp , $wp_query, $wp_rewrite;
    $regex1 = 'member-cat-list/id/([^/]*)/?$';
    $redirect1 = 'index.php?pagename=member-cat-list&id=$matches[1]';
    add_rewrite_rule($regex1, $redirect1, 'top');



    flush_rewrite_rules(false);
}

add_action('init', 'add_rule_rewrite');

//THEM THAM SO QUERY VAR
function add_query_var($vars) {
    $vars[] = 'id';
//   $vars[] ='page';
    return $vars;
}

add_filter('query_vars', 'add_query_var');

// END =========================================================================
//function cua theme ============================================================
// loai javasripte co san trong wordpress nhu khong can thiet

//    if (!is_admin() && isset($scripts->registered['jquery'])) {


add_action( 'wp_default_scripts', 'remove_jquery_migrate' );
function remove_jquery_migrate( $scripts ) {
	if (isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) { // Check whether the script has any dependencies
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
 }




add_action('after_setup_theme', 'blankslate_setup');

function blankslate_setup() {
    load_theme_textdomain('blankslate', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    global $content_width;
    if (!isset($content_width))
        $content_width = 640;
}

add_action('wp_enqueue_scripts', 'blankslate_load_scripts');

function blankslate_load_scripts() {
    wp_enqueue_script('jquery');
}

add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');

function blankslate_enqueue_comment_reply_script() {
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_filter('the_title', 'blankslate_title');

function blankslate_title($title) {
    if ($title == '') {
        return '&rarr;';
    } else {
        return $title;
    }
}

add_filter('wp_title', 'blankslate_filter_wp_title');

function blankslate_filter_wp_title($title) {
    return $title . esc_attr(get_bloginfo('name'));
}

add_action('widgets_init', 'blankslate_widgets_init');

function blankslate_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar Widget Area', 'blankslate'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

function blankslate_custom_pings($comment) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php
}

add_filter('get_comments_number', 'blankslate_comments_number');

function blankslate_comments_number($count) {
    if (!is_admin()) {
        global $id;
        $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}
