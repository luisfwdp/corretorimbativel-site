<?php
/** Scoped editorial presentation. Does not change catalogue, checkout or homepage. */
defined( 'ABSPATH' ) || exit;
require CI_THEME_DIR . '/inc/editorial-content.php';

add_action( 'wp_enqueue_scripts', function () {
	if ( ! ci_current_product() ) { return; }
	wp_enqueue_style( 'ci-editorial', CI_THEME_URI . '/assets/css/editorial.css', array( 'ci-main', 'ci-funnel' ), '1.2.0' );
	wp_enqueue_script( 'ci-editorial', CI_THEME_URI . '/assets/js/editorial.js', array( 'ci-main' ), '1.2.0', true );
}, 20 );
add_filter( 'body_class', function ( $classes ) {
	$key = ci_current_product();
	if ( $key ) { $classes[] = 'ci-editorial'; $classes[] = 'ci-edition--' . $key; }
	return $classes;
} );
add_action( 'wp_body_open', function () {
	if ( ci_current_product() ) { echo '<a class="ci-skip" href="#main">Pular para o conteúdo</a>'; }
} );

function ci_editorial_visual( $key, $priority = false ) {
	if ( 'combo' === $key ) {
		echo '<div class="ci-edition-pair">';
		ci_editorial_visual( 'ebook', $priority ); ci_editorial_visual( 'manual-juridico', $priority );
		echo '</div>'; return;
	}
	$p = ci_product( $key );
	echo '<figure class="ci-publication ci-publication--' . esc_attr( $key ) . '">';
	if ( $p['image'] ) {
		$id = attachment_url_to_postid( $p['image'] );
		$attrs = array( 'class' => 'ci-publication__image', 'alt' => $p['name'], 'loading' => $priority ? 'eager' : 'lazy', 'decoding' => 'async' );
		if ( $priority ) { $attrs['fetchpriority'] = 'high'; }
		if ( $id ) {
			echo wp_get_attachment_image( $id, 'large', false, $attrs );
		} else {
			printf( '<img class="ci-publication__image" src="%s" alt="%s" width="960" height="1200" loading="%s" decoding="async"%s>', esc_url( $p['image'] ), esc_attr( $p['name'] ), $priority ? 'eager' : 'lazy', $priority ? ' fetchpriority="high"' : '' );
		}
	} elseif ( 'ebook' === $key ) {
		get_template_part( 'template-parts/mockup' );
	} else {
		// Product identification, not an invented physical mockup or the eBook cover.
		echo '<div class="ci-document-title"><span class="ci-document-title__brand">Corretor Imbatível</span><p>Manual<br>Jurídico</p><span>para Corretores de Imóveis<br>e Imobiliárias</span><span class="ci-document-title__author">Dr. Rodrigo Barbato Fabbris</span></div>';
	}
	echo '<figcaption>' . esc_html( 'ebook' === $key ? 'eBook · Conhecimento jurídico' : 'Manual · Documentação e formalização' ) . '</figcaption></figure>';
}

function ci_editorial_chapters( $key ) {
	echo '<ol class="ci-syllabus">';
	foreach ( ci_editorial_chapter_data( $key ) as $i => $chapter ) {
		printf( '<li><span class="ci-syllabus__number" aria-hidden="true">%02d</span><div><h3>%s</h3><p>%s</p></div></li>', $i + 1, esc_html( $chapter[0] ), esc_html( $chapter[1] ) );
	}
	echo '</ol>';
}

function ci_editorial_pillars() {
	$items = array(
		'Formalização' => 'Colocar os acordos em termos claros, com atenção ao papel de cada pessoa na negociação.',
		'Organização' => 'Manter documentos e informações acessíveis para acompanhar a história de cada atendimento.',
		'Registro' => 'Valorizar propostas, comunicações e demais elementos que ajudam a compreender a intermediação.',
		'Conhecimento' => 'Entender direitos, deveres e limites da profissão para reconhecer o que exige mais cuidado.',
		'Prevenção' => 'Identificar dúvidas antes de assumir compromissos e buscar orientação individualizada quando necessário.',
	);
	echo '<dl class="ci-principles">';
	foreach ( $items as $title => $text ) { printf( '<div><dt>%s</dt><dd>%s</dd></div>', esc_html( $title ), esc_html( $text ) ); }
	echo '</dl>';
}

