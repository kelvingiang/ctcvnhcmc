<?php 

	novalite_bottom_content();
	do_action( 'novalite_socials' ); 
	
?>
    
<footer id="footer">
	<div class="container">
		<div class="row" >
             
			<div class="span12 copyright" >
            
                <p>
                    <?php if (novalite_setting('novalite_copyright_text')): ?>
                       <?php echo stripslashes(novalite_setting('novalite_copyright_text','html')); ?>
                    <?php else: ?>
                      <?php _e('Copyright','novalite'); ?> <?php echo get_bloginfo("name"); ?> <?php echo date("Y"); ?> 
                    <?php endif; ?> 
                    | <?php _e('Theme by','novalite'); ?> <a href="http://www.themeinprogress.com/" target="_blank">Theme in Progress</a> |
                    <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'novalite' ) ); ?>" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'novalite' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'novalite' ), 'WordPress' ); ?></a>
                
                </p>
			
            </div>
                
		</div>
	</div>
</footer>
    
<div id="back-to-top">
<a href="#" style=""><i class="icon-chevron-up"></i></a> 
</div>
    
<?php wp_footer() ?>  
 
</body>

</html>