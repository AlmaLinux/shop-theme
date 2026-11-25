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

$almalinux_shop_hero = esc_url( get_theme_file_uri( 'assets/images/hero-ato-2024.jpg' ) );

// Photos for the "Seen at events" gallery. See CREDITS.md for where each one came from.
$almalinux_shop_events = array(
	array(
		'file'    => 'event-ato-2024.jpg',
		'alt'     => __( 'Seven people in AlmaLinux shirts at the AlmaLinux booth at All Things Open, most of them holding LEGO sets.', 'almalinux-shop' ),
		'caption' => __( 'All Things Open 2024', 'almalinux-shop' ),
	),
	array(
		'file'    => 'event-sc24.jpg',
		'alt'     => __( 'Six people, most in AlmaLinux shirts, at the AlmaLinux booth at SC24, holding LEGO sets.', 'almalinux-shop' ),
		'caption' => __( 'SC24', 'almalinux-shop' ),
	),
	array(
		'file'    => 'event-cloudfest-2024.jpg',
		'alt'     => __( 'Three people taking a selfie in front of the AlmaLinux booth at CloudFest, one of them in an AlmaLinux shirt.', 'almalinux-shop' ),
		'caption' => __( 'CloudFest 2024', 'almalinux-shop' ),
	),
	array(
		'file'    => 'event-nerdearla.jpg',
		'alt'     => __( 'A group selfie at the AlmaLinux booth at Nerdearla, with a person in an AlmaLinux hoodie waving in the background.', 'almalinux-shop' ),
		'caption' => __( 'Nerdearla', 'almalinux-shop' ),
	),
);
?>
<!-- wp:group {"tagName":"main","layout":{"type":"default"}} -->
<main class="wp-block-group">
	<?php
	// The hero photo is decorative (the heading says what the page is), so its alt text is empty. The gradient overlay keeps the text on the left readable; shop.css swaps it for a solid overlay on narrower screens, where the text covers the whole photo.
	?>
	<!-- wp:cover {"url":"<?php echo $almalinux_shop_hero; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>","focalPoint":{"x":0.5,"y":0.4},"minHeight":560,"minHeightUnit":"px","customGradient":"linear-gradient(90deg,rgba(8,35,54,0.92) 0%,rgba(8,35,54,0.85) 40%,rgba(8,35,54,0.05) 72%)","align":"full","className":"al-shop-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}},"elements":{"link":{"color":{"text":"var:preset|color|accent-2"}}}},"textColor":"al-text-on-dark","layout":{"type":"constrained"}} -->
	<div class="wp-block-cover alignfull al-shop-hero has-al-text-on-dark-color has-text-color has-link-color" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);min-height:560px"><img class="wp-block-cover__image-background" alt="" src="<?php echo $almalinux_shop_hero; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>" style="object-position:50% 40%" data-object-fit="cover" data-object-position="50% 40%"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(90deg,rgba(8,35,54,0.92) 0%,rgba(8,35,54,0.85) 40%,rgba(8,35,54,0.05) 72%)"></span><div class="wp-block-cover__inner-container">
		<!-- wp:group {"align":"wide","layout":{"type":"constrained","contentSize":"620px","justifyContent":"left"}} -->
		<div class="wp-block-group alignwide">
			<!-- wp:paragraph {"className":"al-shop-eyebrow","style":{"typography":{"fontWeight":"700","letterSpacing":"0.12em","textTransform":"uppercase"}},"textColor":"accent-1","fontSize":"small"} -->
			<p class="al-shop-eyebrow has-accent-1-color has-text-color has-small-font-size" style="font-weight:700;letter-spacing:0.12em;text-transform:uppercase"><?php esc_html_e( 'The official AlmaLinux shop', 'almalinux-shop' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"style":{"typography":{"lineHeight":"1.08"}},"fontSize":"display"} -->
			<h1 class="wp-block-heading has-display-font-size" style="line-height:1.08"><?php esc_html_e( 'Merch for the AlmaLinux community', 'almalinux-shop' ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"large"} -->
			<p class="has-large-font-size"><?php esc_html_e( 'Shirts, hoodies, hats, mugs and stickers. Every item is printed when you order it and shipped straight to you.', 'almalinux-shop' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/shop/"><?php esc_html_e( 'Shop all products', 'almalinux-shop' ); ?></a></div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/product-category/apparel/"><?php esc_html_e( 'Shop shirts', 'almalinux-shop' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:paragraph {"className":"al-shop-photo-credit","fontSize":"small"} -->
		<p class="al-shop-photo-credit has-small-font-size"><?php esc_html_e( 'Photo: the AlmaLinux crowd at All Things Open 2024', 'almalinux-shop' ); ?></p>
		<!-- /wp:paragraph -->
	</div></div>
	<!-- /wp:cover -->

	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"0"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:0">
		<!-- wp:heading {"align":"wide"} -->
		<h2 class="wp-block-heading alignwide"><?php esc_html_e( 'Shop by category', 'almalinux-shop' ); ?></h2>
		<!-- /wp:heading -->

		<?php
		// Top-level product categories that have products in them. Each tile's image is bound to the category thumbnail (see almalinux_shop_register_category_image_source() in functions.php), and functions.php also leaves out the default "Uncategorized" category. The tile colors come from shop.css.
		?>
		<!-- wp:terms-query {"termQuery":{"perPage":12,"taxonomy":"product_cat","order":"asc","orderBy":"name","include":[],"hideEmpty":true,"showNested":false,"inherit":false},"align":"wide","className":"al-shop-categories"} -->
		<div class="wp-block-terms-query alignwide al-shop-categories">
			<!-- wp:term-template -->
				<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"woocommerce_thumbnail","linkDestination":"none","metadata":{"bindings":{"url":{"source":"almalinux-shop/category-image"},"alt":{"source":"almalinux-shop/category-image"}}},"className":"al-shop-category-image"} -->
				<figure class="wp-block-image size-woocommerce_thumbnail al-shop-category-image"><img alt="" style="aspect-ratio:1;object-fit:cover"/></figure>
				<!-- /wp:image -->

				<!-- wp:term-name {"level":3,"isLink":true,"className":"al-shop-category-name","fontSize":"medium","fontFamily":"system"} /-->

				<!-- wp:term-description {"className":"al-shop-category-description","fontSize":"small"} /-->
			<!-- /wp:term-template -->
		</div>
		<!-- /wp:terms-query -->
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
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/shop/"><?php esc_html_e( 'See all products', 'almalinux-shop' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"align":"full","className":"al-shop-events","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}},"elements":{"link":{"color":{"text":"var:preset|color|accent-2"}}}},"backgroundColor":"al-deep-band","textColor":"al-text-on-dark","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull al-shop-events has-al-text-on-dark-color has-al-deep-band-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
		<!-- wp:group {"align":"wide","layout":{"type":"constrained","contentSize":"46rem","justifyContent":"left"}} -->
		<div class="wp-block-group alignwide">
			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Seen at events', 'almalinux-shop' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"accent-2","fontSize":"large"} -->
			<p class="has-accent-2-color has-text-color has-large-font-size"><?php
		printf(
			/* translators: %s: link to the shop's email address. */
			esc_html__( 'These are AlmaLinux community members at our booths around the world. If you have a photo of yourself in AlmaLinux gear, send it to %s and we might feature it here.', 'almalinux-shop' ),
			'<a href="mailto:hello@almalinux.org">hello@almalinux.org</a>'
		);
		?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:gallery {"columns":4,"linkTo":"none","align":"wide","className":"al-shop-events-gallery","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"}}}} -->
		<figure class="wp-block-gallery alignwide has-nested-images columns-4 is-cropped al-shop-events-gallery">
			<?php foreach ( $almalinux_shop_events as $almalinux_shop_event ) : ?>
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","linkDestination":"none"} -->
			<figure class="wp-block-image"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/' . $almalinux_shop_event['file'] ) ); ?>" alt="<?php echo esc_attr( $almalinux_shop_event['alt'] ); ?>" style="aspect-ratio:4/3;object-fit:cover"/><figcaption class="wp-element-caption"><?php echo esc_html( $almalinux_shop_event['caption'] ); ?></figcaption></figure>
			<!-- /wp:image -->
			<?php endforeach; ?>
		</figure>
		<!-- /wp:gallery -->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->
