# AlmaLinux Shop theme

This is the WordPress block theme for [shop.almalinux.org](https://shop.almalinux.org/), where the AlmaLinux OS Foundation sells community merch through WooCommerce and Printful. It's a child theme of Twenty Twenty-Five, the default WordPress theme, so the parent handles the core layout and security updates while this theme carries the AlmaLinux branding and the store layouts.

## What's in it

- **Brand settings in `theme.json`.** The AlmaLinux palette, Montserrat Light headings, the almalinux.org body font stack, button styles and spacing all live here. Change a color or a font size in this one file and every page follows. The palette and type match [DESIGN.md in the almawww repo](https://github.com/AlmaLinux/almalinux.org/blob/master/DESIGN.md).
- **Header and footer** (`patterns/header.php`, `patterns/footer.php`) that match the almalinux.org navbar and footer, with the account link and mini cart from WooCommerce.
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
- **Self-hosted Montserrat** in `assets/fonts/montserrat/`, so the shop doesn't load anything from Google.

## Installing

1. Make sure Twenty Twenty-Five is installed on the site (it ships with WordPress). Don't delete it, because this theme depends on it.
2. Build the zip from this repo: `git archive --format=zip --prefix=almalinux-shop/ -o almalinux-shop.zip HEAD`
3. In WordPress, go to **Appearance > Themes > Add New Theme > Upload Theme** and upload the zip.
4. Use **Live Preview** to check the shop before you click **Activate**.

`docs/LAUNCH-CHECKLIST.md` covers the WordPress, WooCommerce and Printful setup that goes with the theme.

## Editing

You can edit templates and patterns in the Site Editor (**Appearance > Editor**). Edits made there are saved in the database, not in this repo, so they'll override the files here without anyone seeing them in git. For anything that should last, make the change in this repo and upload a new version. If someone has already changed a template in the Site Editor, use **Reset** on that template to go back to the theme's version.

The links in the header and footer assume WooCommerce's default page slugs: `/shop/`, `/cart/`, `/checkout/`, `/my-account/` and `/refund_returns/`. If you change a slug in WordPress, update the patterns too.

## License

The theme code is licensed under the GNU General Public License, version 2 or later (see `LICENSE`). That matches WordPress and Twenty Twenty-Five, which WordPress requires for themes built on it.

Montserrat is licensed separately under the SIL Open Font License 1.1 (see `assets/fonts/montserrat/OFL.txt`).

The AlmaLinux name and logos are trademarks of the AlmaLinux OS Foundation and aren't covered by the GPL. See `TRADEMARKS.md`.

## Contributing

The Promo SIG maintains this theme. Please open an issue or pull request here, or come talk to us in the Promo SIG channel on [chat.almalinux.org](https://chat.almalinux.org/).
