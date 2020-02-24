<?php
if ( !defined('ABSPATH') ) die();
/**
* ADMINISTRATION
**/

/*supprimer dashbord article ... + logo wordpress*/
function lgm_theme_admin_head() {
	$blog_url = get_bloginfo('url');
	$templ_url = get_bloginfo('template_url');
	echo '<link rel="shortcut icon" href="'.$blog_url.'/favicon.ico" />';
	echo '<link rel="apple-touch-icon" href="'.$blog_url.'/apple-touch-icon.png"/>';
	echo '<style type="text/css">#wp-admin-bar-wp-logo,#wp-admin-bar-comments,#wp-admin-bar-new-content,#wp-admin-bar-wpseo-menu,.versions,.table_discussion,.b.b-posts,.t.posts,.b.b-cats,.t.cats,.b.b-tags,.t.tags{display:none;}.inside {overflow: hidden;}</style>';
}

add_action('admin_head', 'lgm_theme_admin_head');

/*supprimer fonction dashboard*/

function lgm_theme_disable_default_dashboard_widgets() {
	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');
	remove_meta_box('dashboard_activity', 'dashboard', 'core');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');          // Autres news WordPress
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');            // News WordPress
}

add_action('admin_menu', 'lgm_theme_disable_default_dashboard_widgets');

// Modifier les crédits dans l'administration

function lgm_theme_wp_admin_footer () {
	echo "";
}

add_filter('admin_footer_text', 'lgm_theme_wp_admin_footer');