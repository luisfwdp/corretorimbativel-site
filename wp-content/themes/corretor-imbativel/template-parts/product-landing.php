<?php
/** Shared Manual / Combo landing, using the existing editorial design system. */
defined( 'ABSPATH' ) || exit;
$key = $args['product'];
$combo = 'combo' === $key;
$p = ci_product( $key );
$manual_contents = array( 'Contrato de Intermediação Imobiliária', 'Proposta de Compra', 'Contrato Particular de Compra e Venda', 'Distrato Imobiliário', 'Notificação Extrajudicial de Cobrança de Comissão', 'Atuação do Corretor e Provas da Intermediação', 'Considerações Finais' );
$problems = array(
	array( 'Negociação sem contrato', 'Acordos verbais deixam dúvidas sobre o que foi combinado e sobre as responsabilidades das partes.' ),
	array( 'Proposta mal formalizada', 'Condições incompletas podem gerar interpretações diferentes no momento de fechar o negócio.' ),
	array( 'Divergências sobre comissão', 'Percentuais, responsáveis e condições de pagamento precisam de atenção desde o início.' ),
	array( 'Falta de provas da intermediação', 'Registros dispersos dificultam a compreensão do trabalho realizado pelo corretor.' ),
	array( 'Desistência das partes', 'Entender os documentos e as condições da negociação ajuda a identificar os pontos que exigem análise jurídica.' ),
	array( 'Documentação desorganizada', 'Uma rotina de registros permite acompanhar melhor as etapas de cada negociação.' ),
);
$benefits = $combo ? array( 'Compreender direitos, deveres e riscos da atuação profissional.', 'Conectar os conceitos do eBook aos cuidados documentais do Manual.', 'Reunir os dois materiais de consulta em uma única compra.', 'Adotar uma rotina mais organizada, documentada e preventiva.' ) : array( 'Entender a finalidade dos documentos mais comuns na corretagem.', 'Identificar cuidados na formalização de propostas e contratos.', 'Reconhecer a importância dos registros para comprovar a intermediação.', 'Organizar dúvidas e informações antes de buscar assessoria jurídica.' );
$faq = array(
	array( 'Para quem é este material?', 'Para corretores iniciantes ou experientes, profissionais autônomos, equipes e gestores de imobiliárias que desejam compreender os cuidados jurídicos da intermediação.' ),
	array( 'O Manual é o mesmo produto que o eBook?', 'Não. O eBook Corretor Imbatível apresenta o conhecimento jurídico da profissão. O Manual Jurídico é um produto separado, dedicado aos cuidados com documentos e formalização. O Combo reúne os dois.' ),
	array( 'Recebo documentos editáveis?', 'A oferta apresentada nesta página inclui os materiais descritos acima. Não há promessa de pack de documentos editáveis nesta oferta.' ),
	array( 'Como funciona o acesso e o pagamento?', 'O material é digital. Confira no checkout da Greenn as condições de pagamento, entrega e acesso antes de finalizar sua compra.' ),
	array( 'O material substitui uma consulta jurídica?', 'Não. O conteúdo é educativo e informativo. A aplicação a um caso concreto exige análise individualizada por profissional habilitado, sem garantia de resultado jurídico.' ),
);
?>
<main id="main">
	<section class="ci-hero" id="hero"><div class="ci-container ci-hero__grid">
		<div class="ci-hero__content">
			<p class="ci-eyebrow"><?php echo $combo ? 'A SOLUÇÃO COMPLETA PARA CORRETORES DE IMÓVEIS' : 'DOCUMENTAÇÃO E PREVENÇÃO JURÍDICA NA CORRETAGEM'; ?></p>
			<h1 class="ci-hero__headline"><?php echo $combo ? 'Conhecimento jurídico e materiais práticos para você atuar com mais segurança no mercado imobiliário.' : 'Uma negociação segura começa com os documentos certos.'; ?></h1>
			<p class="ci-hero__sub"><?php echo $combo ? 'Reúna o Corretor Imbatível e o Manual Jurídico em um único combo para compreender os riscos da profissão, melhorar sua documentação e adotar uma atuação mais preventiva.' : 'Conheça o Manual Jurídico para Corretores de Imóveis e Imobiliárias e entenda os cuidados essenciais com contratos, propostas, distratos, comissões e registros da intermediação.'; ?></p>
			<p class="ci-hero__credit">Por Dr. Rodrigo Barbato Fabbris</p>
			<div class="ci-hero__actions"><?php ci_checkout_button( $key, 'hero' ); ?><a class="ci-link-arrow" href="#conteudo">Conheça o conteúdo ↓</a></div>
			<p class="ci-hero__microcopy"><?php echo esc_html( ci_money( $p['price'] ) ); ?> · Conteúdo digital educativo</p>
		</div>
		<div class="ci-hero__media"><?php ci_product_visual( $key ); ?></div>
	</div></section>

	<section class="ci-section" id="dor"><div class="ci-container">
		<h2 class="ci-heading">Os cuidados que começam antes do fechamento.</h2>
		<p class="ci-lede">Reconheça situações que pedem mais atenção na sua rotina profissional.</p>
		<ol class="ci-numbered-list"><?php foreach ( $problems as $i => $item ) : ?>
			<li class="ci-numbered-list__item"><span class="ci-numbered-list__number"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span><span class="ci-numbered-list__body"><span class="ci-numbered-list__title"><?php echo esc_html( $item[0] ); ?></span><span class="ci-numbered-list__text"><?php echo esc_html( $item[1] ); ?></span></span></li>
		<?php endforeach; ?></ol>
	</div></section>

	<section class="ci-section ci-section--muted" id="conteudo"><div class="ci-container">
		<h2 class="ci-heading"><?php echo $combo ? 'Do conhecimento à documentação: o que você recebe.' : 'O que o Manual Jurídico aborda'; ?></h2>
		<?php if ( $combo ) : ?>
		<div class="ci-included-grid">
			<article><p class="ci-eyebrow">01 / EBOOK</p><h3>Corretor Imbatível</h3><p>Conteúdo educativo e jurídico sobre a atuação profissional do corretor: base legal, responsabilidades, comissão, documentação e boas práticas.</p><a href="<?php echo esc_url( home_url( '/ebook/' ) ); ?>">Conhecer o eBook →</a></article>
			<article><p class="ci-eyebrow">02 / MANUAL</p><h3>Manual Jurídico</h3><p>Orientações práticas sobre documentos, contratos, comissões e formalização de negociações. Uma fonte de consulta para uma atuação mais preventiva.</p><a href="<?php echo esc_url( home_url( '/manual-juridico/' ) ); ?>">Conhecer o Manual →</a></article>
		</div>
		<h3>Dentro do Manual Jurídico</h3>
		<?php endif; ?>
		<ol class="ci-chapter-list"><?php foreach ( $manual_contents as $i => $title ) : ?><li class="ci-chapter-list__item"><span class="ci-chapter-list__label"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span><span class="ci-chapter-list__title"><?php echo esc_html( $title ); ?></span></li><?php endforeach; ?></ol>
	</div></section>

	<section class="ci-section" id="beneficios"><div class="ci-container">
		<h2 class="ci-heading"><?php echo $combo ? 'Uma base mais completa para sua rotina.' : 'Mais clareza para cuidar de cada etapa.'; ?></h2>
		<ul class="ci-dash-list ci-dash-list--gold"><?php foreach ( $benefits as $benefit ) : ?><li><?php echo esc_html( $benefit ); ?></li><?php endforeach; ?></ul>
		<blockquote class="ci-pullquote ci-pullquote--left">Preparação, organização e informação ajudam a construir uma atuação mais preventiva.</blockquote>
	</div></section>

	<?php if ( $combo ) : ?>
	<section class="ci-section ci-section--dark ci-section--ruled"><div class="ci-container">
		<p class="ci-eyebrow">Mentalidade Corretor Imbatível</p><h2 class="ci-heading ci-heading--light">Cinco pilares para levar à próxima negociação.</h2>
		<ol class="ci-pillars"><?php foreach ( array( 'Formalização', 'Organização', 'Registro', 'Conhecimento', 'Prevenção' ) as $pillar ) : ?><li><?php echo esc_html( $pillar ); ?></li><?php endforeach; ?></ol>
	</div></section>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/authority' ); ?>

	<section class="ci-section ci-section--muted" id="para-quem"><div class="ci-container">
		<h2 class="ci-heading">Para quem quer conduzir negociações com mais preparo.</h2>
		<p class="ci-lede">Corretores iniciantes e experientes, profissionais autônomos, equipes e gestores de imobiliárias que buscam conhecimento jurídico acessível e atenção à documentação.</p>
	</div></section>
	<?php ci_sales_offer( $key ); ?>
	<?php get_template_part( 'template-parts/faq', null, array( 'items' => $faq ) ); ?>
	<section class="ci-section ci-cta-final"><div class="ci-container"><h2 class="ci-heading">Invista no preparo que acompanha sua carreira.</h2><p class="ci-lede">Conheça os cuidados jurídicos da corretagem e consulte seu material na rotina profissional.</p><?php ci_checkout_button( $key, 'cta_final' ); ?></div></section>
</main>
