<?php
/*
  Template Name:  President
 */
?>

<?php get_header() ?>
<div class="row">
    <div class="col-md-3 sidebar-left " >
        <?php get_sidebar() ?>
    </div>
    <div class="col-md-9  col-sm-12">
        <div class="title-bg">
            <div class="title-text-before"></div>
            <div class="title-text"><lable><?php  _e('President');?>sssssssss</lable></div>
            <div class="title-text-after"></div>
        </div>
        <div class="title-content">
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
                    <div class="col-md-4 col-sm-4" style="text-align: center;  margin: 15px 0">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url(); ?>" style="width: 150px; height: 200px"  />
                        <?php endif; ?>
                        <br> <label style="margin-top: 5px"><?php the_title(); ?></label>  

                    </div>
                    <?php
                endwhile;
            endif;

            wp_reset_postdata();
            wp_reset_query();
            ?>
        </div>
    </div>
    <div class="col-sm-12 sidebar-right " >
        <div class="col-sm-6">
            <?php get_sidebar('news-right') ?>
        </div>
        <div class="col-sm-6">
            <?php  get_template_part('template', 'event'); ?>
        </div>
        <div class="col-sm-12">
        <?php get_sidebar('right'); ?>
            </div>
    </div>
</div>
<?php get_footer() ?>