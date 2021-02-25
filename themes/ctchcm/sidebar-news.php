<aside id="sidebar" role="complementary">
    <div class="sidebar">
        <?php
        get_template_part('template', 'member');
        if (is_page('news'))
            get_template_part('template', 'assembly');
        else
            get_template_part('template', 'news');
        ?>   

    </div>
</aside>