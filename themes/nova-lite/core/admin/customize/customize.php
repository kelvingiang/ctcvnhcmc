<?php

if (!function_exists('novalite_customize_panel_function')) {

	function novalite_customize_panel_function() {
		
		$theme_panel = array ( 

			array(
				
				"label" => __( "Full Image Background","novalite"),
				"description" => __( "Do you want to set a full background image? (After the upload, check 'Fixed', from the Background Attachment section)","novalite"),
				"id" => "novalite_full_image_background",
				"type" => "select",
				"section" => "background_image",
				"options" => array (
				   "off" => __( "No","novalite"),
				   "on" => __( "Yes","novalite"),
				),
				
				"std" => "off",
			
			),

			/* START GENERAL SECTION */ 

			array( 
				
				"title" => __( "General","novalite"),
				"description" => __( "General","novalite"),
				"type" => "panel",
				"id" => "general_panel",
				"priority" => "10",
				
			),

			array( 

				"title" => __( "Load system","novalite"),
				"type" => "section",
				"id" => "loadsystem_section",
				"panel" => "general_panel",
				"priority" => "10",

			),

			array(
				
				"label" => __( "Choose a load system","novalite"),
				"description" => __( "Select a load system, if you've some problems with the theme (for example a blank page).","novalite"),
				"id" => "novalite_loadsystem",
				"type" => "select",
				"section" => "loadsystem_section",
				"options" => array (
				   "mode_a" => __( "Mode a","novalite"),
				   "mode_b" => __( "Mode b","novalite"),
				),
				
				"std" => "mode_a",
			
			),

			/* SKINS */ 

			array( 

				"title" => __( "Color Scheme","novalite"),
				"type" => "section",
				"panel" => "general_panel",
				"priority" => "11",
				"id" => "colorscheme_section",

			),

			array(
				
				"label" => __( "Predefined Color Schemes","novalite"),
				"description" => __( "Choose your Color Scheme","novalite"),
				"id" => "novalite_skin",
				"type" => "select",
				"section" => "colorscheme_section",
				"options" => array (

				   "turquoise" => __( "Turquoise","novalite"),
				   "orange" => __( "Orange","novalite"),
				   "blue" => __( "Blue","novalite"),
				   "red" => __( "Red","novalite"),
				   "purple" => __( "Purple","novalite"),
				   "yellow" => __( "Yellow","novalite"),
				   "green" => __( "Green","novalite"),
				   "light_turquoise" => __( "Light & Turquoise","novalite"),
				   "light_orange" => __( "Light & Orange","novalite"),
				   "light_blue" => __( "Light & Blue","novalite"),
				   "light_red" => __( "Light & Red","novalite"),
				   "light_purple" => __( "Light & Purple","novalite"),
				   "light_yellow" => __( "Light & Yellow","novalite"),
				   "light_green" => __( "Light & Green","novalite"),

				),
				
				"std" => "orange",
			
			),

			/* SETTINGS SECTION */ 

			array( 

				"title" => __( "Styles","novalite"),
				"type" => "section",
				"id" => "styles_section",
				"panel" => "general_panel",
				"priority" => "12",

			),

			array( 

				"label" => __( "Custom css","novalite"),
				"description" => __( "Insert your custom css code.","novalite"),
				"id" => "novalite_custom_css_code",
				"type" => "custom_css",
				"section" => "styles_section",
				"std" => "",

			),

			/* LAYOUTS SECTION */ 

			array( 

				"title" => __( "Layouts","novalite"),
				"type" => "section",
				"id" => "layouts_section",
				"panel" => "general_panel",
				"priority" => "13",

			),

			array(
				
				"label" => __("Home Blog Layout","novalite"),
				"description" => __("If you've set the latest articles, for the homepage, choose a layout.","novalite"),
				"id" => "novalite_home",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
				   "full" => __( "Full Width","novalite"),
				   "left-sidebar" => __( "Left Sidebar","novalite"),
				   "right-sidebar" => __( "Right Sidebar","novalite"),
				),
				
				"std" => "right-sidebar",
			
			),

			array(
				
				"label" => __("Category Layout","novalite"),
				"description" => __("Select a layout for category pages.","novalite"),
				"id" => "novalite_category_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
				   "full" => __( "Full Width","novalite"),
				   "left-sidebar" => __( "Left Sidebar","novalite"),
				   "right-sidebar" => __( "Right Sidebar","novalite"),
				),
				
				"std" => "right-sidebar",
			
			),

			array(
				
				"label" => __("Search Layout","novalite"),
				"description" => __("Select a layout for search page.","novalite"),
				"id" => "novalite_search_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
				   "full" => __( "Full Width","novalite"),
				   "left-sidebar" => __( "Left Sidebar","novalite"),
				   "right-sidebar" => __( "Right Sidebar","novalite"),
				),
				
				"std" => "right-sidebar",
			
			),

			/* HEADER AREA SECTION */ 

			array( 

				"title" => __( "Header","novalite"),
				"type" => "section",
				"id" => "header_section",
				"panel" => "general_panel",
				"priority" => "14",

			),

			array( 

				"label" => __( "Custom Logo","novalite"),
				"description" => __( "Insert the url of your custom logo","novalite"),
				"id" => "novalite_custom_logo",
				"type" => "upload",
				"section" => "header_section",
				"std" => "",

			),

			/* FOOTER AREA SECTION */ 

			array( 

				"title" => __( "Footer","novalite"),
				"type" => "section",
				"id" => "footer_section",
				"panel" => "general_panel",
				"priority" => "15",

			),

			array( 

				"label" => __( "Copyright Text","novalite"),
				"description" => __( "Insert your copyright text.","novalite"),
				"id" => "novalite_copyright_text",
				"type" => "textarea",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Facebook Url","novalite"),
				"description" => __( "Insert Facebook Url (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_facebook_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Twitter Url","novalite"),
				"description" => __( "Insert Twitter Url (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_twitter_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Flickr Url","novalite"),
				"description" => __( "Insert Flickr Url (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_flickr_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Google Url","novalite"),
				"description" => __( "Insert Google Url (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_google_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Linkedin Url","novalite"),
				"description" => __( "Insert Linkedin Url (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_linkedin_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Pinterest Url","novalite"),
				"description" => __( "Insert Pinterest Url (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_pinterest_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Tumblr Url","novalite"),
				"description" => __( "Insert Tumblr Url (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_tumblr_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Youtube Url","novalite"),
				"description" => __( "Insert Youtube Url (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_youtube_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Skype Url","novalite"),
				"description" => __( "Insert Skype ID (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_skype_button",
				"type" => "button",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Instagram Url","novalite"),
				"description" => __( "Insert Instagram ID (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_instagram_button",
				"type" => "button",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Github Url","novalite"),
				"description" => __( "Insert Github ID (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_github_button",
				"type" => "button",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Email Address","novalite"),
				"description" => __( "Insert Email Address (empty if you want to hide the button)","novalite"),
				"id" => "novalite_footer_email_button",
				"type" => "button",
				"section" => "footer_section",
				"std" => "",

			),

			array(
				
				"label" => __( "Feed Rss Button","novalite"),
				"description" => __( "Do you want to display the Feed Rss button?","novalite"),
				"id" => "novalite_footer_rss_button",
				"type" => "select",
				"section" => "footer_section",
				"options" => array (
				   "off" => __( "No","novalite"),
				   "on" => __( "Yes","novalite"),
				),
				
				"std" => "off",
			
			),

			/* TYPOGRAPHY SECTION */ 

			array( 
				
				"title" => __( "Typography","novalite"),
				"description" => __( "Typography","novalite"),
				"type" => "panel",
				"id" => "typography_panel",
				"priority" => "11",
				
			),

			/* LOGO */ 

			array( 

				"title" => __( "Logo","novalite"),
				"type" => "section",
				"id" => "logo_section",
				"panel" => "typography_panel",
				"priority" => "10",

			),

			array( 

				"label" => __( "Font size","novalite"),
				"description" => __( "Insert a size, for logo font (For example, 70px) ","novalite"),
				"id" => "novalite_logo_font_size",
				"type" => "text",
				"section" => "logo_section",
				"std" => "70px",

			),
			
			/* MENU */ 

			array( 

				"title" => __( "Menu","novalite"),
				"type" => "section",
				"id" => "menu_section",
				"panel" => "typography_panel",
				"priority" => "12",

			),

			array( 

				"label" => __( "Font size","novalite"),
				"description" => __( "Insert a size, for menu font (For example, 14px) ","novalite"),
				"id" => "novalite_menu_font_size",
				"type" => "text",
				"section" => "menu_section",
				"std" => "14px",

			),

			/* CONTENT */ 

			array( 

				"title" => __( "Content","novalite"),
				"type" => "section",
				"id" => "content_section",
				"panel" => "typography_panel",
				"priority" => "13",

			),

			array( 

				"label" => __( "Font size","novalite"),
				"description" => __( "Insert a size, for content font (For example, 14px) ","novalite"),
				"id" => "novalite_content_font_size",
				"type" => "text",
				"section" => "content_section",
				"std" => "14px",

			),


			/* HEADLINES */ 

			array( 

				"title" => __( "Headlines","novalite"),
				"type" => "section",
				"id" => "headlines_section",
				"panel" => "typography_panel",
				"priority" => "14",

			),

			array( 

				"label" => __( "H1 headline","novalite"),
				"description" => __( "Insert a size, for H1 elements (For example, 24px) ","novalite"),
				"id" => "novalite_h1_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "24px",

			),

			array( 

				"label" => __( "H2 headline","novalite"),
				"description" => __( "Insert a size, for H2 elements (For example, 22px) ","novalite"),
				"id" => "novalite_h2_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "22px",

			),

			array( 

				"label" => __( "H3 headline","novalite"),
				"description" => __( "Insert a size, for H3 elements (For example, 20px) ","novalite"),
				"id" => "novalite_h3_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "20px",

			),

			array( 

				"label" => __( "H4 headline","novalite"),
				"description" => __( "Insert a size, for H4 elements (For example, 18px) ","novalite"),
				"id" => "novalite_h4_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "18px",

			),

			array( 

				"label" => __( "H5 headline","novalite"),
				"description" => __( "Insert a size, for H5 elements (For example, 16px) ","novalite"),
				"id" => "novalite_h5_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "16px",

			),

			array( 

				"label" => __( "H6 headline","novalite"),
				"description" => __( "Insert a size, for H6 elements (For example, 14px) ","novalite"),
				"id" => "novalite_h6_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "14px",

			),
		);
		
		new novalite_customize($theme_panel);
		
	} 
	
	add_action( 'novalite_customize_panel', 'novalite_customize_panel_function', 10, 2 );

}

do_action('novalite_customize_panel');

?>