<?php
if ( !defined('ABSPATH') ) die();

/**
* Theme includes
*/
require_once locate_template('/admin/init.php');  // Setup I18n add_theme_support TinyMce Gallery
require_once locate_template('/admin/gutenberg.php');         // Menu Dashboard Client
require_once locate_template('/admin/security.php');         // Security
require_once locate_template('/admin/clean.php');         // Clean Head Bodyclass ponctuation 
require_once locate_template('/admin/nav.php');        // Nav 
require_once locate_template('/admin/blog.php');      // Blog 
require_once locate_template('/admin/script.php');         // Scripts and stylesheets
require_once locate_template('/admin/admin.php');         // Dashboard
require_once locate_template('/admin/client.php');         // Menu Dashboard Client
/**
* Plugin includes
*/
require_once locate_template('/admin/yoast.php');         // YOAST
require_once locate_template('/admin/acf.php');         // ACF What else