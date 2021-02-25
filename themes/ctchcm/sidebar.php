<aside id="sidebar" role="complementary">
    <div class="sidebar">
        <?php
        if (have_posts()) : while (have_posts()) : the_post();
                $cat = get_the_category($post->ID);
                $_cat_ID = $cat[0]->term_id;
            endwhile;
        endif;
        ?>
        <?php   
        get_template_part('template', 'member');
        if ($_cat_ID != 16) {
            get_template_part('template', 'event');
        }
        if ($_cat_ID != 1) {
            get_template_part('template', 'news');
        }
        if ($_cat_ID != 2) {
            get_template_part('template', 'term');
        }
    
        ?>   

    </div>
</aside>