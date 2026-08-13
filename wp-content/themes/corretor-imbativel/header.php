<?php
/**
 * Header — minimal, no navigation, focused on conversion.
 *
 * @package Corretor_Imbativel
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#0F2436">

	<?php
	$meta_description = 'O Corretor Imbatível é o manual jurídico que ensina corretores de imóveis a atuar com mais segurança, documentação e profissionalismo nas negociações imobiliárias.';
	$og_image          = CI_THEME_URI . '/assets/images/og-corretor-imbativel.jpg';
	?>
	<meta name="description" content="<?php echo esc_attr( $meta_description ); ?>">
	<link rel="canonical" href="<?php echo esc_url( home_url( '/' ) ); ?>">

	<meta property="og:type" content="website">
	<meta property="og:title" content="Corretor Imbatível — Segurança jurídica para quem vive do mercado imobiliário">
	<meta property="og:description" content="<?php echo esc_attr( $meta_description ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $og_image ); ?>">
	<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
	<meta property="og:locale" content="pt_BR">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="Corretor Imbatível">
	<meta name="twitter:description" content="<?php echo esc_attr( $meta_description ); ?>">
	<meta name="twitter:image" content="<?php echo esc_url( $og_image ); ?>">

	<script type="application/ld+json">
	<?php
	echo wp_json_encode(
		array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Product',
			'name'        => get_theme_mod( 'ci_product_name', 'Corretor Imbatível' ),
			'description' => $meta_description,
			'brand'       => array(
				'@type' => 'Organization',
				'name'  => 'Corretor Imbatível',
			),
			'offers'      => array(
				'@type'         => 'Offer',
				'url'           => home_url( '/' ),
				'priceCurrency' => 'BRL',
				'availability'  => 'https://schema.org/InStock',
			),
		)
	);
	?>
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="ci-header">
	<div class="ci-container ci-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ci-header__logo" aria-label="Corretor Imbatível — início">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( CI_THEME_URI . '/assets/images/logo.svg' ); ?>" alt="Corretor Imbatível" width="180" height="54">
			<?php endif; ?>
		</a>
		<a href="#oferta" class="ci-btn ci-btn--primary ci-btn--sm ci-js-cta" data-event="click_checkout" data-location="header">
			<?php echo esc_html( get_theme_mod( 'ci_cta_sticky', 'QUERO ACESSAR' ) ); ?>
		</a>
	</div>
</header>
