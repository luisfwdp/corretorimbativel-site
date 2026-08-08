<?php
/**
 * Product mockup: uses the uploaded image when available, falls back to a
 * lightweight CSS 3D mockup so the hero never ships broken/empty.
 *
 * @package Corretor_Imbativel
 */

defined( 'ABSPATH' ) || exit;

$mockup_image = get_theme_mod( 'ci_mockup_image' );
$product_name = get_theme_mod( 'ci_product_name', 'Corretor Imbatível' );
?>
<?php if ( $mockup_image ) : ?>
	<img
		src="<?php echo esc_url( $mockup_image ); ?>"
		alt="Mockup do eBook <?php echo esc_attr( $product_name ); ?>"
		class="ci-mockup-image"
		loading="lazy"
		width="960"
		height="720"
	>
<?php else : ?>
	<div class="ci-mockup-css" aria-label="Mockup do eBook Corretor Imbatível" role="img">
		<div class="ci-mockup-css__book">
			<span class="ci-mockup-css__badge">
				<svg width="28" height="32" viewBox="0 0 28 32" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M14 0L27 5V15C27 23 21.6 29.6 14 32C6.4 29.6 1 23 1 15V5L14 0Z" fill="#C9A227"/>
					<path d="M14 3L24 6.7V15C24 21.3 19.9 26.6 14 28.7C8.1 26.6 4 21.3 4 15V6.7L14 3Z" fill="#0F2436"/>
				</svg>
			</span>
			<p class="ci-mockup-css__title">CORRETOR<br>IMBATÍVEL</p>
			<p class="ci-mockup-css__subtitle">Manual Jurídico para<br>Corretores de Imóveis</p>
			<p class="ci-mockup-css__author">Dr. Rodrigo Barbato Fabbris</p>
		</div>
		<div class="ci-mockup-css__tablet">
			<div class="ci-mockup-css__tablet-screen">
				<span class="ci-mockup-css__badge ci-mockup-css__badge--sm">
					<svg width="18" height="20" viewBox="0 0 28 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M14 0L27 5V15C27 23 21.6 29.6 14 32C6.4 29.6 1 23 1 15V5L14 0Z" fill="#C9A227"/>
						<path d="M14 3L24 6.7V15C24 21.3 19.9 26.6 14 28.7C8.1 26.6 4 21.3 4 15V6.7L14 3Z" fill="#0F2436"/>
					</svg>
				</span>
				<p class="ci-mockup-css__title ci-mockup-css__title--sm">CORRETOR<br>IMBATÍVEL</p>
			</div>
		</div>
	</div>
<?php endif; ?>
