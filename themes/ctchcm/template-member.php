
    <div class="title-bg">
        <div class="title-text-before"></div>
        <div class="title-text"><lable><?php _e('Members') ?> </lable></div>
        <div class="title-text-after"></div>
    </div>

    <div class="list-group" style="font-size: 13px">
        <?php
        global $post;
        $argsCate = array(
            'type' => 'post',
             'posts_per_page' => -1,
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'taxonomy' => 'member_category',
            'hide_empty' => 0,
            'parent' => 0,
        );
        $categories = get_categories($argsCate);

        foreach ($categories as $val) {
            ?>
            <!--THAN THIET TIM KIEM CHUYEN SLUG TREN URL-->
            <a href="<?php echo home_url('member-cat-list/id/' . $val->slug); ?>" class="list-group-item"><?php echo $val->name; ?></a>
            <?php
        }
        ?>
    </div>
