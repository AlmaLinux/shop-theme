<?php
/**
 * Title: Product archive
 * Slug: almalinux-shop/product-archive
 * Categories: almalinux-shop
 * Inserter: no
 * Description: The shared body of every product listing: the main shop page, categories, tags and attributes (search results use the product-search pattern). Edit this once and every listing page follows.
 *
 * @package almalinux-shop
 */

?>
<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:woocommerce/breadcrumbs {"align":"wide"} /-->

	<!-- wp:query-title {"type":"archive","showPrefix":false,"align":"wide"} /-->

	<!-- wp:term-description {"align":"wide"} /-->

	<!-- wp:woocommerce/store-notices {"align":"wide"} /-->

	<!-- wp:group {"align":"wide","className":"al-shop-toolbar","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide al-shop-toolbar">
		<!-- wp:woocommerce/product-results-count /-->
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
		<div class="wp-block-group">
			<!-- wp:search {"label":"Search products","showLabel":false,"placeholder":"Search products","buttonText":"Search","buttonUseIcon":true,"query":{"post_type":"product"},"className":"al-shop-search"} /-->
			<!-- wp:woocommerce/catalog-sorting /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:woocommerce/product-collection {"queryId":0,"query":{"woocommerceAttributes":[],"woocommerceStockStatus":["instock","outofstock","onbackorder"],"taxQuery":{},"isProductCollectionBlock":true,"perPage":12,"pages":0,"offset":0,"postType":"product","order":"asc","orderBy":"title","author":"","search":"","exclude":[],"sticky":"","inherit":true},"tagName":"div","displayLayout":{"type":"flex","columns":4,"shrinkColumns":true},"dimensions":{"widthType":"fill","fixedWidth":""},"queryContextIncludes":["collection"],"align":"wide","className":"al-shop-grid"} -->
	<div class="wp-block-woocommerce-product-collection alignwide al-shop-grid">
		<!-- wp:woocommerce/product-template -->
			<!-- wp:woocommerce/product-image {"showSaleBadge":false,"imageSizing":"thumbnail","isDescendentOfQueryLoop":true,"aspectRatio":"1","scale":"cover"} -->
				<!-- wp:woocommerce/product-sale-badge {"isDescendentOfQueryLoop":true,"align":"right"} /-->
			<!-- /wp:woocommerce/product-image -->

			<!-- wp:post-title {"level":2,"isLink":true,"fontSize":"medium","fontFamily":"montserrat","style":{"typography":{"fontWeight":"500","lineHeight":"1.4"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->

			<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"fontSize":"medium","style":{"spacing":{"margin":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|20"}}}} /-->

			<!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true,"fontSize":"small","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} /-->
		<!-- /wp:woocommerce/product-template -->

		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
			<!-- wp:query-pagination-previous /-->
			<!-- wp:query-pagination-numbers /-->
			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->

		<!-- wp:woocommerce/product-collection-no-results -->
			<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","flexWrap":"wrap"}} -->
			<div class="wp-block-group">
				<!-- wp:pattern {"slug":"woocommerce/no-products-found-clear-filters"} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:woocommerce/product-collection-no-results -->
	</div>
	<!-- /wp:woocommerce/product-collection -->
</main>
<!-- /wp:group -->
