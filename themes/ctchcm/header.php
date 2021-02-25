<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <?php seo(); ?>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" key="viewport" content="width=device-width, initial-scale=1">
        <link type="image/x-icon" href="/favicon.ico" rel="icon"> <!-- icon show on web title -->
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon"/>
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
        <?php wp_head(); ?>
        <!--/SCRIPT CHEN SUPERFISH MENU-->
        <script type="text/javascript">
            jQuery(document).ready(function () {
                // superFish
                jQuery('ul.sf-menu').supersubs({
                    minWidth: 16, // minimum width of sub-menus in em units
                    maxWidth: 40, // maximum width of sub-menus in em units
                    extraWidth: 1 // extra width can ensure lines don't sometimes turn over
                })
                        .superfish(); // call supersubs first, then superfish
            });
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-181283701-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-181283701-1');
        </script>

    </head>
    <body <?php
    body_class();
    if (is_page('contact')) {
        echo "onload='initialize()'";
    }
    ?>>
        <div class="my-waiting">
            <img src="<?php echo get_img('loading_pr2.gif') ?>"  style=" width: 150px" />
        </div>
        <div id="wrapper" class="hfeed">
            <!--            <header id="header" role="banner">
                            <section id="branding">
                                <div id="site-title"><?php
//                        if (is_front_page() || is_home() || is_front_page() && is_home()) {
//                            echo '<h1>';
//                        }
//                        
            ?><a href="<?php //  echo esc_url(home_url('/')); ?>" title="<?php // echo esc_html(get_bloginfo('name')); ?>" rel="home"><?php //  echo esc_html(get_bloginfo('name')); ?></a><?php
//                        if (is_front_page() || is_home() || is_front_page() && is_home()) {
//                            echo '</h1>';
//                        }
            ?></div>
                                <div id="site-description"><?php bloginfo('description'); ?></div>
                            </section>-->

            <?php
            get_template_part('template', 'main-menu');
            ?>
        </header>

        <div id="container">
<?php global $_cat_ID; ?>


