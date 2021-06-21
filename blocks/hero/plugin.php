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
        'california-design-system-hero-block',
        plugins_url( 'block.js', __FILE__ ),
        array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'underscore' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
    );

    wp_register_style(
        'california-design-system-hero-style-editor',
        plugins_url( 'editor.css', __FILE__ ),
        array( 'wp-edit-blocks' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
    );

    wp_register_style(
        'california-design-system-hero-style',
        plugins_url( 'style.css', __FILE__ ),
        array( ),
        filemtime( plugin_dir_path( __FILE__ ) . 'style.css' )
    );

    register_block_type( 'cagov/hero', array(
        'style' => 'california-design-system-hero-style',
        'editor_style' => 'california-design-system-hero-style-editor',
        'editor_script' => 'california-design-system-hero-block',
        'render_callback' => 'cagov_hero_dynamic_render_callback'
    ) );
}
add_action( 'init', 'cagov_design_system_register_hero' );

function cagov_hero_dynamic_render_callback($block_attributes, $content)
{
    $title = isset($block_attributes["title"]) ? $block_attributes["title"] : "";
    $body = isset($block_attributes["body"]) ? $block_attributes["body"] : "";
    $buttontext = isset($block_attributes["buttontext"]) ? $block_attributes["buttontext"] : "";
    $buttonurl = isset($block_attributes["buttonurl"]) ? $block_attributes["buttonurl"] : "";
    $mediaID = isset($block_attributes["mediaID"]) ? $block_attributes["mediaID"] : "";
    $mediaURL = isset($block_attributes["mediaURL"]) ? $block_attributes["mediaURL"] : "";

    return sprintf('<div class="wp-block-cagov-hero cagov-with-sidebar cagov-with-sidebar-left cagov-featured-section cagov-bkgrd-gry"><div><div class="cagov-stack cagov-p-2 cagov-featured-sidebar"><h2>%1$s</h2><div class="cagov-hero-body-content">
    <p>This month’s agenda includes consolidated budget proposal, report on equity, and opportunity for public comment.</p><div class="wp-block-button"><a class="wp-block-button__link" href="%4$s">%3$s</a></div></div></div><div><img class="cagov-featured-image" src="%6$s"></div></div></div>', $title, $body, $buttontext, $buttonurl, $mediaID, $mediaURL);
}
