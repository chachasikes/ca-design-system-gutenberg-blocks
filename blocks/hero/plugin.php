<?php

/**
 * Plugin Name: Feature card
 * Plugin URI: TBD
 * Description: Featured content space. Appears on the homepage. Calls attention to a web page, announcement or event. Includes title text, brief description, image, and a button.
 * Version: 1.1.0
 * Author: California Office of Digital Innovation
 * @package cagov-design-system
 */

defined( 'ABSPATH' ) || exit;

/**
 * Load all translations for our plugin from the MO file.
 */
add_action( 'init', 'cagov_design_system_gutenberg_block_hero' );

function cagov_design_system_gutenberg_block_hero() {
    load_plugin_textdomain( 'cagov-design-system', false, basename( __DIR__ ) . '/languages' );
}

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function cagov_design_system_register_hero() {

    if ( ! function_exists( 'register_block_type' ) ) {
        // Gutenberg is not active.
        return;
    }

    wp_register_script(
        'ca-design-system-hero-block',
        plugins_url( 'block.js', __FILE__ ),
        array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'underscore' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
    );

    wp_register_style(
        'ca-design-system-hero-style-editor',
        plugins_url( 'editor.css', __FILE__ ),
        array( 'wp-edit-blocks' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
    );

    wp_register_style( 'ca-design-system-hero-style', false );
    $style_css = file_get_contents(plugin_dir_path(__FILE__) . '/style.css', __FILE__);
    wp_add_inline_style('ca-design-system-hero-style', $style_css);

    register_block_type( 'cagov/hero', array(
        'style' => 'ca-design-system-hero-style',
        'editor_style' => 'ca-design-system-hero-style-editor',
        'editor_script' => 'ca-design-system-hero-block',
    ) );

}
add_action( 'init', 'cagov_design_system_register_hero' );