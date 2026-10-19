<?php
defined( 'ABSPATH' ) || exit;
$key = 'combo'; $product = ci_product( $key );
?>
<main id="main" tabindex="-1">
	<section class="ci-hero ci-combo-hero" id="hero"><div class="ci-container ci-hero__grid">
		<div class="ci-hero__content"><p class="ci-kicker">Combo Completo · A opção mais completa</p>
			<h1 class="ci-hero__headline">Conhecimento jurídico para entender os riscos. Orientação prática para organizar suas negociações. Tudo em um único combo.</h1>
			<p class="ci-hero__sub">O Combo Completo reúne o eBook Corretor Imbatível e o Manual Jurídico para ajudar você a atuar com mais conhecimento, organização e prevenção no mercado imobiliário.</p>
			<div class="ci-hero__actions"><?php ci_editorial_primary( $key, 'hero' ); ?><a class="ci-editorial-link" href="#conteudo">Conheça os dois materiais</a></div>
			<p class="ci-hero__microcopy"><?php echo esc_html( ci_money( $product['price'] ) ); ?> · eBook + Manual Jurídico</p>
		</div><div class="ci-hero__media"><?php ci_editorial_visual( $key, true ); ?></div>
	</div></section>

	<section class="ci-section ci-paper" id="conhecimento-documentacao"><div class="ci-container ci-split">
		<div class="ci-section-intro"><h2>Entender o risco é o começo. Organizar a atuação é o próximo passo.</h2></div>
		<div class="ci-prose"><p>Uma negociação imobiliária combina pessoas, interesses, documentos e compromissos. Conhecer a base jurídica da profissão ajuda a reconhecer o que está em jogo. Dar atenção à documentação ajuda a acompanhar o que foi combinado e o trabalho realizado.</p><p>Esses dois cuidados se complementam. O eBook oferece uma visão da atuação profissional, dos deveres e dos riscos da corretagem. O Manual aproxima essa reflexão dos contratos, propostas, distratos e registros presentes na rotina.</p><p>O Combo reúne os dois produtos em uma única compra, para quem deseja consultar os temas de forma complementar.</p></div>
	</div></section>

	<section class="ci-section" id="dor"><div class="ci-container ci-split">
		<div class="ci-section-intro"><h2>O desafio não está apenas em encontrar o comprador.</h2><p class="ci-lede">Também está em compreender e documentar o caminho até o fechamento.</p></div>
		<div class="ci-prose"><p>Uma comissão pode se tornar motivo de divergência. Uma proposta pode deixar condições em aberto. As partes podem mudar de ideia, ou concluir a negociação sem que o corretor saiba como demonstrar sua participação.</p><p>Somam-se a isso os acordos verbais, a documentação inadequada e os registros dispersos. São situações que pedem preparo para identificar dúvidas, organizar informações e reconhecer quando buscar orientação jurídica.</p><p>O conjunto foi pensado para reunir conhecimento sobre a profissão e atenção aos instrumentos que acompanham a intermediação. A proposta é ampliar seu preparo, sem prometer eliminar riscos.</p></div>
	</div></section>

	<section class="ci-section ci-section--dark" id="conteudo"><div class="ci-container">
		<div class="ci-section-intro"><h2>Dois produtos. Dois focos que se encontram na sua rotina.</h2><p class="ci-lede">Cada material tem uma função própria. Juntos, permitem relacionar a compreensão jurídica com os cuidados documentais.</p></div>
		<div class="ci-two-volumes">
			<article><p class="ci-kicker">Conhecimento jurídico</p><h3>eBook Corretor Imbatível</h3><p>Uma leitura sobre a atividade de corretagem, sua base legal, responsabilidades, comissão e boas práticas. Ajuda você a enxergar a atuação profissional além da apresentação de imóveis.</p><p>Seu ponto de partida para entender direitos, deveres e a importância de uma postura preventiva.</p></article>
			<article><p class="ci-kicker">Orientação documental</p><h3>Manual Jurídico</h3><p>Um material dedicado aos cuidados com contratos, propostas, distratos, comunicação sobre comissão e registros da intermediação.</p><p>Uma forma de olhar com mais atenção para a documentação que participa das diferentes etapas de uma negociação.</p></article>
		</div>
	</div></section>

	<section class="ci-section ci-paper" id="ebook-conteudo"><div class="ci-container ci-syllabus-layout">
		<div class="ci-section-intro"><h2>O que você aprende com o eBook.</h2><p>A visão jurídica e profissional que serve de base para compreender os cuidados da corretagem.</p><div class="ci-volume-aside"><?php ci_editorial_visual( 'ebook' ); ?></div></div>
		<?php ci_editorial_chapters( 'ebook' ); ?>
	</div></section>

	<section class="ci-section" id="manual-conteudo"><div class="ci-container ci-syllabus-layout">
		<div class="ci-section-intro"><h2>O que encontra no Manual Jurídico.</h2><p>O olhar sobre os instrumentos e os registros que ajudam a organizar a intermediação.</p><p class="ci-margin-note">A oferta apresenta os dois materiais de leitura. Não anuncia um pack de documentos editáveis como item incluído.</p></div>
		<?php ci_editorial_chapters( 'manual-juridico' ); ?>
	</div></section>

	<section class="ci-section ci-paper" id="complementaridade"><div class="ci-container">
		<div class="ci-section-intro"><h2>Como uma leitura conversa com a outra.</h2><p class="ci-lede">Você pode aproximar os conceitos da profissão das perguntas que aparecem ao acompanhar uma negociação.</p></div>
		<table class="ci-complement-table" role="table"><caption>Conhecimento e cuidado documental em situações da corretagem</caption><thead role="rowgroup"><tr role="row"><th scope="col" role="columnheader">Situação</th><th scope="col" role="columnheader">O olhar do eBook</th><th scope="col" role="columnheader">O olhar do Manual</th></tr></thead><tbody role="rowgroup">
			<tr role="row"><th scope="row" role="rowheader">Início da intermediação</th><td role="cell"><span class="ci-mobile-column" aria-hidden="true">O olhar do eBook</span>Compreender o papel do corretor e seus limites de atuação.</td><td role="cell"><span class="ci-mobile-column" aria-hidden="true">O olhar do Manual</span>Reconhecer a importância de formalizar o serviço combinado.</td></tr>
			<tr role="row"><th scope="row" role="rowheader">Negociação de condições</th><td role="cell"><span class="ci-mobile-column" aria-hidden="true">O olhar do eBook</span>Relacionar responsabilidade profissional e boas práticas.</td><td role="cell"><span class="ci-mobile-column" aria-hidden="true">O olhar do Manual</span>Dar atenção à proposta e aos compromissos documentados.</td></tr>
			<tr role="row"><th scope="row" role="rowheader">Discussão sobre comissão</th><td role="cell"><span class="ci-mobile-column" aria-hidden="true">O olhar do eBook</span>Entender os pontos jurídicos que podem gerar divergências.</td><td role="cell"><span class="ci-mobile-column" aria-hidden="true">O olhar do Manual</span>Reunir os registros da atuação e compreender a finalidade da comunicação formal.</td></tr>
		</tbody></table>
		<p class="ci-table-note">Exemplos educativos. A análise de direitos e obrigações depende das particularidades de cada caso.</p>
	</div></section>

	<section class="ci-section ci-section--dark" id="mentalidade"><div class="ci-container">
		<div class="ci-section-intro"><p class="ci-kicker">Mentalidade Corretor Imbatível</p><h2>Cinco pilares. Uma postura mais preventiva.</h2><p class="ci-lede">O valor do conjunto também está na forma como você passa a observar e organizar sua atuação.</p></div>
		<?php ci_editorial_pillars(); ?>
	</div></section>

	<section class="ci-section" id="beneficios"><div class="ci-container ci-split">
		<div class="ci-section-intro"><h2>Mais repertório para pensar. Mais atenção para documentar.</h2></div>
		<div class="ci-prose"><p>Com os dois materiais, você reúne em uma compra conteúdos sobre o exercício profissional e sobre os cuidados documentais da intermediação. Pode consultar o tema jurídico e, em seguida, relacioná-lo aos registros e instrumentos envolvidos.</p><p>Isso ajuda a construir um olhar mais atento para propostas, comunicações e responsabilidades. Também permite organizar melhor as dúvidas a levar a um advogado quando a situação exige uma análise específica.</p><p>O benefício é ampliar suas referências de estudo e consulta. O resultado de cada negociação continua dependendo de seus fatos, das partes envolvidas e das condições jurídicas aplicáveis.</p></div>
	</div></section>

	<?php get_template_part( 'template-parts/authority' ); ?>

	<section class="ci-section ci-paper" id="para-quem"><div class="ci-container ci-split">
		<div class="ci-section-intro"><h2>A opção mais completa para quem quer estudar as duas dimensões da profissão.</h2></div>
		<div class="ci-prose"><p>Para corretores iniciantes que desejam uma base de conhecimento e atenção à formalização desde os primeiros atendimentos. Para profissionais experientes que querem revisar sua postura preventiva e sua organização documental.</p><p>Também para equipes e gestores de imobiliárias que buscam referências de leitura sobre a atuação do corretor e os cuidados da intermediação. Se você deseja os dois produtos, o Combo reúne essa escolha em uma única oferta.</p></div>
	</div></section>
	<?php ci_editorial_offer( $key ); ?>
	<?php get_template_part( 'template-parts/faq', null, array( 'items' => ci_editorial_faq_data( $key ) ) ); ?>
	<?php ci_editorial_final( $key, 'Conhecimento e documentação merecem caminhar juntos.', 'Reúna o Corretor Imbatível e o Manual Jurídico para estudar os riscos da profissão e os cuidados com a formalização das negociações.' ); ?>
</main>
