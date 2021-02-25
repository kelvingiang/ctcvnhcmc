<div class="title-bg">
    <div class="title-text-before"></div>
    <div class="title-text"><lable><?php _e('Event'); ?></lable></div>
    <div class="title-text-after"></div>
</div>
<ul id="flexisel">
    <?php
    $arr = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'orderby' => 'ID',
        'order' => 'DESC',
        'cat' => 16
    );

    $my_query = new WP_Query($arr);

    if ($my_query->have_posts()) {
        while ($my_query->have_posts()) {
            $my_query->the_post();
            $images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
            $objImageData = get_post(get_post_thumbnail_id(get_the_ID()));
            $strAlt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
            ?>
            <li>      
                <a href="<?php the_permalink(); ?>">
                    <div class="box">
                        <div style="height: 170px;  margin: auto auto">
                            <img src="<?php echo $images[0]; ?>"  alt="<?php echo $strAlt; ?>" title="<?php echo $objImageData->post_title; ?>" />
                        </div>
                        <div class="nbs-flexisel-title">
                            <label style="height: 100px; line-height: 1.2;  font-size: 13px; text-align: left; margin: 0 5px"><?php the_title(); ?></label> 
                        </div>
                    </div>
                </a>
            </li>
            <?php
        }
        wp_reset_postdata();
        wp_reset_query();
    }
    if (is_page()) {
        $item = 4;
    } else {
        $item = 4;
    }
  
    ?>
</ul>
<div class="clearout"></div>
<script type="text/javascript">
    jQuery("#flexisel").flexisel({
        visibleItems: <?php echo $item ?>,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 3000,
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        vertical: false,
        responsiveBreakpoints: {
            portrait: {
                changePoint: 480,
                visibleItems: 1
            },
            landscape: {
                changePoint: 640,
                visibleItems: 2
            },
            tablet: {
                changePoint: 768,
                visibleItems: 3
            }
        }
    });
</script>    