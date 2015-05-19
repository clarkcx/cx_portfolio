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
		'taxonomies' => array('category','post_tag'),
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

add_action('save_post_Projects', 'cx_save_project_meta', 1, 2); // save the custom fields

// This next thang creates a custom Taxonomy for us to use with the Projects post type

function client_init() {
	// create a new taxonomy
	register_taxonomy(
		'client',
		'projects',
		array(
			'hierarchical' => true,
			'label' => __( 'Clients' ),
			'rewrite' => array( 'slug' => 'clients' )
		)
	);
}
add_action( 'init', 'client_init' );

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

?>