<?php
defined( 'ABSPATH' ) || exit;
$key = $args['product'];
$manual = 'upsell-manual' === $key;
$p = ci_product( $key );
$base = ci_product( $manual ? 'ebook' : 'manual-juridico' );
?>
<main id="main">
	<section class="ci-hero ci-upsell" id="hero"><div class="ci-container ci-hero__grid">
		<div class="ci-hero__content">
			<p class="ci-eyebrow">UMA OFERTA PARA COMPLEMENTAR SEU MATERIAL</p>
			<h1 class="ci-hero__headline"><?php echo $manual ? 'Seu conhecimento jurídico acaba de ganhar um complemento prático.' : 'Você já tem o material prático. Agora fortaleça também seu conhecimento jurídico.'; ?></h1>
			<p class="ci-hero__sub"><?php echo $manual ? 'Você já garantiu o Corretor Imbatível. Agora pode complementar seu material com orientações práticas sobre contratos, propostas, distratos e documentação da intermediação.' : 'Complemente o Manual Jurídico com o eBook Corretor Imbatível e tenha uma visão mais ampla dos direitos, responsabilidades, riscos e boas práticas da corretagem imobiliária.'; ?></p>
			<p class="ci-upsell__price">Adicione <?php echo $manual ? 'o Manual' : 'o eBook'; ?> por <span class="ci-amount"><?php echo esc_html( ci_money( $p['price'] ) ); ?></span></p>
			<p>Compra inicial de <?php echo esc_html( ci_money( $base['price'] ) ); ?> + complemento de <?php echo esc_html( ci_money( $p['price'] ) ); ?> = <?php echo esc_html( ci_money( $base['price'] + $p['price'] ) ); ?> no total.</p>
			<?php if ( 'native' === $p['mode'] ) : ?>
				<p class="ci-purchase-notice">Esta oferta adiciona uma compra à sua jornada. Confira o valor e confirme o pagamento na etapa exibida pela Greenn.</p>
			<?php else : ?>
				<p class="ci-purchase-notice">Esta oferta é uma nova compra, em checkout separado. Ao continuar, você revisará o valor e autorizará o pagamento. Nenhuma cobrança é feita ao visitar esta página.</p>
			<?php endif; ?>
			<?php ci_checkout_button( $key, 'upsell' ); ?>
			<?php if ( ci_sales_url( $p['decline'] ) ) : ?>
				<a class="ci-decline" href="<?php echo esc_url( ci_sales_url( $p['decline'] ) ); ?>"><?php echo $manual ? 'NÃO, OBRIGADO. QUERO CONTINUAR APENAS COM O EBOOK.' : 'NÃO, OBRIGADO. QUERO CONTINUAR APENAS COM O MANUAL.'; ?></a>
			<?php else : ?>
				<p class="ci-decline">Você pode fechar esta página e consultar as instruções da sua compra inicial.</p>
			<?php endif; ?>
		</div>
		<div class="ci-hero__media"><?php ci_product_visual( $key ); ?></div>
	</div></section>
</main>
