<?php

///QUAN LY CAC PHAN CSS VA JS CHO ADMIN VA CLINET
// PHAN BIET ADD VO PHAN ADMIN HAY CLIENT
function ctcvnhcm_header_scripts() {
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        // PHAN CLIENT 
//        wp_register_script('my-js', get_template_directory_uri() . '/js/my-js.js', array('jquery'), '1.0.0'); // Custom scripts
//        wp_enqueue_script('my-js'); // Enqueue it!
        wp_register_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('bootstrap-js');
    
        
        wp_register_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css', array(), '1.0', 'all');
        wp_enqueue_style('bootstrap_css'); // Enqueue it!
        wp_register_style('bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.css', array(), '1.0', 'all');
        wp_enqueue_style('bootstrap-s');
        
        wp_register_style('my-css', get_template_directory_uri() . '/css/my.css', array(), '1.0', 'all'); // Custom scripts
        wp_enqueue_style('my-css');
        
        
    } else {
        //PHAN ADMIN
//        wp_register_script('my-jquery', get_template_directory_uri() . '/js/jquery-1.4.2.min.js', array('jquery'), '1.0.0'); // Custom scripts
//        wp_enqueue_script('my-jquery');
//
//        wp_register_script('my-js-admin', get_template_directory_uri() . '/js/my-js-admin.js', array('jquery'), '1.0.0'); // Custom scripts
//        wp_enqueue_script('my-js-admin'); // Enqueue it!
//
//        wp_register_style('my-style-admin', get_template_directory_uri() . '/css/my-style-admin.css', array(), '1.0', 'all');
//        wp_enqueue_style('my-style-admin'); // Enqueue it!
    }
    // ADD CHO CA ADMIN VA CLIENT
    wp_register_script('jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('jquery-ui');

    wp_register_style('jquery-ui', get_template_directory_uri() . '/css/jquery-ui.min.css', array(), '1.0', 'all');
    wp_enqueue_style('jquery-ui');




// Enqueue it!
}

add_action('wp_enqueue_scripts', 'ctcvnhcm_header_scripts');

