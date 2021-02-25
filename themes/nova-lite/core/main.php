<?php

/**
 * Wp in Progress
 * 
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

/*-----------------------------------------------------------------------------------*/
/* TAG TITLE */
/*-----------------------------------------------------------------------------------*/  

if ( ! function_exists( '_wp_render_title_tag' ) ) {

	function novalite_title( $title, $sep ) {
		
		global $paged, $page;
	
		if ( is_feed() )
			return $title;
	
		$title .= get_bloginfo( 'name' );
	
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";
	
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'novalite' ), max( $paged, $page ) );
	
		return $title;
		
	}

	add_filter( 'wp_title', 'novalite_title', 10, 2 );

	function novalite_addtitle() {
		
?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php

	}

	add_action( 'wp_head', 'novalite_addtitle' );

}

/*-----------------------------------------------------------------------------------*/
/* REQUIRE */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('novalite_require')) {

	function novalite_require($folder) {
	
		if (isset($folder)) : 
	
			if ( ( !novalite_setting('novalite_loadsystem') ) || ( novalite_setting('novalite_loadsystem') == "mode_a" ) ) {
		
				$folder = dirname(dirname(__FILE__)) . $folder ;  
				
				$files = scandir($folder);  
				  
				foreach ($files as $key => $name) {  
				
					if ( (!is_dir($name)) && ( $name <> ".DS_Store" ) ) { 
					
						require_once $folder . $name;
					
					} 
				}  
			
			} else if ( novalite_setting('novalite_loadsystem') == "mode_b" ) {
	
				$dh  = opendir(get_template_directory().$folder);
				
				while (false !== ($filename = readdir($dh))) {
				   
					if ( ( strlen($filename) > 2 ) && ( $filename <> ".DS_Store" ) ) {
					
						require_once get_template_directory()."/".$folder.$filename;
					
					}
				}
			}
		
		endif;
		
	}

}

/*-----------------------------------------------------------------------------------*/
/* SCRIPTS */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('novalite_enqueue_script')) {

	function novalite_enqueue_script($folder) {
	
		if (isset($folder)) : 
	
			if ( ( !novalite_setting('novalite_loadsystem') ) || ( novalite_setting('novalite_loadsystem') == "mode_a" ) ) {
		
				$dir = dirname(dirname(__FILE__)) . $folder ;  
				
				$files = scandir($dir);  
				  
				foreach ($files as $key => $name) {  

					if ( (!is_dir($name)) && ( $name <> ".DS_Store" ) ) { 
						
						wp_enqueue_script( str_replace('.js','',$name), get_template_directory_uri() . $folder . "/" . $name , array('jquery'), FALSE, TRUE ); 
						
					} 
				}  
			
			} else if ( novalite_setting('novalite_loadsystem') == "mode_b" ) {
	
				$dh  = opendir(get_template_directory().$folder);
				
				while (false !== ($filename = readdir($dh))) {
				   
					if ( ( strlen($filename) > 2 ) && ( $filename <> ".DS_Store" ) ) {
						
						wp_enqueue_script( str_replace('.js','',$filename), get_template_directory_uri() . $folder . "/" . $filename , array('jquery'), FALSE, TRUE ); 
					
					}
					
				}
		
			}
			
		endif;
	
	}

}

/*-----------------------------------------------------------------------------------*/
/* STYLES */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('novalite_enqueue_style')) {

	function novalite_enqueue_style($folder) {
	
		if (isset($folder)) : 
	
			if ( ( !novalite_setting('novalite_loadsystem') ) || ( novalite_setting('novalite_loadsystem') == "mode_a" ) ) {
			
				$dir = dirname(dirname(__FILE__)) . $folder ;  
				
				$files = scandir($dir);  
				  
				foreach ($files as $key => $name) {  
					
					if ( (!is_dir($name)) && ( $name <> ".DS_Store" ) ) { 
						
						wp_enqueue_style( str_replace('.css','',$name), get_template_directory_uri() . $folder . "/" . $name ); 
						
					} 
				}  
			
			
			} else if ( novalite_setting('novalite_loadsystem') == "mode_b" ) {
	
				$dh  = opendir(get_template_directory().$folder);
				
				while (false !== ($filename = readdir($dh))) {
				   
					if ( ( strlen($filename) > 2 ) && ( $filename <> ".DS_Store" ) ) {
						
						wp_enqueue_style( str_replace('.css','',$filename), get_template_directory_uri() . $folder . "/" . $filename ); 
				
					}
				
				}
			
			}
		
		endif;
	
	}

}

