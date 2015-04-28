<?php
/**
* Constructs the RSS/XML feed used by podcasting apps like iTunes and Pocketcasts
*/

$podcast_name           = '';
$podcast_description    = '';
///
$podcast_artwork_id     = get_field('podcast_album_art','options');
$podcast_artwork        = wp_get_attachment_image_src( $podcast_artwork_id, 'cap-podcast-thumbnail' );
$podcast_artwork_src    = $podcast_artwork[0];
///
$podcast_subtitle       = '';
$podcast_author         = get_field('podcast_author','options');
$podcast_author_email   = get_field('podcast_author_email','options');
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:atom="http://www.w3.org/2005/Atom" xml:lang="en" version="2.0">
    <channel>
        <title><?php the_field('podcast_name','options');?></title>
        <link><?php bloginfo('url');?>/podcast</link>
        <atom:link href="<?php echo get_feed_link();?>?post_type=cap_podcast" rel="self" type="application/rss+xml"/>
        <description>
            <?php the_field('podcast_description','options');?>
        </description>
        <generator>
            PressCast 1.0 - http://presscast.com
        </generator>
        <language>en</language>
        <copyright><?php the_field('podcast_copyright','options');?></copyright>
        <image>
            <url>
                <?php echo $podcast_artwork_src;?>
            </url>
            <title><?php the_field('podcast_name','options');?></title>
            <link><?php bloginfo('url');?>/podcast</link>
        </image>

        <itunes:image href="<?php echo $podcast_artwork_src;?>"/>
        <itunes:summary>
            <?php the_field('podcast_description','options');?>
        </itunes:summary>
        <itunes:subtitle><?php the_field('podcast_subtitle','options');?></itunes:subtitle>
        <itunes:author><?php echo $podcast_author;?></itunes:author>
        <itunes:owner>
            <itunes:name><?php echo $podcast_author;?></itunes:name>
            <itunes:email><?php echo $podcast_author_email;?></itunes:email>
        </itunes:owner>
        <itunes:explicit>clean</itunes:explicit>
        <itunes:category text="News and Politics"/>
        <itunes:category text="Technology">
        <itunes:category text="Podcasting"/>
        </itunes:category>

        <?php while( have_posts()) : the_post(); ?>
        <?php
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
                Test subtitle is the short descriptionin listings
            </itunes:subtitle>
            <itunes:summary>
                <![CDATA[<?php echo strip_tags(get_the_content_feed());?>]]>
            </itunes:summary>
            <description>
                <![CDATA[<?php echo strip_tags(get_the_content_feed());?>]]>
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
                    echo $tag->name.', ';
                }
                echo '</itunes:keywords>';
            }
            ?>

            <itunes:explicit>no</itunes:explicit>
            <pubDate><?php the_date('r');?></pubDate>
        </item>
        <?php endwhile; ?>
    </channel>
</rss>
