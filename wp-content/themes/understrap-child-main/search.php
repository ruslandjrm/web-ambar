<?php
/**
 * The template for displaying search results pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');
$theme_settings_search = !empty(get_field('theme_settings_search','options')) ? get_field('theme_settings_search','options') :'';
if($theme_settings_search){
    $featured_posts = $theme_settings_search['search_group'] ? $theme_settings_search['search_group'] :'';
    //custom-pagination
    $total_results = $wp_query->found_posts;
    $results_per_page = get_option('posts_per_page');
    $total_pages = ceil($total_results / $results_per_page);
    $current_page = max(1, get_query_var('paged'));
    $paginate_args = array(
        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'format' => '?paged=%#%',
        'current' => $current_page,
        'total' => $total_pages,
        'prev_text' => __('&laquo; Prev'),
        'next_text' => __('Next &raquo;'),
    );
    //cta-form
    $heading_block = $theme_settings_search['heading_block'] ? $theme_settings_search['heading_block'] : '';
    $ht = $heading_block['heading_size'] ? $heading_block['heading_size'] : 'h2';
    $heading = $heading_block['heading'] ? '<'.$ht.' class="heading">'.$heading_block['heading'].'</'.$ht.'>' : '';

    $content_section = $theme_settings_search['content_text'] ? $theme_settings_search['content_text'] : '';
    $form = $theme_settings_search['form'] ? $theme_settings_search['form'] : '';

    $background_settings = $theme_settings_search['background_settings'] ? $theme_settings_search['background_settings'] : '';
    $styles_settings = $theme_settings_search['styles_settings'] ? $theme_settings_search['styles_settings'] : '';

    $styles = styles_global_settings($styles_settings);

    $background = bg_global_settings($background_settings);
?>

<div class="wrapper ctn-search">
    <header class="page-header container">
        <p class="page-title"><?php printf(esc_html__('Search Results', 'understrap')); ?></p>
    </header>
    <div class="page-content container">
        <div class="content-search">
            <div class="title-search">
                <p class="title-term" ><?php echo get_search_query(); ?></p>
            </div>
            <?php
                get_template_part('global-templates/left-sidebar-check');
            ?>
            <div class="post-object">
                
                <?php foreach( $featured_posts as $featured_post ): 
                $permalink = get_permalink( $featured_post->ID );
                $title = get_the_title( $featured_post->ID );
                $thumbnail_url = get_the_post_thumbnail_url( $featured_post->ID ); 
                $terms = wp_get_post_terms($featured_post->ID, 'content-type');
                
                ?>
                <div class="row">
                    <div class="col-12 col-md-6"  data-aos="fade-in-zoom" data-aos-delay="100">
                        <div class="post-content">
                            <?php if(!empty($terms) && !is_wp_error($terms)) {
                                $taxonomy_name = $terms[0]->name;
                            ?>
                            <p class="content-type"><?php echo $taxonomy_name; ?></p>

                            <?php } ?>
                        
                            <h6><?php echo esc_html( $title ); ?></h6>
                            <a class="btn-site btn-fill btn-color-primary " href="<?php echo esc_url( $permalink ); ?>">View</a>
                        </div> 
                    </div>
                    <div class="col-12 col-md-6" data-aos="fade-in-zoom" data-aos-delay="250">
                        <div class="post-img">
                            <?php if ( $thumbnail_url ) : ?>
                                <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <?php 
                    wp_reset_postdata(); 
                ?>
            </div>
            <div class="row justify-content-center">
                <main class="site-main" id="main">
                    

                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="entry-header"  data-aos="fade-left">
                                    <?php if (get_post_type() === 'page') : ?>
                                        <span class="post-type"><?php esc_html_e('Page', 'understrap'); ?></span>
                                    <?php else : ?>
                                        <span class="post-type"><?php esc_html_e('Post', 'understrap'); ?></span>
                                    <?php endif; ?>
                                    <h6 class="entry-title"><?php the_title(); ?></h6>
                                </div>

                                <div class="entry-content"  data-aos="fade-left">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="permalink"  data-aos="fade-left">
                                    <a class="btn-link" href="<?php the_permalink(); ?>">Read</a>
                                </div>
                            </article><!-- #post-<?php the_ID(); ?> -->
                        <?php endwhile; ?>
                        <div class="navigation pagination">
                            <?php echo paginate_links($paginate_args);?>
                        </div>
                    <?php else : ?>
                        <p><?php esc_html_e('No results found. Please try again with different keywords.', 'understrap'); ?></p>
                    <?php endif; ?>

                </main>
            </div>

            <?php
            // Do the right sidebar check and close div#primary.
            get_template_part('global-templates/right-sidebar-check');
            ?>
        </div>         
    </div>
    <section class="general-section cta-side-form <?php echo $background['parallax'].' '.$styles['custom_class'].' size-'.$styles['content_width'].'  heading-'.$styles['heading_color'].' text-'.$styles['text_color']; ?>" style="background:<?php echo $background['bg'];?> no-repeat; text-align: <?php echo $styles['text_align'];?>!important; margin: <?php echo $styles['margin_top']; ?>px 0 <?php echo $styles['margin_bottom']; ?>px; padding: <?php echo $styles['padding_top']; ?>px 0 <?php echo $styles['padding_bottom']; ?>px;" id="<?php echo $id; ?>">
        <?php echo $background['video_content']; ?>
        <?php echo $background['overContent']; ?>
        <div class="container" id="<?php echo $styles['section_anchor']; ?>">
            <div class="row">
                <div class="col-12 col-lg-6" data-aos="fade-in-zoom" data-aos-delay="100">
                    <div class="content-title">
                        <?php echo $heading; ?>
                        <?php echo $content_section; ?>
                    </div>
                </div>
                <div class="col-12 col-lg-6" data-aos="fade-in-zoom" data-aos-delay="250">
                    <div class="content-form">
                        <?php echo do_shortcode('[gravityform id="' . $form . '" title="false" description="false" ajax="true"]'); ?>
                    </div>
                </div>
            </div>
            
        
        </div>
    </section>
</div><!-- #single-wrapper -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

    var paginationLinks = document.querySelectorAll('.page-numbers');

    paginationLinks.forEach(function(link) {

        var pageNumber = link.textContent.trim();

        link.addEventListener('click', function(event) {
            event.preventDefault(); 

            var newUrl = "/?s=lorem&submit=Search&sf_paged=" + pageNumber;

            window.location.href = newUrl;
        });
    });
    });
    document.addEventListener('DOMContentLoaded', function() {

    const nextPageLink = document.querySelector('.pagination a.next');
    const prevPageLink = document.querySelector('.pagination a.prev');

    if (nextPageLink) {
        nextPageLink.parentNode.removeChild(nextPageLink); 
    }

    if (prevPageLink) {
        prevPageLink.parentNode.removeChild(prevPageLink); 
    }
    });
</script>
<?php } ?>
<?php
get_footer();
