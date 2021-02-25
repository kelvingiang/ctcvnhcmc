<?php

class LIENT_IN_GROUP {

    public function view_custom_post($tax_id, $post_id) {
        $arr = array(
            'post_type' => 'member',
             'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'member_category', // taxonomy name
                    'field' => 'term_id', // term_id, slug or name
                    'terms' => $tax_id, // term id, term slug or term name
                )
            )
        );
        $wp_query = new WP_Query($arr);
        echo '    <div class="list-group" style="font-size: 13px">';
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                if ($post_id == get_the_ID())
                    continue;
                ?>
                <a href="<?php the_permalink(); ?>" class="list-group-item item-text"><?php the_title(); ?></a>
                <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
        echo '</ul>';
    }

    public function view_post($tax_id, $post_id, $offset) {
        global $wp_query;


        $showNum = 20;
        $arr = array(
            'post_type' => 'post',
            'cat' => $tax_id,
            'posts_per_page' => $showNum,
             'offset' => $offset,
            'orderby' => 'ID',
            'order' => 'DESC',
        );
        $wp_query = new WP_Query($arr);
        ?>
        <h2 class="orther_post">其他訊息</h2>
        <?php
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                if ($post_id == get_the_ID())
                    continue;
                ?>
                <div class="in-group-list">
                    <div style="margin-bottom: 5px; font-weight:  bold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div> 
                    <div style="margin-left: 10px">
                        <?php
//                        echo substr(get_the_content(), 0, 200) . '.....'; 
                          the_content_feed();
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
        endif;
        ?>
        <div class="more">  
            <?php
            switch ($tax_id) {
                case 1:
                    $page_link = 'news';
                    break;
                case 2 :
                    $page_link = 'assembly';
                    break;
                case 16:
                    $page_link = 'event';
                    break;
            }
            ?>
            <a  class="btn btn-primary" href="<?php echo home_url($page_link); ?>" >更多</a>
        </div>
        <?php
    }

}
?>