/*-----------------------------------------------------------------------------------*/
/* THEME SETTINGS */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('novalite_setting')) {

	function novalite_setting( $id, $type = "attr" ) {

		$sanitation = array(
			
			"attr" => array( "function" => "esc_attr", "controls" => "" ),
			"html" => array( "function" => "esc_html", "controls" => "" ),
			"url"  => array( "function" => "esc_url",  "controls" => array('http', 'https', 'skype', 'mailto') ),
			
		);
		
		$novalite_setting = call_user_func( $sanitation[$type]["function"], get_theme_mod($id), $sanitation[$type]["controls"] );
		
		if (isset($novalite_setting)) :
			
			return $novalite_setting;
	
		endif;

	}
	
}

/*-----------------------------------------------------------------------------------*/
/* POST META */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('novalite_postmeta')) {

	function novalite_postmeta($id) {
	
		global $post;
		
		if (!is_404()) {
			$val = get_post_meta( $post->ID , $id, TRUE);
			if(isset($val))
			return $val;
		} else {
			return null;
		}
	
	}

}

/*-----------------------------------------------------------------------------------*/
/* CONTENT TEMPLATE */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('novalite_template')) {

	function novalite_template($id) {
	
		$template = array ("full" => "span12" , "left-sidebar" => "span8" , "right-sidebar" => "span8" );
	
		$span = $template["full"];
		$sidebar =  "full";
	
		if ( ( is_search() ) && ( novalite_setting('novalite_search_layout')) ) {
			
			$span = $template[novalite_setting('novalite_search_layout')];
			$sidebar =  novalite_setting('novalite_search_layout');
				
		} else if ( ( (is_category()) || (is_tag()) || (is_tax()) || (is_month()) ) && ( novalite_setting('novalite_category_layout')) ) {
			
			$span = $template[novalite_setting('novalite_category_layout')];
			$sidebar =  novalite_setting('novalite_category_layout');
				
		} else if ( ( is_home() ) && ( novalite_setting('novalite_home')) ) {
			
			$span = $template[novalite_setting('novalite_home')];
			$sidebar =  novalite_setting('novalite_home');
				
		} else if ( ( is_home() ) && ( !novalite_setting('novalite_home')) ) {
			
			$span = $template["right-sidebar"];
			$sidebar =  "right-sidebar";
				
		} else if (novalite_postmeta('novalite_template')) {
			
			$span = $template[novalite_postmeta('novalite_template')];
			$sidebar =  novalite_postmeta('novalite_template');
				
		}
	
		return ${$id};
		
	}

}

/*-----------------------------------------------------------------------------------*/
/* GET PAGED */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('novalite_paged')) {

	function novalite_paged() {
		
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		return $paged;
		
	}

}

/*-----------------------------------------------------------------------------------*/
/* PRETTYPHOTO */
/*-----------------------------------------------------------------------------------*/   

if (!function_exists('novalite_prettyPhoto')) {

	function novalite_prettyPhoto( $html, $id, $size, $permalink, $icon, $text ) {
		
		if ( ! $permalink )
			return str_replace( '<a', '<a data-rel="prettyPhoto" ', $html );
		else
			return $html;
	}
	
	add_filter( 'wp_get_attachment_link', 'novalite_prettyPhoto', 10, 6);

}

/*-----------------------------------------------------------------------------------*/
/* CUSTOM EXCERPT MORE */
/*-----------------------------------------------------------------------------------*/   

if (!function_exists('novalite_new_excerpt_more')) {

	function novalite_new_excerpt_more() {
		
		global $post;
		return '<p><a class="button" href="'.get_permalink($post->ID).'" title="More">  ' . __( "Read More","novalite") . ' →</a></p>';
	
	}
	
	add_filter('excerpt_more', 'novalite_new_excerpt_more');

}

/*-----------------------------------------------------------------------------------*/
/* REMOVE CATEGORY LIST REL */
/*-----------------------------------------------------------------------------------*/   

