<?php
/**
 * Local test data: reshape WooCommerce's sample categories into the shop's real ones.
 *
 * Run by dev/blueprint.json after the sample products are imported. The live shop uses Apparel, Hats, Drinkware, Bags and Stickers, each with a thumbnail and a one-line description, so this creates those, moves the sample products into them, and deletes the sample categories. The two Music products end up in "Uncategorized," which tests that the front page tiles leave it out. Bags has no thumbnail on purpose, to test the placeholder image.
 *
 * @package almalinux-shop
 */

require '/wordpress/wp-load.php';

/**
 * Find a sample product's image ID by product name, or 0 if there isn't one.
 *
 * @param string $name Product name.
 * @return int
 */
function almalinux_shop_dev_image( $name ) {
	$products = wc_get_products( array( 'name' => $name, 'limit' => 1 ) );
	return $products ? (int) $products[0]->get_image_id() : 0;
}

$categories = array(
	'Apparel'   => array(
		'description' => 'Tees, polos and hoodies.',
		'image'       => 'T-Shirt with Logo',
		'products'    => array( 'T-Shirt', 'T-Shirt with Logo', 'V-Neck T-Shirt', 'Long Sleeve Tee', 'Polo', 'Hoodie', 'Hoodie with Logo', 'Hoodie with Pocket', 'Hoodie with Zipper', 'Logo Collection', 'AlmaLinux Community Edition Heavyweight Organic Cotton Zip-Up Hoodie with Embroidered Logo and Extra Long Name' ),
	),
	'Hats'      => array(
		'description' => 'Beanies and caps.',
		'image'       => 'Beanie',
		'products'    => array( 'Beanie', 'Beanie with Logo', 'Cap' ),
	),
	'Drinkware' => array(
		'description' => 'Mugs for your morning coffee.',
		'image'       => 'WordPress Pennant',
		'products'    => array( 'WordPress Pennant' ),
	),
	'Bags'      => array(
		'description' => 'A tote for your laptop and your stickers.',
		'image'       => '',
		'products'    => array( 'Belt' ),
	),
	'Stickers'  => array(
		'description' => 'Sticker sheets and laptop stickers.',
		'image'       => 'Sunglasses',
		'products'    => array( 'Sunglasses', 'Sticker With No Image' ),
	),
);

$sample = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false, 'exclude' => array( (int) get_option( 'default_product_cat' ) ) ) );

foreach ( $categories as $name => $category ) {
	$term = wp_insert_term( $name, 'product_cat', array( 'description' => $category['description'] ) );
	if ( is_wp_error( $term ) ) {
		error_log( "Couldn't create the $name test category: " . $term->get_error_message() );
		continue;
	}
	$image = $category['image'] ? almalinux_shop_dev_image( $category['image'] ) : 0;
	if ( $image ) {
		update_term_meta( $term['term_id'], 'thumbnail_id', $image );
	}
	foreach ( $category['products'] as $product_name ) {
		foreach ( wc_get_products( array( 'name' => $product_name, 'limit' => -1 ) ) as $product ) {
			wp_set_object_terms( $product->get_id(), array( (int) $term['term_id'] ), 'product_cat' );
		}
	}
}

// Delete the sample categories, then put anything left without a category into Uncategorized, as WooCommerce does when you save a product.
foreach ( $sample as $term ) {
	wp_delete_term( $term->term_id, 'product_cat' );
}
foreach ( wc_get_products( array( 'limit' => -1, 'return' => 'ids' ) ) as $product_id ) {
	if ( ! wp_get_object_terms( $product_id, 'product_cat', array( 'fields' => 'ids' ) ) ) {
		wp_set_object_terms( $product_id, array( (int) get_option( 'default_product_cat' ) ), 'product_cat' );
	}
}
