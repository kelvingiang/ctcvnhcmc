<?php get_header(); ?>
<div class="row">
    <div class="col-md-3 sidebar-left">
        <?php get_sidebar(); ?>
    </div>
    <div class="col-md-9 col-sm-12" >
        <section id="content" role="main" style="padding-right: 5px">


            <?php
            global $wp_query;
//            
            if (have_posts()) : while (have_posts()) : the_post();
                    $cat = get_the_category($post->ID);
                    $_term_id = $cat[0]->term_id;
                    $_term_name = $cat[0]->name;
                    $images = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                    $objImageData = get_post(get_post_thumbnail_id($post->ID));
                    $strAlt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
                    ?>
                    <div class="title-bg">
                        <div class="title-text-before"></div>
                        <div class="title-text"><lable> <?php echo $_term_name ?> </lable></div>
                        <div class="title-text-after"></div>
                    </div>
                    <div class="title-content" style="padding: 10px 15px">
                        <h2 style="font-weight: bold; padding-left: 10px; padding-bottom: 10px; min-height: 30px "><?php the_title() ?></h2>
                        <?php if (!empty($images)) { ?>
                            <div style="width: 98%;  text-align: center;  margin-bottom: 10px ">
                                <img style=" width: 60%" src="<?php echo $images[0]; ?>"  alt="<?php echo $strAlt; ?>" title="<?php echo $objImageData->post_title; ?>" />
                            </div>
                        <?php }
                        ?>
                        <?php the_content(); ?>
                    </div>
                    <?php
                endwhile;
            endif;
            ?>
        </section>
        <div>
            <?php
            require_once (HCM_DIR_CLASS . 'in-group.php');
            $in_group = new LIENT_IN_GROUP();
            $in_group->view_post($_term_id, $post->ID, $_SESSION['offset']);
            ?>
        </div>
    </div>
    <div class="col-sm-12 sidebar-right">
        <?php get_sidebar('right'); ?>
    </div>
</div>
<?php get_footer(); ?>