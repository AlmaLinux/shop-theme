<?php
/**
 * Title: Shop header
 * Slug: almalinux-shop/header
 * Categories: header, almalinux-shop
 * Block Types: core/template-part/header
 * Inserter: no
 * Description: Dark header that matches the almalinux.org navbar, with the logo, store navigation, account link and mini cart.
 *
 * @package almalinux-shop
 */

$almalinux_shop_logo = esc_url( get_stylesheet_directory_uri() . '/assets/images/logo-white-text.svg' );
?>
<!-- wp:group {"align":"full","className":"al-shop-header","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"elements":{"link":{"color":{"text":"var:preset|color|al-text-on-dark"}}}},"backgroundColor":"al-deep-blue","textColor":"al-text-on-dark","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull al-shop-header has-al-text-on-dark-color has-al-deep-blue-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)">
	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"className":"al-shop-brand","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group al-shop-brand">
			<!-- wp:image {"width":"166px","height":"32px","sizeSlug":"full","linkDestination":"custom","className":"al-shop-logo"} -->
			<figure class="wp-block-image size-full is-resized al-shop-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $almalinux_shop_logo; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>" alt="<?php esc_attr_e( 'AlmaLinux shop home', 'almalinux-shop' ); ?>" style="width:166px;height:32px"/></a></figure>
			<!-- /wp:image -->

			<!-- wp:paragraph {"className":"al-shop-wordmark","style":{"typography":{"fontWeight":"300"}},"fontSize":"large","fontFamily":"montserrat"} -->
			<p class="al-shop-wordmark has-montserrat-font-family has-large-font-size" style="font-weight:300"><?php esc_html_e( 'Shop', 'almalinux-shop' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
		<div class="wp-block-group">
			<!-- wp:navigation {"overlayBackgroundColor":"al-deep-band","overlayTextColor":"al-text-on-dark","layout":{"type":"flex","justifyContent":"right","flexWrap":"wrap"},"ariaLabel":"Shop"} -->
				<!-- wp:navigation-link {"label":"<?php echo esc_attr__( 'All products', 'almalinux-shop' ); ?>","url":"/shop/","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"almalinux.org","url":"https://almalinux.org/","kind":"custom","className":"al-shop-nav-main-site"} /-->
			<!-- /wp:navigation -->

			<!-- wp:woocommerce/customer-account {"displayStyle":"icon_only","iconStyle":"line","iconClass":"wc-block-customer-account__account-icon"} /-->

			<!-- wp:woocommerce/mini-cart {"iconColor":{"slug":"al-text-on-dark","color":"#fefefe"},"productCountColor":{"slug":"al-cta","color":"#24c2ff"}} /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
