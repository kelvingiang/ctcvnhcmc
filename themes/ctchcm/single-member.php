<?php get_header(); ?>
<div class="row">
    <div class="col-md-3 sidebar-left">
        <?php get_sidebar('member'); ?>
    </div>
    <div class="col-md-9 col-sm-12">
        <section id="content" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php
                    $terms = get_the_terms($post->ID, 'member_category');
                    if ($terms) {
                        foreach ($terms as $term) {
                            $_term_id = $term->term_id;
                            $ts = get_term($term->term_id, 'member_category');
                            $_term_name = $ts->name;
                        }
                    }

//                    $ee = get_post_meta(get_the_ID());
//                    echo '<pre>';
//                    print_r($ee);
//                    echo '</pre>';
                    ?>
                    <div class="title-bg">
                        <div class="title-text-before"></div>
                        <div class="title-text"><lable> <?php echo $_term_name; ?> </lable></div>
                        <div class="title-text-after"></div>
                    </div>
                    <div class="title-content" style="padding-top: 10px">
                        <div class="col-md-4 col-sm-4">
                            <?php
                            if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                                $url = get_the_post_thumbnail_url();
                            } else {
                                $url = get_img('no-image.jpg');
                            }
                            ?>
                            <img src ="<?php echo $url ?>" width="200px" style="margin: 5px"/>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <ul class="mem_item">
                                <li> <label class="mem_item_title"> <?php _e('Company'); ?></label>   : <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_company', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"> <?php _e('Contact'); ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_contact', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"> <?php _e('Operating')?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_industry', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"><?php _e('Address')?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_address', TRUE); ?></label> </li>
                                <!--<li> <label class="mem_item_title"><?php// _e('Cell') ?></label>   :  <label class="mem_item_content"><?php// echo get_post_meta($post->ID, '_member_cell', TRUE); ?></label> </li>-->
                                <li> <label class="mem_item_title"><?php _e('Phone') ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_phone', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"><?php _e('Fax'); ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_fax', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"><?php _e('Email') ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_email', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"><?php _e('Website') ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_web', TRUE); ?></label> </li>
                            </ul>
                        </div>

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
            $in_group->view_custom_post($_term_id, $post->ID);
            ?>
        </div>
    </div>
       <div class="col-sm-12 sidebar-right">
        <?php get_sidebar('member-right'); ?>
    </div>
</div>
<?php get_footer(); ?>