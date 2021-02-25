
    <div class="title-bg">
        <div class="title-text-before"></div>
        <div class="title-text"><lable> <?php _e('News') ?></lable></div>
        <div class="title-text-after"></div>
    </div>
    <?php if (is_home()) echo '<div class="title-content">' ?>
    <div class="list-group">
        <?php
        global $wp_query;
        if (is_home()) {
            $count = 10;
        } else {
            $count = 5;
        }
        $news_team = array(
            'post_type' => 'post',
            'posts_per_page' => $count,
            'orderby' => 'ID',
            'order' => 'DESC',
            'cat' => 1);
        $news_query = new WP_Query($news_team);
        if ($news_query->have_posts()):
            while ($news_query->have_posts()):
                $news_query->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="list-group-item"><?php the_title(); ?></a>
                <?php
            endwhile;
        endif;

        wp_reset_postdata();
        wp_reset_query();
        ?>
    </div>
    <?php if (is_home()) echo '</div>' ?>
