<?php
if (!defined("ABSPATH"))
    exit;

class studios_grid
{
    public function __construct()
    {
        // create shortcode for studios grid
        add_shortcode("threshold_rander_studios", array($this, "threshold_studios_grid"));
    }
    public function threshold_studios_grid()
    {
        ob_start();
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'studio',
            'post_status' => 'publish',
            'paged' => $paged,
        );
        $query = new \WP_Query($args); ?>
        <section class="threshold_studio_container">
            <div class="threshold_studio_wrapper">
                <?php if ($query->have_posts()): ?>
                    <div class="threshold_studio__row">
                        <?php while ($query->have_posts()):
                            $query->the_post(); ?>
                            <article class="threshold_studio__inner_container">

                                <!-- Post Feature image -->
                                <div class="threshold_studio__feature">
                                    <a href="<?php echo esc_attr(get_the_permalink()) ?>" rel="bookmark"
                                        aria-label="More about <?php echo esc_attr(get_the_title()); ?>">
                                        <?php esc_html(the_post_thumbnail('medium_large')) ?>
                                    </a>
                                </div>

                                <!-- Post Info -->
                                <div class="studio_info_container">

                                    <!-- post title -->
                                    <h1 class="studio_title">
                                        <?php echo esc_html(substr(get_the_title(), 0, 30)) . '...'; ?>
                                    </h1>
                                    <!-- Studio location -->
                                    <div class="studio_location_wrapper">
                                        <!-- map icon -->
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_51_2)">
                                                <path
                                                    d="M10.0716 -0.00718689C5.97187 -0.00718689 2.5 3.48438 2.5 7.62063C2.5 11.9519 6.52406 16.3813 9.23094 19.4944C9.24125 19.5069 9.67877 19.9928 10.2178 19.9928H10.2656C10.8047 19.9928 11.2391 19.5069 11.25 19.4944C13.7903 16.5741 17.5 11.7591 17.5 7.62063C17.5 3.48438 14.7919 -0.00718689 10.0716 -0.00718689ZM10.3222 18.6559C10.3003 18.6778 10.2684 18.7022 10.2403 18.7225C10.2115 18.7028 10.1803 18.6778 10.1572 18.656L9.83029 18.28C7.26406 15.3359 3.75 11.3044 3.75 7.62063C3.75 4.16344 6.645 1.2425 10.0716 1.2425C14.3397 1.2425 16.25 4.44563 16.25 7.62063C16.25 10.4172 14.2553 14.1303 10.3222 18.6559ZM10.0219 3.7775C7.95092 3.7775 6.27186 5.45656 6.27186 7.5275C6.27186 9.59844 7.95092 11.2775 10.0219 11.2775C12.0928 11.2775 13.7719 9.59844 13.7719 7.5275C13.7719 5.45656 12.0928 3.7775 10.0219 3.7775ZM10.0219 10.0275C8.64342 10.0275 7.49309 8.87875 7.49309 7.5C7.49309 6.12156 8.61465 5 9.99309 5C11.3725 5 12.4931 6.12156 12.4931 7.5C12.4937 8.87875 11.4012 10.0275 10.0219 10.0275Z"
                                                    fill="#FFC700" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_51_2">
                                                    <rect width="20" height="20" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <p class="studio_location"> <?php
                                        $studio_location = get_post_meta(get_the_ID(), 'location', true);
                                        echo esc_html($studio_location); ?>
                                        </p>
                                    </div>

                                    <!-- post content -->
                                    <div class="studio_content_wrapper">
                                        <p class="studio_content"> <?php
                                        echo esc_html(substr(get_the_content(), 0, 100)) . '...'; ?>
                                        </p>
                                    </div>

                                    <!-- studios features -->
                                    <div class="studio_features_wrapper">
                                        <?php 
                                        $studio_features = get_field('features');
                                        if (!empty($studio_features) && is_array($studio_features)):
                                            foreach ($studio_features as $feature): 
                                                if (!empty($feature['items'])): ?>
                                                    <div class="studio_features">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                                        </svg>
                                                        <span><?php echo esc_html($feature['items']); ?></span>
                                                    </div>
                                                <?php endif;
                                            endforeach;
                                        endif;
                                        ?>
                                    </div>


                                    <!-- post author and Date -->
                                    <div class="studio_author_learn_more_bnt">
                                        <a class="learn_more_btn" href="<?php echo home_url('book-now'); ?>">
                                            Book at This Location
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
                    <div class="studio_navigation" role="navigation">
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
                    <div class='threshold_no_studios_message'>
                        <h2>No Studios to Display</h2>
                        <p>We're adding new studio locations. Visit again soon to explore our latest facilities.</p>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </section>

        <?php return ob_get_clean();
    }
}