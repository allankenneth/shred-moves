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
		'rest_base'             => 'moves',
  		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'rewrite'               => $rewrite,
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



class Move_Info_Meta_Box {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
		add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

		add_meta_box(
			'move_info',
			__( 'Move Info', 'text_domain' ),
			array( $this, 'render_metabox' ),
			'Move',
			'advanced',
			'default'
		);

	}

	public function render_metabox( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'move_nonce_action', 'move_nonce' );

		// Retrieve an existing value from the database.
		$move_addbreakdown = get_post_meta( $post->ID, 'AddBreakDown', true );
		$move_consecrecord = get_post_meta( $post->ID, 'Consecutive Record', true );
		$move_inventor = get_post_meta( $post->ID, 'Inventor', true );
		$move_jobs = get_post_meta( $post->ID, 'JobsNotation', true );
		$move_relatedto = get_post_meta( $post->ID, 'RelatedTo', true );
		$move_supplementalvid = get_post_meta( $post->ID, 'SupplementalVideos', true );
		$move_video = get_post_meta( $post->ID, 'Video', true );

		// Set default values.
		if( empty( $move_addbreakdown ) ) $move_addbreakdown = '';
		if( empty( $move_consecrecord ) ) $move_consecrecord = '';
		if( empty( $move_inventor ) ) $move_inventor = '';
		if( empty( $move_jobs ) ) $move_jobs = '';
		if( empty( $move_relatedto ) ) $move_relatedto = '';
		if( empty( $move_supplementalvid ) ) $move_supplementalvid = '';
		if( empty( $move_video ) ) $move_video = '';
		// Form fields.
		echo '<table class="form-table">';

		echo '	<tr>';
		echo '		<th><label for="move_addbreakdown" class="move_addbreakdown_label">' . __( 'ADD Breakdown', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="move_addbreakdown" name="move_addbreakdown" class="move_addbreakdown_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $move_addbreakdown ) . '">';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="move_consecrecord" class="move_consecrecord_label">' . __( 'Consecutive Record', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="move_consecrecord" name="move_consecrecord" class="move_consecrecord_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $move_consecrecord ) . '">';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="move_inventor" class="move_inventor_label">' . __( 'Inventor', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="move_inventor" name="move_inventor" class="move_inventor_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $move_inventor ) . '">';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="move_jobs" class="move_jobs_label">' . __( 'Jobs Notation', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="move_jobs" name="move_jobs" class="move_jobs_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $move_jobs ) . '">';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="move_relatedto" class="move_relatedto_label">' . __( 'Related To', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="move_relatedto" name="move_relatedto" class="move_relatedto_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $move_relatedto ) . '">';
		echo '		</td>';
		echo '	</tr>';


		echo '	<tr>';
		echo '		<th><label for="move_supplementalvid" class="move_supplementalvid_label">' . __( 'Supplemental Videos', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="move_supplementalvid" name="move_supplementalvid" class="move_supplementalvid_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $move_supplementalvid ) . '">';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="move_video" class="move_video_label">' . __( 'Video Demo', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="move_video" name="move_video" class="move_video_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $move_video ) . '">';
		echo '		</td>';
		echo '	</tr>';

		echo '</table>';
	}

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = $_POST['move_nonce'];
		$nonce_action = 'move_nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Check if the user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		// Check if it's not an autosave.
		if ( wp_is_post_autosave( $post_id ) )
			return;

		// Check if it's not a revision.
		if ( wp_is_post_revision( $post_id ) )
			return;
/*			$move_addbreakdown = get_post_meta( $post->ID, 'AddBreakDown', true );
			$move_consecrecord = get_post_meta( $post->ID, 'Consecutive Record', true );
			$move_inventor = get_post_meta( $post->ID, 'Inventor', true );
			$move_jobs = get_post_meta( $post->ID, 'JobsNotation', true );
			$move_relatedto = get_post_meta( $post->ID, 'RelatedTo', true );
			$move_supplementalvid = get_post_meta( $post->ID, 'SupplementalVideos', true );
			$move_video = get_post_meta( $post->ID, 'Video', true );
*/		// Sanitize user input.
		$move_addbreakdown = isset( $_POST[ 'move_addbreakdown' ] ) ? sanitize_text_field( $_POST[ 'move_addbreakdown' ] ) : '';
		$move_consecrecord = isset( $_POST[ 'move_consecrecord' ] ) ? sanitize_text_field( $_POST[ 'move_consecrecord' ] ) : '';
		$move_inventor = isset( $_POST[ 'move_inventor' ] ) ? sanitize_text_field( $_POST[ 'move_inventor' ] ) : '';
		$move_jobs = isset( $_POST[ 'move_jobs' ] ) ? sanitize_text_field( $_POST[ 'move_jobs' ] ) : '';
		$move_relatedto = isset( $_POST[ 'move_relatedto' ] ) ? sanitize_text_field( $_POST[ 'move_relatedto' ] ) : '';
		$move_supplementalvid = isset( $_POST[ 'move_supplementalvid' ] ) ? sanitize_text_field( $_POST[ 'move_supplementalvid' ] ) : '';
		$move_video = isset( $_POST[ 'move_video' ] ) ? sanitize_text_field( $_POST[ 'move_video' ] ) : '';


		// Update the meta field in the database.
		update_post_meta( $post_id, 'move_addbreakdown', $move_addbreakdown );
		update_post_meta( $post_id, 'move_consecrecord', $move_consecrecord );
		update_post_meta( $post_id, 'move_inventor', $move_inventor );
		update_post_meta( $post_id, 'move_jobs', $move_jobs );
		update_post_meta( $post_id, 'move_relatedto', $move_relatedto );
		update_post_meta( $post_id, 'move_supplementalvid', $move_supplementalvid );
		update_post_meta( $post_id, 'move_video', $move_video );

	}

}

new Move_Info_Meta_Box;

