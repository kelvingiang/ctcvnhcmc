<?php 

/**
 * Wp in Progress
 * 
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

function novalite_before_content_function() { 

	global $post;

?>

    <div class="line"> 
    
        <div class="entry-info">
       
            <div class="entry-date"><strong> <?php _e( 'Posted on:','novalite'); ?> </strong> <?php echo get_the_date(); ?> <span class="sep">/</span> </div>
            
            <?php if  ( ( comments_open() ) && (novalite_setting('novalite_view_comments') == "on" ) ) : ?>
                <div class="entry-comments"> <strong><?php _e( 'Comments: ','novalite'); ?></strong>
                    <?php echo comments_number( '<a href="'.get_permalink($post->ID).'#respond">'.__( "No comments","novalite").'</a>', '<a href="'.get_permalink($post->ID).'#comments">1 '.__( "comment","novalite").'</a>', '<a href="'.get_permalink($post->ID).'#comments">% '.__( "comments","novalite").'</a>' ); ?>
                <span class="sep">/</span> </div> 
            <?php endif; ?>
            
            <div class="entry-standard"> 
            	<strong> <?php _e( 'Categories: ','novalite'); echo the_category(', '); ?> </strong>
            </div>

        </div>

    </div>
    
<?php

} 

add_action( 'novalite_before_content', 'novalite_before_content_function', 10, 2 );

?>