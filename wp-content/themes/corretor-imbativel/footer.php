<?php
/**
 * Footer — legal disclaimer and closing.
 *
 * @package Corretor_Imbativel
 */

defined( 'ABSPATH' ) || exit;
?>
	<footer class="ci-footer">
		<div class="ci-container ci-footer__inner">
			<p class="ci-footer__brand">Corretor Imbatível</p>
			<p class="ci-footer__disclaimer">
				O conteúdo possui finalidade educacional e informativa e não substitui análise jurídica individualizada de casos concretos.
			</p>
			<p class="ci-footer__copy">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Corretor Imbatível · Barbato Fabbris Advogados Associados. Todos os direitos reservados.
			</p>
			<?php $privacy = get_privacy_policy_url(); $terms = ci_sales_url( get_theme_mod( 'ci_terms_url', '' ) ); ?>
			<?php if ( $privacy || $terms ) : ?><p class="ci-footer__links">
				<?php if ( $privacy ) : ?><a href="<?php echo esc_url( $privacy ); ?>">Política de Privacidade</a><?php endif; ?>
				<?php if ( $terms ) : ?><a href="<?php echo esc_url( $terms ); ?>">Termos de Uso</a><?php endif; ?>
			</p><?php endif; ?>
		</div>
	</footer>

	<?php $ci_key = ci_current_product(); if ( $ci_key && ! ci_is_upsell( $ci_key ) ) : ?>
	<div class="ci-sticky-cta" id="ci-sticky-cta" hidden inert aria-hidden="true">
		<?php ci_checkout_button( $ci_key, 'sticky' ); ?>
	</div>
	<?php endif; ?>

	<?php wp_footer(); ?>
</body>
</html>
