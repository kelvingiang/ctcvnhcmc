<?php

/**
 * Wp in Progress
 * 
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

$novalite_new_metaboxes = new novalite_metaboxes ('page', array (

array( "name" => "Navigation",  
       "type" => "navigation",  
       "item" => array( "setting" => __( "Setting","novalite") ),   
       "start" => "<ul>", 
       "end" => "</ul>"),  

array( "type" => "begintab",
	   "tab" => "setting",
	   "element" =>

		array( "name" => __( "Setting","novalite"),
			   "type" => "title",
		),

		array( "name" => __( "Slogan","novalite"),
			   "desc" => __( "Insert the slogan of page","novalite"),
			   "id" => "novalite_slogan",
			   "type" => "text",
		),

		array( "name" => __( "Template","novalite"),
			   "desc" => __( "Select a template for this page","novalite"),
			   "id" => "novalite_template",
			   "type" => "select",
			   "options" => array(
				   "full" => __( "Full Width","novalite"),
				   "left-sidebar" =>  __( "Left Sidebar","novalite"),
				   "right-sidebar" => __( "Right Sidebar","novalite"),
				   ),
			   "std" => "full",
		),
			  
),

array( "type" => "endtab"),

array( "type" => "endtab")
)

);


?>