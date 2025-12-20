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
                            <iframe id="videoFrame" width="100%" height="400"
                                src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>" frameborder="0"
                                allow="autoplay; accelerometer; clipboard-write; picture-in-picture" allowfullscreen>
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
                <div class="vlog-title">
                    <h1><?php the_title(); ?></h1>
                    <div class="vlog-date">
                        <?php $post_time = get_post_time(); ?>
                        <span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="2" y="3" width="12" height="11" rx="1" stroke="currentColor" stroke-width="1.5" fill="none"/>
                                <path d="M5 1v3M11 1v3M2 7h12" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            <?php echo date("d M Y", $post_time); ?>
                        </span>
                    </div>
                </div>

                <div class="vlog-content-wrap">
                    <h2 class="content-heading">About this Video</h2>
                    <div class="content-text">
                        <?php the_content(); ?>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>
        <!-- Back to All Videos Button -->
        <div class="back_to_posts">
            <a href="<?php echo esc_url(home_url('vlog')); ?>">

                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.0313 9.25781H5.60354L12.4434 3.32031C12.5528 3.22461 12.4864 3.04688 12.3418 3.04688H10.6133C10.5371 3.04688 10.4649 3.07422 10.4082 3.12305L3.02737 9.52734C2.95977 9.58594 2.90555 9.65838 2.8684 9.73976C2.83124 9.82114 2.81201 9.90956 2.81201 9.99902C2.81201 10.0885 2.83124 10.1769 2.8684 10.2583C2.90555 10.3397 2.95977 10.4121 3.02737 10.4707L10.4512 16.9141C10.4805 16.9395 10.5156 16.9531 10.5528 16.9531H12.3399C12.4844 16.9531 12.5508 16.7734 12.4414 16.6797L5.60354 10.7422H17.0313C17.1172 10.7422 17.1875 10.6719 17.1875 10.5859V9.41406C17.1875 9.32812 17.1172 9.25781 17.0313 9.25781Z"
                        fill="#FFC700" />
                </svg>
                Back to All Videos
            </a>
        </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const playButton = document.getElementById('playButton');
        const videoPlayer = document.getElementById('videoPlayer');
        const featuredImage = document.querySelector('.vlog-featured-image');
        const videoFrame = document.getElementById('videoFrame');

        if (playButton && videoPlayer && videoFrame) {
            playButton.addEventListener('click', function () {
                const currentSrc = videoFrame.src;
                videoFrame.src = currentSrc + '?autoplay=1';
                featuredImage.style.display = 'none';
                videoPlayer.style.display = 'block';
            });
        }
    });
</script>


<?php get_footer();