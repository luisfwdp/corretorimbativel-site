<?php
defined( 'ABSPATH' ) || exit;
$author_photo = get_theme_mod( 'ci_author_photo', '' );
?>
	<!-- AUTORIDADE -->
	<section class="ci-section" id="especialista">
		<div class="ci-container ci-especialista">
			<div class="ci-especialista__photo">
				<?php if ( $author_photo ) : ?>
					<img src="<?php echo esc_url( $author_photo ); ?>" alt="Dr. Rodrigo Barbato Fabbris" loading="lazy" width="480" height="600">
				<?php else : ?>
					<div class="ci-author-monogram" aria-hidden="true">RF</div>
				<?php endif; ?>
			</div>
			<div class="ci-especialista__content">
				<p class="ci-eyebrow">Quem assina o conteúdo jurídico</p>
				<h2 class="ci-heading">Dr. Rodrigo Barbato Fabbris</h2>
				<p class="ci-lede">
					Advogado, corretor de imóveis e sócio fundador da Barbato Fabbris Advogados Associados, com mais de 15 anos de experiência em Direito Civil, Imobiliário e Empresarial — atuando em assessoria contratual, contencioso cível e estruturação jurídica de operações imobiliárias.
				</p>
				<ul class="ci-especialista__credentials">
					<li>Graduado em Direito pela PUC/PR (2006)</li>
					<li>Especialista em Direito Imobiliário aplicado à gestão empresarial — PUC/PR</li>
					<li>Pós-graduado em Direito Empresarial pelo Instituto Legale</li>
					<li>MBA em Gestão Empresarial pela FGV</li>
					<li>Técnico em Transações Imobiliárias — Corretor de Imóveis registrado no CRECI/PR</li>
					<li>Membro da Comissão de Direito Imobiliário e da Construção da OAB/PR</li>
				</ul>
			</div>
		</div>
	</section>

