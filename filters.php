<?php
function cap_podcast_change_archive_title( $title ) {
	if( is_post_type_archive('cap_podcast') ) {
		$title = $title . '<div class="rss-feed"><a href="'.get_feed_link().'?post_type=cap_podcast"><span class="dashicons dashicons-rss"></span> Subscribe to Podcast</a></div>';
	}
	return $title;
}
add_filter('get_the_archive_title','cap_podcast_change_archive_title');

// Check to see if color posts is active, if so then output styles.
if ( is_plugin_active( 'color-posts/color-posts.php' ) ) {
	function cap_podcast_override_color_posts( $colors_css, $color, $contrast ) {
		$css = '';
		return $css;
	}
	add_filter( 'colorposts_css_output', 'cap_podcast_override_color_posts', 10, 3 );

	function cap_podcast_player_colors( $id ) {
		$color = get_post_meta( $id, '_post_colors', true)['color'];
		$css = '<style>';
		$css .= '.episode-header, .mejs-mediaelement {background-color: #'.$color.'!important;}';
		$css .= '.mejs-container .mejs-controls {background: rgba(0,0,0,0.3)!important;}';
		$css .= '.mejs-horizontal-volume-slider {border-bottom: 0px!important;}';
		$css .= '</style>';
		return $css;
	}
}
