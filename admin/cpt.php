<?php
add_action('init', 'lgm_add_cpt');
function lgm_add_cpt()
{
  $labels = array(
    'name' => _x('CPT', 'post type general name'),
    'singular_name' => _x('CPT', 'post type singular name'),
    'add_new' => _x('Ajouter', 'CPT'),
    'add_new_item' => __('Ajouter une CPT'),
    'edit_item' => __('Modifier CPT'),
    'new_item' => __('Nouvelle CPT'),
    'view_item' => __('Voir CPT'),
    'search_items' => __('Rechercher une CPT'),
    'not_found' =>  __('Aucun CPT trouvé'),
    'not_found_in_trash' => __('Aucun CPT trouvé dans la corbeille'),
    'parent_item_colon' => ''
  );
  $args = array(
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'labels' => $labels,
        'show_in_admin_bar' => true,
        'menu_position' => 15,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => 'CPT'),
        'supports' => array('title'),
        'menu_icon' => 'dashicons-list-view'
  );
register_post_type('CPT',$args);
}

function CPT_columns($columns)
{
  $columns = array(
    'cb' => '&lt;input type="checkbox" />',
    'thumbnail' => 'Image',
    'title' => __( 'Titre' ),
    'date' => __( 'Date' ),
	);

	return $columns;
}

add_filter("manage_edit-CPT_columns", "CPT_columns",5,2);

function CPT_custom_column($column){
  global $post;
  switch( $column ) {
    case 'thumbnail' :
      echo edit_post_link(get_the_post_thumbnail($post->ID, array( 75, 75)),null,null,$post->ID);
    break;
    default :
    break;
  }
      
}

add_action('manage_CPT_posts_custom_column' ,'CPT_custom_column',5);

add_action( 'acf/save_post', 'lgm_featured_image_from_gallery', 20 );

function lgm_featured_image_from_gallery($post_id) {
	$screen = get_current_screen();
	if ( 'post' === $screen->base && 'carexception' === $screen->post_type ) {
		$images = get_field('galerie_car', false, false);
		$image_id = $images[0];
		if ( $image_id ) {
		set_post_thumbnail( $post_id, $image_id );
    }
    
	}
}

add_action('admin_head', 'my_column_width');

function my_column_width() {
    echo '<style type="text/css">';
    echo '.type-carexception th,.type-carexception td{ vertical-align:middle !important;}';
    echo '.column-thumbnail { text-align: center; width:80px !important; overflow:hidden }';
    echo '</style>';
}