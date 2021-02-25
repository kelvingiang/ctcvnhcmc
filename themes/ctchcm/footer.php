<div class="clear"></div>
</div>

</div>
</div>
<footer id="footer" role="contentinfo">
    <div id="footer-content" >
        <div id="friendlink">
            <ul>
                <?php
                $arr = array(
                    'post_status' => 'publish',
                    'post_type' => 'friend-link',
                    'posts_per_page' => -1,
                    'order' => 'ASC',
                    'orderby' => 'meta_value_num',
                    'meta_key' => '_friendlink_order'
                );

                $wp_query = new WP_Query($arr);

                if (have_posts($wp_query)) {
                    while (have_posts($wp_query)) {
                        the_post();
                        ?>
                        <li>
                            <a href="http://<?php echo get_post_meta(get_the_ID(), '_friendlink_web', true); ?>" target="_blank"><?php the_title() ?></a> 
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div id="copyright">
            <div class="col-lg-7 col-xs-12">
                <label><?php _e('Address'); ?> :  <?php echo get_option('website_address') ?></label><br>
                <label><?php _e('Phone'); ?> (Tel) :  <?php echo get_option('website_phone') ?></label> &nbsp; | &nbsp;
                <label><?php _e('Fax'); ?>(Fax ) :  <?php echo get_option('website_fax') ?></label><br>
                <label><?php _e('Email'); ?> (Email) : <?php echo get_option('website_email') ?></label>
            </div>
            <div class="col-lg-5 col-xs-12 banquyen " >
                <?php
                echo sprintf(__('%1$s %2$s %3$s. All Rights Reserved.', 'blankslate'), '&copy;', date('Y'), esc_html(get_bloginfo('name')));
                echo sprintf(__(' Theme By: %1$s.', 'blankslate'), 'Digiwin');
                ?>
            </div>
        </div>
    </div>
</footer>
    

<?php
require_once HCM_DIR_CLASS . 'my-popup.php';
wp_footer();
?>
<div id="back-top-wrapper" >
    <a id="back-top"  >
        <img  src="<?php echo get_img('up.png'); ?>" />     </a>
</div> 

</body>

</html>

