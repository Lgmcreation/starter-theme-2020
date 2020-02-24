<?php
if ( !defined('ABSPATH') ) die();
/**
* REMOVE TAGS
*/
/* suppression de la metabox des tags et des formats sur la page d'ajout/edition de posts */

function lgm_theme_remove_tags_metabox() {
	remove_meta_box('tagsdiv-post_tag', 'post', 'side');
}

add_action('admin_menu', 'lgm_theme_remove_tags_metabox');

/* suppression de la colonne "Mots-clefs" sur la liste des articles */

function lgm_theme_remove_tags_column($defaults) {
		unset($defaults['tags']);
		return $defaults;
	}

add_filter( 'manage_posts_columns', 'lgm_theme_remove_tags_column');
	
/* suppression du menu "Mots-clefs" */

function lgm_theme_remove_tags_menu() {
	global $submenu;
	unset($submenu['edit.php'][16]);
}

add_action('admin_head', 'lgm_theme_remove_tags_menu');

/**
* COMMENTS
*/
//SUPPRIME LES COMMENTAIRES de wordpress

function lgm_theme_comments_closed( $open, $post_id ) {
		$post = get_post( $post_id );
		$open = false;
		return $open;
}

add_filter('comments_open', 'lgm_theme_comments_closed', 10, 2);

//suppression de la colonne "commentaires" sur la liste des pages
function lgm_theme_remove_commentspage_column($defaults) {
	unset($defaults['comments']);
	return $defaults;
}

add_filter( 'manage_pages_columns', 'lgm_theme_remove_commentspage_column');


// suppression de la colonne "commentaires" sur la liste des articles

function lgm_theme_remove_commentsart_column($defaults) {
	unset($defaults['comments']);
	return $defaults;
}

add_filter( 'manage_posts_columns', 'lgm_theme_remove_commentsart_column');
