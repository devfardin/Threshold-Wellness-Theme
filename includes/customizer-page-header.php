<?php
/**
 * Add Page Header Settings to Kadence Customizer
 */

function threshold_page_header_customizer($wp_customize) {
    // Add Page Header Section
    $wp_customize->add_section('threshold_page_header', array(
        'title' => __('Global Page Header Settings', 'threshold-wellness'),
        'priority' => 30,
    ));

    // Background Type Control
    $wp_customize->add_setting('page_header_bg_type', array(
        'default' => 'image',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('page_header_bg_type', array(
        'label' => __('Background Type', 'threshold-wellness'),
        'section' => 'threshold_page_header',
        'type' => 'select',
        'choices' => array(
            'image' => __('Image', 'threshold-wellness'),
            'video' => __('Video', 'threshold-wellness'),
        ),
    ));

    // Background Image Control
    $wp_customize->add_setting('page_header_bg_image', array(
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'page_header_bg_image', array(
        'label' => __('Background Image', 'threshold-wellness'),
        'section' => 'threshold_page_header',
        'active_callback' => function() {
            return get_theme_mod('page_header_bg_type', 'image') === 'image';
        },
    )));

    // Background Video Control
    $wp_customize->add_setting('page_header_bg_video', array(
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'page_header_bg_video', array(
        'label' => __('Background Video (MP4)', 'threshold-wellness'),
        'section' => 'threshold_page_header',
        'active_callback' => function() {
            return get_theme_mod('page_header_bg_type', 'image') === 'video';
        },
    )));
}

add_action('customize_register', 'threshold_page_header_customizer');