# Testing the theme locally

These are directions for setting up a local WordPress and WooCommerce site to test this theme before it goes anywhere near shop.almalinux.org. They're written so that a person or an AI coding agent can follow them.

Every page now renders on the local site without errors, but nobody has reviewed the screenshots for layout, branding or accessibility yet. Everything was written against the WordPress 7.1.4 and WooCommerce 11.2.1 source. Expect to find and fix problems.

## Ground rules

- Test only on a local site. Don't upload anything to shop.almalinux.org or change anything there.
- Don't push to GitHub or open a pull request without benny's approval. Commit fixes locally in small, logical commits.
- Match production: WordPress 7.1.x, WooCommerce 11.2.1, PHP 8.3, and Twenty Twenty-Five installed as the parent theme.
- Any setup files (a Playground blueprint, a `.wp-env.json`, a script) go in this repo, under `dev/` or at the root, with a short note in the README on how to use them. Prefer free and open source tools.

## 1. Set up the site

Follow "Local development" in the README: `npm install`, `npx playwright install chromium`, then `npm run dev`. The site is at <http://127.0.0.1:9400> and takes under a minute to start.

`dev/blueprint.json` builds the site fresh on every start, so there's no setup to do by hand. It:

- installs WooCommerce 11.2.1 and Twenty Twenty-Five, and activates this theme (mounted straight from the repo, so edits show up on reload)
- imports WooCommerce's sample products with its CSV importer, which gives you the Color and Size attributes, variations and sale prices
- replaces the sample categories with the shop's real ones (Apparel, Hats, Drinkware, Bags and Stickers) using `dev/categories.php`, with descriptions and thumbnails borrowed from sample product images. Bags has no thumbnail, to test the placeholder, and two products stay in Uncategorized, to test that the front page leaves it out
- adds a product with a long name, a product with no image, and a "Community favorite" tag (the sample data has no tags)
- turns on attribute archives so the attribute template gets used, sets permalinks to **Post name**, and turns on Cash on delivery
- turns on `WP_DEBUG` and writes PHP warnings to `dev/logs/debug.log`

If you need more test content, add it to the blueprint rather than through the admin, so the next person gets it too.

## 2. Take the screenshots

With the site running, run `npm run screenshots` in a second terminal. It takes about two minutes. It finds real product, category, tag and attribute URLs from the store, screenshots every page in the table below at 390px (phone), 768px (tablet) and 1440px (desktop), and places a Cash on delivery order to reach the confirmation page. It flags any page with a console error, a PHP warning on the page, or an unexpected HTTP status.

Open the `index.html` it prints to review all the screenshots on one page. Each run gets its own dated folder under `dev/screenshots/`, which git ignores.

The script can't judge how a page looks, and it doesn't check the Site Editor. That's what section 3 is for.

## 3. Check every page

These are the pages the screenshot script covers.

| Page | URL |
| --- | --- |
| Shop home | `/` |
| All products | `/shop/` |
| A category | `/product-category/<slug>/` |
| A tag | `/product-tag/<slug>/` |
| An attribute | `/color/blue/` (the archive for one attribute value) |
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
3. Confirm the "Shop by category" tiles on the front page (a core Terms Query block) show each category's thumbnail, name and description, leave out empty categories and Uncategorized, and that `product-collection` on the front page shows the newest products. Also open the front page template in the Site Editor and check that the tiles' Image block shows as bound to "Product category image."
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
