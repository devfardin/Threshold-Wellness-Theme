<?php
/**
 * Custom Page Header with Customizer Settings
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Get customizer settings
$bg_type = get_theme_mod('page_header_bg_type', 'image');
$bg_image = get_theme_mod('page_header_bg_image');
$bg_video = get_theme_mod('page_header_bg_video');

// Get global title
if (is_category()) {
    $title = single_cat_title('', false);
    $subtitle = category_description();
} else if(is_author()) {
    $title = get_queried_object()->display_name;
    $subtitle = '';
} else if(is_search()) {
    $title = get_queried_object()->display_name;
    $subtitle = '';
} else if(is_404()) {
    $title = get_queried_object()->display_name;
    $subtitle = '';
} else if(is_single()){
    $title = get_the_title();
    $subtitle = '';
}

?>

<?php
echo '<div class="custom-page-header">';

if ( $bg_type === 'video' && $bg_video ) {
    echo '<video autoplay muted loop playsinline><source src="' . esc_url($bg_video) . '" type="video/mp4"></video>';
} elseif ( $bg_type === 'image' && $bg_image ) {
    echo '<div class="custom-page-header-bg" style="background-image: url(' . esc_url($bg_image) . ');"></div>';
}

echo '<div class="custom-page-header-overlay"></div>';
echo '<div class="entry-content-wrap">';
echo '<h1 class="custom-page-title">' . esc_html($title) . '</h1>';
if ( $subtitle ) {
    echo '<p class="custom-page-subtitle">' . wp_kses_post($subtitle) . '</p>';
}
echo '</div></div>';
?>