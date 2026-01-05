<?php
/**
 * Custom Page Header Manager for Kadence Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


class Custom_Page_Header {

    public function __construct() {
        add_action( 'acf/init', [ $this, 'register_page_header_fields' ] );
        add_filter( 'theme_mod_page_title', [ $this, 'disable_page_title' ] );
        add_action( 'kadence_before_content', [ $this, 'render_custom_page_header' ], 5 );
    }

    public function register_page_header_fields() {
        if ( ! function_exists('acf_add_local_field_group') ) return;

        acf_add_local_field_group([
            'key' => 'group_custom_page_header',
            'title' => 'Custom Page Header',
            'fields' => [
                [
                    'key' => 'field_enable_custom_header',
                    'label' => 'Enable Custom Header',
                    'name' => 'enable_custom_header',
                    'type' => 'true_false',
                    'default_value' => 0,
                    'ui' => 1,
                ],
                [
                    'key' => 'field_page_title',
                    'label' => 'Page Title',
                    'name' => 'page_title',
                    'type' => 'text',
                    'placeholder' => 'Leave empty to use page name',
                    'conditional_logic' => [[['field' => 'field_enable_custom_header', 'operator' => '==', 'value' => '1']]],
                ],
                [
                    'key' => 'field_page_subtitle',
                    'label' => 'Page Subtitle',
                    'name' => 'page_subtitle',
                    'type' => 'text',
                    'conditional_logic' => [[['field' => 'field_enable_custom_header', 'operator' => '==', 'value' => '1']]],
                ],
                [
                    'key' => 'field_background_type',
                    'label' => 'Background Type',
                    'name' => 'background_type',
                    'type' => 'select',
                    'choices' => ['image' => 'Image', 'video' => 'Video', 'url' => 'URL'],
                    'default_value' => 'image',
                    'conditional_logic' => [[['field' => 'field_enable_custom_header', 'operator' => '==', 'value' => '1']]],
                ],
                [
                    'key' => 'field_page_background',
                    'label' => 'Background Image',
                    'name' => 'page_background',
                    'type' => 'image',
                    'return_format' => 'url',
                    'conditional_logic' => [[['field' => 'field_enable_custom_header', 'operator' => '==', 'value' => '1'], ['field' => 'field_background_type', 'operator' => '==', 'value' => 'image']]],
                ],
                [
                    'key' => 'field_background_video',
                    'label' => 'Background Video',
                    'name' => 'background_video',
                    'type' => 'file',
                    'return_format' => 'url',
                    'mime_types' => 'mp4,webm',
                    'conditional_logic' => [[['field' => 'field_enable_custom_header', 'operator' => '==', 'value' => '1'], ['field' => 'field_background_type', 'operator' => '==', 'value' => 'video']]],
                ],
                [
                    'key' => 'field_background_video_url',
                    'label' => 'Background Video URL',
                    'name' => 'background_video_url',
                    'type' => 'url',
                    'placeholder' => 'https://example.com/video.mp4',
                    'conditional_logic' => [[['field' => 'field_enable_custom_header', 'operator' => '==', 'value' => '1'], ['field' => 'field_background_type', 'operator' => '==', 'value' => 'url']]],
                ],
            ],
            'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'page']]],
        ]);
    }

    public function get_embed_url($url) {
        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
            return isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1' : false;
        }
        if (strpos($url, 'vimeo.com') !== false) {
            preg_match('/vimeo\.com\/(\d+)/', $url, $matches);
            return isset($matches[1]) ? 'https://player.vimeo.com/video/' . $matches[1] . '?autoplay=1&muted=1&loop=1&background=1&controls=0' : false;
        }
        return $url;
    }

    public function disable_page_title( $value ) {
        if ( is_page() && function_exists('get_field') && get_field('enable_custom_header') ) {
            return false;
        }
        return $value;
    }

    public function render_custom_page_header() {
        if ( ! is_page() || ! function_exists('get_field') || ! get_field('enable_custom_header') ) {
            return;
        }

        $title = get_field('page_title') ?: get_the_title();
        $subtitle = get_field('page_subtitle');
        $bg_type = get_field('background_type') ?: 'image';
        $bg_image = get_field('page_background');
        $bg_video = get_field('background_video');
        $bg_video_url = get_field('background_video_url');

        echo '<div class="custom-page-header ' . esc_attr(get_the_title()) . '">';
        
        if ( ($bg_type === 'video' && $bg_video) || ($bg_type === 'url' && $bg_video_url) ) {
            $video_src = $bg_type === 'url' ? $bg_video_url : $bg_video;
            $embed_url = $this->get_embed_url($video_src);
            
            if ($embed_url !== $video_src) {
                echo '<iframe src="' . esc_url($embed_url) . '" frameborder="0" allow="autoplay; fullscreen" style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;"></iframe>';
            } else {
                echo '<video autoplay muted loop playsinline style="position:absolute;top:0;left:0;width:100%;height:100%;"><source src="' . esc_url($video_src) . '" type="video/mp4"></video>';
            }
        } elseif ( $bg_type === 'image' && $bg_image ) {
            echo '<div class="custom-page-header-bg" style="background-image: url(' . esc_url($bg_image) . ');"></div>';
        }
        echo '<div class="custom-page-header-overlay"></div>';
        echo '<div class="entry-content-wrap">';
        echo '<h1 class="custom-page-title">' . esc_html($title) . '</h1>';
        if ( $subtitle ) {
            echo '<p class="custom-page-subtitle">' . esc_html($subtitle) . '</p>';
        }
        echo '</div></div>';
    }
}

