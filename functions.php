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

/**
 * Let an Image block show a product category's thumbnail.
 *
 * Core's Terms Query block can list categories with their names and descriptions, but WordPress has no block for a term's image. The "Shop by category" tiles on the front page use a core Image block bound to this source, so each tile shows the thumbnail set under Products > Categories. Categories without a thumbnail get WooCommerce's placeholder image.
 */
function almalinux_shop_register_category_image_source() {
	if ( ! function_exists( 'register_block_bindings_source' ) ) {
		return;
	}
	register_block_bindings_source(
		'almalinux-shop/category-image',
		array(
			'label'              => __( 'Product category image', 'almalinux-shop' ),
			'uses_context'       => array( 'termId', 'taxonomy' ),
			'get_value_callback' => 'almalinux_shop_category_image_value',
		)
	);
}
add_action( 'init', 'almalinux_shop_register_category_image_source' );

/**
 * Return the bound Image block's url (the category thumbnail) or alt (empty, since the category name sits right next to the image).
 *
 * @param array    $source_args    Arguments from the block's binding.
 * @param WP_Block $block_instance The Image block being rendered.
 * @param string   $attribute_name The attribute being bound.
 * @return string|null
 */
function almalinux_shop_category_image_value( $source_args, $block_instance, $attribute_name ) {
	if ( 'alt' === $attribute_name ) {
		return '';
	}
	if ( 'url' !== $attribute_name || empty( $block_instance->context['termId'] ) ) {
		return null;
	}
	$thumbnail_id = (int) get_term_meta( (int) $block_instance->context['termId'], 'thumbnail_id', true );
	$url          = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'woocommerce_thumbnail' ) : false;
	if ( ! $url && function_exists( 'wc_placeholder_img_src' ) ) {
		$url = wc_placeholder_img_src( 'woocommerce_thumbnail' );
	}
	return $url ? $url : null;
}

/**
 * Leave the store's default category ("Uncategorized") out of the front page category tiles.
 *
 * WooCommerce puts any product without a category there, so it isn't always empty. The Terms Query block has no exclude option, so while the term list inside a Terms Query block with the al-shop-categories class renders, this adds the default category to the query's exclude list. It finds the category by its ID, so renaming it doesn't matter.
 *
 * @param array         $context      Context passed to the block.
 * @param array         $parsed_block The block being rendered.
 * @param WP_Block|null $parent_block Its parent block.
 * @return array
 */
function almalinux_shop_category_tiles_context( $context, $parsed_block, $parent_block ) {
	if (
		'core/term-template' === $parsed_block['blockName']
		&& $parent_block instanceof WP_Block
		&& 'core/terms-query' === $parent_block->name
		&& str_contains( $parent_block->attributes['className'] ?? '', 'al-shop-categories' )
	) {
		add_filter( 'get_terms_args', 'almalinux_shop_exclude_default_category' );
		add_filter( 'render_block_core/term-template', 'almalinux_shop_stop_excluding_default_category' );
	}
	return $context;
}
add_filter( 'render_block_context', 'almalinux_shop_category_tiles_context', 10, 3 );

/**
 * Add the default product category to a product category term query's exclude list.
 *
 * @param array $args WP_Term_Query arguments.
 * @return array
 */
function almalinux_shop_exclude_default_category( $args ) {
	$default = (int) get_option( 'default_product_cat' );
	if ( $default && in_array( 'product_cat', (array) $args['taxonomy'], true ) ) {
		$args['exclude'] = array_merge( wp_parse_id_list( $args['exclude'] ?? array() ), array( $default ) );
	}
	return $args;
}

/**
 * Remove the exclusion once the category tiles have rendered, so no other term query is affected.
 *
 * @param string $content The rendered term list.
 * @return string
 */
function almalinux_shop_stop_excluding_default_category( $content ) {
	remove_filter( 'get_terms_args', 'almalinux_shop_exclude_default_category' );
	remove_filter( 'render_block_core/term-template', 'almalinux_shop_stop_excluding_default_category' );
	return $content;
}
