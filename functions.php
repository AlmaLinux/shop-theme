<?php
/**
 * AlmaLinux Shop theme setup.
 *
 * @package almalinux-shop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load the store stylesheet on the front end and in the editor.
 */
function almalinux_shop_enqueue_styles() {
	$version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style(
		'almalinux-shop',
		get_stylesheet_directory_uri() . '/assets/css/shop.css',
		array(),
		$version
	);
}
add_action( 'wp_enqueue_scripts', 'almalinux_shop_enqueue_styles' );

/**
 * Use the same stylesheet inside the Site Editor so editors see what visitors see.
 */
function almalinux_shop_editor_styles() {
	add_editor_style( 'assets/css/shop.css' );
}
add_action( 'after_setup_theme', 'almalinux_shop_editor_styles' );

/**
 * Group this theme's patterns together in the inserter.
 */
function almalinux_shop_pattern_category() {
	register_block_pattern_category(
		'almalinux-shop',
		array( 'label' => __( 'AlmaLinux Shop', 'almalinux-shop' ) )
	);
}
add_action( 'init', 'almalinux_shop_pattern_category' );
