<?php
/*
  Template Name:  Member
 */
?>
<?php get_header(); ?>
<div class="siler-event">
    <?php get_template_part('template', 'slider-multi'); ?>
</div>
<div class="row">
    <div class="col-md-3 sidebar-left">
        <?php get_sidebar('member') ?>
    </div>

    <div class="col-md-9 col-sm-12 ">

        <div class="title-bg">
            <div class="title-text-before"></div>
            <div class="title-text"><lable> <?php _e('Members'); ?></lable></div>
            <div class="title-text-after"></div>
        </div>
        <?php if (is_home()) echo '<div class="title-content">' ?>
        <div class="list-group">
            <?php
            global $wp_query;
            if (get_query_var('paged')) {
                $paged = get_query_var('paged');
            } elseif (get_query_var('page')) {
                $paged = get_query_var('page');
            } else {
                $paged = 1;
            }

            $showNum = 10;
            $offset = ($paged - 1) * $showNum;
            $news_team = array(
                'post_type' => 'member',
                'posts_per_page' => $showNum,
                'orderby' => 'ID',
                'order' => 'ASC',
                'offset' => $offset,
                'paged' => $paged,
                'meta_key' => '_member_order',
                'meta_query' => array(
                    array(
                        'key' => '_member_display',
                        'value' => 'on',
                        'compare' => '='
                    )
                )
            );
            $wp_query = new WP_Query($news_team);

            if ($wp_query->have_posts()):
                while ($wp_query->have_posts()):
                    $wp_query->the_post();
                    ?>
                    <div class="title-content">
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
                                <li> <label class="mem_item_title"><?php _e('Company'); ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_company', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"><?php _e('Contact'); ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_contact', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"><?php _e('Operating'); ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_industry', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"><?php _e('Address'); ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_address', TRUE); ?></label> </li>
                                <!--<li> <label class="mem_item_title"><?php// _e('Cell'); ?></label>   :  <label class="mem_item_content"><?php// echo get_post_meta($post->ID, '_member_cell', TRUE); ?></label> </li>-->
                                <li> <label class="mem_item_title"><?php _e('Phone'); ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_phone', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"><?php _e('Fax'); ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_fax', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"><?php _e('Email'); ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_email', TRUE); ?></label> </li>
                                <li> <label class="mem_item_title"><?php _e('Website'); ?></label>   :  <label class="mem_item_content"><?php echo get_post_meta($post->ID, '_member_web', TRUE); ?></label> </li>
                            </ul>
                        </div>

                    </div>
                    <?php
                endwhile;
            endif;
/// CAC PHUONG THUC  PAGING
// PHUONG THUC PAGING THU NHAT
//  posts_nav_link();    
// PHUONG THUC PAGING THU HAI
//next_posts_link(__( 'Previous ' ));
// echo '  |  ';
// previous_posts_link(__( ' Next ' ));
// PHUONG THUC PAGING THU BA
            $big = 999999999; // DAY LA GIA TRI SO TRANG LON NHAT TA CHO 1 SO BAT KY 
            $base = str_replace($big, '%#%', esc_url(get_pagenum_link($big))); //    TAO RA LINK PHANTRANG
            $format = '?page=%#%'; // kieu lay url mac dinh khong nen doi
            $current = max(1, $paged);
            $total = $wp_query->max_num_pages;
            $args = array(
                'base' => $base,
                'format' => $format,
                'total' => $total,
                'current' => $current,
                'show_all' => FALSE,
                'end_size' => 1, // SO TRANG DAU VA CUOI
                'mid_size' => 2, // SO TRANG HIEN TAI
                'prev_next' => true,
//                    'prev_text' => __('« Previous'),
//                    'next_text' => __('Next »'),
                'type' => 'plain', // CAC KIEU HIEN THI HTML ; plain = <a> ; list = <li>; array = tra ve kieu array.
                'add_args' => false, // ADD THEM GIA TRI TREN URL VD : array ('test' => 'abc')
                'add_fragment' => '', // ADD THEM PHAN VAO URL VD : &test = abc
                'before_page_number' => '', // THEM GIA TRI TRUOC  ITEM PHAN TRANG
                'after_page_number' => ''  // THEM GIA TRI VAO SAU ITEM PHAN TRANG
            );




            // wp_pagenavi();
            wp_reset_postdata();
            wp_reset_query();
            ?>
            <div id="paginate"> 
                <?php echo paginate_links($args); ?>
            </div>
        </div>
        <?php if (is_home()) echo '</div>' ?>

    </div>
    <div class="col-sm-12 sidebar-right" >
        <?php get_sidebar('member-right') ?>
    </div>
</div>
</div>
<style type="text/css">
    .mem_item .mem_item_title , .mem_item .mem_item_content{
        font-size: 12px !important;

    }
    .mem_item li{
        margin: 2px 0 !important;
    }
    .title-content{
        margin-bottom: 0 !important;
    }
</style>
<?php get_footer(); ?>