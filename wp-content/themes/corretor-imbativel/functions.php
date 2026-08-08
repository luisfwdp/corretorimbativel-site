<?php
/**
 * Corretor Imbatível theme bootstrap.
 *
 * @package Corretor_Imbativel
 */

defined( 'ABSPATH' ) || exit;

define( 'CI_THEME_VERSION', '1.0.0' );
define( 'CI_THEME_DIR', get_template_directory() );
define( 'CI_THEME_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function ci_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'primary' => __( 'Menu Principal', 'corretor-imbativel' ),
		)
	);
}
add_action( 'after_setup_theme', 'ci_setup' );

/**
 * Enqueue styles and scripts.
 */
function ci_assets() {
	wp_enqueue_style(
		'ci-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Lato:wght@400;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'ci-main', CI_THEME_URI . '/assets/css/main.css', array(), CI_THEME_VERSION );

	wp_enqueue_script( 'ci-main', CI_THEME_URI . '/assets/js/main.js', array(), CI_THEME_VERSION, true );

	wp_localize_script(
		'ci-main',
		'ciData',
		array(
			'checkoutUrl' => esc_url_raw( get_theme_mod( 'ci_checkout_url', '' ) ),
			'ga4Id'        => esc_js( get_theme_mod( 'ci_ga4_id', '' ) ),
			'metaPixelId'  => esc_js( get_theme_mod( 'ci_meta_pixel_id', '' ) ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'ci_assets' );

/**
 * Preload critical fonts to protect LCP.
 */
function ci_preload_fonts() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'ci_preload_fonts', 1 );

/**
 * Tracking snippets (GA4 / Meta Pixel) — only output when IDs are configured.
 */
function ci_tracking_head() {
	$ga4_id   = get_theme_mod( 'ci_ga4_id', '' );
	$pixel_id = get_theme_mod( 'ci_meta_pixel_id', '' );

	if ( $ga4_id ) {
		?>
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga4_id ); ?>"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', '<?php echo esc_js( $ga4_id ); ?>');
		</script>
		<?php
	}

	if ( $pixel_id ) {
		?>
		<script>
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
			document,'script','https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '<?php echo esc_js( $pixel_id ); ?>');
			fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo esc_attr( $pixel_id ); ?>&ev=PageView&noscript=1" /></noscript>
		<?php
	}
}
add_action( 'wp_head', 'ci_tracking_head', 20 );

require CI_THEME_DIR . '/inc/customizer.php';