if (!function_exists('novalite_remove_category_list_rel')) {

	function novalite_remove_category_list_rel($output) {
		$output = str_replace('rel="category"', '', $output);
		return $output;
	}
	
	add_filter('wp_list_categories', 'novalite_remove_category_list_rel');
	add_filter('the_category', 'novalite_remove_category_list_rel');

}

/*-----------------------------------------------------------------------------------*/
/* REMOVE THUMBNAIL DIMENSION */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('novalite_remove_thumbnail_dimensions')) {

	function novalite_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}
	
	add_filter( 'post_thumbnail_html', 'novalite_remove_thumbnail_dimensions', 10, 3 );
	
}

/*-----------------------------------------------------------------------------------*/
/* REMOVE CSS GALLERY */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('novalite_my_gallery_style')) {

	function novalite_my_gallery_style() {
		return "<div class='gallery'>";
	}
	
	add_filter( 'gallery_style', 'novalite_my_gallery_style', 99 );

}

/*-----------------------------------------------------------------------------------*/
/* IE8 SCRIPTS */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('novalite_ie8_scripts')) {

	function novalite_ie8_scripts() { ?>

<!--[if IE 8]>
    <script src="<?php echo get_template_directory_uri(); ?>/inc/scripts/html5.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/inc/scripts/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->

<?php

	}
	
	add_action('wp_head', 'novalite_ie8_scripts');

	
}

/*-----------------------------------------------------------------------------------*/
/* STYLES AND SCRIPTS */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('novalite_scripts_styles')) {

	function novalite_scripts_styles() {

		global $wp_styles;

		wp_enqueue_style( 'my-theme-ie', get_stylesheet_directory_uri() . "/inc/css/ie.css", array( 'my-theme' )  );
		$wp_styles->add_data( 'my-theme-ie', 'conditional', 'chrome' );

		novalite_enqueue_style('/inc/css');

		if ( ( get_theme_mod('novalite_skin') ) && ( get_theme_mod('novalite_skin') <> "turquoise" ) ):
	
			wp_enqueue_style( 'novalite-' . get_theme_mod('novalite_skin') , get_template_directory_uri() . '/inc/skins/' . get_theme_mod('novalite_skin') . '.css' ); 
		endif;

		wp_enqueue_style( 'suevafree-google-fonts', '//fonts.googleapis.com/css?family=Montez|Oxygen|Yanone+Kaffeesatz&subset=latin,latin-ext' );

		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	
		wp_enqueue_script( "jquery-ui-core", array('jquery'));
		wp_enqueue_script( "jquery-ui-tabs", array('jquery'));
		
		novalite_enqueue_script('/inc/js');
	
	}
	
	add_action( 'wp_enqueue_scripts', 'novalite_scripts_styles' );

}

/*-----------------------------------------------------------------------------------*/
/* THEME SETUP */
/*-----------------------------------------------------------------------------------*/   

if (!function_exists('novalite_setup')) {

	function novalite_setup() {

		if ( ! isset( $content_width ) )
			$content_width = 1170;

		add_theme_support( 'post-formats', array( 'aside','gallery','quote','video','audio','link','status','chat','image' ) );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
	
		add_theme_support( 'title-tag' );
	
		if (novalite_setting('novalite_body_background')):
			$background = novalite_setting('novalite_body_background');
		else:
			$background = "/inc/images/background/patterns/pattern12.jpg";
		endif;
		
		add_theme_support( 'custom-background', array(
			'default-color' => 'f3f3f3',
			'default-image' => get_template_directory_uri() . $background,
		) );
	
		add_image_size( 'blog', 1170,429, TRUE ); 
		add_image_size( 'slide', 1170,429, TRUE ); 
		
		add_image_size( 'large', 449,304, TRUE ); 
		add_image_size( 'medium', 290,220, TRUE ); 
		add_image_size( 'small', 211,150, TRUE ); 

		register_nav_menu( 'main-menu', 'Main menu' );
	
		load_theme_textdomain('novalite', get_template_directory() . '/languages');
		
		$require_array = array (
			"/core/classes/",
			"/core/admin/customize/",
			"/core/functions/",
			"/core/templates/",
			"/core/metaboxes/",
		);
		
		foreach ( $require_array as $require_file ) {	
		
			novalite_require($require_file);
		
		}
		
	}

	add_action( 'after_setup_theme', 'novalite_setup' );

}

?>