<?php
/*
  Template Name:  Member Cat List
 */
?>
<?php get_header(); ?>
<div class="siler-event">
    <?php get_template_part('template', 'slider-multi'); ?>
</div>
<div class="row">
    <div class="col-md-3 sidebar-left">
        <?php get_sidebar() ?>
    </div>
    <div class="col-md-9 col-sm-12">
        <?php
        global $wpdb;
        // NHAN DC SLUG TU SLUG VAO DATABSE LAY ID OF TAXONOMI DO
        $_slug = get_query_var('id');

// THONG SO id DUA CHUYEN TREN url DE LAY DONG DU LIEU CAN CHINH SUA
        $table = $wpdb->prefix . 'terms';
        $sql = "SELECT * FROM $table WHERE slug = '$_slug'";
        $row = $wpdb->get_row($sql, ARRAY_A);  // LAY DONG DU LIEU TRA VE KIEU array
// CO ID TAX TIEP TUC LAY NHOM DOI TUONG TRONG TAXOMOMY DO
        ?>
        <div class="title-bg">
            <div class="title-text-before"></div>
            <div class="title-text"><lable><?php echo $row['name'] ?></lable></div>
            <div class="title-text-after"></div>
        </div>
        <div class="title-content">
            <ul class="list-grid">
                <?php
                $arr = array(
                    'post_type' => 'member',
                     'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'member_category', // taxonomy name
                            'field' => 'term_id', // term_id, slug or name
                            'terms' => $row['term_id'], // term id, term slug or term name
                        )
                    )
                );
                $wp_query = new WP_Query($arr);
                if ($wp_query->have_posts()):
                    while ($wp_query->have_posts()):
                        $wp_query->the_post();
                        if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                            $url = get_the_post_thumbnail_url();
                        } else {
                            $url = get_img('no-image.jpg');
                        }
                        ?>
                        <li class="list-item">
                            <div class="col-lg-2 col-sm-2"><img src="<?php echo $url; ?>"/></div> 
                            <div class="col-lg-10 col-sm-10"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></div>
                        </li>                   
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                wp_reset_query();
                ?>
            </ul>
        </div>
    </div>
    <div class="col-sm-12  sidebar-right">
        <?php get_sidebar('right') ?>
    </div>
</div>

<?php get_footer(); ?>