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
			<p class="ci-footer__links">
				<a href="#">Política de Privacidade</a>
				<span aria-hidden="true">&bull;</span>
				<a href="#">Termos de Uso</a>
			</p>
		</div>
	</footer>

	<div class="ci-sticky-cta" id="ci-sticky-cta" aria-hidden="true">
		<a href="#oferta" class="ci-btn ci-btn--primary ci-btn--block ci-js-cta" data-event="click_checkout" data-location="sticky">
			<?php echo esc_html( get_theme_mod( 'ci_cta_sticky', 'QUERO ACESSAR' ) ); ?>
		</a>
	</div>

	<?php wp_footer(); ?>
</body>
</html>
