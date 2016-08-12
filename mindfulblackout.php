<?php 
/**
 * Plugin Name:  Mindful Blackout Poetry
 * Plugin URI: https://github.com/
 * Description: make blackout poetry
 * Version: .7
 * Author: Tom Woodward
 * Author URI: http://bionicteaching.com
 * License: GPL2
 */
 
 /*   2015 Tom Woodward   (email : bionicteaching@gmail.com)
 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


function custom_post_type_poem() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Poems', 'Post Type General Name', 'blackout' ),
		'singular_name'       => _x( 'Poem', 'Post Type Singular Name', 'blackout' ),
		'menu_name'           => __( 'Poems', 'blackout' ),
		'parent_item_colon'   => __( 'Parent Poem', 'blackout' ),
		'all_items'           => __( 'All Poems', 'blackout' ),
		'view_item'           => __( 'View Poem', 'blackout' ),
		'add_new_item'        => __( 'Add New Poem', 'blackout' ),
		'add_new'             => __( 'Add New', 'blackout' ),
		'edit_item'           => __( 'Edit Poem', 'blackout' ),
		'update_item'         => __( 'Update Poem', 'blackout' ),
		'search_items'        => __( 'Search Poem', 'blackout' ),
		'not_found'           => __( 'Poetry Not Found', 'blackout' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'blackout' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'Poems', 'blackout' ),
		'description'         => __( 'Poetic info', 'blackout' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'poem' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		 'show_in_rest'       => true,
	);
// Registering your Custom Post Type
	register_post_type( 'Poems', $args );

}	
add_action( 'init', 'custom_post_type_poem', 0 );

//custom template
add_filter( 'template_include', 'include_template_function', 1 );

function include_template_function( $template_path ) {
    if ( get_post_type() == 'poems' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-poems.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-poems.php';

            }
        }
    }
    return $template_path;
}


function blackout_enqueue_scripts() {
    wp_enqueue_style( 'blackoutStyles', plugins_url( '/css/blackoutStyles.css', __FILE__ )  );
    wp_enqueue_script( 'html2canvas', plugins_url( '/js/html2canvas.js', __FILE__), array(jquery), '1.0.0', true );
    wp_enqueue_script( 'main', plugins_url( '/js/main.js', __FILE__), array(), '1.0.0', true );

}
add_action( 'wp_enqueue_scripts', 'blackout_enqueue_scripts' );

//filters the content into poem ready form 
function makePoem($content) {
  $post_ID = get_the_ID();	
  if (get_post_type() == 'poems' & wp_get_post_parent_id($post_ID) == 0)   {
     $originText = explode(' ', get_the_content()); 
	  $length = count($originText);
	  $i = 0;
	  $content = '';
	  while ($i < $length) {
	  	$content .= ' <button id="btn'. $i .'" class="buttonProps button" onclick="highLight(btn'. $i .')">' . $originText[$i] .'</button>';
	  	$i++;
	  }
      
     // echo '<div id="parent-id">' . the_id() . '</div>';
    return $content;
  }
  // otherwise returns the database content
  return $content;
}

add_filter( 'the_content', 'makePoem' );

/* 
 * Setup JavaScript
 */
add_action( 'wp_enqueue_scripts', function() {

	//load script
	wp_enqueue_script( 'my-post-submitter', plugin_dir_url( __FILE__ ) . 'js/post-submitter.js', array( 'jquery' ) );

	//localize data for script
	wp_localize_script( 'my-post-submitter', 'POST_SUBMITTER', array(
			'root' => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest' ),
			'success' => __( 'Thanks for your submission!', 'your-text-domain' ),
			'failure' => __( 'Your submission could not be processed.', 'your-text-domain' ),
			'current_user_id' => get_current_user_id()
		)
	);

});


// if both logged in and not logged in users can send this AJAX request,
// add both of these actions, otherwise add only the appropriate one
add_action( 'wp_ajax_nopriv_wp-post-submitter', 'wp-post-submitter' );
add_action( 'wp_ajax_wp-post-submitter', 'wp-post-submitter' );
