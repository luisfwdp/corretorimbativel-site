<?php
/** wp eval-file tests/wordpress.php — isolated local WordPress only. */
if ( ! defined( 'WP_CLI' ) || ! WP_CLI || ! preg_match( '~^http://(127\.0\.0\.1|localhost):[0-9]+$~', home_url() ) ) { exit( 'Use apenas WordPress local isolado.' ); }
$saved = get_theme_mods();
$user = get_current_user_id();
function ci_assert( $condition, $message ) { if ( ! $condition ) { throw new RuntimeException( $message ); } }
try {
	foreach ( ci_catalogue() as $key => $default ) {
		foreach ( array( 'price', 'checkout', 'verified', 'mode', 'embed', 'decline' ) as $field ) { remove_theme_mod( 'ci_sales_' . $key . '_' . $field ); }
	}
	set_theme_mod( 'ci_price_new', 'R$ 97,00' );
	set_theme_mod( 'ci_checkout_url', 'https://payfast.greenn.com.br/123089' );
	ci_assert( 147.0 === ci_product( 'ebook' )['price'], 'Legacy promotional price must not override eBook public price' );
	ci_assert( ! ci_product( 'ebook' )['ready'], 'Legacy checkout must not enable new public offer' );
	ci_assert( 244.0 === ci_product( 'ebook' )['price'] + ci_product( 'manual-juridico' )['price'], 'Separate total' );
	ci_assert( 197.0 === ci_product( 'combo' )['price'], 'Combo price' );
	ci_assert( 197.0 === ci_product( 'ebook' )['price'] + ci_product( 'upsell-manual' )['price'], 'eBook journey' );
	ci_assert( 197.0 === ci_product( 'manual-juridico' )['price'] + ci_product( 'upsell-ebook' )['price'], 'Manual journey' );
	ci_assert( '' === ci_sales_url( 'javascript:alert(1)' ) && '' === ci_sales_url( 'http://example.invalid' ), 'Reject unsafe checkout protocols' );
	set_theme_mod( 'ci_sales_ebook_checkout', 'https://example.invalid/test-ebook' );
	ci_assert( ! ci_product( 'ebook' )['ready'], 'Configured but unreviewed checkout must remain disabled' );
	set_theme_mod( 'ci_sales_ebook_verified', true );
	ci_assert( ci_product( 'ebook' )['ready'], 'Reviewed HTTPS checkout' );
	set_theme_mod( 'ci_sales_ebook_price', 0 );
	ci_assert( ! ci_product( 'ebook' )['ready'], 'Invalid price must disable purchase' );
	set_theme_mod( 'ci_sales_upsell-manual_checkout', 'https://example.invalid/test-manual-complement' );
	set_theme_mod( 'ci_sales_upsell-manual_verified', true );
	ci_assert( ! ci_product( 'upsell-manual' )['ready'], 'Upsell requires conclusion destination' );
	set_theme_mod( 'ci_sales_upsell-manual_decline', 'https://example.invalid/completion' );
	ci_assert( ci_product( 'upsell-manual' )['ready'], 'Separate checkout with decline' );
	set_theme_mod( 'ci_sales_upsell-manual_mode', 'native' );
	ci_assert( ! ci_product( 'upsell-manual' )['ready'], 'Native mode requires exact generated code' );
	// Rendering fixture only. This is not a real Greenn code or financial test.
	$fixture = '<button data-greenn-upsell="fixture-only">Fixture</button>';
	set_theme_mod( 'ci_sales_upsell-manual_embed', $fixture );
	set_theme_mod( 'ci_sales_upsell-manual_checkout', '' );
	ob_start(); ci_checkout_button( 'upsell-manual' ); $html = ob_get_clean();
	ci_assert( false !== strpos( $html, $fixture ), 'Native code must remain byte-for-byte intact' );
	wp_set_current_user( 0 );
	ci_assert( null === ci_greenn_embed( '<script>test()</script>' ), 'Unprivileged users cannot save executable embed' );
	wp_set_current_user( 1 );
	ci_assert( $fixture === ci_greenn_embed( $fixture ), 'Privileged administrator can save exact provider code' );
	foreach ( ci_catalogue() as $key => $unused ) {
		$page = get_page_by_path( $key );
		ci_assert( $page && 'page-' . $key . '.php' === get_post_meta( $page->ID, '_wp_page_template', true ), 'Page/template registration: ' . $key );
		ci_assert( count( get_posts( array( 'post_type' => 'page', 'name' => $key, 'post_status' => 'any', 'posts_per_page' => -1 ) ) ) === 1, 'Idempotent registration: ' . $key );
	}
	WP_CLI::success( 'Catalogue, legacy isolation, totals, HTTPS validation, checkout gates, upsell modes, embed permission and page registration passed.' );
} finally {
	foreach ( get_theme_mods() as $key => $unused ) { remove_theme_mod( $key ); }
	foreach ( $saved as $key => $value ) { set_theme_mod( $key, $value ); }
	wp_set_current_user( $user );
}
