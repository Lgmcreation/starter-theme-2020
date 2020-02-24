<?php
if ( !defined('ABSPATH') ) die();
//GUTENBERG
	function lgm_theme_setup_gutenberg() {

	add_theme_support('editor-styles');
	add_editor_style( 'style-editor.css' );
	//BLOC LARGE
	add_theme_support( 'align-wide' );
	//COLOR
	add_theme_support( 'disable-custom-colors' );
	//FONT
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => __( 'Small', 'lgm-theme' ),
			'shortName' => __( 'S', 'lgm-theme' ),
			'size' => 14,
			'slug' => 'small'
		),
		array(
			'name' => __( 'Large', 'lgm-theme' ),
			'shortName' => __( 'L', 'lgm-theme' ),
			'size' => 22,
			'slug' => 'large'
		),
	));
	add_theme_support('disable-custom-font-sizes');

	//EMBEDS
	add_theme_support( 'responsive-embeds' );

}
add_action( 'after_setup_theme', 'lgm_theme_setup_gutenberg' );

/**
 * Disable Editor
 *
 * @package      ClientName
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/
/**
 * Templates and Page IDs without editor
 *
 */
function lgm_disable_editor( $id = false ) {
	$excluded_templates = array(
		'page-accueil.php',
		'page-contact.php',
	);
	$excluded_ids = array(
		// get_option( 'page_on_front' )
	);
	if( empty( $id ) )
		return false;
	$id = intval( $id );
	$template = get_page_template_slug( $id );
	return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}
/**
 * Disable Gutenberg by template
 *
 */
function lgm_disable_gutenberg( $can_edit, $post_type ) {
	if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
		return $can_edit;
	if( lgm_disable_editor( $_GET['post'] ) )
		$can_edit = false;
	return $can_edit;
}
add_filter( 'gutenberg_can_edit_post_type', 'lgm_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'lgm_disable_gutenberg', 10, 2 );
/**
 * Disable Classic Editor by template
 *
 */
function lgm_disable_classic_editor() {
	$screen = get_current_screen();
	if( 'page' !== $screen->id || ! isset( $_GET['post']) )
		return;
	if( lgm_disable_editor( $_GET['post'] ) ) {
		remove_post_type_support( 'page', 'editor' );
	}
}
add_action( 'admin_head', 'lgm_disable_classic_editor' );