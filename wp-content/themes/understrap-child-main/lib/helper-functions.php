<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Buttons block
function block_buttons( $buttons, $buttons_justification ) {
	if ( $buttons && $buttons_justification ) { ?>
		<div class="content-buttons buttons-justification-<?php echo $buttons_justification; ?>">
			<?php foreach ( $buttons as $item ) {
				$button_link          = $item['button_link'];
				$button_style         = $item['button_style'];
				$button_color         = $item['button_color'];
				$icon_button          = $item['icon_button'] ? $item['icon_button'] : '';
				$icon_button_position = $item['icon_button_position'] ? $item['icon_button_position'] : 'icon-right';

				$class_icon_button = $icon_button ? '' : 'btn-color-without-arrow';
				?>
				<?php if ( $button_link ) { ?>
					<a class="btn-site <?php echo $icon_button_position; ?> <?php echo $class_icon_button; ?> btn-<?php echo $button_style; ?> btn-color-<?php echo $button_color; ?> "
					   target="<?php echo $button_link['target']; ?>" href="<?php echo $button_link['url']; ?>">
						<?php echo $button_link['title']; ?>
						<?php if ( $icon_button ) { ?>
							<span><img src="<?php echo $icon_button; ?>" alt="icon button"></span>
						<?php } ?>
					</a>
				<?php } ?>
			<?php } ?>
		</div>
	<?php } ?>

	<?php
}

function breadcrumb_hero() {
	if ( function_exists( 'bcn_display' ) ) {
		?>
		<div class="breadcrumb-site">
			<div class="items-breadcrumb"> <?php bcn_display(); ?></div>
		</div>
		<?php
	}
}

function get_the_svg( $filename ) {
	$path = get_stylesheet_directory_uri() . '/assets/img/acf/' . $filename . '.svg';
	echo $path;
	if ( file_exists( $path ) ) {
		return file_get_contents( $path );
	} else {
		return '';
	}
}

//create menus
if ( ! function_exists( 'custom_navigation_menu' ) ) {
	function custom_navigation_menu() {
		$locations = array(
			'footerMenu1' => __( 'Footer Menu 1', 'custom_navigation_menu' ),
			'footerMenu2' => __( 'Footer Menu 2', 'custom_navigation_menu' ),
			'footerMenu3' => __( 'Footer Menu 3', 'custom_navigation_menu' ),
			'footerMenu4' => __( 'Footer Menu 4', 'custom_navigation_menu' ),
			'footerMenu5' => __( 'Footer Menu 5', 'custom_navigation_menu' ),
			'footerMenu6' => __( 'Footer Menu 6', 'custom_navigation_menu' ),
		);
		register_nav_menus( $locations );
	}

	add_action( 'init', 'custom_navigation_menu' );
}

/***************
 * styles global
 ****************/
function styles_global_settings( $styles_settings ) {
	$styles = array(
		'heading_color'  => '',
		'text_color'     => '',
		'content_width'  => '',
		'text_align'     => '',
		'section_anchor' => '',
		'margin_top'     => '',
		'margin_bottom'  => '',
		'padding_top'    => '',
		'padding_bottom' => '',
		'custom_class'   => '',
	);

	if ( $styles_settings ) {
		//Content Styles
		$heading_color  = $styles_settings['heading_color'] ? $styles_settings['heading_color'] : '';
		$text_color     = $styles_settings['text_color'] ? $styles_settings['text_color'] : '';
		$content_width  = $styles_settings['content_width'] ? $styles_settings['content_width'] : '';
		$text_align     = $styles_settings['text_align'] ? $styles_settings['text_align'] : '';
		$section_anchor = $styles_settings['section_anchor'] ? $styles_settings['section_anchor'] : '';

		//spacing
		$default_sizes = $styles_settings['default_sizes'] ? $styles_settings['default_sizes'] : false;
		if ( $default_sizes ) {
			$margin_top     = $styles_settings['margin_top_default'] ? $styles_settings['margin_top_default'] : 0;
			$margin_bottom  = $styles_settings['margin_bottom_default'] ? $styles_settings['margin_bottom_default'] : 0;
			$padding_top    = $styles_settings['padding_top_default'] ? $styles_settings['padding_top_default'] : 0;
			$padding_bottom = $styles_settings['padding_bottom_default'] ? $styles_settings['padding_bottom_default'] : 0;
		} else {
			$margin_top     = $styles_settings['margin_top'] ? $styles_settings['margin_top'] : 0;
			$margin_bottom  = $styles_settings['margin_bottom'] ? $styles_settings['margin_bottom'] : 0;
			$padding_top    = $styles_settings['padding_top'] ? $styles_settings['padding_top'] : 0;
			$padding_bottom = $styles_settings['padding_bottom'] ? $styles_settings['padding_bottom'] : 0;
		}

		$custom_class = $styles_settings['custom_classes'] ? $styles_settings['custom_classes'] : '';

		$styles = array(
			'heading_color'  => $heading_color,
			'text_color'     => $text_color,
			'content_width'  => $content_width,
			'text_align'     => $text_align,
			'section_anchor' => $section_anchor,
			'margin_top'     => $margin_top,
			'margin_bottom'  => $margin_bottom,
			'padding_top'    => $padding_top,
			'padding_bottom' => $padding_bottom,
			'custom_class'   => $custom_class,
		);
	}

	return $styles;
}

