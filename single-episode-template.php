<?php
/**
* We're going to override the_content through a filter.
*/

function cap_podcast_player( $id = null, $player_type = 'default' ) {
    if (empty($id)) {
        $post_id = get_the_ID();
    } else {
        $post_id = $id;
    }
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

    if ( 'default' == $player_type ) {
        $episode_title = '
        <div class="episode-info">
            <h4>Episode #'.$episode_number.'</h4>
            <h2>'.get_the_title($post_id).'</h2>
        </div>
        ';
    } elseif ( 'large' == $player_type ) {
        $post_object = get_post($post_id);
        $episode_title = '
        <a href="'.get_permalink($post_id).'" class="episode-info">
            <h4>Episode #'.$episode_number.'</h4>
            <h2>'.get_the_title($post_id).'</h2>
            <span class="description">'.wp_trim_words( $post_object->post_content , '60' ).'</span>
        </a>
        ';
    } elseif ( 'mini' == $player_type ) {
        $episode_title = '';
    }
    // Construct Markup
    $markup = '
    <div class="episode-header">
        <div class="episode-artwork-container">
            <div class="episode-artwork" style="background-image: url('.$episode_artwork_src.');">
                <div id="play-episode" class="maintain-ratio">
                    <span class="dashicons"></span>
                </div>
            </div>
        </div>
        '.$episode_title.'
    </div>';
    $script = "
    <script type='text/javascript'>
    var playerID = jQuery('#episode-".$episode_number."-".$post_id." audio').attr('id');
    var player".$post_id." = document.getElementById(playerID);
    jQuery('#episode-".$episode_number."-".$post_id." #play-episode').click(function(){
        jQuery('#episode-".$episode_number."-".$post_id." #play-episode .dashicons').toggleClass('paused');
    });

    jQuery('#episode-".$episode_number."-".$post_id." #play-episode').click(function() {

        if ( jQuery('#episode-".$episode_number."-".$post_id." #play-episode .dashicons').hasClass('paused') ) {
            player".$post_id.".play();
        }

        if ( !jQuery('#episode-".$episode_number."-".$post_id." #play-episode .dashicons').hasClass('paused') ) {
            player".$post_id.".pause();
        }

    });
    </script>
    ";
    if (function_exists('cap_podcast_player_colors')) {
        $player .= cap_podcast_player_colors($post_id);
    }
    return '<div id="episode-'.$episode_number.'-'.$post_id.'" class="podcast-player '.$player_type.'">'.$markup.$player.$download_link.$script.'</div>';
}

function cap_podcast_single_display($content) {
    if (is_singular('cap_podcast')) {
        $player = cap_podcast_player();
        $content = $player.$content;
    }
    return $content;
}
add_filter('the_content','cap_podcast_single_display');

function cap_podcast_player_waves_effect() {
    if ( is_singular('cap_podcast') || is_post_type_archive('cap_podcast') ):
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            Waves.attach('#play-episode');
            Waves.init();
        });
    </script>
    <?php endif;
}
add_action('wp_footer','cap_podcast_player_waves_effect');
