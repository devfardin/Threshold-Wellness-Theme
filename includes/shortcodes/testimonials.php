<?php
if (!defined("ABSPATH")) {
    exit;
}

class testimonials
{
    public function __construct()
    {
        // create shortcode for testimonials
        add_shortcode("threshold_rander_testimonials", array($this, "threshold_testimonials"));
    }
    public function threshold_testimonials()
    {
        ob_start();
        wp_enqueue_style("byteitfarm_customer_reviews");
        $args = array(
            'post_type' => 'wpm-testimonial',
            'post_status' => 'publish',
            'posts_per_page' => 6,
        );
        $query = new \WP_Query($args);

        ?>
        <section class="byteitfarm_reviews_container">
            <div class="byteitfarm_revews_wrapper">
                <?php if ($query->have_posts()): ?>
                    <div class="byteitfarm_revews__row">
                        <?php while ($query->have_posts()):
                            $query->the_post(); ?>
                            <div class="byteitfarm_innter_container feature_item">
                                <div>
                                    <!-- client rating START -->
                                    <div class="client_rating">
                                        <?php
                                        $value = (int) get_post_meta(get_the_ID(), 'star_rating', true);
                                        echo str_repeat('<span class="fill">★</span>', $value) . str_repeat('<span class="out">☆</span>', 5 - $value);
                                        ?>
                                    </div>
                                    <!-- Client rating END -->
                                    <!-- client comments START -->
                                    <div class="client_comment">
                                        <p><?php echo get_the_content() ?></p>
                                    </div>
                                    <!-- client comments END -->
                                </div>
                                <!-- Clint info START -->
                                <div class="reviews_author">
                                    <div class="author_feature">
                                        <?php the_post_thumbnail('widget-thumbnail'); ?>
                                    </div>
                                    <div class="author_name_degnation">
                                        <span class="author_name"><?php echo get_post_meta(get_the_ID(), 'client_name', true); ?></span>

                                        <?php if (!empty(get_post_meta(get_the_ID(), 'designation', true))) ?>
                                            <span
                                                class="author_degnation"><?Php echo get_post_meta(get_the_ID(), 'designation', true) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <h1 class='iris_no_post_message'> No Reviews are available at the moment </h1>
                    <?php
                endif;
                ?>
            </div>
        </section>
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }
}