<?php
if ( !defined('ABSPATH') ) die();
/**
* Rôle éditeur pour le client
**/
	/*Gestion Capacité Editeur*/
	function lgm_theme_set_editor_capabilities() {
	    if (current_user_can('editor')) {
	        $editor = get_role( 'editor' );
	        // liste des capacités a ajouter.
	        $editor->add_cap( 'edit_theme_options' ); // Ajout theme_option dans le but de créer Bouton Gestion Menu seul
	        // liste des capacités a retirer.
	        $caps = array(
	            
	        );

	        foreach ( $caps as $cap ) {
	            // sup.
	            $editor->remove_cap( $cap );
	        }
	    }
	}
	add_action( 'init', 'lgm_theme_set_editor_capabilities' );

	/*Suppression menu et sous menu*/
	    function lgm_theme_edit_editor_menu() {
	        if( current_user_can('editor')) {
	            /*MENU*/
	            remove_menu_page( 'tools.php' );
	            remove_menu_page( 'themes.php' );
	            remove_menu_page( 'edit-comments.php' );
	            /*SOUSMENU*/

	            /*AJOUT NOUVEAU BOUTON MENU*/
	            add_menu_page( 'Menu', 'Menu', 'edit_theme_options', 'nav-menus.php', '', 'dashicons-menu', 61);
	        }
	    }
	    add_action( 'admin_menu', 'lgm_theme_edit_editor_menu' );
    
    /*Suppression icone dans l'adminbar*/
    function lgm_theme_edit_adminbar() {
        if (current_user_can('editor')) {
            global $wp_admin_bar;
            $wp_admin_bar->remove_node('customize');
            $wp_admin_bar->remove_node('comments');
            $wp_admin_bar->remove_menu('wp-logo');
        }
    }
    add_action( 'wp_before_admin_bar_render', 'lgm_theme_edit_adminbar' );

    /*Cacher le message de mise à jour*/
    function lgm_theme_hide_wp_update_nag() {
    	if (current_user_can('editor')) {
			remove_action( 'admin_notices', 'update_nag', 3 );
		}
	}
	add_action('admin_menu','lgm_theme_hide_wp_update_nag');
