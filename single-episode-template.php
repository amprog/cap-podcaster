<?php
/**
* We're going to override the_content through a filter.
*/

function cap_podcast_construct_player() {
    $post_id = get_the_ID();
    $episode_number = get_post_meta( $post_id, 'episode_number', true );
    // Get Episode Media Source
    $episode_attachment_id = get_post_meta( $post_id, 'episode_file', true );
    $episode_external_file = get_post_meta( $post_id, 'external_episode_file', true );
    if (!empty($episode_attachment_id)) {
        $player_src = wp_get_attachment_url( $episode_attachment_id );
    } elseif (!empty($episode_external_file)) {
        $player_src = $episode_external_file;
    }
    $attr = array(
    	'src'      => ''.$player_src.'',
    	'loop'     => '',
    	'autoplay' => '',
    	'preload' => 'metadata'
	);
    $player = wp_audio_shortcode( $attr );

    $download_link = '<small><a href="'.$player_src.'" download="episode'.$episode_number.'.mp3">Download this Episode</a></small>';
    // Get Episode Artwork //
    $episode_artwork_id = get_post_thumbnail_id( $post_id );
    $episode_artwork = wp_get_attachment_image_src( $episode_artwork_id, 'cap-podcast-thumbnail' );
    $episode_artwork_src = $episode_artwork[0];
    // Contrsuct Markup
    $markup = '
    <div id="episode-header">
        <div class="episode-artwork-container">
            <div class="episode-artwork" style="background-image: url('.$episode_artwork_src.');">
                <div id="play-episode" class="maintain-ratio">
                    <span class="dashicons"></span>
                </div>
            </div>
        </div>
        <div class="episode-info">
            <h4>Episode #'.$episode_number.'</h4>
            <h2>'.get_the_title($post_id).'</h2>
        </div>
    </div>';
    $media = $player;
    $script = "
    <script>
    var player = document.getElementsByTagName('audio')[0];
    jQuery('#play-episode').click(function(){
        jQuery('#play-episode .dashicons').toggleClass('paused');
    });

    jQuery('#play-episode').click(function() {

        if ( jQuery('#play-episode .dashicons').hasClass('paused') ) {
            player.play();
        }

        if ( !jQuery('#play-episode .dashicons').hasClass('paused') ) {
            player.pause();
        }

    });

    jQuery(document).ready(function(){
        Waves.attach('#play-episode');
        Waves.init();
    });

    </script>
    ";
    return '<div class="podcast-player">'.$markup.$player.$download_link.$script.'</div>';
}

function cap_podcast_single_display($content) {
    if (is_singular()) {
        $player = cap_podcast_construct_player();
        $content = $player.$content;
    }
    return $content;
}
add_filter('the_content','cap_podcast_single_display');
