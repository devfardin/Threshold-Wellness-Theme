<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
wp_enqueue_style('single-vlog', get_template_directory_uri() . '/assets/css/single-vlog.css');
?>

<section class="threshold-single-vlog">
    <div class="container site-container">
        <?php while (have_posts()):
            the_post(); ?>

            <!-- Featured Image with Play Icon -->
            <div class="vlog-featured-image">
                <?php if (has_post_thumbnail()): ?>
                    <div class="image-container">
                        <?php the_post_thumbnail('full', ['class' => 'featured-img']); ?>
                        <div class="play-icon" id="playButton">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                                <circle cx="32" cy="32" r="32" fill="#FFC700" fill-opacity="1" />
                                <path d="M26 20L46 32L26 44V20Z" fill="#000000" />
                            </svg>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Video Player (Hidden initially) -->
            <div class="video-player" id="videoPlayer" style="display: none;">
                <div class="video-container">
                    <?php
                    $youtube_url = get_post_meta(get_the_ID(), 'video-url', true);
                    if ($youtube_url):
                        // Extract video ID from YouTube URL
                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $youtube_url, $matches);
                        $video_id = $matches[1] ?? '';
                        if ($video_id):
                            ?>
                            <iframe width="100%" height="400"
                                src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>?autoplay=-1" frameborder="0"
                                allow="accelerometer; clipboard-write;  picture-in-picture" allowfullscreen>
                            </iframe>
                        <?php
                        endif;
                    endif;
                    ?>
                </div>
            </div>

            <!-- Category and Title Section -->
            <div class="vlog-meta">
                <?php
                $categories = get_the_terms(get_the_ID(), 'video-category'); // Assuming custom taxonomy
                if ($categories && !is_wp_error($categories)):
                    ?>
                    <div class="vlog-category">
                        <span class="category-tag"><?php echo esc_html($categories[0]->name); ?></span>
                    </div>
                <?php endif; ?>

                <h1 class="vlog-title"><?php the_title(); ?></h1>
                <div class="title-border"></div>
            </div>

            <!-- About This Video Section -->
            <div class="vlog-content">
                <h2 class="content-heading">About this Video</h2>
                <div class="content-text">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- Back to All Videos Button -->
            <div class="back-button-container">
                <a href="<?php echo get_post_type_archive_link('vlog'); ?>" class="back-button">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Back to All Videos
                </a>
            </div>

        <?php endwhile; ?>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const playButton = document.getElementById('playButton');
        const videoPlayer = document.getElementById('videoPlayer');
        const featuredImage = document.querySelector('.vlog-featured-image');

        if (playButton && videoPlayer) {
            playButton.addEventListener('click', function () {
                featuredImage.style.display = 'none';
                videoPlayer.style.display = 'block';
            });
        }
    });
</script>


<?php get_footer();