<?php

echo __FILE__;
// PART GIAN TIEP;
define('HCM_DIR_CONTROLER', THEME_URL . DS . 'controlers' . DS);
define('HCM_DIR_MODEL', THEME_URL . DS . 'models' . DS);
define('HCM_DIR_VIEW', THEME_URL . DS . 'views' . DS);
define('HCM_DIR_METABOX', THEME_URL . DS . 'metabox' . DS);
define('HCM_DIR_CLASS', THEME_URL . DS . 'class' . DS);
define('HCM_DIR_SHORTCODE', THEME_URL . DS . 'shortcode' . DS);

// PART TRUC TIEP;     
define('THEME_PART', get_template_directory_uri());
define('HCM_URI_IMAGES', THEME_PART . DS . 'images' . DS);
define('HCM_URI_ICON', HCM_URI_IMAGES . 'icon' . DS);
define('HCM_URI_CSS', THEME_PART . DS . 'css' . DS);
define('HCM_URI_JS', THEME_PART . DS . 'js' . DS);

