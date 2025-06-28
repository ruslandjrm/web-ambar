<?php

/*********************
* Get ACF Blocks List
**********************/
function get_acf_blocks_list() {
    return [
        'general-content',
        'new-block' // Add more blocks here
    ];
}

/*********************
* Register Blocks
**********************/
function register_acf_blocks() {
    $blocks = get_acf_blocks_list();

    foreach ($blocks as $block) {

        register_block_type( get_stylesheet_directory() . '/lib/blocks/' . $block );

        $style_path = get_stylesheet_directory() . '/lib/blocks/' . $block . '/' . $block . '.css';

        if ( file_exists( $style_path ) ) {
            wp_register_style(
                $block . '-style',
                get_stylesheet_directory_uri() . '/lib/blocks/' . $block . '/' . $block . '.css',
                array(),
                filemtime( $style_path )
            );
        }
    }
}
add_action( 'init', 'register_acf_blocks' );


/*********************
* Enqueue Block Styles
**********************/
function enqueue_block_styles() {
    if ( ! is_singular() ) return;

    global $post;
    if ( ! $post || ! has_blocks( $post ) ) return;

    $blocks = get_acf_blocks_list();

    foreach ( $blocks as $block ) {
        if ( has_block( 'acf/' . $block, $post ) ) {
            wp_enqueue_style( $block . '-style' );
        }
    }
}
add_action( 'wp', 'enqueue_block_styles' );

