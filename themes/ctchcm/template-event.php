<!--phankhac-->
<div class="title-bg">
    <div class="title-text-before"></div>
    <div class="title-text"><lable><?php _e('Event'); ?></lable></div>
    <div class="title-text-after"></div>
</div>
<?php if(is_home()) echo '<div class="title-content">' ?>
    <div class="list-group">
        <?php
        if(is_home()){
            $count = 10;
        }else{
            $count = 5;
        }
        
        $team_team = array(
            'post_type' => 'post',
            'posts_per_page' => $count,
            'orderby' => 'ID',
            'order' => 'DESC',
            'cat' => 16);
        $team_query = new WP_Query($team_team);
        if ($team_query->have_posts()):
            while ($team_query->have_posts()):
                $team_query->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="list-group-item"><?php the_title(); ?></a>
                <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
        ?>
    </div>
<?php if(is_home()) echo '</div>' ?>

