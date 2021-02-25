<?php function novalite_css_custom() { ?>

<style type="text/css">

<?php

/* =================== BODY STYLE =================== */

	if ( get_theme_mod('novalite_full_image_background') == "on" )
		echo "body.custombody {  -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}"; 

/* =================== BEGIN LOGO STYLE =================== */

	$logostyle = '';

	/* Logo Font Size */
	if (novalite_setting('novalite_logo_font_size')) 
		$logostyle .= "font-size:".novalite_setting('novalite_logo_font_size').";"; 
	
	if ($logostyle)
		echo '#logo a { '.$logostyle.' } ';

/* =================== END LOGO STYLE =================== */

/* =================== BEGIN NAV STYLE =================== */

	$navstyle = '';

	/* Nav  Font Size */
	if (novalite_setting('novalite_menu_font_size')) 
		$navstyle .= "font-size:".novalite_setting('novalite_menu_font_size').";"; 
	
	if ($navstyle)
		echo 'nav#mainmenu ul li a { '.$navstyle.' } ';

/* =================== END NAV STYLE =================== */

/* =================== BEGIN CONTENT STYLE =================== */

	if (novalite_setting('novalite_content_font_size')) 
		echo ".article p, .article li, .article address, .article dd, .article blockquote, .article td, .article th { font-size:".novalite_setting('novalite_content_font_size')."}"; 
	

/* =================== END CONTENT STYLE =================== */

/* =================== START TITLE STYLE =================== */

	$titlestyle = '';

	if ($titlestyle)
		echo 'h1.title, h2.title, h3.title, h4.title, h5.title, h6.title, h1, h2, h3, h4, h5, h6  { '.$titlestyle.' } ';

	if (novalite_setting('novalite_h1_font_size')) 
		echo "h1 {font-size:".novalite_setting('novalite_h1_font_size')."; }"; 
	if (novalite_setting('novalite_h2_font_size')) 
		echo "h2 { font-size:".novalite_setting('novalite_h2_font_size')."; }"; 
	if (novalite_setting('novalite_h3_font_size')) 
		echo "h3 { font-size:".novalite_setting('novalite_h3_font_size')."; }"; 
	if (novalite_setting('novalite_h4_font_size')) 
		echo "h4 { font-size:".novalite_setting('novalite_h4_font_size')."; }"; 
	if (novalite_setting('novalite_h5_font_size')) 
		echo "h5 { font-size:".novalite_setting('novalite_h5_font_size')."; }"; 
	if (novalite_setting('novalite_h6_font_size')) 
		echo "h6 { font-size:".novalite_setting('novalite_h6_font_size')."; }"; 


/* =================== END TITLE STYLE =================== */


/* =================== END LINK STYLE =================== */


	if (novalite_setting('novalite_custom_css_code'))
		echo novalite_setting('novalite_custom_css_code'); 

?>

</style>
    
<?php }

add_action('wp_head', 'novalite_css_custom');

?>