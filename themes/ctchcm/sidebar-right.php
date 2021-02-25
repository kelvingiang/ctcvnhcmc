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
        ?>   

    </div>
</aside>