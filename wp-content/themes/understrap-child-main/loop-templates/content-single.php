<?php

/**
 * Single post template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$reading_time_min=!empty(get_field('reading_time'))?get_field('reading_time'):'3';
$post_type = get_post_type();
$breadcrumb = 'Blog';
if($post_type == 'product-brief'){
    $breadcrumb = 'Product Brief';
}else if($post_type == 'white-paper'){
    $breadcrumb = 'White Paper';
}else if($post_type == 'case-study'){
    $breadcrumb = 'Case Study';
}
?>


<article id="single-post" data-aos-duration="800" data-aos="fade-up">

    <div class="tittle-post">
        <div class="breadcrumb-site">
            <div class="items-breadcrumb">
                <span>
                    <a href="<?php echo site_url('/resources'); ?>"><span>Resources</span></a>
                </span>
                >
                <span>
                    <span><?php echo $breadcrumb; ?></span>
                </span>
            </div>
        </div>

        <?php 
        the_title('<h1>', '</h1>');
        echo '<p class="post-date">' . get_the_date() . '</p>';
        ?>
    </div>

    <?php
    // Check if the post has a featured image
    if ( has_post_thumbnail() ) {
        echo '<div class="post-featured-image">';
        the_post_thumbnail('full');
        echo '</div>';
    } else {
        echo '<div class="post-featured-image">';
        echo '<img src="' . get_stylesheet_directory_uri() . '/assets/img/placeholder-post.png" alt="placeholder-post">';
        echo '</div>';
    }
    echo '<div class="post-content">';
    echo the_content();
    echo '</div>';
    ?>

</article>
