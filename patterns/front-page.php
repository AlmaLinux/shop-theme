<?php
/**
 * Title: Shop front page
 * Slug: almalinux-shop/front-page
 * Categories: almalinux-shop
 * Inserter: no
 * Description: Shop home: a short welcome band, the newest products, and a list of categories.
 *
 * @package almalinux-shop
 */

?>
<!-- wp:group {"tagName":"main","layout":{"type":"default"}} -->
<main class="wp-block-group">
	<!-- wp:group {"align":"full","className":"al-shop-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}},"elements":{"link":{"color":{"text":"var:preset|color|accent-2"}}}},"backgroundColor":"al-deep-band","textColor":"al-text-on-dark","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull al-shop-hero has-al-text-on-dark-color has-al-deep-band-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
		<!-- wp:group {"align":"wide","layout":{"type":"constrained","contentSize":"720px","justifyContent":"left"}} -->
		<div class="wp-block-group alignwide">
			<!-- wp:heading {"level":1,"fontSize":"display"} -->
			<h1 class="wp-block-heading has-display-font-size"><?php esc_html_e( 'The AlmaLinux shop', 'almalinux-shop' ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"large"} -->
			<p class="has-large-font-size"><?php esc_html_e( 'Merch for the AlmaLinux community. Every item is printed when you order it and shipped straight to you.', 'almalinux-shop' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/shop/"><?php esc_html_e( 'Shop all products', 'almalinux-shop' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)">
		<!-- wp:heading {"align":"wide"} -->
		<h2 class="wp-block-heading alignwide"><?php esc_html_e( 'New in the shop', 'almalinux-shop' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:woocommerce/product-collection {"queryId":1,"query":{"woocommerceAttributes":[],"woocommerceStockStatus":["instock","onbackorder"],"taxQuery":{},"isProductCollectionBlock":true,"perPage":8,"pages":1,"offset":0,"postType":"product","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"tagName":"div","displayLayout":{"type":"flex","columns":4,"shrinkColumns":true},"dimensions":{"widthType":"fill","fixedWidth":""},"collection":"woocommerce/product-collection/new-arrivals","hideControls":["inherit","order","filterable"],"queryContextIncludes":["collection"],"align":"wide","className":"al-shop-grid"} -->
		<div class="wp-block-woocommerce-product-collection alignwide al-shop-grid">
			<!-- wp:woocommerce/product-template -->
				<!-- wp:woocommerce/product-image {"showSaleBadge":false,"imageSizing":"thumbnail","isDescendentOfQueryLoop":true,"aspectRatio":"1","scale":"cover"} -->
					<!-- wp:woocommerce/product-sale-badge {"isDescendentOfQueryLoop":true,"align":"right"} /-->
				<!-- /wp:woocommerce/product-image -->

				<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"medium","fontFamily":"montserrat","style":{"typography":{"fontWeight":"500","lineHeight":"1.4"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->

				<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"fontSize":"medium","style":{"spacing":{"margin":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|30"}}}} /-->
			<!-- /wp:woocommerce/product-template -->
		</div>
		<!-- /wp:woocommerce/product-collection -->

		<!-- wp:buttons {"align":"wide","className":"is-style-outline"} -->
		<div class="wp-block-buttons alignwide is-style-outline">
			<!-- wp:button {"className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/shop/"><?php esc_html_e( 'See everything', 'almalinux-shop' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"}}},"backgroundColor":"accent-5","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-accent-5-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)">
		<!-- wp:heading {"align":"wide"} -->
		<h2 class="wp-block-heading alignwide"><?php esc_html_e( 'Browse by category', 'almalinux-shop' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:woocommerce/product-categories {"hasCount":false,"hasEmpty":false,"isHierarchical":false,"align":"wide","className":"al-shop-category-list"} /-->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->
