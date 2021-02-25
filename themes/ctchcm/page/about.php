<?php
/*
  Template Name:  About
 */
?>
<?php get_header(); ?>
<div class="siler-event">
    <?php get_template_part('template', 'slider-multi'); ?>
</div>
<div class="row">
    <div class="col-md-3 sidebar-left ">
        <?php get_sidebar('news') ?>
    </div>
    <div class="col-md-9 col-sm-12">

        <div class="title-bg">
            <div class="title-text-before"></div>
            <div class="title-text"><lable> <?php _e('About Us'); ?></lable></div>
            <div class="title-text-after"></div>
        </div>
        <?php if (is_home()) echo '<div class="title-content">' ?>
        <div class="list-group" style="padding: 10px">
            <?php
            echo get_post_meta(1, '_web_about', true);
            ?>
        </div>
        <div class="col-sm-12 sidebar-right ">
            <div class="col-sm-6">
                <?php get_template_part('template', 'event'); ?>
            </div>
            <div class="col-sm-6">
                <?php get_sidebar('news-right') ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
