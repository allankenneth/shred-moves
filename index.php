<?php
/*
Plugin Name: Footbag Moves List
Description: This sets up a "Moves" custom post type, with two custom taxonomies: "Skill Levels" and "ADDs." It contains the page templates for single moves and the taxonomies, as well as a custom template for the custom fields.
Version: 0.1
License: GPL
Author: Allan Kenneth
Author URI: footbag.org
*/

function get_moveslist_template($single_template) {
     global $post;

     if ($post->post_type == 'moves') {
          $single_template = dirname( __FILE__ ) . '/templates/single-moves.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'get_moveslist_template' );

function get_moveslist_archive_template( $archive_template ) {
     global $post;

     if ( is_post_type_archive ( 'moves' ) ) {
          $archive_template = dirname( __FILE__ ) . '/templates/archive-moves.php';
     }
     return $archive_template;
}
add_filter( 'archive_template', 'get_moveslist_archive_template' ) ;


function get_moveslist_tax_template( $taxonomy_template ) {
     global $post;

     if ( is_tax ( 'skill_level' ) ) {
          $taxonomy_template = dirname( __FILE__ ) . '/templates/taxonomy-skill_level.php';
     }
     if ( is_tax ( 'adds' ) ) {
          $taxonomy_template = dirname( __FILE__ ) . '/templates/taxonomy-add_count.php';
     }
     return $taxonomy_template;
}

add_filter( 'taxonomy_template', 'get_moveslist_tax_template' ) ;


// Register Custom Post Type
function freestyle_moves() {

	$labels = array(
		'name'                  => _x( 'Moves', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Move', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Moves', 'text_domain' ),
		'name_admin_bar'        => __( 'Moves', 'text_domain' ),
		'archives'              => __( 'Move Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Move:', 'text_domain' ),
		'all_items'             => __( 'All Moves', 'text_domain' ),
		'add_new_item'          => __( 'Add New Move', 'text_domain' ),
		'add_new'               => __( 'Add Move', 'text_domain' ),
		'new_item'              => __( 'New Move', 'text_domain' ),
		'edit_item'             => __( 'Edit Move', 'text_domain' ),
		'update_item'           => __( 'Update Move', 'text_domain' ),
		'view_item'             => __( 'View Move', 'text_domain' ),
		'search_items'          => __( 'Search Moves', 'text_domain' ),
		'not_found'             => __( 'Move Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into move', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this move', 'text_domain' ),
		'items_list'            => __( 'Moves list', 'text_domain' ),
		'items_list_navigation' => __( 'Moves list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter moves list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'freestyle/move',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Move', 'text_domain' ),
		'description'           => __( 'Freestyle Moves ', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
		'taxonomies'            => array( 'skill_level', ' add_count' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-video',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'freestyle/moves',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
		'rewrite'               => $rewrite,
		'rest_base'             => 'moves-api',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	);
	register_post_type( 'moves', $args );

}
add_action( 'init', 'freestyle_moves', 0 );
// Register Custom Taxonomy
function skill_levels() {

	$labels = array(
		'name'                       => _x( 'Skill Levels', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Skill Level', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Skill Level', 'text_domain' ),
		'all_items'                  => __( 'All Skill Levels', 'text_domain' ),
		'parent_item'                => __( 'Skill Level', 'text_domain' ),
		'parent_item_colon'          => __( 'Skill Level:', 'text_domain' ),
		'new_item_name'              => __( 'New Skill Level', 'text_domain' ),
		'add_new_item'               => __( 'Add New Skill Level', 'text_domain' ),
		'edit_item'                  => __( 'Edit Skill Level', 'text_domain' ),
		'update_item'                => __( 'Update Skill Level', 'text_domain' ),
		'view_item'                  => __( 'View Skill Level', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate skill levels with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove skill levels', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Skill Levels', 'text_domain' ),
		'search_items'               => __( 'Search Skill Levels', 'text_domain' ),
		'not_found'                  => __( 'Skill Level Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Skill Levels', 'text_domain' ),
		'items_list'                 => __( 'Move skill level list', 'text_domain' ),
		'items_list_navigation'      => __( 'Skill level list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'rewrite'                    => array('slug' => 'freestyle/moves/skill_level'),
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'skill_level', array( 'moves' ), $args );

}
add_action( 'init', 'skill_levels', 0 );

// Register Custom Taxonomy
function adds() {

	$labels = array(
		'name'                       => _x( 'ADD Count', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'ADD Count', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'ADD Count', 'text_domain' ),
		'all_items'                  => __( 'All ADD Count', 'text_domain' ),
		'parent_item'                => __( 'Parent ADD Count', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent ADD Count:', 'text_domain' ),
		'new_item_name'              => __( 'New ADD Count', 'text_domain' ),
		'add_new_item'               => __( 'Add New ADD Count', 'text_domain' ),
		'edit_item'                  => __( 'Edit ADD Count', 'text_domain' ),
		'update_item'                => __( 'Update ADD Count', 'text_domain' ),
		'view_item'                  => __( 'View ADD Count', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular ADD Count', 'text_domain' ),
		'search_items'               => __( 'Search ADD Count', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'ADD count list', 'text_domain' ),
		'items_list_navigation'      => __( 'ADD count list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'rewrite'                    => array('slug' => 'freestyle/moves/add_count'),
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'adds', array( 'moves' ), $args );

}
add_action( 'init', 'adds', 0 );



