<?php
/**
 * Custom Page Header for Category Pages
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$current_category = get_queried_object();
$category_name = $current_category->name ?? '';
$category_description = $current_category->description ?? '';
?>

<div class="threshold-page-header">
    <div class="threshold-page-header-container">
        <div class="threshold-page-header-content">
            <?php if ($category_name): ?>
                <h1 class="threshold-page-title"><?php echo esc_html($category_name); ?></h1>
            <?php endif; ?>
            
            <?php if ($category_description): ?>
                <p class="threshold-page-description"><?php echo esc_html($category_description); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>