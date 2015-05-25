<?php
/*
Plugin Name: CX Portfolio
Plugin URI: http://www.ablewild.com
Description: Add custom post types for showing lovely work.
Version: 1.1
Author: Pete Clark
Author URI: http://twitter.com/clarkcx
Licence: GPL2
*/

//////////////////////////////////////////////////////
///* CREATE CUSTOM POST TYPE: PROJECTS *///////////
//////////////////////////////////////////////////////

add_action('init', 'Projects_register');
 
function Projects_register() {
	$labels = array(
		'name' => _x('Projects', 'post type general name'),
		'singular_name' => _x('Project', 'post type singular name'),
		'add_new' => _x('Add New', 'Project'),
		'add_new_item' => __('Add New Project'),
		'edit_item' => __('Edit Project'),
		'new_item' => __('New Project'),
		'view_item' => __('View Project'),
		'search_items' => __('Search Projects'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'description' => __('Great websites are made for the end-users and designed around their needs. The way we work guides the design towards a result your customers will love. We also step out from the virtual world with event design.'),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/tiny_icon_projects.png',
		'rewrite' => array("slug" => "projects", 'with_front'=> false), // Permalinks format
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail'),
		//'taxonomies' => array('category','post_tag'),
		'register_meta_box_cb' => 'add_projects_metaboxes',
		'has_archive' => true
	  ); 
 
	register_post_type( 'Projects' , $args );
}

// Add the Projects meta boxes

function add_projects_metaboxes() {
	add_meta_box('cx_project_info', 'Additional Info', 'cx_project_info', 'projects', 'normal', 'default');
}

// The project Additional Info metabox

function cx_project_info() {
	global $post;
	
	// Noncename neede to verify where the data originated
	echo '<input type="hidden" name="projectmeta_noncename" id="projectmeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the additional info data if it's already been entered
	$project_duration = get_post_meta($post->ID, '_duration', true);
	$project_url = get_post_meta($post->ID, '_url', true);
	$project_testimonial_text = get_post_meta($post->ID, '_testimonial_text', true);
	$project_testimonial_name = get_post_meta($post->ID, '_testimonial_name', true);
	
	// Echo out the field
	echo '<p>Duration (weeks):</p>';
	echo '<input type="text" name="_duration" value="' . $project_duration . '" class="widefat" />';
	echo '<p>URL:</p>';
	echo '<input type="text" name="_url" value="' . $project_url . '" class="widefat" />';
	echo '<p>Testimonial text:</p>';
	echo '<textarea name="_testimonial_text" class="widefat">' . $project_testimonial_text . '</textarea>';
	echo '<p>Testimonial given by:</p>';
	echo '<input type="text" name="_testimonial_name" value="' . $project_testimonial_name . '" class="widefat" />';
	
}
	
// Save the Metabox data

function cx_save_project_meta($post_id, $post) {

	// Verify this came from our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['projectmeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	
	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$projects_meta['_duration'] = $_POST['_duration'];
	$projects_meta['_url'] = $_POST['_url'];
	$projects_meta['_testimonial_text'] = $_POST['_testimonial_text'];
	$projects_meta['_testimonial_name'] = $_POST['_testimonial_name'];
	
	// Add values of $projects_meta as custom fields
	
	foreach ($projects_meta as $key => $value) { // Cycle through the $projects_meta array!
		 if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		 $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		 if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
		 	update_post_meta($post->ID, $key, $value);
		 } else { // If the custom field doesn't have a value
		 	add_post_meta($post->ID, $key, $value);
		 }
		 if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}
}

add_action('save_post_projects', 'cx_save_project_meta', 1, 2); // save the custom fields

/*************************************
* Custom Taxonomies
*************************************/

