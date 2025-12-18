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
                <img src="<?php echo get_avatar_url($author_id); ?>"
                    alt="<?php echo get_the_author_meta('display_name', $author_id); ?>">
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
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>"
                    target="_blank">

                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.6539 11.25L15.2094 7.63047H11.7364V5.28164C11.7364 4.29141 12.2215 3.32617 13.777 3.32617H15.3559V0.244531C15.3559 0.244531 13.9231 0 12.5531 0C9.69299 0 7.82346 1.73359 7.82346 4.87187V7.63047H4.64417V11.25H7.82346V20H11.7364V11.25H14.6539Z" />
                    </svg>

                </a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url(get_permalink()); ?>&text=<?php echo esc_attr(get_the_title()); ?>"
                    target="_blank">

                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.9441 5.92641C17.9568 6.10406 17.9568 6.28176 17.9568 6.45941C17.9568 11.8782 13.8325 18.1218 6.29441 18.1218C3.97207 18.1218 1.81473 17.4492 0 16.2818C0.329961 16.3198 0.647187 16.3325 0.989844 16.3325C2.90605 16.3325 4.67004 15.6853 6.07867 14.5813C4.27664 14.5432 2.76648 13.363 2.24617 11.7386C2.5 11.7766 2.75379 11.802 3.02031 11.802C3.38832 11.802 3.75637 11.7513 4.09898 11.6625C2.22082 11.2817 0.812148 9.63199 0.812148 7.63961V7.58887C1.35781 7.89344 1.99238 8.08379 2.66492 8.10914C1.56086 7.37309 0.837539 6.11676 0.837539 4.69543C0.837539 3.93402 1.04055 3.23606 1.3959 2.62692C3.41367 5.11422 6.44668 6.73856 9.84766 6.91625C9.78422 6.61168 9.74613 6.29445 9.74613 5.97719C9.74613 3.71828 11.5736 1.8782 13.8451 1.8782C15.0253 1.8782 16.0913 2.37313 16.84 3.17262C17.7664 2.99496 18.6547 2.65231 19.4416 2.18277C19.137 3.13457 18.4898 3.93406 17.6395 4.44164C18.4644 4.35285 19.2639 4.12438 19.9999 3.80715C19.4416 4.6193 18.7436 5.34262 17.9441 5.92641Z" />
                    </svg>

                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url(get_permalink()); ?>"
                    target="_blank">


                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.16719 17.4998H1.53906V5.81624H5.16719V17.4998ZM3.35117 4.22249C2.19102 4.22249 1.25 3.26156 1.25 2.1014C1.25 1.54414 1.47137 1.00969 1.86542 0.615648C2.25947 0.221602 2.79391 0.000228882 3.35117 0.000228882C3.90844 0.000228882 4.44288 0.221602 4.83692 0.615648C5.23097 1.00969 5.45234 1.54414 5.45234 2.1014C5.45234 3.26156 4.51094 4.22249 3.35117 4.22249ZM18.7461 17.4998H15.1258V11.8123C15.1258 10.4569 15.0984 8.71859 13.2395 8.71859C11.3531 8.71859 11.0641 10.1912 11.0641 11.7147V17.4998H7.43984V5.81624H10.9195V7.40999H10.9703C11.4547 6.49203 12.6379 5.52328 14.4031 5.52328C18.075 5.52328 18.75 7.94124 18.75 11.0819V17.4998H18.7461Z" />
                    </svg>


                </a>
                <a
                    href="mailto:?subject=<?php echo esc_attr(get_the_title()); ?>&body=<?php echo esc_url(get_permalink()); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M18.125 2.5H1.875C0.839453 2.5 0 3.33945 0 4.375V15.625C0 16.6605 0.839453 17.5 1.875 17.5H18.125C19.1605 17.5 20 16.6605 20 15.625V4.375C20 3.33945 19.1605 2.5 18.125 2.5ZM18.125 4.375V5.96895C17.2491 6.68219 15.8528 7.79125 12.8677 10.1287C12.2098 10.6462 10.9067 11.8893 10 11.8748C9.09344 11.8895 7.78988 10.646 7.13231 10.1287C4.14766 7.7916 2.75098 6.6823 1.875 5.96895V4.375H18.125ZM1.875 15.625V8.37492C2.77008 9.08785 4.03941 10.0883 5.97414 11.6033C6.82793 12.2754 8.32312 13.759 10 13.75C11.6686 13.759 13.1449 12.2969 14.0255 11.6036C15.9602 10.0886 17.2299 9.08793 18.125 8.37496V15.625H1.875Z" />
                    </svg>
                </a>
            </div>

            <!-- back to posts -->
            <div class="back_to_posts">
                <a href="<?php echo esc_url(home_url('blog')); ?>">

                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.0313 9.25781H5.60354L12.4434 3.32031C12.5528 3.22461 12.4864 3.04688 12.3418 3.04688H10.6133C10.5371 3.04688 10.4649 3.07422 10.4082 3.12305L3.02737 9.52734C2.95977 9.58594 2.90555 9.65838 2.8684 9.73976C2.83124 9.82114 2.81201 9.90956 2.81201 9.99902C2.81201 10.0885 2.83124 10.1769 2.8684 10.2583C2.90555 10.3397 2.95977 10.4121 3.02737 10.4707L10.4512 16.9141C10.4805 16.9395 10.5156 16.9531 10.5528 16.9531H12.3399C12.4844 16.9531 12.5508 16.7734 12.4414 16.6797L5.60354 10.7422H17.0313C17.1172 10.7422 17.1875 10.6719 17.1875 10.5859V9.41406C17.1875 9.32812 17.1172 9.25781 17.0313 9.25781Z"
                            fill="#FFC700" />
                    </svg>
                    Back to All Posts
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
