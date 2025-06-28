<?php

/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');
?>

<div class="page-single-posts">
    <section class="page-single-posts__content">
        <div class="container">
            <div id="post-content-id" class="wrapper post-content">          
                <?php
                // Do the left sidebar check and open div#primary.
                get_template_part('global-templates/left-sidebar-check');
                ?>
                <div class="row justify-content-center">
                    <main class="site-main" id="main">
                        <?php
                        if (have_posts()) {
                            the_post();
                            get_template_part('loop-templates/content', 'single');

                            // If comments are open or we have at least one comment, load up the comment template.
                            //if (comments_open() || get_comments_number()) {
                            //  comments_template();
                            //}
                        }
                        ?>

                    </main>
                </div>
                <?php
                // Do the right sidebar check and close div#primary.
                //get_template_part('global-templates/right-sidebar-check');
                ?>
            </div>
        </div> 
    </section>

    <?php
    get_template_part('loop-templates/main-related-topic', '');
    get_template_part('lib/blocks/cta-side-form/cta-side-form');
    ?>

    <?php
    //section articles
    get_template_part('loop-templates/content', 'single-articles');

    //section Banner CTA-Grid Single Posts
    get_template_part('loop-templates/content', 'single-banner-cta-grid');
    ?>


</div><!-- #single-wrapper -->


<?php
get_footer();
