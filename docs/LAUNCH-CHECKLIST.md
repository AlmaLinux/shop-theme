# Shop launch checklist

This is the setup that goes with the theme. Work through it in the WordPress admin for shop.almalinux.org before the shop goes live. Items marked **(check)** are things I couldn't confirm from outside the admin, so please look at the real screen and correct this list if it's different.

## 1. Keep the shop private while you work

- [ ] Go to **WooCommerce > Settings > Site visibility** and set the shop to **Coming soon**. Choose **Entire site** until launch. Admins can still see everything, and you can make a private link there to share with reviewers.
- [ ] Switch it to **Live** as the very last step (section 9).

## 2. Remove the placeholder content

- [ ] **Posts:** delete "Hello world!" and empty the trash.
- [ ] **Pages:** delete "Sample Page." Keep Shop, Cart, Checkout, My account and Refund and Returns Policy.
- [ ] **Comments:** delete the sample comment. If the shop doesn't need comments anywhere, turn them off under **Settings > Discussion**.
- [ ] **Menus:** remove "Sample Page" and the duplicate Home, Cart and Checkout links from any old menu. The new header has its own navigation, which you can edit under **Appearance > Editor > Navigation**.

## 3. Site basics

- [x] Under **Settings > General**, set the Site Title to "AlmaLinux Shop" and write a one-line tagline.
- [x] Under **Settings > Permalinks**, use **Post name**. The theme's links expect `/shop/`, `/cart/`, `/checkout/`, `/my-account/` and `/refund_returns/`.
- [x] Under **WooCommerce > Settings > Advanced > Page setup**, confirm that Cart, Checkout, My account and Terms and conditions point at the right pages.
- [x] Set the site icon (favicon). Under **Appearance > Editor > Styles**, or the Site Logo block's settings, upload `static/fav/android-chrome-512x512.png` from the almawww repo. **(check: where WordPress 7.1 puts the site icon setting for block themes)**

## 4. Install the theme

- [x] Under **Appearance > Themes**, make sure **Twenty Twenty-Five** is installed. This theme depends on it, so don't delete it.
- [x] Upload `almalinux-shop.zip` (see the README for how to build it).
- [x] Click **Live Preview** and check the home page, a category, a product, the cart and checkout before you click **Activate**.
- [ ] After uploading version 0.2.0 or later, open **Appearance > Editor > Templates**. If anyone has edited the **Front page** template in the Site Editor, use **Reset** on it, or the new design won't show. Do the same for the **Header** and **Footer** template parts if they were edited.
- [x] Once it's active, delete the themes you aren't using (Storefront, Twenty Twenty-Three, Twenty Twenty-Four and so on). Every installed theme is more code to keep patched, even when it's switched off.

## 5. Reconnect Printful

- [ ] In Printful's dashboard (**Stores > Manage my stores**), disconnect the old store connection if it still points at the compromised site.
- [ ] In WordPress, open the Printful plugin and connect the store. Printful creates the WooCommerce API key it needs during this step. Then check **WooCommerce > Settings > Advanced > REST API** and delete any key you don't recognize.
- [ ] Republish the Printful products to the store. Printful's help center says reconnecting means republishing products.
- [ ] Under the Printful plugin's **Settings > Size guide settings**, set the button text, colors and units. Size guides show up automatically on Printful products that have sizing information. For brand consistency, use `#0f4266` for the title and `#24c2ff` for the button.
- [ ] Choose how shipping rates and taxes are calculated (Printful's live rates or WooCommerce's own). **(check: which one the old shop used)**

## 6. Store policies and legal pages

- [ ] Rewrite the WooCommerce draft **Refund and Returns Policy** page to match Printful's returns policy, then publish it. The footer links to it as "Shipping, returns and refunds."
- [ ] Under **WooCommerce > Settings > Accounts & Privacy**, set the privacy policy text shown at checkout and link it to <https://almalinux.org/p/privacy-policy/>, or to a shop-specific page if the store needs one.
- [ ] Decide whether checkout needs a terms checkbox and which page it points to.
- [ ] Turn on guest checkout (**WooCommerce > Settings > Accounts & Privacy**) so nobody has to make an account to buy a sticker.

## 7. Payments

- [ ] Connect the payment gateway the Foundation chooses, using fresh keys.
- [ ] Turn on two-factor authentication on that gateway's dashboard account.
- [ ] Use the gateway's hosted or embedded card fields, so card numbers never touch the shop server.

## 8. Email and analytics

- [ ] Under **WooCommerce > Settings > Emails**, set the base color to `#0f4266` and add the AlmaLinux logo as the header image.
- [ ] Send yourself a test email and check that it isn't flagged as spam.
- [ ] Optional: add Matomo tracking to match almalinux.org. That needs a new site ID in matomo.almalinux.org.

## 9. Test, then launch

- [ ] Place a real test order from your phone and from a desktop browser, and check it all the way through: product page, size guide, cart, checkout, confirmation email, and the order showing up in Printful. Cancel it in Printful before it goes to production.
- [ ] Check one product page, one category and the checkout with a keyboard only (Tab, Shift+Tab, Enter) to confirm focus is visible everywhere.
- [ ] Confirm the **Shop** link in the almalinux.org navbar opens the new shop.
- [ ] Set **Site visibility** to **Live**.
