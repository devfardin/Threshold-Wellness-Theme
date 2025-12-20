<?php
/**
 * Threshold Wellness Theme Functions
 */

// Security Constants
define('THRESHOLD_WELLNESS_VERSION', '1.0.0');
define('THRESHOLD_WELLNESS_DIR', __DIR__ . '/includes/');
define('THRESHOLD_WELLNESS_SHORTCODE_DIR', __DIR__ . '/includes/shortcodes/');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class ThresholdWellnessFunctions {
    public function __construct() {
        $this->load_dependencies();
        $this->init();
    }
    public function load_dependencies() {
        require_once( THRESHOLD_WELLNESS_DIR . 'enqueue.php');
        require_once( THRESHOLD_WELLNESS_DIR . 'custom-page-header.php');
        require_once( THRESHOLD_WELLNESS_DIR . 'customizer-page-header.php');
        require_once( THRESHOLD_WELLNESS_SHORTCODE_DIR . 'blog-posts.php');
        require_once( THRESHOLD_WELLNESS_SHORTCODE_DIR . 'vlogs-grid.php');
        require_once( THRESHOLD_WELLNESS_SHORTCODE_DIR . 'studios-grid.php');
    }
    
    public function init() {
       new ThresholdWellnessAssets();
       new Custom_Page_Header();
       new ThresholdBlogPostsShortcode();
       new Vlogs_grid();
       new studios_grid();
    }
}

new ThresholdWellnessFunctions();