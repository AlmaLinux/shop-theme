# AlmaLinux Shop theme

This is the WordPress block theme for [shop.almalinux.org](https://shop.almalinux.org/), where the AlmaLinux OS Foundation sells community merch through WooCommerce and Printful. It's a child theme of Twenty Twenty-Five, the default WordPress theme, so the parent handles the core layout and security updates while this theme carries the AlmaLinux branding and the store layouts.

## What's in it

- **Brand settings in `theme.json`.** The AlmaLinux palette, Montserrat Light headings, the almalinux.org body font stack, button styles and spacing all live here. Change a color or a font size in this one file and every page follows. The palette and type match [DESIGN.md in the almawww repo](https://github.com/AlmaLinux/almalinux.org/blob/master/DESIGN.md). Besides the core brand colors, the palette has:
  - **Light surface** (`accent-5`, `#eef1f4`), the cool gray behind product images and the made-to-order note.
  - **Five tile tints** (`al-tint-blue`, `al-tint-green`, `al-tint-yellow`, `al-tint-red` and `al-tint-cyan`), named "Tint ... (tiles)" in the color picker. The category tiles on the front page cycle through them.
  - **Logo red** (`al-logo-red`, `#ff4949`), used only in the logo-color stripe. It doesn't meet WCAG AA as text, so use **Error red** (`al-red`) for red text.
- **Header and footer** (`patterns/header.php`, `patterns/footer.php`) that match the almalinux.org navbar and footer, with the account link and mini cart from WooCommerce. A thin stripe in the five logo colors runs under the header and along the top of the footer. It's drawn in `assets/css/shop.css`, so it doesn't show up as a block in the editor.
- **A front page** (`patterns/front-page.php`) with these sections, top to bottom:
  1. A hero: a community photo in a Cover block, with the headline, intro, "Shop all products" and "Shop shirts" (which links to the Apparel category at `/product-category/apparel/`).
  2. "Shop by category": a tile for each top-level product category that has products in it, with its thumbnail, name and description. The tiles come from core's Terms Query block, so adding or editing a category under **Products > Categories** updates them. The thumbnail comes from a small block bindings source in `functions.php` ("Product category image"), because WordPress has no block for a category's image. Uncategorized is always left out.
  3. "New in the shop": the eight newest products.
  4. "As seen at events": a gallery of community members at AlmaLinux booths.
  5. Two short reassurance items: made to order, and who to email with questions.
- **Store templates** in `templates/` for every page a shopper sees:

  | Template | Page |
  | --- | --- |
  | `front-page.html` | Shop home |
  | `archive-product.html` | All products (`/shop/`) |
  | `taxonomy-product_cat.html` | A product category |
  | `taxonomy-product_tag.html` | A product tag |
  | `taxonomy-product_attribute.html` | A product attribute, such as a color or size |
  | `product-search-results.html` | Product search results |
  | `single-product.html` | A single product |
  | `page-cart.html` | Cart |
  | `page-checkout.html` | Checkout, with a simpler header |

  Order confirmation and My account use WooCommerce's own templates with this theme's header and footer.
- **Shared patterns.** Every listing page uses `patterns/product-archive.php` (search results use `patterns/product-search.php`), so a change to the product grid only has to be made once. `patterns/made-to-order-note.php` is the note on product pages that tells shoppers each item is printed when they order it.
- **Product cards.** Every product grid (front page, all products, categories, tags, attributes and search) puts each image on a rounded light gray card. Printful's white image backgrounds blend into the card, and cards lift slightly on hover unless the visitor prefers reduced motion.
- **Self-hosted Montserrat** in `assets/fonts/montserrat/`, so the shop doesn't load anything from Google.
- **Images** in `assets/images/`: the AlmaLinux logos (`logo-white-text.svg`, `logo-dark-text.svg` and `icon.svg`), the front page hero photo (`hero-ato-2024.jpg`, 2000px wide) and the four "As seen at events" photos (`event-*.jpg`, 1200px wide). `CREDITS.md` lists where each photo came from and which event it shows. Keep new photos under about 300 KB for the hero and 200 KB for the gallery, and strip their location metadata before you add them.

## Installing

1. Make sure Twenty Twenty-Five is installed on the site (it ships with WordPress). Don't delete it, because this theme depends on it.
2. Build the zip from this repo: `git archive --format=zip --prefix=almalinux-shop/ -o almalinux-shop.zip HEAD`
3. In WordPress, go to **Appearance > Themes > Add New Theme > Upload Theme** and upload the zip.
4. Use **Live Preview** to check the shop before you click **Activate**.

`docs/LAUNCH-CHECKLIST.md` covers the WordPress, WooCommerce and Printful setup that goes with the theme. `docs/TESTING.md` explains how to test the theme on a local site first.

The zip leaves out the local development tools (`dev/`, `package.json` and the git config files), which `.gitattributes` excludes from `git archive`.

## Local development

You can run a complete local copy of the shop with [WordPress Playground](https://wordpress.org/playground/), which runs WordPress in Node with no web server, database or Docker. You need Node.js 20 or newer.

1. Run `npm install` once, then `npx playwright install chromium` if you want screenshots.
2. Run `npm run dev` and open <http://127.0.0.1:9400>. You're logged in as `admin` (password `password`).
3. Edit the theme files in this repo and reload the page. The site uses this folder directly, so there's nothing to copy or rebuild.
4. With the site running, run `npm run screenshots` in a second terminal. It screenshots every page in `docs/TESTING.md` at phone, tablet and desktop widths, places a test order, and writes a review page to `dev/screenshots/<date>/index.html`.

Every `npm run dev` builds a fresh site from `dev/blueprint.json`. That file pins WordPress 7.1.5, WooCommerce 11.2.1 and PHP 8.3 to match production, and it imports WooCommerce's sample products. Test orders, settings and Site Editor changes are gone when you stop the server, so anything that should last belongs in this repo. PHP warnings and errors go to `dev/logs/debug.log`, which is cleared on each start.

Playground runs PHP compiled to WebAssembly on SQLite, not MySQL, so it's close to production but not identical. If something works locally and breaks on the live site, suspect that difference first.

## Editing

You can edit templates and patterns in the Site Editor (**Appearance > Editor**). Edits made there are saved in the database, not in this repo, so they'll override the files here without anyone seeing them in git. For anything that should last, make the change in this repo and upload a new version. If someone has already changed a template in the Site Editor, use **Reset** on that template to go back to the theme's version.

The links in the header and footer assume WooCommerce's default page slugs: `/shop/`, `/cart/`, `/checkout/`, `/my-account/` and `/refund_returns/`. If you change a slug in WordPress, update the patterns too.

## License

The theme code is licensed under the GNU General Public License, version 2 or later (see `LICENSE`). That matches WordPress and Twenty Twenty-Five, which WordPress requires for themes built on it.

Montserrat is licensed separately under the SIL Open Font License 1.1 (see `assets/fonts/montserrat/OFL.txt`).

The AlmaLinux name and logos are trademarks of the AlmaLinux OS Foundation and aren't covered by the GPL. See `TRADEMARKS.md`.

The photos in `assets/images/` aren't covered by the GPL either. They come from the almalinux.org blog and are licensed under CC BY-SA 4.0, with credit to the AlmaLinux OS Foundation. See `CREDITS.md`.

## Contributing

The Promo SIG maintains this theme. Please open an issue or pull request here, or come talk to us in the Promo SIG channel on [chat.almalinux.org](https://chat.almalinux.org/).
