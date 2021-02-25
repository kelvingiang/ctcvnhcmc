<?php
/*
  Template Name:  Event
 */
?>
<?php get_header(); ?>

<div class="row">
    <div class="col-md-3 sidebar-left">
        <?php get_sidebar('news') ?>
    </div>
    <div class="col-md-9 col-sm-12">

        <div class="title-bg">
            <div class="title-text-before"></div>
            <div class="title-text"><lable><?php _e('Event')?> </lable></div>
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
            $_SESSION['offset'] = $offset;
            $news_team = array(
                'post_type' => 'post',
                'posts_per_page' => $showNum,
                'orderby' => 'ID',
                'order' => 'DESC',
                'offset' => $offset,
                'paged' => $paged,
                'cat' => 16);
            $wp_query = new WP_Query($news_team);

            if ($wp_query->have_posts()):
                while ($wp_query->have_posts()):
                    $wp_query->the_post();
                    ?>
                    <li class="list-group-item">
                        <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
                        <div style="margin-left: 10px; margin-top: 5px">
                            <?php
//                            echo substr(get_the_content(), 0, 200) . '.....'; 
                            the_content_feed();
                            ?>
                        </div>
                    </li>
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
    <div class="col-sm-12 sidebar-right">
        <div class="col-sm-6">
            <?php get_template_part('template', 'member'); ?>
        </div>
        <div class="col-sm-6">
            <?php get_sidebar('news-right') ?>
        </div>  
    </div>
</div>
</div>
<?php get_footer(); ?>