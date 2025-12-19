<?php
/**
 * Threshold Wellness Assets Enqueue
 */

if (!defined('ABSPATH')) {
    exit;
}

define('THRESHOLD_WELLNESS_STYLE_URI', get_stylesheet_directory_uri() . '/assets/css/');
define('THRESHOLD_WELLNESS_SCRIPT_URI', get_stylesheet_directory_uri() . '/assets/js/');

class ThresholdWellnessAssets {
    
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }
    
    public function enqueue_styles() {
        // Main CSS with optimization
        wp_enqueue_style(
            'threshold-wellness-main',
            THRESHOLD_WELLNESS_STYLE_URI . 'main.css',
            [],
            THRESHOLD_WELLNESS_VERSION,
            'all'
        );
        wp_enqueue_style(
            'threshold-wellness-home',
            THRESHOLD_WELLNESS_STYLE_URI . 'home.css',
            [],
            THRESHOLD_WELLNESS_VERSION,
            'all'
        );
        wp_enqueue_style(
            'custom-page-header',
            THRESHOLD_WELLNESS_STYLE_URI . 'custom-page-header.css',
            [],
            THRESHOLD_WELLNESS_VERSION,
            'all'
        );

        wp_enqueue_style(
            'single-blog-post',
            THRESHOLD_WELLNESS_STYLE_URI . 'single-posts.css',
            [],
            THRESHOLD_WELLNESS_VERSION,
            'all'
        );

        wp_enqueue_style(
            'blog-posts',
            THRESHOLD_WELLNESS_STYLE_URI . 'blog-posts.css',
            [],
            THRESHOLD_WELLNESS_VERSION,
            'all'
        );
        wp_enqueue_style(
            'vlogs-grid',
            THRESHOLD_WELLNESS_STYLE_URI . 'vlogs-grid.css',
            [],
            THRESHOLD_WELLNESS_VERSION,
            'all'
        );
        wp_enqueue_style(
            'single-vlog',
            THRESHOLD_WELLNESS_STYLE_URI . 'single-vlog.css',
            [],
            THRESHOLD_WELLNESS_VERSION,
            'all'
        );
    }
    
    public function enqueue_scripts() {
        wp_enqueue_script(
            'threshold-wellness-main',
            THRESHOLD_WELLNESS_SCRIPT_URI . 'main.js',
            ['jquery'],
            THRESHOLD_WELLNESS_VERSION,
            true
        );
        wp_enqueue_script(
            'threshold-wellness-modal',
            THRESHOLD_WELLNESS_SCRIPT_URI . 'modal.js',
            ['jquery'],
            THRESHOLD_WELLNESS_VERSION,
            true
        );
    }
}