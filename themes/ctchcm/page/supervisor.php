<?php
/*
  Template Name:  Supervision
 */
?>
<?php get_header(); ?>
<div class="row">
    <div class="col-md-3 sidebar-left">
        <?php get_sidebar() ?>
    </div>
    <div class="col-md-9 col-sm-12">
        <div class="title-bg">
            <div class="title-text-before"></div>
            <div class="title-text"><lable><?php _e('Supervisor'); ?></lable></div>
            <div class="title-text-after"></div>
        </div>
        <div class="title-content">
            <div class="col-md-12 tieude-lon khoangcach"><?php _e('President List'); ?></div>
            <div style=" clear:  both"></div>
            <div class="col-md-12  hoitruong tieude">
                <div><label><?php _e('Term'); ?></label></div>
                <div><label><?php _e('Position'); ?></label></div>
                <div><label><?php _e('Full Name'); ?></label></div>
                <div><label><?php _e('Company'); ?></label></div>
                <!--<div class="col-lg-2"><label>備註</label></div>-->
            </div>
            <div style=" clear:  both"></div>
            <?php
            $arr = array(
                'post_status' => 'publish',
                'post_type' => 'hoitruong',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'orderby' => 'meta_value_num',
                'meta_key' => '_supervisor_order'
            );
            $wp_query = new WP_Query($arr);
            if ($wp_query->have_posts()):
                while ($wp_query->have_posts()):
                    $wp_query->the_post();
                    ?>
                    <div class="col-md-12 col-sm-12 hoitruong">
                        <div><label><?php echo get_post_meta(get_the_ID(), '_supervisor_term', true); ?></label></div>
                        <div><label><?php echo get_post_meta(get_the_ID(), '_supervisor_position', true); ?></label></div>
                        <div><label><?php the_title(); ?></label></div>
                        <div><label><?php echo get_post_meta(get_the_ID(), '_supervisor_company', true); ?></label></div>
                        <!--<div class="col-lg-2"><label>備註</label></div>-->
                    </div>
                    <?php
                endwhile;
            endif;

            wp_reset_postdata();
            wp_reset_query();
            ?>
            <!--////================================================================================================-->
            <div style=" clear:  both"></div>
            <div class="col-md-12 col-sm-12 tieude-lon khoangcach">
                <?php echo get_option('website_list_title') ?>
            </div>
            <div style=" clear:  both"></div>
            <div class="col-md-12  col-sm-12 hoivien tieude">
                <div class="hide"><label></label></div>
                <div><label><?php _e('Position'); ?></label></div>
                <div><label><?php _e('Full Name'); ?></label></div>
                <div><label><?php _e('Company'); ?></label></div>
                <div ><label><?php _e('Phone'); ?></label></div>
                <div class="hide"><label><?php _e('Cell'); ?></label></div>
                <div class="hide"><label><?php _e('Fax'); ?></label></div>
            </div>
            <div style=" clear:  both"></div>
            <?php
            $arr = array(
                'post_status' => 'publish',
                'post_type' => 'hoivien',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'orderby' => 'meta_value_num',
                'meta_key' => '_supervisor_order'
            );
            $wp_query = new WP_Query($arr);
            $stt = 0;
            if ($wp_query->have_posts()):
                while ($wp_query->have_posts()):
                    $wp_query->the_post();
                    ?>

                    <div class="col-md-12 col-sm-12 hoivien" style="overflow: auto">
                        <div class="hide"><label><?php echo $stt + 1; ?></label></div>
                        <div><label><?php echo get_post_meta(get_the_ID(), '_supervisor_position', TRUE); ?></label></div>
                        <div><label><?php the_title(); ?></label></div>
                        <div><label><?php echo get_post_meta(get_the_ID(), '_supervisor_company', TRUE); ?></label></div>
                        <div><label><?php echo get_post_meta(get_the_ID(), '_supervisor_phone', TRUE); ?></label></div>
                        <div class="hide"><label><?php echo get_post_meta(get_the_ID(), '_supervisor_cell', TRUE); ?></label></div>
                        <div class="hide"><label><?php echo get_post_meta(get_the_ID(), '_supervisor_fax', TRUE); ?></label></div>
                    </div>
                    <?php
                    $stt++;
                endwhile;
            endif;

            wp_reset_postdata();
            wp_reset_query();
            ?>
        </div>

    </div>
    <div class="col-sm-12 sidebar-right">
        <div class="col-sm-6">
            <?php get_sidebar('news-right') ?>
        </div>
        <div class="col-sm-6">
            <?php get_template_part('template', 'event'); ?>
        </div>
        <div class="col-sm-12">
        <?php get_sidebar('right'); ?>
            </div>
    </div>
</div>

<?php get_footer(); ?>