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
            <h1 class="custom-page-title"> <?php echo esc_html(the_title()) ?></h1>
            <p class="custom-page-subtitle"> <?php echo esc_html(get_the_date(' F j, Y')) ?></p>
        </div>
    </div>

    <div class="site-container">
        <div id="content" style="margin-top: 60px">



        </div>
    </div>
</section>

<?php get_footer();
