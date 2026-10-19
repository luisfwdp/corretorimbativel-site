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

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="ci-header">
	<div class="ci-container ci-header__inner">
		<div class="ci-header__logo">
			<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Corretor Imbatível — início"><img src="<?php echo esc_url( CI_THEME_URI . '/assets/images/logo.svg' ); ?>" alt="Corretor Imbatível" width="180" height="54"></a>
			<?php endif; ?>
		</div>
		<?php $ci_key = ci_current_product(); if ( $ci_key && ! ci_is_upsell( $ci_key ) ) : ?>
			<a href="#oferta" class="ci-link-arrow ci-header__offer">Ver oferta ↓</a>
		<?php endif; ?>
	</div>
</header>