/****************
 * overlay options
 *****************/
function overlay_content( $key = 'horizontal-blue', $opacity = '1', $direction = '180', $overlay_blend_mode = 'initial' ) {
	$item_class['horizontal-blue']    = '<div class="overlay-content" style="background: linear-gradient(' . $direction . 'deg, #2474bb 0%, #002f87 100%); opacity: ' . $opacity . ';  mix-blend-mode: ' . $overlay_blend_mode . ';"></div>';
	$item_class['vertical-blue']      = '<div class="overlay-content" style="background: linear-gradient(' . $direction . 'deg, #2474bb 0%, #002f87 100%); opacity: ' . $opacity . ';  mix-blend-mode: ' . $overlay_blend_mode . ';"></div>';
	$item_class['vertical-blue-dark'] = '<div class="overlay-content" style="background: linear-gradient(' . $direction . 'deg, #004EA8 50%, #00004B 100%); opacity: ' . $opacity . ';  mix-blend-mode: ' . $overlay_blend_mode . ';"></div>';

	if ( empty( $item_class[ $key ] ) ) {
		$key = 'horizontal-blue';
	}

	return $item_class[ $key ];
}

function gradient_bg( $key = 'horizontal-blue' ) {
	$item_class['horizontal-blue']    = 'linear-gradient(90deg, #2474bb 0%, #002f87 100%)';
	$item_class['vertical-blue']      = 'linear-gradient(180deg, #2474bb 0%, #002f87 100%)';
	$item_class['vertical-blue-dark'] = 'linear-gradient(180deg, #004EA8 30%, #00004B 100%)';

	if ( empty( $item_class[ $key ] ) ) {
		$key = 'horizontal-blue';
	}

	return $item_class[ $key ];
}

/*********************
 * background settings
 **********************/
function bg_global_settings( $background_settings ) {
	$bg            = 'none';
	$video_content = '';
	$overContent   = '';

	$background = array(
		'type'          => '',
		'bg'            => '',
		'video_content' => '',
		'overContent'   => '',
		'parallax'      => '',
	);

	if ( $background_settings ) {

		$type     = $background_settings['media_type'] ? $background_settings['media_type'] : 'none';
		$parallax = $background_settings['parallax'] ? 'parallax-effect' : '';

		if ( $type == 'color' ) {
			$bgcolor = $background_settings['color'] ? $background_settings['color'] : '';
			$bg      = $bgcolor['color_picker'] ? $bgcolor['color_picker'] : '';
		} elseif ( $type == 'image' ) {
			$bgimage = $background_settings['image'] ? $background_settings['image'] : '';
			$bg      = $bgimage ? 'url(' . $bgimage['url'] . ')' : '';
		} elseif ( $type == 'video' ) {
			$bg_video      = $background_settings['video_mp4'] ? $background_settings['video_mp4'] : '';
			$video_content = $bg_video ? '<div class="video-container"><video id="video-bg" width="100%" height="660" autoplay loop muted><source src="' . $bg_video . '" type="video/mp4" /></video></div>' : '';
		} elseif ( $type == 'gradient' ) {
			$grad = $background_settings['gradient_bg'] ? $background_settings['gradient_bg'] : '';
			$bg   = gradient_bg( $grad['gradient'] );
		}

		//overlay
		$overlay_type       = $background_settings['overlay_type'] ? $background_settings['overlay_type'] : '';
		$overlay_opacity    = $background_settings['overlay_opacity'] ? $background_settings['overlay_opacity'] : '0';
		$overlay_blend_mode = $background_settings['blend_mode'] ? $background_settings['blend_mode'] : 'initial';

		if ( $type == 'image' || $type == 'video' ) {
			if ( $overlay_type == 'color' ) {
				$overlay_color = $background_settings['overlay_color'] ? $background_settings['overlay_color'] : '';
				$overContent   = '<div class="overlay-content" style="background: ' . $overlay_color['color_picker'] . '; opacity: ' . $overlay_opacity . '; mix-blend-mode: ' . $overlay_blend_mode . ';"></div>';
			} else {
				$overlay_gradient          = $background_settings['overlay_gradient'] ? $background_settings['overlay_gradient'] : '';
				$ovelay_gradient_direction = $background_settings['ovelay_gradient_direction'] ? $background_settings['ovelay_gradient_direction'] : '';
				$overContent               = overlay_content( $overlay_gradient['gradient'], $overlay_opacity, $ovelay_gradient_direction, $overlay_blend_mode );
			}
		}
		$background = array(
			'type'          => $type,
			'bg'            => $bg,
			'video_content' => $video_content,
			'overContent'   => $overContent,
			'parallax'      => $parallax,
		);
	}

	return $background;
}

