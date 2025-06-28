<?php
/**
 * Optimize theme performance.
 *
 * @package UnderstrapChild
 */

/**
 * Clean up WordPress Header
 */
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'template_redirect', 'wp_shortlink_header', 11 );

/**
 * Disable the emojis.
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'embed_head', 'print_emoji_detection_script' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}

add_action( 'init', 'disable_emojis' );
/** Clean up WordPress Header END */

/**
 * Remove JQuery migrate.
 *
 * @param $scripts
 *
 * @return void
 */
function dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, [ 'jquery-migrate' ] );
	}
}

add_action( 'wp_default_scripts', 'dequeue_jquery_migrate' );

/**
 * Remove self pings.
 */
add_action( 'pre_ping', function ( &$links ) {
	$home = get_option( 'home' );

	foreach ( $links as $l => $link ) {
		if ( 0 === strpos( $link, $home ) ) {
			unset( $links[ $l ] );
		}
	}
} );

/**
 * Slow down the default heartbeat.
 */
add_filter( 'heartbeat_settings', function ( $settings ) {
	// 60 seconds.
	$settings['interval'] = 60;

	return $settings;
} );

/**
 * Remove wp-embed.min.js
 *
 * @return void
 */
function deregister_scripts() {
	wp_dequeue_script( 'wp-embed' );
}

add_action( 'wp_footer', 'deregister_scripts' );

/**
 * Enqueue scripts and styles.
 *
 * @return void
 */
function disable_loading_css_js() {
	if ( ! is_user_logged_in() ) {
		wp_dequeue_style( 'dashicons' );
		wp_dequeue_style( 'font-awesome' );
		wp_dequeue_style( 'megamenu-genericons' );
		wp_dequeue_style( 'megamenu-fontawesome6' );
	}

	if ( is_front_page() && ! is_user_logged_in() ) {
		wp_dequeue_style( 'search-filter-plugin-styles' );
		wp_dequeue_style( 'magnific-popup-css' );

		wp_dequeue_script( 'magnific-popup-js' );
		wp_dequeue_script( 'jquery-ui-datepicker' );
		wp_dequeue_script( 'page-links-to' );
		wp_dequeue_script( 'search-filter-plugin-build' );
		wp_dequeue_script( 'search-filter-plugin-chosen' );
	}
}

add_action( 'wp_enqueue_scripts', 'disable_loading_css_js', 9999 );

/**
 * Remove JS/CSS version for Speed Optimization.
 *
 * @param $src
 *
 * @return string
 */
function remove_script_version( $src ) {
	$parts = explode( '?ver', $src );

	return $parts[0];
}

add_filter( 'script_loader_src', 'remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'remove_script_version', 15, 1 );

function my_output_buffer_callback( $buffer, $phase ) {
	/*
	if ( is_user_logged_in() ) {
		return $buffer;
	}
	*/
	if ( $phase & PHP_OUTPUT_HANDLER_FINAL || $phase & PHP_OUTPUT_HANDLER_END ) {
		$lazy_load_script = '
		<script id="locance-script-inline-optimization">
		function loadCSS(filename) { var l = document.createElement("link"); l.rel = "stylesheet"; l.href = filename; var h = document.getElementsByTagName("head")[0]; h.parentNode.insertBefore(l, h); }
		document.addEventListener("DOMContentLoaded", () => {
			setTimeout(function(){ 
				loadCSS("https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap");
				loadCSS("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"); 
				loadCSS("' . get_home_url() . '/wp-content/plugins/megamenu-pro/icons/genericons/genericons/genericons.css");
				loadCSS("' . get_home_url() . '/wp-content/plugins/megamenu-pro/icons/fontawesome6/css/all.min.css");
				loadCSS("' . get_home_url() . '/wp-includes/css/dashicons.min.css");
			}, 50);
		});
		var script_loaded=!1;function loadJSscripts(){if(!script_loaded){script_loaded=!0;var t=document.getElementsByTagName("script");for(i=0;i<t.length;i++)if(null!==t[i].getAttribute("data-src")){var e=document.createElement("script");e.src=t[i].getAttribute("data-src");document.body.appendChild(e)}document.dispatchEvent(new CustomEvent("StartAsyncLoading"));}}window.addEventListener("scroll",function(t){setTimeout(function(){loadJSscripts()},500);});window.addEventListener("mousemove",function(){setTimeout(function(){loadJSscripts()},500);});window.addEventListener("touchstart",function(){setTimeout(function(){loadJSscripts()},500);});window.addEventListener?window.addEventListener("load",function(){setTimeout(loadJSscripts,5e3)},!1):window.attachEvent?window.attachEvent("onload",function(){setTimeout(loadJSscripts,5e3)}):window.onload=loadJSscripts;</script>
		';

		$buffer = str_replace( '</body>', $lazy_load_script . "\n</body>", $buffer );

		$buffer = str_replace( 'window.lazySizesConfig.loadMode=1;', 'window.lazySizesConfig.loadMode=1;window.lazySizesConfig.expand=100;window.lazySizesConfig.loadHidden=false;', $buffer );

		$buffer = str_replace( 'src="https://www.google.com/recaptcha/', 'data-src="https://www.google.com/recaptcha/', $buffer );

		if ( is_front_page() ) {
			$buffer = preg_replace( '/<div class="container" id="" data-aos-duration="800" data-aos="fade-up">/', '<div class="container" id="">', $buffer, 2 );

			$buffer = str_replace( "jQuery(document).ready(function($) {", "document.addEventListener('StartAsyncLoading',function(event){var $ = jQuery;", $buffer );
			$buffer = str_replace( "jQuery(document).ready(function ($) {", "document.addEventListener('StartAsyncLoading',function(event){var $ = jQuery;", $buffer );
			$buffer = str_replace( 'document.addEventListener("DOMContentLoaded", function() {', "document.addEventListener('StartAsyncLoading',function(event){", $buffer );
		}

		return $buffer;
	}

	return $buffer;
}

ob_start( 'my_output_buffer_callback' );