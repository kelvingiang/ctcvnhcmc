<?php

function suite_seo_metaboxes_add() {

    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (!in_array($post_type, array('silder', 'orders', 'hoitruong','hoivien','friend-link'))) {
            add_meta_box('seo-meta-box', __('SEO 網 頁 搜 索', 'suite'), 'suite_seo_metabox', $post_type, 'normal', 'high');
        }
    }
}

function suite_seo_metabox($post) {
    
    $custom = get_post_custom($post->ID);

    if (isset($custom['seo_title'][0])) {
        $seo_title = $custom['seo_title'][0];
    }
    if (isset($custom['seo_description'][0])) {
        $seo_description = $custom['seo_description'][0];
    }
    if (isset($custom['seo_keywords'][0])) {
        $seo_keywords = $custom['seo_keywords'][0];
    }
    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');

    
    if (!empty($seo_title)) {
        $seo_title_val = $seo_title;
    }
    if (!empty($seo_keywords)) {
        $seo_keywords_val = $seo_keywords;
    }
    if (!empty($seo_description)) {
        $seo_description_val = $seo_description;
    }

?>
<p>
    <label for="seo_title" class="label-admin"><?php _e('SEO 標 題') ?></label>
    <input type="text" id="seo_title" name="seo_title" value="<?php echo $seo_title_val ?>" style="display: block; width: 100%"/>
</p>
<p>
    <label for="seo_description" class="label-admin"><?php _e('SEO 內 容') ?></label>
    <textarea id="seo_description" name="seo_description" style="display: block; width: 100%" maxlength="60" ><?php echo $seo_description_val; ?></textarea>
</p>
<p>
    <label for="seo_keywords" class="label-admin"><?php _e('Keywords SEO 關鍵字') ?></label>
    <textarea id="seo_keywords" name="seo_keywords" style="display: block; width: 100%"><?php echo $seo_keywords_val; ?></textarea>
</p>
<?php
}

if (is_admin()) {
    add_action('add_meta_boxes', 'suite_seo_metaboxes_add');
    add_action( 'save_post', 'suite_seo_metabox_save');
}

function suite_seo_metabox_save( $post_id ) {
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
            return;
        }

	//Custom fields
	if (isset($_POST['seo_title'])) {
		update_post_meta( $post_id, 'seo_title', esc_attr($_POST['seo_title']));
	}
	if (isset($_POST['seo_description'])) {
		update_post_meta( $post_id, 'seo_description', esc_attr($_POST['seo_description']));
	}
	if (isset($_POST['seo_keywords'])) {
		update_post_meta( $post_id, 'seo_keywords', esc_attr($_POST['seo_keywords']));
	}
}