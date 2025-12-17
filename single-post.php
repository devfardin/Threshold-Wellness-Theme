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
            <!-- author infor     -->
            <div class="author_info">


            </div>
            <!-- post content -->
            <div>

            </div>
            <!-- article sharing icons facebook, twitter, linkedin, gmail -->
            <div>

            </div>
            <!-- back to all post buton -->
            <div>

            </div>



        </div>
    </div>
</section>

<?php get_footer();