function create_project_tax_clients() {
	// create a new taxonomy
	$labels = array(
		'singular_name' => __( 'Client' ),
		'add_new_item' => __( 'Add New Client' )
	);

	register_taxonomy(
		'client',
		'projects',
		array(
			'hierarchical' => true,
			'label' => __( 'Clients' ),
			'labels' => $labels,
			'rewrite' => array( 'slug' => 'clients' )
		)
	);
}
function create_project_tax_type() {
	$labels = array(
		'singular_name' => __( 'Project' ),
		'add_new_item' => __( 'Add New Project type' )
	);
	// create a new taxonomy
	register_taxonomy(
		'project_type',
		'projects',
		array(
			'hierarchical' => true,
			'label' => __( 'Project type' ),
			'labels' => $labels,
			'rewrite' => array( 'slug' => 'project-type', 'with_front'=> false )
		)
	);
}
add_action( 'init', 'create_project_tax_clients' );
add_action( 'init', 'create_project_tax_type' );

// This next bit includes template files that come with the plugin. Woot. 

add_filter('template_include', 'portfolio_archive_template');
add_filter('template_include', 'portfolio_post_template');

function portfolio_archive_template( $template ) {
  if ( is_post_type_archive('projects') ) {
    $theme_files = array('archive-portfolio.php', 'cx_portfolio/archive-portfolio.php');
    $exists_in_theme = locate_template($theme_files, false);
    if ( $exists_in_theme != '' ) {
      return $exists_in_theme;
    } else {
      return plugin_dir_path(__FILE__) . 'archive-portfolio.php';
    }
  }
  return $template;
}

function portfolio_post_template( $template ) {
  if ( is_singular('projects') ) {
    $theme_files = array('single-projects.php', 'cx_portfolio/single-projects.php');
    $exists_in_theme = locate_template($theme_files, false);
    if ( $exists_in_theme != '' ) {
      return $exists_in_theme;
    } else {
      return plugin_dir_path(__FILE__) . 'single-projects.php';
    }
  }
  return $template;
}

/*************************************
* includes
*************************************/

include('cx-portfolio-shortcodes.php'); // This creates shortcodes used by the plugin

/*************************************
* Styles and scripts
*************************************/


function cx_portfolio_scripts() {
	wp_enqueue_style( 'cx-portfolio', plugins_url( '/css/cx-portfolio.css' , __FILE__ )	);
	//wp_enqueue_script('cx-portfolio', plugins_url( '/js/cx-portfolio.js' , __FILE__ ), array('jquery'), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'cx_portfolio_scripts' );

/*************************************
* Change the number of projects shown 
*************************************/

function change_project_archive_count( $query ) {
    if ( is_post_type_archive( 'projects' ) ) {
        // Display 50 posts for a custom post type called 'projects'
        $query->set( 'posts_per_page', 50 );
        return;
    }
}
add_action( 'pre_get_posts', 'change_project_archive_count', 1 );

/*************************************
* Add extra featured images to projects
This requires the MultiPostThumbnails plugin by Chris Scott
https://github.com/voceconnect/multi-post-thumbnails/wiki
*************************************/

function add_extra_projects_images(){
	if (class_exists('MultiPostThumbnails')) {
	    new MultiPostThumbnails(
	        array(
	            'label' => 'Second Image',
	            'id' => 'second-image',
	            'post_type' => 'projects'
	        )
	    );
	}
	if (class_exists('MultiPostThumbnails')) {
	    new MultiPostThumbnails(
	        array(
	            'label' => 'Third Image',
	            'id' => 'third-image',
	            'post_type' => 'projects'
	        )
	    );
	}
	if (class_exists('MultiPostThumbnails')) {
	    new MultiPostThumbnails(
	        array(
	            'label' => 'Fourth Image',
	            'id' => 'fourth-image',
	            'post_type' => 'projects'
	        )
	    );
	}
	if (class_exists('MultiPostThumbnails')) {
	    new MultiPostThumbnails(
	        array(
	            'label' => 'Thumbnail Image',
	            'id' => 'thumbnail-image',
	            'post_type' => 'projects'
	        )
	    );
	}
}
add_action('wp_loaded','add_extra_projects_images');

/*************************************
* Add extra featured images to projects
This requires the Posts 2 Posts plugin by Scribu
https://github.com/scribu/wp-posts-to-posts/wiki/Basic-usage
*************************************/

function my_connection_projects_to_projects() {
    p2p_register_connection_type( array(
        'name' => 'project_to_project',
        'from' => 'projects',
        'to' => 'projects'
    ) );
}
add_action( 'p2p_init', 'my_connection_projects_to_projects' );

?>