<?php

///QUAN LY CAC PHAN CSS VA JS CHO ADMIN VA CLINET
// PHAN BIET ADD VO PHAN ADMIN HAY CLIENT
function ctcvnhcm_header_scripts() {

    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        // PHAN CLIENT 

        wp_register_script('bootstrap-js', HCM_URI_JS . 'bootstrap.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('bootstrap-js');

        wp_register_style('bootstrap_css', HCM_URI_CSS . 'bootstrap.css', array(), '1.0', 'all');
        wp_enqueue_style('bootstrap_css'); // Enqueue it!

        wp_register_style('bootstrap-theme', HCM_URI_CSS . 'bootstrap-theme.css', array(), '1.0', 'all');
        wp_enqueue_style('bootstrap-s');

        wp_register_style('my-css', HCM_URI_CSS . 'my.css', array(), '1.0', 'all'); // Custom scripts
        wp_enqueue_style('my-css');

//        wp_register_script('custom-js', HCM_URI_JS . 'custom.js', array('jquery'), '1.0.0'); // Custom scripts
//        wp_enqueue_script('custom-js');

        // PHAN  CUA MENU SUPERFISH 
        wp_register_style('superfish', get_template_directory_uri() . '/superfish/css/superfish.css', '1.0', 'all');
        wp_enqueue_style('superfish');

//        wp_register_style('superfish-navbar', get_template_directory_uri() . '/superfish/css/superfish-superfish-navbar.css', '1.0', 'all');
//        wp_enqueue_style('superfish-navbar');

        wp_register_style('superfish-custom', get_template_directory_uri() . '/superfish/superfish-custom.css', '1.0', 'all');
        wp_enqueue_style('superfish-custom');

        wp_register_script('superfish-js', get_template_directory_uri() . '/superfish/js/superfish.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('superfish-js');

        wp_register_script('supersubs-js', get_template_directory_uri() . '/superfish/js/supersubs.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('supersubs-js');

        wp_register_script('super-custom-js', get_template_directory_uri() . '/superfish/superfish-cus.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('super-custom-js');
        //-------- END ----------------
        // PHAN CUA SILDER
        wp_register_script('jquery-easing', get_template_directory_uri() . '/slider/jquery.easing.1.3.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('jquery.easing');

        wp_register_style('slider-css', get_template_directory_uri() . '/slider/skitter.css', '1.0', 'all');
        wp_enqueue_style('slider-css');

        wp_register_script('slider-js', get_template_directory_uri() . '/slider/jquery.skitter.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('slider-js');

        // PHAN SLIDER MULTI 
        wp_register_style('slider-multi-css', get_template_directory_uri() . '/slider-multi/flexisel.css', '1.0', 'all');
        wp_enqueue_style('slider-multi-css');

        wp_register_script('slider-multi-js', get_template_directory_uri() . '/slider-multi/jquery.flexisel.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('slider-multi-js');

        // RESPONSIVE
                wp_register_style('responsive-css', get_template_directory_uri() . '/css/responsive.css', '1.0', 'all');
        wp_enqueue_style('responsive-css');
        //--------------------- END --------------



        wp_register_script('my-js', HCM_URI_JS . 'my-js.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('my-js'); // Enqueue it!
    } else {
        //PHAN ADMIN

//        wp_register_script('my-js-admin', get_template_directory_uri() . '/js/my-js-admin.js', array('jquery'), '1.0.0'); // Custom scripts
//        wp_enqueue_script('my-js-admin'); // Enqueue it!
//
        wp_register_style('style_admin', HCM_URI_CSS . 'admin/admin-style.css', array(), '1.0', 'all');
        wp_enqueue_style('style_admin'); // Enqueue it!

        $role = wp_get_current_user();
        if ($role->roles[0] != 'administrator') {
            wp_register_style('role_admin', HCM_URI_CSS . 'admin/admin-role.css', array(), '1.0', 'all');
            wp_enqueue_style('role_admin'); // Enqueue it!
        }
    }
    
     
    wp_register_script('jquery-ui-js', HCM_URI_JS . 'jquery-ui.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('jquery-ui-js');

    wp_register_style('jquery-ui-css', HCM_URI_CSS . 'jquery-ui.css', array(), '1.0', 'all');
    wp_enqueue_style('jquery-ui-css');
   

    wp_register_script('my_function', HCM_URI_JS . 'custom.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('my_function');
//
// Enqueue it!
}
//
add_action('init', 'ctcvnhcm_header_scripts');

//add_action('wp_enqueue_scripts', 'ctcvnhcm_header_scripts');

function style_to_footer() {
    // ADD CHO CA ADMIN VA CLIENT
    wp_register_script('jquery-ui-js', HCM_URI_JS . 'jquery-ui.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('jquery-ui-js');

    wp_register_style('jquery-ui-css', HCM_URI_CSS . 'jquery-ui.css', array(), '1.0', 'all');
    wp_enqueue_style('jquery-ui-css');

//    wp_register_script('slider-cus-js', get_template_directory_uri() . '/slider/slider-custom.js', array('jquery'), '1.0.0'); // Custom scripts
//    wp_enqueue_script('slider-cus-js');
}

add_action('wp_footer', 'style_to_footer');
