<?php
/**
 * Title: Made to order note
 * Slug: almalinux-shop/made-to-order-note
 * Categories: almalinux-shop
 * Description: A short note on product pages explaining that items are printed on demand, so shoppers know to expect a few extra days before their order ships.
 *
 * @package almalinux-shop
 */

?>
<!-- wp:group {"className":"al-shop-note","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|10"},"border":{"left":{"color":"var:preset|color|al-cta","width":"4px"},"radius":"6px"}},"backgroundColor":"accent-5","layout":{"type":"constrained"}} -->
<div class="wp-block-group al-shop-note has-accent-5-background-color has-background" style="border-radius:6px;border-left-color:var(--wp--preset--color--al-cta);border-left-width:4px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
	<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"fontSize":"small"} -->
	<p class="has-small-font-size" style="font-weight:600"><?php esc_html_e( 'Printed when you order it', 'almalinux-shop' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"fontSize":"small"} -->
	<p class="has-small-font-size"><?php esc_html_e( 'We don\'t keep stock on a shelf. Our print partner makes each item after you order, so it takes a few extra days before it ships. You\'ll see shipping options and costs for your address at checkout.', 'almalinux-shop' ); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
