<?php
if ( !defined('ABSPATH') ) die();
/**
* ACF
**/

//Ajouter la gestion des pages d'options pour ACF
if( function_exists('acf_add_options_page') ) {
	function lgm_theme_acf_init() {
		acf_add_options_page(array(
			'page_title'    => 'ADMINISTRATION',
			'menu_title'    => 'ADMINISTRATION',
			'menu_slug'     => 'administration-client-acf',
			'capability'    => 'edit_posts',
			'position'      => '63',
			'redirect' => true
		));
	}
	add_action('acf/init', 'lgm_theme_acf_init');
}

//Path d'enregistrement des fichiers acf json
add_filter('acf/settings/save_json', 'lgm_acf_json_save_point');
function lgm_acf_json_save_point( $path ) {
	$path = get_stylesheet_directory() . '/admin/acf-json';
	return $path;
}

//Path de chargement des fichiers acf json
add_filter('acf/settings/load_json', 'lgm_acf_json_load_point');
function lgm_acf_json_load_point( $paths ) {
	unset($paths[0]);
	$paths[] = get_stylesheet_directory() . '/admin/acf-json';
	return $paths;
}

//CONFIGURATION TINYMCE POUR ACF
add_filter( 'acf/fields/wysiwyg/toolbars', function ( $toolbars ) {
	// Uncomment to view format of $toolbars
	/*
		echo '< pre >';
			print_r($toolbars);
		echo '< /pre >';
		die;
	*/
		// Register a basic toolbar with a single row of options];
		$toolbars['BASIC'][1] = [ 'bold', 'italic', 'underline', 'bullist', 'link','unlink', 'alignleft', 'aligncenter', 'alignright'];
		$toolbars['TRES BASIC'][1] = [ 'bold', 'italic', 'underline','link','unlink', 'alignleft', 'aligncenter', 'alignright'];
		return $toolbars;
	} );


/* ACF Google Maps API KEY */
	// function dfwp_acf_init( $api ){
    //     $api['key'] = 'xxx';
    //     return $api;
    // }
    // add_filter('acf/fields/google_map/api', 'dfwp_acf_init');





//generate image responsvie avec id de l'image sous acf
//https://www.awesomeacf.com/responsive-images-wordpress-acf/

function lgm_acf_responsive_image($image_id,$image_size,$max_width,$lazy = false){

	// check the image ID is not blank
	if($image_id != '') {

		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );


		if($lazy){
			// generate the markup for the responsive image
			echo 'data-src="'.$image_src.'" data-srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';
		}else{
			echo 'src="'.$image_src.'" srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';
		}
		

	}
}

add_filter( 'acf/fields/wysiwyg/toolbars', function ( $toolbars ) {
// Uncomment to view format of $toolbars
/*
	echo '< pre >';
		print_r($toolbars);
	echo '< /pre >';
	die;
*/
	// Register a basic toolbar with a single row of options];
	$toolbars['BASIC'][1] = [ 'bold', 'italic', 'underline', 'bullist', 'link','unlink', 'alignleft', 'aligncenter', 'alignright'];
	$toolbars['TRES BASIC'][1] = [ 'bold', 'italic', 'underline','link','unlink', 'alignleft', 'aligncenter', 'alignright'];

	return $toolbars;
} );