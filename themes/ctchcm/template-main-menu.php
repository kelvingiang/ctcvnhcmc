<nav id="menu"  class="row" role="navigation">
    <div class="col-lg-5 col-md-5 col-sm-12">
        <div class="col-md-3 col-xs-2 ">
            <a href="<?php echo home_url(); ?>">
                <img class="logo"  src="<?php echo get_img(get_option('website_logo')); ?>"/>
            </a> 
        </div>
        <div class=" col-md-9 col-xs-10 web-title" >
            <h1 style=" letter-spacing: 1px; "><?php echo get_option("website_name_cn") ?></h1>
            <h1 style=" margin-top: 5px;"><?php echo get_option("website_name_vn") ?></h1>
        </div>
    </div>
    <!--<div style="clear: both"></div>-->
    <div class="col-lg-7 col-md-7 col-sm-12">
        <div class="main-menu">
            <?php wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' => 'sf-menu')); ?>
        </div>
        <div style="clear: both"></div>
        <div class="mobile-menu"style=" height: 180px;">
            <?php wp_nav_menu(array('theme_location' => 'mobile-menu', 'menu_class' => 'menu')); ?>
        </div>

    </div>
    <div id="search">
        <?php // get_search_form(); ?>
    </div>
</nav>
<?php
if (!is_page('contact')) {
    get_template_part('template', 'slider');
} else {
    get_template_part('template', 'googlemap');
}
?>
<div class="middle-menu">
    <?php wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' => 'sf-menu')); ?>
</div>
