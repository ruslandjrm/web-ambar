<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<div id="wrapper-footer" class="wrapper">
	<footer id="colophon" class="site-footer">
		<?php get_template_part( 'template-parts/layout/footer', 'content' ); ?>
		
	</footer><!-- #colophon -->
</div><!-- #wrapper-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->
<?php wp_footer(); ?>
<script>
	jQuery(document).ready(function ($) {
		AOS.init();
	});
</script>
</body>
</html>