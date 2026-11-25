<?php
/**
 * Title: Shop footer
 * Slug: almalinux-shop/footer
 * Categories: footer, almalinux-shop
 * Block Types: core/template-part/footer
 * Inserter: no
 * Description: Deep band footer that matches almalinux.org, with store links, community links and legal links.
 *
 * @package almalinux-shop
 */

$almalinux_shop_icon = esc_url( get_stylesheet_directory_uri() . '/assets/images/icon.svg' );
?>
<!-- wp:group {"align":"full","className":"al-shop-footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"}},"elements":{"link":{"color":{"text":"var:preset|color|accent-2"},":hover":{"color":{"text":"var:preset|color|al-text-on-dark"}}},"heading":{"color":{"text":"var:preset|color|al-text-on-dark"}}}},"backgroundColor":"al-deep-band","textColor":"al-text-on-dark","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull al-shop-footer has-al-text-on-dark-color has-al-deep-band-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"34%"} -->
		<div class="wp-block-column" style="flex-basis:34%">
			<!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo $almalinux_shop_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>" alt="" style="width:48px;height:48px"/></figure>
			<!-- /wp:image -->

			<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}}} -->
			<p style="font-weight:600"><?php esc_html_e( 'AlmaLinux OS Foundation', 'almalinux-shop' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size"><?php esc_html_e( 'Merch for the AlmaLinux community. Every item is printed when you order it.', 'almalinux-shop' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size"><?php esc_html_e( 'Questions about an order?', 'almalinux-shop' ); ?> <a href="mailto:shop@almalinux.org">shop@almalinux.org</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":2,"className":"al-shop-footer-heading","fontSize":"medium"} -->
			<h2 class="wp-block-heading al-shop-footer-heading has-medium-font-size"><?php esc_html_e( 'Shop', 'almalinux-shop' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:list {"className":"is-style-default al-shop-footer-list","fontSize":"small"} -->
			<ul class="wp-block-list is-style-default al-shop-footer-list has-small-font-size">
				<!-- wp:list-item --><li><a href="/shop/"><?php esc_html_e( 'All products', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="/cart/"><?php esc_html_e( 'Cart', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="/my-account/"><?php esc_html_e( 'My account', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="/refund_returns/"><?php esc_html_e( 'Shipping, returns and refunds', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":2,"className":"al-shop-footer-heading","fontSize":"medium"} -->
			<h2 class="wp-block-heading al-shop-footer-heading has-medium-font-size"><?php esc_html_e( 'Community', 'almalinux-shop' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:list {"className":"al-shop-footer-list","fontSize":"small"} -->
			<ul class="wp-block-list al-shop-footer-list has-small-font-size">
				<!-- wp:list-item --><li><a href="https://almalinux.org/">almalinux.org</a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="https://wiki.almalinux.org/"><?php esc_html_e( 'Wiki', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="https://chat.almalinux.org/"><?php esc_html_e( 'Chat', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="https://forums.almalinux.org/"><?php esc_html_e( 'Forums', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="https://almalinux.org/members/"><?php esc_html_e( 'Membership', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":2,"className":"al-shop-footer-heading","fontSize":"medium"} -->
			<h2 class="wp-block-heading al-shop-footer-heading has-medium-font-size"><?php esc_html_e( 'Legal', 'almalinux-shop' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:list {"className":"al-shop-footer-list","fontSize":"small"} -->
			<ul class="wp-block-list al-shop-footer-list has-small-font-size">
				<!-- wp:list-item --><li><a href="https://almalinux.org/p/privacy-policy/"><?php esc_html_e( 'Privacy Policy', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="https://almalinux.org/p/terms-of-service/"><?php esc_html_e( 'Terms of Service', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="https://almalinux.org/p/the-almalinux-os-licensing-policy/"><?php esc_html_e( 'Licensing Policy', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="https://almalinux.org/p/the-almalinux-os-trademark-usage-policy/"><?php esc_html_e( 'Trademark Usage Policy', 'almalinux-shop' ); ?></a></li><!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:paragraph {"align":"wide","className":"al-shop-footer-legal","fontSize":"small"} -->
	<p class="alignwide al-shop-footer-legal has-small-font-size"><?php esc_html_e( 'AlmaLinux and the AlmaLinux logo are trademarks of the AlmaLinux OS Foundation.', 'almalinux-shop' ); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
