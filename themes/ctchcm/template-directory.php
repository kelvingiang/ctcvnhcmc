<div class="title-bg">
    <div class="title-text-before"></div>
    <div class="title-text"><lable> 會員通訊錄 </lable></div>
    <div class="title-text-after"></div>
</div>
<div class="title-content">
    <div class="list-group">
        <?php
        global $post;
        $argsCate = array(
            'type' => 'post',
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
        wp_reset_postdata();
        wp_reset_query();
        ?>
    </div>
</div>