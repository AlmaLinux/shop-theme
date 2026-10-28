// Screenshots every page in docs/TESTING.md at phone, tablet and desktop widths,
// and records console errors and PHP warnings for each one.
//
// Usage: start the site with `npm run dev`, then in another terminal run
// `npm run screenshots`. Open the index.html it prints to review everything at once.
// Set SHOP_URL to point at a different local site.

import { chromium } from 'playwright';
import { mkdir, writeFile } from 'node:fs/promises';
import path from 'node:path';

const BASE = ( process.env.SHOP_URL || 'http://127.0.0.1:9400' ).replace( /\/$/, '' );
const WIDTHS = [ 390, 768, 1440 ];
// Playground's default admin login.
const ADMIN = { user: 'admin', pass: 'password' };
const PHP_NOTICE = /(Fatal error|Warning|Notice|Deprecated|Parse error):\s/;

const stamp = new Date().toISOString().replace( /[:T]/g, '-' ).slice( 0, 19 );
const outDir = path.join( import.meta.dirname, 'screenshots', stamp );
const results = [];

async function storeApi( route ) {
	const res = await fetch( `${ BASE }/wp-json/wc/store/v1/${ route }` );
	if ( ! res.ok ) {
		throw new Error( `Store API ${ route } returned ${ res.status }. Is npm run dev running?` );
	}
	return res.json();
}

// Find real URLs from the store instead of hardcoding sample-data slugs.
async function discover() {
	const products = await storeApi( 'products?per_page=100' );
	const simple = products.find( ( p ) => p.type === 'simple' && p.images.length && p.is_purchasable );
	const variable = products.find( ( p ) => p.type === 'variable' );
	const category = products.flatMap( ( p ) => p.categories )[ 0 ];
	const tagged = products.find( ( p ) => p.tags.length );
	const attributes = await storeApi( 'products/attributes' );
	const color = attributes.find( ( a ) => a.taxonomy === 'pa_color' );
	const colorTerms = color ? await storeApi( `products/attributes/${ color.id }/terms` ) : [];
	// WordPress redirects this query to the term's archive URL, wherever the permalink settings put it.
	const attributeUrl = colorTerms[ 0 ] ? ( await fetch( `${ BASE }/?taxonomy=pa_color&term=${ colorTerms[ 0 ].slug }` ) ).url : null;
	return {
		simple,
		variable,
		categoryUrl: category?.link,
		tagUrl: tagged?.tags[ 0 ].link,
		attributeUrl,
	};
}

// The cart and checkout blocks show gray placeholders until their data loads.
async function waitForBlocks( page ) {
	await page.waitForFunction( () => ! document.querySelector( '[class*="skeleton"]' ), null, { timeout: 20000 } ).catch( () => {} );
}

async function shoot( page, name, url, { expectStatus = 200 } = {} ) {
	const entry = { name, url, status: null, consoleErrors: [], phpNotices: [], shots: [], error: null };
	results.push( entry );
	if ( ! url ) {
		entry.error = 'No URL found for this page in the test data.';
		console.log( `SKIP  ${ name }: ${ entry.error }` );
		return entry;
	}
	const onConsole = ( msg ) => msg.type() === 'error' && entry.consoleErrors.push( msg.text() );
	const onPageError = ( err ) => entry.consoleErrors.push( err.message );
	page.on( 'console', onConsole );
	page.on( 'pageerror', onPageError );
	try {
		for ( const width of WIDTHS ) {
			await page.setViewportSize( { width, height: 900 } );
			const res = await page.goto( new URL( url, BASE ).href, { waitUntil: 'networkidle', timeout: 60000 } );
			entry.status ??= res?.status() ?? null;
			await waitForBlocks( page );
			const file = `${ name.replace( /[^a-z0-9]+/gi, '-' ).toLowerCase() }-${ width }.png`;
			await page.screenshot( { path: path.join( outDir, file ), fullPage: true } );
			entry.shots.push( { width, file } );
		}
		const text = await page.locator( 'body' ).innerText();
		entry.phpNotices = text.split( '\n' ).filter( ( line ) => PHP_NOTICE.test( line ) );
	} catch ( err ) {
		entry.error = err.message.split( '\n' )[ 0 ];
	}
	page.off( 'console', onConsole );
	page.off( 'pageerror', onPageError );
	entry.consoleErrors = [ ...new Set( entry.consoleErrors ) ];
	if ( expectStatus === 404 ) {
		// Chrome logs the page's own 404 as a console error.
		entry.consoleErrors = entry.consoleErrors.filter( ( e ) => ! e.includes( 'status of 404' ) );
	}
	if ( entry.status !== null && entry.status !== expectStatus ) {
		entry.error ??= `Expected HTTP ${ expectStatus }, got ${ entry.status }.`;
	}
	const problems = entry.error || entry.consoleErrors.length || entry.phpNotices.length;
	console.log( `${ problems ? 'CHECK' : 'OK   ' } ${ name } (${ entry.status ?? 'no response' })` );
	return entry;
}

// Fill in the checkout block and place a Cash on delivery order. Returns the
// order confirmation URL, or null if checkout didn't go through.
async function placeOrder( page ) {
	await page.setViewportSize( { width: 1440, height: 900 } );
	await page.goto( `${ BASE }/checkout/`, { waitUntil: 'networkidle', timeout: 60000 } );
	await waitForBlocks( page );
	// Checkout asks for a shipping address when shipping is set up, and only a billing address when it isn't.
	const form = ( await page.locator( '#shipping-first_name' ).count() ) ? 'shipping' : 'billing';
	await page.locator( '#email' ).fill( 'test@example.com' );
	await page.locator( `#${ form }-first_name` ).fill( 'Test' );
	await page.locator( `#${ form }-last_name` ).fill( 'Shopper' );
	await page.locator( `#${ form }-address_1` ).fill( '100 Test Street' );
	await page.locator( `#${ form }-city` ).fill( 'Raleigh' );
	await page.locator( `#${ form }-state` ).selectOption( 'NC' );
	await page.locator( `#${ form }-postcode` ).fill( '27601' );
	await page.locator( '.wc-block-components-checkout-place-order-button' ).click();
	await page.waitForURL( /order-received/, { timeout: 60000 } );
	return page.url();
}

