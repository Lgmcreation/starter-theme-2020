<?php
if ( !defined('ABSPATH') ) die();
/**
* Clean wp_head
*/
function lgm_theme_head_clean() {
	//Clean wp_head
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'parent_post_rel_link');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);        
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);      
	remove_action('wp_head', 'print_emoji_detection_script', 7 ); 

	//Remove the WordPress version from RSS feeds
	add_filter('the_generator', '__return_false');     

}
add_action('init', 'lgm_theme_head_clean');


/**
* Add and remove body_class() classes
*/
function lgm_theme_body_class($classes) {
	// Add post/page slug
	if (is_single() || is_page() && !is_front_page()) {
		$classes[] = basename(get_permalink());
	}

	// Remove unnecessary classes
	$home_id_class = 'page-id-' . get_option('page_on_front');
	$remove_classes = array(
		'page-template-default',
		$home_id_class
	);
	$classes = array_diff($classes, $remove_classes);

	return $classes;
}
add_filter('body_class', 'lgm_theme_body_class');

//Remove oembed js footer
function deregister_scripts_oembed_footer(){
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'deregister_scripts_oembed_footer' );

//Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');

// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );

//Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

//Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');

//Remove oEmbed JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');