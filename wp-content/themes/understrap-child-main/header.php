<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
$navbar_type       = get_theme_mod( 'understrap_navbar_type', 'collapse' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	echo '<link rel="preload" href="' . get_home_url() . '/wp-content/themes/understrap-child-main/assets/img/arrow-bottom-form.png" as="image">';
	echo '<link rel="preload" href="' . get_home_url() . '/wp-content/themes/understrap-child-main/assets/img/arrow-buttom.png" as="image">';
	echo '<link rel="preload" href="' . get_home_url() . '/wp-content/themes/understrap-child-main/assets/img/arrow-card.svg" as="image">';
	echo '<link rel="preload" href="' . get_home_url() . '/wp-content/themes/understrap-child-main/assets/img/arrow-button-link-secundary.svg" as="image">';

	echo '<link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style" onload="this.rel=\'stylesheet\'">';
	echo '<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" as="style" onload="this.rel=\'stylesheet\'">';
	echo '<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" as="style" onload="this.rel=\'stylesheet\'">';

	echo '<link rel="preload" as="script" href="' . get_home_url() . '/wp-includes/js/jquery/jquery.min.js">';

	echo '<link rel="preload" as="script" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js">';
	echo '<link rel="preload" as="script" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js">';
	?>

	<!-- Google Tag Manager -->
	<script>document.addEventListener('StartAsyncLoading',function(event){(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-T9Z8BCS');});</script>
	<!-- End Google Tag Manager -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T9Z8BCS" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php do_action( 'wp_body_open' ); ?>
<div id="page" class="site">
	<!-- ******************* The Navbar Area ******************* -->
	<header id="wrapper-navbar" class="header-site">
        <a id="GoSecondSection" class="skip-link <?php echo understrap_get_screen_reader_class( true ); ?>" href="#">
            <?php esc_html_e( 'Skip to content', 'understrap' ); ?>
        </a>
        <nav id="main-nav" class="navbar navbar-expand-lg " aria-labelledby="main-nav-label">
            <div class="container">

                <?php get_template_part( 'template-parts/layout/header', 'content' ); ?>

            </div>
        </nav>
    </header><!-- #wrapper-navbar -->