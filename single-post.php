<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<section class="threshold-sinlge-post">

    <div class="custom-page-header">
        <div class="custom-page-header-bg"
            style="background-image: url('<?php echo esc_attr(the_post_thumbnail_url('post-thumbnail')) ?>');">
        </div>'
        <div class="custom-page-header-overlay"></div>
        <div class="entry-content-wrap site-container">
            <!-- post categories -->
            <span class="blog_post_category_wraper">

                <?php
                $categories = get_the_terms(get_the_ID(), 'category');
                if ($categories) {
                    foreach ($categories as $category):
                        $link = get_term_link($category, 'category'); ?>
                        <a class='blog_post_category'
                            href="<?php echo esc_url($link) ?>"><?php echo esc_html($category->name) ?>
                        </a>
                    <?php endforeach;
                }
                ; ?>
            </span>
            <h1 class="custom-page-title"> <?php echo esc_html(the_title()) ?></h1>
            <p class="custom-page-subtitle"> <?php echo esc_html(get_the_date(' F j, Y')) ?></p>
        </div>
    </div>

    <div class="site-container">
        <div class="blog_post_info">
            <!-- author info -->
            <div class="author_info">
                <?php $author_id = $post->post_author; ?>
                <img src="<?php echo get_avatar_url($author_id); ?>" alt="<?php echo get_the_author_meta('display_name', $author_id); ?>">
                <div class="author_details">
                    <h4>
                        <?php echo get_the_author_meta('display_name', $author_id); ?>
                    </h4>
                    <p><?php echo get_the_author_meta('description', $author_id); ?></p>
                </div>
            </div>

            <!-- post content -->
            <div class="post_content">
                <?php the_content(); ?>
            </div>

            <!-- social sharing -->
            <div class="social_share">
                <span>Share:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url(get_permalink()); ?>&text=<?php echo esc_attr(get_the_title()); ?>" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url(get_permalink()); ?>" target="_blank">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="mailto:?subject=<?php echo esc_attr(get_the_title()); ?>&body=<?php echo esc_url(get_permalink()); ?>">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>

            <!-- back to posts -->
            <div class="back_to_posts">
                <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>">
                    <i class="fas fa-arrow-left"></i> Back to All Posts
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
