<?php
class Vlogs_grid
{
    public function __construct()
    {
        // create short for vlogs grid
        add_shortcode("threshold_rander_vlogs", array($this, "threshold_vlogs_grid"));
    }
    public function threshold_vlogs_grid()
    {
        ob_start();
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'vlog',
            'post_status' => 'publish',
            'paged' => $paged,
        );
        $query = new \WP_Query($args); ?>
        <section class="threshold_vlog_container">
            <div class="threshold_vlog_wrapper">
                <?php if ($query->have_posts()): ?>
                    <div class="threshold_vlog__row">
                        <?php while ($query->have_posts()):
                            $query->the_post(); ?>
                            <article class="threshold_vlog__inner_container">

                                <!-- Post Feature image -->
                                <div class="threshold_vlog__feature">
                                    <a href="<?php echo esc_attr(get_the_permalink()) ?>" rel="bookmark"
                                        aria-label="More about <?php echo esc_attr(get_the_title()); ?>">
                                        <?php esc_html(the_post_thumbnail('medium_large')) ?>
                                    </a>
                                    <?php
                                    $categories = get_the_terms(get_the_ID(), 'video-category');
                                    if ($categories) {
                                        $first_three_categories = array_slice($categories, 0, 1, false);
                                        foreach ($first_three_categories as $category):
                                            $link = get_term_link($category, 'video-category'); ?>
                                            <a class='vlog_category' href="<?php echo esc_url($link) ?>"><?php echo esc_html($category->name) ?>
                                            </a>
                                        <?php endforeach;
                                    }
                                    ; ?>
                                    <div class="vlog_video_icon" id="openModal-<?php echo get_the_ID(); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                                            <circle cx="32" cy="32" r="32" fill="#FFC700" fill-opacity="1" />
                                            <path d="M26 20L46 32L26 44V20Z" fill="#000000" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Modal Overlay -->
                                <div id="customModal-<?php echo get_the_ID(); ?>" class="modal-overlay">
                                    <div class="modal-box">
                                        <button class="modal-close" id="closeModal-<?php echo get_the_ID(); ?>">&times;</button>
                                        <h2><?php echo esc_html(get_the_title()); ?></h2>
                                        <div class="modal-video-content">
                                            <?php echo get_the_content(); ?>
                                        </div>
                                    </div>
                                </div>


                                <!-- Post Info -->
                                <div class="vlog_info_container">
                                    <div class="vlog_date">
                                        <?php $post_time = get_post_time(); ?>
                                        <span> <?php echo date("d M Y", $post_time); ?> </span>
                                    </div>
                                    <!-- post title -->
                                    <h1 class="vlog_title">
                                        <?php echo esc_html(substr(get_the_title(), 0, 30)) . '...'; ?>
                                    </h1>
                                    <!-- post content -->
                                    <div class="vlog_content_wrapper">
                                        <p class="vlog_content"> <?php
                                        echo esc_html(substr(get_the_content(), 0, 100)) . '...'; ?>
                                        </p>
                                    </div>

                                    <!-- post author and Date -->
                                    <div class="vlog_author_learn_more_bnt">
                                        <a class="learn_more_btn" href="<?php echo get_the_permalink(); ?>">
                                            Watch Video
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="15" viewBox="0 0 18 15"
                                                fill="none">
                                                <path
                                                    d="M10.22 13.7985C10.0795 13.6578 10.0007 13.4672 10.0007 13.2685C10.0007 13.0697 10.0795 12.8791 10.22 12.7385L15.19 7.76845H0.75C0.551088 7.76845 0.360322 7.68943 0.21967 7.54878C0.0790175 7.40813 0 7.21737 0 7.01845C0 6.81954 0.0790175 6.62878 0.21967 6.48812C0.360322 6.34747 0.551088 6.26845 0.75 6.26845H15.19L10.22 1.29845C10.1213 1.20678 10.0491 1.09018 10.0111 0.96093C9.97308 0.831681 9.97063 0.694572 10.004 0.564048C10.0374 0.433524 10.1053 0.314418 10.2007 0.219278C10.2961 0.124138 10.4154 0.0564872 10.546 0.0234531C10.6764 -0.00996352 10.8133 -0.0076322 10.9425 0.0302018C11.0717 0.0680358 11.1883 0.139974 11.28 0.238453L17.53 6.48845C17.6705 6.62908 17.7493 6.8197 17.7493 7.01845C17.7493 7.2172 17.6705 7.40783 17.53 7.54845L11.28 13.7985C11.1394 13.9389 10.9488 14.0178 10.75 14.0178C10.5512 14.0178 10.3606 13.9389 10.22 13.7985Z"
                                                    fill="#FFC700" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                    <div class="vlog_navigation" role="navigation">
                        <?php
                        $big = 999999999; // need an unlikely integer
                        $translated = __('', 'extracatchy'); // Supply translatable string
                        echo paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $query->max_num_pages,
                            'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>'
                        )); ?>
                    </div>

                <?php else: ?>
                    <div class='threshold_no_vlogs_message'>
                        <h2>No Vlogs to Display</h2>
                        <p>We’re creating new video content behind the scenes. Visit again soon to explore our latest moments.</p>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </section>

        <?php return ob_get_clean();
    }
}