<?php
if ( !defined('ABSPATH') ) die();
/**
* MENU
*/

/*Déclaration MENU*/
register_nav_menus(array(
'main-menu' => esc_html__( 'Main Menu', 'lgm-theme' ),
));

/*Retier les class et id des LI expecter les class current*/
function lgm_theme_my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item',)) : '';
}
add_filter('nav_menu_css_class', 'lgm_theme_my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'lgm_theme_my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'lgm_theme_my_css_attributes_filter', 100, 1);

/*Changer les liens vides en span*/
function lgm_theme_empty_nav_links_to_span( $item_output, $item, $depth, $args ) {
	if ( true == $item->current ) {
		$item_output = preg_replace( '/<a.*?>(.*)<\/a>/', '<span>$1</span>', $item_output );
	}
	return $item_output;
}
add_action( 'walker_nav_menu_start_el', 'lgm_theme_empty_nav_links_to_span', 10, 4 );