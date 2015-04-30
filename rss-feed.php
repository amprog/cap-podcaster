<?php
/**
* Constructs the RSS/XML feed used by podcasting apps like iTunes and Pocketcasts
* for reference this is the iTunes feed spec sheet https://www.apple.com/itunes/podcasts/specs.html
*/

if (get_field('podcast_name','options')) {
    $podcast_name         = get_field('podcast_name','options');
} else {
    $podcast_name         = get_bloginfo('name');
}

if (get_field('podcast_description','options')) {
    $podcast_description  = htmlspecialchars(get_field('podcast_description','options'));
} else {
    $podcast_description  = get_bloginfo('description');
}

if (get_field('podcast_author','options')) {
    $podcast_author       = get_field('podcast_author','options');
} else {
    $podcast_author       = get_bloginfo('name');
}

if (get_field('podcast_author_email','options')) {
    $podcast_author_email = get_field('podcast_author_email','options');
} else {
    $podcast_author_email = get_bloginfo('admin_email');
}
$podcast_copyright        = '&#xA9; ';
if (get_field('podcast_copyright','options')) {
    $podcast_copyright   .= get_field('podcast_copyright','options');
} else {
    $podcast_copyright   .= get_bloginfo('name');
}
$podcast_copyright       .= ' '.date("Y");


///
$podcast_artwork_id      = get_field('podcast_album_art','options');
$podcast_artwork         = wp_get_attachment_image_src( $podcast_artwork_id, 'cap-podcast-thumbnail' );
$podcast_artwork_src     = $podcast_artwork[0];
///
$podcast_subtitle        = get_field('podcast_subtitle', 'options');

?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:atom="http://www.w3.org/2005/Atom" xml:lang="en" version="2.0">
    <channel>
        <title><?php echo $podcast_name; ?></title>
        <link><?php bloginfo('url');?>/podcast</link>
        <atom:link href="<?php echo get_feed_link();?>?post_type=cap_podcast" rel="self" type="application/rss+xml"/>
        <description>
            <?php echo $podcast_description;?>
        </description>
        <generator>
            PressCast 1.0 - http://presscast.com
        </generator>
        <language>en</language>
        <copyright><?php echo $podcast_copyright;?></copyright>
        <image>
            <url>
                <?php echo $podcast_artwork_src;?>
            </url>
            <title><?php echo $podcast_name; ?></title>
            <link><?php bloginfo('url');?>/podcast</link>
        </image>

        <itunes:image href="<?php echo $podcast_artwork_src;?>"/>
        <itunes:summary>
            <?php echo $podcast_description;?>
        </itunes:summary>
        <?php if (isset($podcast_subtitle)) {
            echo '<itunes:subtitle>'.$podcast_subtitle.'</itunes:subtitle>';
        }?>
        <itunes:author><?php echo $podcast_author;?></itunes:author>
        <itunes:owner>
            <itunes:name><?php echo $podcast_author;?></itunes:name>
            <itunes:email><?php echo $podcast_author_email;?></itunes:email>
        </itunes:owner>
        <?php if (true == get_field('podcast_explicit', 'options')) {
            $is_episode_explicit = '<itunes:explicit>yes</itunes:explicit>';
        } else {
            $is_episode_explicit = '<itunes:explicit>clean</itunes:explicit>';
        }?>

        <?php echo $is_episode_explicit;?>

        <?php foreach (get_field('podcast_categories','options') as $key => $value) {
            echo '<itunes:category text="'.htmlspecialchars($value).'"/>';
        }?>

        <?php while( have_posts()) : the_post(); ?>

        <?php
            $post_id = get_the_ID();
            $episode_number = get_post_meta( $post_id, 'episode_number', true );
            $episode_subtitle = get_post_meta( $post_id, 'episode_subtitle', true );
            // Get Episode Media Source
            $episode_attachment_id = get_post_meta( $post_id, 'episode_file', true );
            $episode_external_file = get_post_meta( $post_id, 'external_episode_file', true );

            $episode_cleaned_content = strip_tags(get_the_content_feed());
            $episode_cleaned_subtitle = strip_tags($episode_subtitle);

            if (!empty($episode_attachment_id)) {
                $player_src = wp_get_attachment_url( $episode_attachment_id );
            } elseif (!empty($episode_external_file)) {
                $player_src = $episode_external_file;
            }
            $media_info = wp_get_attachment_metadata($episode_attachment_id);

            $episode_artwork_src = $podcast_artwork_src;

            $episode_artwork_id = get_post_thumbnail_id( $post_id );
            if (!empty($episode_artwork_id)) {
                $episode_artwork = wp_get_attachment_image_src( $episode_artwork_id, 'cap-podcast-thumbnail' );
                $episode_artwork_src = $episode_artwork[0];
            }
        ?>

        <item>
            <title><?php the_title_rss(); ?> #<?php echo $episode_number;?></title>
            <itunes:subtitle>
                <![CDATA[<?php echo htmlspecialchars($episode_cleaned_subtitle);?>]]>
            </itunes:subtitle>
            <itunes:summary>
                <![CDATA[<?php echo htmlspecialchars($episode_cleaned_content);?>]]>
            </itunes:summary>
            <description>
                <![CDATA[<?php echo htmlspecialchars($episode_cleaned_content);?>]]>
            </description>
            <link><?php echo $player_src;?></link>
            <enclosure url="<?php echo $player_src;?>" length="<?php echo $media_info['length'];?>" type="audio/mpeg"/>
            <guid><?php the_permalink();?></guid>
            <itunes:duration><?php echo $media_info['length_formatted'];?></itunes:duration>
            <itunes:image href="<?php echo $episode_artwork_src;?>"/>
            <author><?php echo $podcast_author_email;?> (<?php echo $podcast_author;?>)</author>
            <itunes:author><?php echo $podcast_author;?></itunes:author>
            <?php
            $posttags = get_the_tags();
            if ($posttags) {
                echo '<itunes:keywords>';
                foreach($posttags as $tag) {
                    echo htmlspecialchars($tag->name).', ';
                }
                echo '</itunes:keywords>';
            }
            ?>

            <?php
            if (true == get_post_meta($post_id, 'explicit', true)) {
                $is_episode_explicit = '<itunes:explicit>yes</itunes:explicit>';
            } else {
                $is_episode_explicit = '<itunes:explicit>clean</itunes:explicit>';
            }
            ?>
            <pubDate><?php the_date('r');?></pubDate>
        </item>
        <?php endwhile; ?>
    </channel>
</rss>