function ci_editorial_primary( $key, $location ) {
	if ( ci_product( $key )['ready'] ) { ci_checkout_button( $key, $location ); return; }
	// A real in-page navigation while payment configuration is pending, never a fake checkout.
	echo '<a class="ci-btn ci-btn--primary ci-offer-anchor" href="#oferta">CONHECER A OFERTA</a>';
}

function ci_editorial_offer( $key ) {
	$p = ci_product( $key );
	$combo = 'combo' === $key;
	?>
	<section class="ci-section ci-section--dark ci-editorial-offer" id="oferta" aria-labelledby="ci-offer-title">
		<div class="ci-container ci-offer-layout">
			<div class="ci-offer-copy">
				<p class="ci-kicker"><?php echo $combo ? 'Os dois materiais. Uma única compra.' : 'Uma leitura para acompanhar sua atuação.'; ?></p>
				<h2 id="ci-offer-title"><?php echo esc_html( $p['name'] ); ?></h2>
				<p><?php echo esc_html( $p['summary'] ); ?></p>
				<ul class="ci-offer-includes">
					<?php if ( $combo ) : ?><li>eBook Corretor Imbatível</li><li>Manual Jurídico para Corretores de Imóveis e Imobiliárias</li>
					<?php else : ?><li><?php echo 'ebook' === $key ? 'Sete capítulos sobre a atuação jurídica e profissional do corretor' : 'Orientações sobre documentos, contratos, propostas, distratos e intermediação'; ?></li><li>Conteúdo digital com finalidade educacional</li><?php endif; ?>
				</ul>
				<p class="ci-offer-disclaimer">Material educativo. Não substitui orientação jurídica individualizada nem garante resultados em uma negociação.</p>
			</div>
			<div class="ci-offer-decision">
				<?php if ( $combo ) : $total = ci_product( 'ebook' )['price'] + ci_product( 'manual-juridico' )['price']; ?>
					<table class="ci-value-table"><caption>Compare a compra dos materiais</caption><tbody>
						<tr><th scope="row">eBook</th><td><?php echo esc_html( ci_money( ci_product( 'ebook' )['price'] ) ); ?></td></tr>
						<tr><th scope="row">Manual Jurídico</th><td><?php echo esc_html( ci_money( ci_product( 'manual-juridico' )['price'] ) ); ?></td></tr>
						<tr class="ci-value-table__total"><th scope="row">Total separado</th><td><?php echo esc_html( ci_money( $total ) ); ?></td></tr>
					</tbody></table>
				<?php endif; ?>
				<p class="ci-price-label"><?php echo $combo ? 'Combo Completo' : 'Investimento no material'; ?></p>
				<p class="ci-editorial-price"><?php echo esc_html( ci_money( $p['price'] ) ); ?></p>
				<?php if ( $combo && $total > $p['price'] ) : ?><p class="ci-savings">Economia de <?php echo esc_html( ci_money( $total - $p['price'] ) ); ?> em relação aos dois produtos separados.</p><?php endif; ?>
				<?php if ( ci_sales_copy( $p['installment'] ) ) : ?><p><?php echo esc_html( $p['installment'] ); ?></p><?php endif; ?>
				<?php ci_checkout_button( $key, 'oferta' ); ?>
				<p class="ci-decision-note">Confira as condições de pagamento e acesso no checkout da Greenn.</p>
				<?php if ( ci_sales_copy( $p['guarantee'] ) ) : ?><p class="ci-confirmed-guarantee"><?php echo esc_html( $p['guarantee'] ); ?></p><?php endif; ?>
			</div>
		</div>
	</section>
	<?php
}

function ci_editorial_final( $key, $title, $text ) {
	?>
	<section class="ci-section ci-editorial-final" id="cta-final"><div class="ci-container ci-final-layout">
		<div><h2><?php echo esc_html( $title ); ?></h2><p><?php echo esc_html( $text ); ?></p></div>
		<div><?php ci_editorial_primary( $key, 'cta_final' ); ?><p class="ci-decision-note">Conteúdo digital · Finalidade educacional</p></div>
	</div></section>
	<?php
}
