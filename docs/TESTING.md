# Testing the theme locally

These are directions for setting up a local WordPress and WooCommerce site to test this theme before it goes anywhere near shop.almalinux.org. They're written so that a person or an AI coding agent can follow them.

The theme has not been rendered or tested yet. Everything in it was written against the WordPress 7.1.4 and WooCommerce 11.2.1 source, and the PHP and JSON pass a syntax check, but nobody has looked at a page. Expect to find and fix problems.

## Ground rules

- Test only on a local site. Don't upload anything to shop.almalinux.org or change anything there.
- Don't push to GitHub or open a pull request without benny's approval. Commit fixes locally in small, logical commits.
- Match production: WordPress 7.1.x, WooCommerce 11.2.1, PHP 8.3, and Twenty Twenty-Five installed as the parent theme.
- Any setup files (a Playground blueprint, a `.wp-env.json`, a script) go in this repo, under `dev/` or at the root, with a short note in the README on how to use them. Prefer free and open source tools.

## 1. Set up the site

Use whichever of these works on a Mac:

- **WordPress Playground CLI** (no Docker needed): `npx @wp-playground/cli server`, with this repo mounted as `wp-content/themes/almalinux-shop` and a blueprint that installs WooCommerce and activates the theme.
- **wp-env** (needs Docker): a `.wp-env.json` that loads WordPress 7.1, WooCommerce 11.2.1 and this theme.

Check each tool's current documentation for the exact flags, because both change often.

## 2. Add test content

- Import WooCommerce's sample products (`sample-data/sample_products.xml` in the WooCommerce plugin folder) with **Tools > Import > WordPress**. That gives you products with categories, tags, attributes, variations and sale prices.
- Make one product with a long name and one with no image, so the edge cases show up.
- Create the Cart, Checkout and My account pages if the setup didn't, and set permalinks to **Post name**.
- Turn on a test payment method (Cash on delivery or Check payments works) so you can get through checkout.

## 3. Check every page

Screenshot each page at three widths: 390px (phone), 768px (tablet) and 1440px (desktop).

| Page | URL |
| --- | --- |
| Shop home | `/` |
| All products | `/shop/` |
| A category | `/product-category/<slug>/` |
| A tag | `/product-tag/<slug>/` |
| An attribute | `/?pa_color=blue` or the attribute's archive URL |
| Search results, with results | `/?s=hoodie&post_type=product` |
| Search results, nothing found | `/?s=zzzz&post_type=product` |
| A simple product | any |
| A variable product | any with sizes or colors |
| Cart, empty and with items | `/cart/` |
| Checkout | `/checkout/` |
| Order confirmation | place a test order |
| My account, logged out and logged in | `/my-account/` |
| 404 page | `/does-not-exist/` |

For each page, check:

- **Nothing is broken.** There are no block errors ("This block contains unexpected or invalid content"), no PHP warnings, and no console errors.
- **It's on brand.** The header and footer match almalinux.org, the headings use Montserrat, the colors come from the palette in `theme.json`, and the logo is the white-text version on the dark header.
- **It's readable.** Text and buttons meet WCAG AA contrast (4.5:1 for body text, 3:1 for large text and controls), and nothing overflows or overlaps at any width.
- **It works from a keyboard.** You can reach everything with Tab, and focus is always visible, including on the dark header and footer.
- **The mobile menu works.** It opens, closes, and the account and cart icons stay usable.

Also open **Appearance > Editor** and confirm each template, part and pattern loads in the Site Editor without block validation errors.

## 4. Things nobody has verified yet

These are the parts most likely to need fixing:

1. The `navigation-link` labels in `patterns/header.php` are built with PHP inside block attributes. Confirm they render and stay editable.
2. Confirm the `woocommerce/mini-cart` and `woocommerce/customer-account` icons pick up the light color on the dark header.
3. Confirm the `woocommerce/product-categories` block on the front page renders as pill links, and that `product-collection` on the front page shows the newest products.
4. Confirm the `core/search` block with `query.post_type = product` returns product results in the product search template.
5. Check that the checkout template uses this theme's `checkout-header` part and not WooCommerce's.
6. Check that theme.json font sizes, spacing and the `display` size look right. The heading weights (300 for h1 and h2, 500 for smaller headings) are a judgment call, so flag anything that looks too thin.
7. Check that Montserrat loads from `assets/fonts/` and that nothing loads from Google.
8. Decide whether the variable font (about 210 KB) should be subset to Latin to save weight.

## 5. Report back

When you're done, give benny:

- A short list of what you fixed, with commit hashes.
- Anything you couldn't fix or that needs her decision.
- The screenshots, in one folder or one page so she can review them quickly.

Don't declare the theme ready until you've fixed what you found and rechecked those pages once.
