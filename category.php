<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
<?php 
get_template_part('includes/page-header');
?>
<div class="cfx-body">
    <div id="content">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $current_category = get_queried_object();
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'paged' => $paged,
            'cat' => $current_category->term_id,
        );
        $query = new \WP_Query($args);
        ?>
        <section class="threshold_post_container">
            <div class="threshold_post_wrapper">
                <?php if ($query->have_posts()): ?>
                    <div class="threshold_post__row">
                        <?php while ($query->have_posts()):
                            $query->the_post(); ?>
                            <article class="threshold_post__inner_container">

                                <!-- Post Feature image -->
                                <div class="threshold_post__feature">
                                    <a href="<?php echo get_the_permalink(); ?>" rel="bookmark"
                                        aria-label="More about <?php echo get_the_title(); ?>">
                                        <?php the_post_thumbnail(''); ?>
                                    </a>
                                </div>
                                <!-- Post Info -->
                                <div class="blog_post_info_container">
                                    <!-- post title -->
                                    <h1 class="blog_post_title">
                                        <?php echo substr(get_the_title(), 0, 60) . '...'; ?>
                                    </h1>
                                    <!-- post content -->
                                    <div class="blog_post_content_wrapper">
                                        <p class="blog_post_content"> <?php
                                        echo substr(get_the_content(), 0, 130) . '...'; ?>
                                        </p>
                                    </div>
                                    <div class="blog_post_read_more_btn">
                                        <a href="<?php echo get_the_permalink(); ?>">Read More</a>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="11" viewBox="0 0 8 11" fill="none">
                                            <path
                                                d="M1.58331 0.25L0.232056 1.48375L4.62122 5.5L0.232056 9.51625L1.58331 10.75L7.33331 5.5L1.58331 0.25Z"
                                                fill="#622743" />
                                        </svg>
                                    </div>
                                    <!-- post author and Date -->
                                    <div class="post_author_date_wrapper">
                                        <!-- post author -->
                                        <?php 
                                        $author_id = get_the_author_meta('ID');
                                        $author_name = get_the_author_meta('display_name', $author_id);
                                        $avatar_url = get_avatar_url($author_id);
                                        
                                        $name_parts = explode(' ', trim($author_name));
                                        $first_initial = !empty($name_parts[0]) ? strtoupper($name_parts[0][0]) : '';
                                        $last_initial = !empty($name_parts[1]) ? strtoupper($name_parts[1][0]) : '';
                                        $initials = $first_initial . $last_initial;
                                        
                                        // Check if it's a default gravatar (mystery person)
                                        $is_default_avatar = strpos($avatar_url, 'd=mm') !== false || strpos($avatar_url, 'd=blank') !== false || strpos($avatar_url, 'd=mystery') !== false;
                                        ?>
                                         <a href="<?php echo get_author_posts_url($author_id); ?>" class="blog_post_author_wrapper">
                                            <?php if ($is_default_avatar): ?>
                                                <div class='blog_post__author_initials'><?php echo $initials; ?></div>
                                            <?php else: ?>
                                                <img class='blog_post__author_avatar' src="<?php echo $avatar_url; ?>"
                                                    alt="<?php echo $author_name; ?>" 
                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class='blog_post__author_initials' style='display:none;'><?php echo $initials; ?></div>
                                            <?php endif; ?>
                                            <h3 class='auther_display_name'>
                                                <?php echo $author_name; ?>
                                            </h3>
                                        </a>
                                        <div class="blog_post_date">
                                            <?php $post_time = get_post_time(); ?>
                                            <span> <?php echo date("d M Y", $post_time); ?> </span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>         <?php wp_reset_postdata(); ?>
                    </div>
                    <div class="blog_post_navigation" role="navigation">
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
                    <div class='threshold_no_posts_message'>
                        <h2>No Articles Found in This Category</h2>
                        <p>We're working on bringing you fresh content. Please check back soon for new articles and insights.</p>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </section>
    </div>
</div>

<?php
get_footer();