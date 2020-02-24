<?php
if ( !defined('ABSPATH') ) die();
/**
* SECURITY
**/


	/*Masque les erreurs de connexions*/
	function lgm_no_wordpress_errors(){
		return 'Error!';
	}
	add_filter( 'login_errors', 'lgm_no_wordpress_errors' );

	/*Disable XML RPC*/
	add_filter( 'xmlrpc_enabled', '__return_false' );
	remove_action( 'wp_head', 'rsd_link' );
