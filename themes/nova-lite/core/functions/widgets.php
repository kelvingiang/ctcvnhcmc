<?php

function novalite_widgets_init() {
	
	register_sidebar(array(
	
		'name' => __('Sidebar', 'novalite'),
		'id'   => 'side_sidebar_area',
		'description'   => __('This sidebar will be shown at the side of content.','novalite'),
		'before_widget' => '<div class="pin-article span4"><div class="article">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>'
	
	));

	register_sidebar(array(

		'name' => __('Header Sidebar', 'novalite'),
		'id'   => 'header_sidebar_area',
		'description'   => __('This sidebar will be shown before the content.','novalite'),
		'before_widget' => '<div class="pin-article span4"><div class="article">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>'
	
	));

	register_sidebar(array(

		'name' => __('Bottom Sidebar', 'novalite'),
		'id'   => 'bottom_sidebar_area',
		'description'   => __('This sidebar will be shown after the content.','novalite'),
		'before_widget' => '<div class="span4"><div class="widget-box">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>'
	
	));
}

add_action( 'widgets_init', 'novalite_widgets_init' );

?>