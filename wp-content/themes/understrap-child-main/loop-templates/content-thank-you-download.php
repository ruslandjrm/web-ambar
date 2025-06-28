<?php
/**
 * Partial template for content in page.php
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content ">
                <div class="container">
                        <?php
                                the_content();
                                //understrap_link_pages();
                        ?>
                </div>		
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->