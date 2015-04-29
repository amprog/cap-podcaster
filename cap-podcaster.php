<?php
/*
Plugin Name: CAP Podcaster
Plugin URI: http://americanprogress.org
Description: Creates a podcast post type. You can either host media files directly from the media library via S3 or can use an outside source. Currently ONLY supports audio files. Video coming late summer. To use the color matching feature please install Jetpack.
Version: 1.0.0
Author: Seth Rubenstein for Center for American Progress
Author URI: http://sethrubenstein.info
*/
add_filter( 'jetpack_development_mode', '__return_true' );

$plugin_dir = plugin_dir_path( __FILE__ );
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Register 'podcast' post type
 */
function cap_podcast_register() {

	$labels = array(
		'name'                => _x( 'Podcast Episodes', 'Post Type General Name', 'cap_podcaster' ),
		'singular_name'       => _x( 'Podcast Episode', 'Post Type Singular Name', 'cap_podcaster' ),
		'menu_name'           => __( 'Podcasts', 'cap_podcaster' ),
		'name_admin_bar'      => __( 'Podcasts', 'cap_podcaster' ),
		'parent_item_colon'   => __( 'Parent Item:', 'cap_podcaster' ),
		'all_items'           => __( 'All Podcast Episodes', 'cap_podcaster' ),
		'add_new_item'        => __( 'Add New Episode', 'cap_podcaster' ),
		'add_new'             => __( 'Add New', 'cap_podcaster' ),
		'new_item'            => __( 'New Episode', 'cap_podcaster' ),
		'edit_item'           => __( 'Edit Episode', 'cap_podcaster' ),
		'update_item'         => __( 'Update Episode', 'cap_podcaster' ),
		'view_item'           => __( 'View Episode', 'cap_podcaster' ),
		'search_items'        => __( 'Search Episodes', 'cap_podcaster' ),
		'not_found'           => __( 'Not found', 'cap_podcaster' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'cap_podcaster' ),
	);
	$rewrite = array(
		'slug'                => 'podcast',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'cap_podcast', 'cap_podcaster' ),
		'description'         => __( 'Podcasts', 'cap_podcaster' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'taxonomies'          => array( 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
        'menu_icon'           => 'dashicons-megaphone',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'cap_podcast', $args );

}
add_action( 'init', 'cap_podcast_register', 0 );

// Create image size for podcast player and XML feed.
add_image_size( 'cap-podcast-thumbnail', 600, 600, true );

// Register stylesheet, scripts, and icons.
function cap_podcast_styles_scripts() {
    wp_register_style( 'cap-podcaster',  plugin_dir_url( __FILE__ ) . 'cap-podcaster.css' );
    wp_enqueue_style( 'cap-podcaster' );
    wp_enqueue_style( 'dashicons' );

	// Special Effects
	// We need a check for waves if present then use that if not then use this.
	wp_register_style( 'waves-css',  plugin_dir_url( __FILE__ ) . 'bower_components/waves/dist/waves.css' );
    wp_enqueue_style( 'waves-css' );
	wp_enqueue_script( 'waves-js', plugin_dir_url( __FILE__ ) . 'bower_components/waves/dist/waves.js', array(), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'cap_podcast_styles_scripts' );

// Override default WP xml feed for podcast post type - use the included rss-feed.php template.
function cap_podcast_feed_xml( $for_comments ) {
    $rss_template = plugin_dir_path( __FILE__ ).'rss-feed.php';

    if( get_query_var( 'post_type' ) == 'cap_podcast' and file_exists( $rss_template ) ) {
        load_template( $rss_template );
    } else {
        do_feed_rss2( $for_comments ); // Call default function
	}
}
remove_all_actions( 'do_feed_rss2' );
add_action( 'do_feed_rss2', 'cap_podcast_feed_xml', 10, 1 );

include $plugin_dir.'/fields.php';
include $plugin_dir.'/options.php';
include $plugin_dir.'/filters.php';
include $plugin_dir.'/single-episode-template.php';
