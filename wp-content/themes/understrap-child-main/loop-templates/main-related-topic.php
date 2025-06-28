<?php
$id_single = get_the_id();

$terms = get_the_terms($id_single, 'category');
$id_categories = [];

if ($terms && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        $id_categories[] = $term->term_id;
    }
}


$post_types = array('post', 'white-paper', 'product-brief', 'team-member' );

$args = array(
    'post_type'      => $post_types,
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post__not_in'   => array($id_single),
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $id_categories
        )
    )
);

$resources = new WP_Query($args);
?>
<?php if ($resources->have_posts()) : ?>
<section class="general-section related-post alignfull size-default heading-dark_2 text-dark_2">
    <div class="container">
        <div class="content-title row-content-element">
            <div class="eyebrow">
                <div class="title-related">
                    <h2>Related Reads</h2>    
                </div>
            </div>
        </div>

        <div class="post-slider-list">
            <div class="slider-list-space post-slider-js">
                    <?php while ($resources->have_posts()) : 
                        $resources->the_post(); 
                        $post_id = get_the_ID();
                        $title = get_the_title($post_id);
                        $feature_image = wp_get_attachment_url(get_post_thumbnail_id($post_id));
                        $feature_image = $feature_image ? $feature_image : get_stylesheet_directory_uri() . '/assets/img/placeholder-post.png';
                        $link = get_the_permalink($post_id);
                        $post_type = get_post_type($post_id);
                        $post_type_object = get_post_type_object($post_type);
                        $singular_label = $post_type_object->labels->singular_name;
                        $excerpt = wp_trim_words(get_the_content(), 24, '...');
                    ?>
                        <div class="related-post-item">
                            <?php if ($link) { ?> 
                                <a class="block-link" href="<?php echo esc_url($link); ?>"></a>
                            <?php } ?>
                            
                            <p class="post-type"><?php echo esc_html($singular_label); ?></p>
                            
                            <img src="<?php echo esc_url($feature_image); ?>" alt="img-post">
                            
                            <h3><?php echo esc_html($title); ?></h3>
                            
                            <p class="post-excerpt"><?php echo esc_html($excerpt); ?></p>
                            
                            <a class="btn-link" href="<?php echo esc_url($link); ?>">Read More</a>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>

<script>
    jQuery(document).ready(function ($) {
        jQuery('.post-slider-js').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            speed: 600,
            dots: false,
            arrows: false,
            autoplay: true,
            infinite: true,
            accessibility: false,
            focusOnSelect: false,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                    }
                },
            ]
        }); 
    });
</script>

<?php endif; ?>