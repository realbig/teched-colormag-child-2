<?php
/**
 * The theme's functions file that loads on EVERY page, used for uniform functionality.
 *
 * @since   {{VERSION}}
 * @package Colormag_Child_2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Make sure PHP version is correct
if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
	wp_die( _x( 'ERROR in ColorMag Child 02 theme: PHP version 5.3 or greater is required.', 'PHP Version too low Error', 'colormag-child-2' ) );
}

// Make sure no theme constants are already defined (realistically, there should be no conflicts)
if ( defined( 'THEME_VER' ) ||
	defined( 'THEME_URL' ) ||
	defined( 'THEME_DIR' ) ||
	defined( 'THEME_FILE' ) ) {
	wp_die( _x( 'ERROR in ColorMag Child 02 theme: There is a conflicting constant. Please either find the conflict or rename the constant.', 'Constant or Global already in use Error', 'colormag-child-2' ) );
}

/**
 * Define Constants based on our Stylesheet Header. Update things only once!
 */
$theme_header = wp_get_theme();

define( 'THEME_VER', $theme_header->get( 'Version' ) );
define( 'THEME_NAME', $theme_header->get( 'Name' ) );
define( 'THEME_URL', get_stylesheet_directory_uri() );
define( 'THEME_DIR', get_stylesheet_directory() );

$parent_theme = wp_get_theme( $theme_header->get( 'Template' ) );

// Parent Theme didn't have any cache busting. This will at least do so for the main styles
define( 'PARENT_THEME_VER', $parent_theme->get( 'Version' ) );

add_action( 'init', 'teched_register_scripts' );
function teched_register_scripts() {
	
	wp_register_script(
		'teched',
		THEME_URL . '/dist/assets/js/app.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VER,
		true
	);
	
	wp_register_style(
		'teched-parent',
		get_template_directory_uri() . '/style.css',
		array(),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : PARENT_THEME_VER,
		'all'
	);
	
	wp_register_style(
		'teched',
		THEME_URL . '/dist/assets/css/app.css',
		array( 'teched-parent' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VER,
		'all'
	);
	
}

add_action( 'wp_enqueue_scripts', 'teched_enqueue_scripts' );
function teched_enqueue_scripts() {
	
	//wp_enqueue_script( 'teched' );
	
	wp_enqueue_style( 'teched' );
	
}