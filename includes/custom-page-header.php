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
                    'choices' => ['image' => 'Image', 'video' => 'Video'],
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
            ],
            'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'page']]],
        ]);
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

        echo '<div class="custom-page-header">';
        
        if ( $bg_type === 'video' && $bg_video ) {
            echo '<video autoplay muted loop playsinline><source src="' . esc_url($bg_video) . '" type="video/mp4"></video>';
        } elseif ( $bg_type === 'image' && $bg_image ) {
            echo '<div class="custom-page-header-bg" style="background-image: url(' . esc_url($bg_image) . ');"></div>';
        }
        
        echo '<div class="entry-content-wrap">';
        echo '<h1 class="custom-page-title">' . esc_html($title) . '</h1>';
        if ( $subtitle ) {
            echo '<p class="custom-page-subtitle">' . esc_html($subtitle) . '</p>';
        }
        echo '</div></div>';
    }
}

