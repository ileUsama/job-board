<?php

/*
	
@package DevelopersHub
	
	========================
		ADMIN PAGE / CUSTOM POST TYPE
	========================
*/

//Custom post type

function job_init() {
    // set up job labels
    $labels = array(
        'name' => 'Jobs',
        'singular_name' => 'Job',
        'add_new' => 'Add New Job',
        'add_new_item' => 'Add New Job',
        'edit_item' => 'Edit Job',
        'new_item' => 'New Job',
        'all_items' => 'All Jobs',
        'view_item' => 'View Job',
        'search_items' => 'Search Jobs',
        'not_found' =>  'No Jobs Found',
        'not_found_in_trash' => 'No Jobs found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Job Listings',
    );
    
    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'job'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'editor',
            //'excerpt',
            //'trackbacks',
            'custom-fields',
            //'comments',
            //'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type( 'job', $args );
    
    // register taxonomy

    // Add new "Locations" taxonomy to Posts
  register_taxonomy('job_type', 'job', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Job Type', 'taxonomy general name' ),
      'singular_name' => _x( 'Jobs', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Job Types' ),
      'all_items' => __( 'All Job Types' ),
      'parent_item' => __( 'Parent Job type' ),
      'parent_item_colon' => __( 'Parent Job type:' ),
      'edit_item' => __( 'Edit Job type' ),
      'update_item' => __( 'Update Job type' ),
      'add_new_item' => __( 'Add New Job type' ),
      'new_item_name' => __( 'New Job type Name' ),
      'menu_name' => __( 'Job Types' ),
    ),
    // Control the slugs used for this taxonomy
    'query_var', true,
    'rewrite' => array(
      'slug' => 'job_type', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
    ),
  ));
}
add_action( 'init', 'job_init' );

function my_custom_columns_list( $columns ) {
		if ( ! is_array( $columns ) ) {
			$columns = [];
		}

		unset( $columns['title'], $columns['date'], $columns['author'], $columns['comments']);

		$columns['title'] = __( 'Position', 'job-board' );
		$columns['job_type'] = __( 'Type', 'job-board' );
		//$columns['job_location'] = __( 'Location', 'job-board' );
		$columns['job_status'] = '<span class="tips" data-tip="' . __( 'Status', 'job-board' ) . '">' . __( 'Status', 'job-board' ) . '</span>';
		$columns['date'] = __( 'Posted', 'job-board' );
		$columns['job_expires'] = __( 'Expires', 'job-board' );
		$columns['job_listing_category'] = __( 'Categories', 'job-board' );
		//$columns['featured_job'] = '<span class="tips" data-tip="' . __( 'Featured?', 'job-board' ) . '">' . __( 'Featured?', 'job-board' ) . '</span>';
		$columns['filled'] = '<span class="tips" data-tip="' . __( 'Filled?', 'job-board' ) . '">' . __( 'Filled?', 'job-board' ) . '</span>';
		$columns['actions'] = __( 'Actions', 'job-board' );

		if ( ! get_option( 'job-board_enable_categories' ) ) {
			unset( $columns['job_listing_category'] );
		}

		if ( ! get_option( 'job-board_enable_types' ) ) {
			unset( $columns['job_listing_type'] );
		}

		return $columns;
	}
	add_filter( 'manage_job_posts_columns', 'my_custom_columns_list' );

//Called Metabox external File to Add Custom Metabox

require_once dirname( __FILE__ ) . '/metabox.php';












 