/*********************
 * Add Header css external
 **********************/
function add_external_assets() {
    echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">';
    echo '<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">';
}
add_action('wp_head', 'add_external_assets');

/*********************
 * Add footer js external
 **********************/
function add_external_scripts() {
    echo '<script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>';
    echo '<script defer src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>';
    echo '<script defer src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>';
    echo '<script defer src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>';
}
add_action('wp_footer', 'add_external_scripts', 100);

function add_search_to_nav_menu( $items, $args ) {
	if ( $args->theme_location == 'primary' ) {
		$items .= '<li class="menu-item dropdown nav-search">';
		$items .= '<a href="#" class="dropdown-toggle dropdown-toggle-search" data-toggle="dropdown">Search <b class="caret"></b></a>';
		$items .= '<ul class="dropdown-menu dropdown-menu--search">';
		$items .= '<li>' . get_search_form( false ) . ' <img class="nav-search--icon" src="' . get_stylesheet_directory_uri() . '/assets/img/search-icon-w.svg" alt="Search Icon"></li>';
		$items .= '</ul></li>';
	}

	return $items;
}

add_filter( 'wp_nav_menu_items', 'add_search_to_nav_menu', 10, 2 );

/*********************
 * customize Excerpt Read More Content
 **********************/
function understrap_all_excerpts_get_more_link( $post_excerpt ) {
	return $post_excerpt;
}

add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );

/*********************
 * Pagination
 **********************/
function post_pagination( $paged = '', $max_page = '' ) {
	if ( ! $paged ) {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
	}

	if ( ! $max_page ) {
		global $wp_query;
		$max_page = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
	}

	$big = 999999999;

	$html = paginate_links( array(
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, $paged ),
		'total'     => $max_page,
		'mid_size'  => 1,
		'prev_text' => __( '« Prev' ),
		'next_text' => __( 'Next »' ),
		'prev_next' => false,
	) );

	$html = "<div class='navigation pagination'>" . $html . "</div>";

	echo $html;
}

function buttons_header() {
	$theme_settings_header = get_field( 'theme_settings_header', 'options' ) ? get_field( 'theme_settings_header', 'options' ) : '';
	if ( $theme_settings_header ) {
		$buttons_block         = $theme_settings_header['header_buttons'] ? $theme_settings_header['header_buttons'] : '';
		$buttons_justification = $buttons_block['buttons_justification'];
		$buttons               = $buttons_block['buttons'];

		return block_buttons( $buttons, $buttons_justification );
	}
}

// Register shortcode
add_shortcode( 'shortcode_buttons_header', 'buttons_header' );

add_filter( 'register_post_type_args', 'change_post_type_label', 10, 2 );

function change_post_type_label( $args, $post_type ) {
	if ( $post_type === 'post' ) {
		$args['labels']['name']          = 'Blog Posts';
		$args['labels']['singular_name'] = 'Blog Post';
	}

	return $args;
}

/**
 * Shortcode to display copyright year.
 *
 * @param array $atts Optional attributes.
 *                    $starting_year Optional. Define starting year to show starting year and current year e.g. 2010 -
 *                    2022.
 *                    $separator Optional. Separator between starting year and current year.
 *
 * @return string Copyright year text.
 */
function copyright_year_shortcode( $atts ) {
	// Setup defaults.
	$args = shortcode_atts(
		[
			'starting_year' => '',
			'separator'     => ' - ',
		],
		$atts
	);

	$current_year = gmdate( 'Y' );

	// Return current year if starting year is empty.
	if ( ! $args['starting_year'] ) {
		return $current_year;
	}

	return esc_html( $args['starting_year'] . $args['separator'] . $current_year );
}

add_shortcode( 'copyright_year', 'copyright_year_shortcode' );