function indexHtml() {
	const rows = results.map( ( r ) => {
		const notes = [
			r.error && `<li class="bad">Error: ${ escape( r.error ) }</li>`,
			...r.phpNotices.map( ( n ) => `<li class="bad">PHP: ${ escape( n ) }</li>` ),
			...r.consoleErrors.map( ( e ) => `<li class="bad">Console: ${ escape( e ) }</li>` ),
		].filter( Boolean );
		const shots = r.shots
			.map( ( s ) => `<figure><a href="${ s.file }"><img src="${ s.file }" loading="lazy" alt="${ escape( r.name ) } at ${ s.width }px"></a><figcaption>${ s.width }px</figcaption></figure>` )
			.join( '' );
		return `<section><h2>${ escape( r.name ) } <small>${ escape( r.url ?? '' ) } · ${ r.status ?? 'no response' }</small></h2>${ notes.length ? `<ul>${ notes.join( '' ) }</ul>` : '<p class="ok">No errors recorded.</p>' }<div class="shots">${ shots }</div></section>`;
	} );
	return `<!doctype html><meta charset="utf-8"><title>Shop screenshots ${ stamp }</title>
<style>
body{font:15px/1.5 -apple-system,BlinkMacSystemFont,sans-serif;margin:24px;background:#f4f4f4;color:#000518}
section{background:#fff;border-radius:8px;padding:16px;margin:0 0 24px}
h2{margin:0 0 8px;font-size:18px}small{font-weight:400;color:#5b6670}
.shots{display:flex;gap:16px;align-items:flex-start;overflow-x:auto}
figure{margin:0;flex:none}figure img{display:block;border:1px solid #dcd7d7;max-height:600px}
figure:nth-child(1) img{width:195px}figure:nth-child(2) img{width:256px}figure:nth-child(3) img{width:480px}
.bad{color:#b0181b}.ok{color:#2f6b0a}
</style>
<h1>Shop screenshots, ${ stamp }</h1><p>${ escape( BASE ) }. Click a screenshot to open it full size.</p>
${ rows.join( '\n' ) }`;
}

function escape( s ) {
	return String( s ).replace( /[&<>"]/g, ( c ) => ( { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' } )[ c ] );
}

const found = await discover();
await mkdir( outDir, { recursive: true } );
const browser = await chromium.launch();

// Logged-out shopper with an empty cart.
const guest = await browser.newContext();
const page = await guest.newPage();
await shoot( page, 'Shop home', '/' );
await shoot( page, 'All products', '/shop/' );
await shoot( page, 'Category', found.categoryUrl );
await shoot( page, 'Tag', found.tagUrl );
await shoot( page, 'Attribute', found.attributeUrl );
await shoot( page, 'Search with results', '/?s=hoodie&post_type=product' );
await shoot( page, 'Search with no results', '/?s=zzzz&post_type=product' );
await shoot( page, 'Simple product', found.simple?.permalink );
await shoot( page, 'Variable product', found.variable?.permalink );
await shoot( page, 'Cart, empty', '/cart/' );
await shoot( page, 'My account, logged out', '/my-account/' );
await shoot( page, '404', '/does-not-exist/', { expectStatus: 404 } );

// Same shopper, now with something in the cart.
if ( found.simple ) {
	await page.goto( `${ BASE }/?add-to-cart=${ found.simple.id }`, { waitUntil: 'networkidle', timeout: 60000 } );
}
await shoot( page, 'Cart, with items', '/cart/' );
await shoot( page, 'Checkout', '/checkout/' );
let orderUrl = null;
try {
	orderUrl = await placeOrder( page );
} catch ( err ) {
	console.log( `Couldn't place the test order: ${ err.message.split( '\n' )[ 0 ] }` );
}
const confirmation = await shoot( page, 'Order confirmation', orderUrl );
if ( ! orderUrl ) {
	confirmation.error = "The test order didn't go through, so there's no confirmation page. Check the Checkout screenshots.";
}
await guest.close();

// Logged-in admin.
const admin = await browser.newContext();
const adminPage = await admin.newPage();
await adminPage.goto( `${ BASE }/wp-login.php`, { waitUntil: 'networkidle', timeout: 60000 } );
await adminPage.locator( '#user_login' ).fill( ADMIN.user );
await adminPage.locator( '#user_pass' ).fill( ADMIN.pass );
await Promise.all( [ adminPage.waitForURL( /wp-admin/, { timeout: 60000 } ), adminPage.locator( '#wp-submit' ).click() ] );
await shoot( adminPage, 'My account, logged in', '/my-account/' );
await admin.close();

await browser.close();

await writeFile( path.join( outDir, 'report.json' ), JSON.stringify( results, null, '\t' ) );
await writeFile( path.join( outDir, 'index.html' ), indexHtml() );
const flagged = results.filter( ( r ) => r.error || r.consoleErrors.length || r.phpNotices.length ).length;
console.log( `\n${ results.length } pages, ${ flagged } with something to check.` );
console.log( `Review: ${ path.join( outDir, 'index.html' ) }` );
