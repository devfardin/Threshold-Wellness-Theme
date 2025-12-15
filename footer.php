<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display(486);
?>

<?php wp_footer(); ?>

</body>
</html>