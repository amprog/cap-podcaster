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

// Register Custom Post Type
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
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
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

if( function_exists('register_field_group') ):

register_field_group(array (
	'key' => 'group_553e4cdaea25c',
	'title' => 'Episode Settings',
	'fields' => array (
		array (
			'key' => 'field_553e4cee5e1d0',
			'label' => 'Media',
			'name' => '',
			'prefix' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
		),
		array (
			'key' => 'field_553e4d2f5e1d2',
			'label' => 'Episode File',
			'name' => 'episode_file',
			'prefix' => '',
			'type' => 'file',
			'instructions' => 'Upload your episodes MP3 (Audio only) or MP4 (Video only) file.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'library' => 'all',
			'min_size' => '',
			'max_size' => '',
			'mime_types' => 'mp3, mp4',
		),
		array (
			'key' => 'field_553e4cf65e1d1',
			'label' => 'Externally Hosted Episode File',
			'name' => 'external_episode_file',
			'prefix' => '',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'http://source.com/media/file.mp3',
		),
		array (
			'key' => 'field_553e4d715e1d3',
			'label' => 'Episode Specifics',
			'name' => '',
			'prefix' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
		),
		array (
			'key' => 'field_553e4f4c0eac2',
			'label' => 'Episode Number',
			'name' => 'episode_number',
			'prefix' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_553e4d7e5e1d4',
			'label' => 'Explicit',
			'name' => 'explicit',
			'prefix' => '',
			'type' => 'true_false',
			'instructions' => 'Some podcast directories (iTunes, Pocketcasts) have explicit tags. If this episode contains explicit content/language click the checkbox to enable to explicit tag.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'cap_podcast',
			),
		),
	),
	'menu_order' => 100,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
));

endif;

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}


add_image_size( 'cap-podcast-thumbnail', 600, 600, true );

function cap_podcast_styles_scripts() {
    wp_register_style( 'cap-podcaster',  plugin_dir_url( __FILE__ ) . 'cap-podcaster.css' );
    wp_enqueue_style( 'cap-podcaster' );
    wp_enqueue_style( 'dashicons' );

	// Special Effects
	wp_register_style( 'waves-css',  plugin_dir_url( __FILE__ ) . 'bower_components/waves/dist/waves.css' );
    wp_enqueue_style( 'waves-css' );
	wp_enqueue_script( 'waves-js', plugin_dir_url( __FILE__ ) . 'bower_components/waves/dist/waves.js', array(), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'cap_podcast_styles_scripts' );

remove_all_actions( 'do_feed_rss2' );

function cap_podcast_feed_xml( $for_comments ) {
    $rss_template = plugin_dir_path( __FILE__ ) . 'rss-feed.php';
    if( get_query_var( 'post_type' ) == 'cap_podcast' and file_exists( $rss_template ) )
        load_template( $rss_template );
    else
        do_feed_rss2( $for_comments ); // Call default function
}
add_action( 'do_feed_rss2', 'cap_podcast_feed_xml', 10, 1 );

// Check to see if color posts is active, if so then output styles.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'color-posts/color-posts.php' ) ) {
	function cap_podcast_player_colors( $colors_css, $color, $contrast ) {
		$css = '#episode-header, .mejs-mediaelement {background-color: #'.$color.'!important;}';
		$css .= 'body .mejs-container .mejs-controls {background: rgba(0,0,0,0.3)!important;}';
		$css .= '.mejs-horizontal-volume-slider {border-bottom: 0px!important;}';
		return $css;
	}
	add_filter( 'colorposts_css_output', 'cap_podcast_player_colors', 10, 3 );
}

$plugin_dir = plugin_dir_path( __FILE__ );

include $plugin_dir.'/single-episode-template.php';
