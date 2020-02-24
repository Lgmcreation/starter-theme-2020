<?php
if ( !defined('ABSPATH') ) die();
/*
* Plugin Name: Disable Yoast SEO Notifications
* Description: Hide annoying notifications after each upgrade of Yoast SEO plugin and others admin notices.
* Version: 1.1
* Author: Aurélien Denis
* Author URI: https://wpchannel.com/
*/

add_action('admin_init', 'wpc_disable_yoast_notifications');

function wpc_disable_yoast_notifications() {
  if (is_plugin_active('wordpress-seo/wp-seo.php')) {
    remove_action('admin_notices', array(Yoast_Notification_Center::get(), 'display_notifications'));
    remove_action('all_admin_notices', array(Yoast_Notification_Center::get(), 'display_notifications'));
	}
	// Avec celui-ci on pousse la metabox de Yoast en bas
	add_filter( 'wpseo_metabox_prio', 'myprefix_wpseo_prio_low' );
	function myprefix_wpseo_prio_low( $priority ) {
	$priority = 'low';
	return $priority;
	}
	//masquer colonne
	add_filter( 'wpseo_use_page_analysis', '__return_false' );

	// Là on désactive les pointers, qui vont sinon nous refaire le parcours de découverte à chaque mise à jour…
	class WPSEO_Pointers {
	public static function get_instance() {}
	}

		// … et ici on enlève l'horrible redirection vers la page "Vous avez mis à jour Yoast"
	add_filter( 'option_wpseo', 'filter_yst_wpseo_option' );
		function filter_yst_wpseo_option( $option ) {
		$option['seen_about'] = true;
		return $option;
	}

	//desactive json search
	add_filter( 'disable_wpseo_json_ld_search', '__return_true' );

}