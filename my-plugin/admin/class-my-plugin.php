<?php
/**
 * Registers the service_tab post type.
 */
function ews_job_post_type() {
	$labels = array(
		'name'               => __( 'Service Tabs' ),
		'singular_name'      => __( 'Service Tab' ),
		'add_new'            => __( 'Add New Service Tab' ),
		'add_new_item'       => __( 'Add New Service Tab' ),
		'edit_item'          => __( 'Edit Service Tab' ),
		'new_item'           => __( 'Add New Service Tab' ),
		'view_item'          => __( 'View Service Tab' ),
		'search_items'       => __( 'Search Service Tab' ),
		'not_found'          => __( 'No service tab found' ),
		'not_found_in_trash' => __( 'No service tab found in trash' )
	);
	$supports = array(
		'title',
		'editor',
		'thumbnail',
		'revisions',
	);
	$args = array(
		'labels'               => $labels,
		'supports'             => $supports,
		'public'               => true,
		'capability_type'      => 'post',
		'rewrite'              => array( 'slug' => 'service_tab' ),
		'has_archive'          => true,
		'menu_position'        => 30,
		'menu_icon'            => 'dashicons-admin-generic',
		'register_meta_box_cb' => 'ews_add_tab_metaboxes'
	);
	register_post_type( 'service_tab', $args );
}
add_action( 'init', 'ews_job_post_type' );




/**
 * Adds a metabox to the right side of the screen under the “Publish” box
 */
function ews_add_tab_metaboxes() {
	add_meta_box(
		'ews_tab_heading',
		'Heading',
		'ews_tab_heading',
		'service_tab',
		'normal',
		'default'
	);

		add_meta_box(
		'ews_tab_sub_heading',
		'Sub Heading',
		'ews_tab_sub_heading',
		'service_tab',
		'normal',
		'default'
	);
}


/**
 * Output the HTML for the metabox.
 */
function ews_tab_heading() {
	global $post;
	// Nonce field to validate form request came from current site
	wp_nonce_field( basename( __FILE__ ), 'service_tab_fields' );
	// Get the tab_heading data if it's already been entered
	$tab_heading = get_post_meta( $post->ID, 'tab_heading', true );
	// Output the field
	echo '<input type="text" name="tab_heading" value="' . esc_textarea( $tab_heading )  . '" class="widefat">';
}


/**
 * Output the HTML for the metabox.
 */
function ews_tab_sub_heading() {
	global $post;
	// Nonce field to validate form request came from current site
	wp_nonce_field( basename( __FILE__ ), 'service_tab_fields' );
	// Get the tab_sub_heading data if it's already been entered
	$tab_sub_heading = get_post_meta( $post->ID, 'tab_sub_heading', true );
	// Output the field
	echo '<input type="text" name="tab_sub_heading" value="' . esc_textarea( $tab_sub_heading )  . '" class="widefat">';
}


/**
 * Save the metabox data
 */
function ews_save_jobs_meta( $post_id, $post ) {
	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if ( ! isset( $_POST['tab_heading'] ) || ! wp_verify_nonce( $_POST['service_tab_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $jobs_meta.
	$jobs_meta['tab_heading'] = esc_textarea( $_POST['tab_heading'] );
	$jobs_meta['tab_sub_heading'] = esc_textarea( $_POST['tab_sub_heading'] );
	// Cycle through the $jobs_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ( $jobs_meta as $key => $value ) :
		// Don't store custom data twice
		if ( 'revision' === $post->post_type ) {
			return;
		}
		if ( get_post_meta( $post_id, $key, false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, $key, $value );
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, $key, $value);
		}
		if ( ! $value ) {
			// Delete the meta key if there's no value
			delete_post_meta( $post_id, $key );
		}
	endforeach;
}
add_action( 'save_post', 'ews_save_jobs_meta', 1, 2 );

/**
 * Adds a taxonomy
 */
add_action( 'init', 'create_service_tab_listings' );

function create_service_tab_listings() {
	register_taxonomy(
		'service_listings',
		'service_tab',
		array(
			'label' => __( 'Listings' ),
			'rewrite' => array( 'slug' => 'services_listings' ),
			'hierarchical' => true,
		)
	);
}