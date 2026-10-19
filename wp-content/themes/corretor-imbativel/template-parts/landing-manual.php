<?php
/** Independent documentary narrative, based on the scope supplied by the owner. */
defined( 'ABSPATH' ) || exit;
$key = 'manual-juridico'; $product = ci_product( $key );
?>
<main id="main" tabindex="-1">
	<section class="ci-hero ci-manual-hero" id="hero"><div class="ci-container ci-hero__grid">
		<div class="ci-hero__content">
			<p class="ci-kicker">Manual Jurídico · Documentação e formalização</p>
			<h1 class="ci-hero__headline">Uma negociação imobiliária pode começar com um aperto de mão. Mas sua segurança profissional não deveria depender apenas disso.</h1>
			<p class="ci-hero__sub">Conheça o Manual Jurídico para Corretores de Imóveis e Imobiliárias e entenda os cuidados com contratos, propostas, distratos, comissões e registros da intermediação.</p>
			<div class="ci-hero__actions"><?php ci_editorial_primary( $key, 'hero' ); ?><a class="ci-editorial-link" href="#conteudo">Explore os sete temas do Manual</a></div>
			<p class="ci-hero__microcopy"><?php echo esc_html( ci_money( $product['price'] ) ); ?> · Conteúdo digital educativo</p>
		</div>
		<div class="ci-hero__media"><?php ci_editorial_visual( $key, true ); ?></div>
	</div></section>

	<section class="ci-section ci-paper" id="dor"><div class="ci-container ci-split">
		<div class="ci-section-intro"><h2>Quando tudo fica na conversa, o que sustenta a história da negociação?</h2><p class="ci-lede">A confiança aproxima as partes. A documentação ajuda a entender o que foi combinado.</p></div>
		<div class="ci-prose"><p>Você acompanha visitas, esclarece condições e mantém contato com comprador e vendedor. Mas, quando surge uma divergência, pode ser difícil reunir o que aconteceu: uma condição estava no áudio, outra ficou em uma conversa presencial e a versão final da proposta não foi registrada.</p><p>Negociação sem contrato, proposta mal formalizada e documentação dispersa deixam espaço para dúvidas sobre prazos, responsabilidades e comissão. Uma desistência pode tornar ainda mais importante compreender os compromissos assumidos por cada pessoa.</p><p>O cuidado documental começa antes do conflito. Ele faz parte da forma como você organiza e acompanha seu trabalho.</p></div>
	</div></section>

	<section class="ci-section ci-section--dark ci-editorial-statement" id="formalizacao"><div class="ci-container">
		<h2>Formalizar é dar clareza ao que foi combinado.</h2>
		<p class="ci-lede">Quem participa? Qual serviço foi ajustado? Quais condições foram apresentadas? O que mudou durante a conversa?</p>
		<p>Registrar essas informações permite consultar os acordos e acompanhar a evolução do negócio. Isso não torna uma negociação imune a problemas, mas evita depender apenas da memória quando as versões deixam de coincidir.</p>
		<p>Para o corretor, entender a finalidade de cada documento é um passo importante para reconhecer o que deve ser organizado e o que precisa de orientação jurídica específica.</p>
	</div></section>

	<section class="ci-section" id="solucao"><div class="ci-container ci-split ci-split--offset">
		<div class="ci-section-intro"><p class="ci-kicker">Uma referência para sua rotina</p><h2>Conheça o Manual Jurídico.</h2></div>
		<div class="ci-prose"><p>O Manual Jurídico para Corretores de Imóveis e Imobiliárias concentra a atenção nos documentos e nos registros que acompanham a intermediação. A proposta é aproximar o cuidado jurídico de situações concretas da rotina profissional.</p><p>O material aborda contratos, propostas, distratos, comunicação sobre comissão e provas da atuação do corretor. Cada tema ajuda a compreender a função da documentação e os pontos que merecem atenção ao formalizar uma negociação.</p><p>É um produto independente do eBook Corretor Imbatível. Seu foco está na documentação e na formalização, sem prometer que uma leitura substitua a análise individual de um advogado.</p></div>
	</div></section>

	<section class="ci-section ci-paper" id="conteudo"><div class="ci-container ci-syllabus-layout">
		<div class="ci-section-intro"><h2>Da intermediação aos registros: o conteúdo do Manual.</h2><p>Sete temas para compreender por que documentos diferentes cumprem funções diferentes em uma negociação.</p><p class="ci-margin-note">Conhecer a finalidade de um instrumento ajuda a reconhecer os cuidados necessários. A adequação ao caso concreto exige análise profissional.</p></div>
		<?php ci_editorial_chapters( $key ); ?>
	</div></section>

	<section class="ci-section" id="exemplos"><div class="ci-container">
		<div class="ci-section-intro"><h2>Onde esse cuidado aparece no dia a dia.</h2><p class="ci-lede">Cenários ilustrativos para conectar a leitura à rotina, sem prometer resultados para casos concretos.</p></div>
		<div class="ci-scenarios">
			<article><p class="ci-scenario-stage">Antes de começar</p><h3>O proprietário pede que você anuncie o imóvel.</h3><p>Além de combinar a divulgação, é importante entender como registrar o serviço de intermediação e as condições acertadas. O tema do contrato de intermediação ajuda a perceber o valor dessa formalização inicial.</p></article>
			<article><p class="ci-scenario-stage">Durante a negociação</p><h3>O comprador apresenta condições diferentes.</h3><p>Preço, prazos e forma de pagamento mudam ao longo das conversas. O estudo da proposta de compra reforça a atenção ao registro das condições apresentadas, para que as partes possam consultá-las com mais clareza.</p></article>
			<article><p class="ci-scenario-stage">Quando o caminho muda</p><h3>Uma das partes decide não continuar.</h3><p>O encerramento da negociação também pede cuidado. O tema do distrato ajuda a reconhecer a importância de examinar o que foi formalizado e de buscar orientação antes de assumir novas obrigações.</p></article>
		</div>
	</div></section>

	<section class="ci-section ci-section--dark" id="cuidados"><div class="ci-container ci-split">
		<div class="ci-section-intro"><h2>Contrato, proposta e distrato não são a mesma coisa.</h2><p class="ci-lede">Cada documento participa de um momento e responde a uma necessidade.</p></div>
		<div class="ci-prose"><p>A proposta registra condições apresentadas para um negócio. O contrato formaliza compromissos que precisam ser compreendidos pelas partes. O distrato trata do encerramento de uma relação anteriormente estabelecida.</p><p>Tratá-los como formulários intercambiáveis pode fazer com que detalhes relevantes passem despercebidos. O imóvel, as partes, os prazos e as condições negociadas precisam ser considerados antes de adaptar ou utilizar qualquer instrumento.</p><p>O Manual convida você a olhar para a finalidade de cada documento. Diante de dúvidas sobre cláusulas, obrigações ou consequências, procure uma análise jurídica individualizada.</p></div>
	</div></section>

	<section class="ci-section ci-paper" id="comissao"><div class="ci-container ci-documentary-note">
		<div><p class="ci-kicker">Comissão e intermediação</p><h2>Seu trabalho tem uma história. Os registros ajudam a contá-la.</h2></div>
		<div class="ci-prose"><p>Uma visita, uma proposta encaminhada, uma apresentação entre as partes e as comunicações mantidas ao longo do atendimento podem ajudar a compreender a atuação do corretor. Quando esses elementos estão dispersos, reconstruir a sequência dos fatos se torna mais difícil.</p><p>Por isso, a discussão sobre comissão não se resume a lembrar o percentual. Também envolve o serviço ajustado, as circunstâncias da negociação e os registros disponíveis. O Manual aborda a atuação do corretor, as provas da intermediação e a finalidade da notificação extrajudicial de cobrança.</p><p>Documentação não é garantia de recebimento. A existência de um direito e a medida adequada para exercê-lo dependem da análise do caso concreto.</p></div>
	</div></section>

	<section class="ci-section" id="beneficios"><div class="ci-container ci-split">
		<div class="ci-section-intro"><h2>Uma rotina documental organizada muda a forma de acompanhar a negociação.</h2></div>
		<div class="ci-prose"><p>Você passa a dar mais atenção ao que precisa ser formalizado, ao lugar em que os documentos ficam guardados e às informações que devem acompanhar cada etapa do atendimento.</p><p>Esse cuidado facilita a consulta ao histórico da negociação e ajuda a preparar informações mais claras quando é necessário conversar com as partes ou buscar assessoria jurídica.</p><dl class="ci-editorial-benefits"><div><dt>Mais clareza</dt><dd>Reconhecer a finalidade dos documentos e as condições que precisam ser compreendidas.</dd></div><div><dt>Mais organização</dt><dd>Relacionar propostas, comunicações e compromissos a cada negociação.</dd></div><div><dt>Mais atenção preventiva</dt><dd>Perceber dúvidas que merecem análise antes de seguir adiante.</dd></div></dl></div>
	</div></section>

	<?php get_template_part( 'template-parts/authority' ); ?>

	<section class="ci-section ci-paper" id="para-quem"><div class="ci-container ci-split">
		<div class="ci-section-intro"><h2>Para quem quer dar mais atenção à formalização.</h2></div>
		<div class="ci-prose"><p>O Manual é voltado a corretores autônomos, profissionais vinculados a imobiliárias, equipes e gestores que lidam com documentos e condições de negociação em sua rotina.</p><p>Para quem está começando, é uma oportunidade de reconhecer o papel dos principais instrumentos. Para quem já atua, é um convite a revisar como acordos e registros são organizados. Em ambos os casos, a leitura é educativa e não dispensa apoio jurídico para situações específicas.</p></div>
	</div></section>

	<?php ci_editorial_offer( $key ); ?>
	<?php get_template_part( 'template-parts/faq', null, array( 'items' => ci_editorial_faq_data( $key ) ) ); ?>
	<?php ci_editorial_final( $key, 'A próxima conversa pode ser mais bem documentada.', 'Conheça os cuidados com os documentos da corretagem e leve uma perspectiva mais organizada para sua atuação profissional.' ); ?>
</main>
