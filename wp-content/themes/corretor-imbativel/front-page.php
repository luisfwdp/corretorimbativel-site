<?php
/**
 * Corretor Imbatível — landing page front-page template.
 *
 * Editorial redesign per LANDING-PAGE-REDESIGN.md: numbered lists instead of
 * card grids, flush-left rhythm, navy/gold rule dividers. WordPress structure,
 * Customizer fields, tracking and checkout are unchanged from the previous
 * version — only markup/classes changed to match the new design system.
 *
 * @package Corretor_Imbativel
 */

defined( 'ABSPATH' ) || exit;

get_header();

$eyebrow      = get_theme_mod( 'ci_hero_eyebrow', 'SEGURANÇA JURÍDICA PARA QUEM VIVE DO MERCADO IMOBILIÁRIO' );
$headline     = get_theme_mod( 'ci_hero_headline', 'Sua próxima comissão pode depender do que você faz antes da negociação dar problema.' );
$subheadline  = get_theme_mod( 'ci_hero_subheadline', 'Conheça os principais riscos jurídicos da profissão e aprenda a conduzir negociações imobiliárias de maneira mais segura, organizada e profissional.' );
$cta_primary  = get_theme_mod( 'ci_cta_primary', 'QUERO SER UM CORRETOR IMBATÍVEL' );
$price_old    = get_theme_mod( 'ci_price_old', 'R$ 397,00' );
$price_new    = get_theme_mod( 'ci_price_new', 'R$ 97,00' );
$installment  = get_theme_mod( 'ci_installment', '[PARCELAMENTO]' );
$checkout_url = get_theme_mod( 'ci_checkout_url', 'https://payfast.greenn.com.br/123089' );
$guarantee    = get_theme_mod( 'ci_guarantee_text', '' );
$product_name = get_theme_mod( 'ci_product_name', 'Corretor Imbatível — Manual Jurídico para Corretores de Imóveis' );
$author_photo = get_theme_mod( 'ci_author_photo', '' );

$testimonials = ci_parse_pipe_lines( get_theme_mod( 'ci_testimonials', '' ) );
$faq_override = ci_parse_pipe_lines( get_theme_mod( 'ci_faq', '' ) );

$faq_default = array(
	array( 'Para quem é o Corretor Imbatível?', 'Para corretores de imóveis autônomos, profissionais vinculados a imobiliárias, gestores imobiliários e imobiliárias que querem reduzir riscos jurídicos durante negociações imobiliárias.' ),
	array( 'Preciso ter conhecimento jurídico prévio?', 'Não. O conteúdo foi escrito para ser acessível a corretores sem formação jurídica, traduzindo a legislação em orientações práticas para o dia a dia da corretagem.' ),
	array( 'O conteúdo serve para corretores iniciantes?', 'Sim. O material apresenta desde os conceitos fundamentais da profissão até boas práticas avançadas de documentação e prevenção de litígios.' ),
	array( 'Como recebo meu acesso?', 'O acesso é enviado por e-mail após a confirmação do pagamento.' ),
	array( 'O conteúdo é digital?', 'Sim, 100% digital — leitura em computador, tablet ou celular.' ),
	array( 'Como funciona o pagamento?', 'O pagamento é processado integralmente pela Greenn. Parcelamento: ' . ( $installment ? esc_html( $installment ) : '[PARCELAMENTO]' ) . '.' ),
	array( 'O Corretor Imbatível substitui uma consulta jurídica?', 'Não. O conteúdo possui finalidade educacional e informativa e não substitui a análise jurídica individualizada de um caso concreto por um advogado.' ),
);

$faq_items = ! empty( $faq_override ) ? $faq_override : $faq_default;

$dores = array(
	array( 'Negociação sem formalização', 'Acordos fechados apenas verbalmente, sem qualquer registro da atuação do corretor.' ),
	array( 'Divergência sobre comissão', 'Discussões sobre percentual, forma de pagamento ou quem tem direito à remuneração.' ),
	array( 'Ausência de provas da intermediação', 'Dificuldade em comprovar que foi o corretor quem aproximou as partes e viabilizou o negócio.' ),
	array( 'Proposta mal estruturada', 'Documentos incompletos que não protegem nem o corretor, nem as partes envolvidas.' ),
	array( 'Desistência das partes', 'Insegurança sobre quais consequências e direitos se aplicam quando o negócio não se conclui.' ),
	array( 'Documentação inadequada', 'Falta de contratos, autorizações e registros que sustentem a atuação profissional.' ),
	array( 'Negociação concluída sem o corretor', 'Comprador e vendedor fecham diretamente, deixando o corretor fora do resultado que ele gerou.' ),
	array( 'Relação mal definida entre as partes', 'Papéis pouco claros entre comprador, vendedor e intermediador ao longo da negociação.' ),
);

$identificacao = array(
	'Você apresentou o comprador, mas depois as partes negociaram diretamente.',
	'Você trabalhou semanas em uma venda e começou uma discussão sobre sua comissão.',
	'Um cliente desistiu e ninguém sabia exatamente quais eram as consequências.',
	'Você percebeu que precisava de um documento, mas não sabia qual utilizar.',
);

$aprendizado = array(
	array( 'Riscos jurídicos da profissão', 'Entenda os principais pontos de atenção na atuação do corretor de imóveis.' ),
	array( 'Segurança na intermediação', 'Aprenda por que formalizar cada etapa da negociação pode ser tão importante.' ),
	array( 'Comissão de corretagem', 'Entenda situações que podem gerar conflitos relacionados à sua remuneração.' ),
	array( 'Documentação', 'Conheça a importância de registrar propostas, visitas, negociações e acordos.' ),
	array( 'Responsabilidade profissional', 'Entenda deveres, responsabilidades e limites da atuação do corretor.' ),
	array( 'Boas práticas', 'Estruture uma atuação mais organizada, ética e profissional no mercado imobiliário.' ),
);

$capitulos = array(
	'Introdução à atuação segura do corretor',
	'O corretor de imóveis: conceito e atuação',
	'Base jurídica: o que diz a lei',
	'Corretor angariador x corretor vendedor',
	'A importância da documentação na intermediação',
	'Boas práticas na intermediação imobiliária',
	'Considerações finais e orientação do especialista',
);

$sem_rotina = array(
	'Acordos verbais',
	'Registros dispersos',
	'Dúvidas sobre documentos',
	'Dificuldade para comprovar atuação',
	'Problemas descobertos tarde demais',
);

$mentalidade_ci = array(
	'Formalização',
	'Organização',
	'Registro',
	'Conhecimento',
	'Prevenção',
);

$para_quem = array(
	array( 'Corretores iniciantes', 'Construa sua carreira já com uma base jurídica sólida.' ),
	array( 'Corretores experientes', 'Reforce e atualize sua atuação com boas práticas documentais.' ),
	array( 'Corretores autônomos', 'Proteja sua comissão e sua atuação sem o respaldo de uma equipe jurídica interna.' ),
	array( 'Equipes imobiliárias', 'Padronize a forma como toda a equipe documenta e conduz negociações.' ),
	array( 'Gestores de imobiliárias', 'Reduza riscos jurídicos e conflitos internos entre corretores.' ),
);
?>

<main id="main">

	<!-- HERO -->
	<section class="ci-hero" id="hero">
		<div class="ci-container ci-hero__grid">
			<div class="ci-hero__content">
				<p class="ci-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
				<h1 class="ci-hero__headline"><?php echo esc_html( $headline ); ?></h1>
				<p class="ci-hero__sub"><?php echo esc_html( $subheadline ); ?></p>
				<p class="ci-hero__credit"><strong>Corretor Imbatível</strong> — conteúdo desenvolvido por Dr. Rodrigo Barbato Fabbris</p>
				<div class="ci-hero__actions">
					<a href="#oferta" class="ci-btn ci-btn--primary ci-btn--lg ci-js-cta" data-event="click_checkout" data-location="hero">
						<?php echo esc_html( $cta_primary ); ?>
					</a>
					<a href="#solucao" class="ci-link-arrow">Conheça o conteúdo ↓</a>
				</div>
				<p class="ci-hero__microcopy">Acesso digital &bull; Compra segura</p>
			</div>
			<div class="ci-hero__media">
				<svg class="ci-hero__blueprint" viewBox="0 0 400 480" aria-hidden="true" focusable="false">
					<rect x="20" y="20" width="360" height="440" fill="none" stroke="currentColor" stroke-width="1"/>
					<line x1="20" y1="120" x2="380" y2="120" stroke="currentColor" stroke-width="1"/>
					<line x1="200" y1="20" x2="200" y2="460" stroke="currentColor" stroke-width="1"/>
					<circle cx="200" cy="240" r="90" fill="none" stroke="currentColor" stroke-width="1"/>
				</svg>
				<?php get_template_part( 'template-parts/mockup' ); ?>
			</div>
		</div>
	</section>

	<!-- CREDIBILITY BAR -->
	<div class="ci-credibility">
		<div class="ci-container ci-credibility__inner">
			<span>Direito Imobiliário</span>
			<span>Mercado Imobiliário</span>
			<span>Prevenção Jurídica</span>
			<span>Boas Práticas</span>
			<span>Documentação</span>
		</div>
	</div>

	<!-- PROBLEMA -->
	<section class="ci-section" id="dor">
		<div class="ci-container">
			<h2 class="ci-heading">O problema não começa quando chega o processo.</h2>
			<p class="ci-lede">Na maioria das vezes, ele começa muito antes: quando uma negociação importante é conduzida sem a formalização adequada.</p>

			<ol class="ci-numbered-list">
				<?php foreach ( $dores as $i => $dor ) : ?>
					<li class="ci-numbered-list__item">
						<span class="ci-numbered-list__number"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<span class="ci-numbered-list__body">
							<span class="ci-numbered-list__title"><?php echo esc_html( $dor[0] ); ?></span>
							<span class="ci-numbered-list__text"><?php echo esc_html( $dor[1] ); ?></span>
						</span>
					</li>
				<?php endforeach; ?>
			</ol>

			<blockquote class="ci-pullquote">Uma negociação mal conduzida pode custar muito mais do que uma comissão.</blockquote>
		</div>
	</section>

	<!-- IDENTIFICAÇÃO -->
	<section class="ci-section ci-section--dark ci-section--ruled" id="identificacao">
		<div class="ci-container ci-identificacao">
			<h2 class="ci-heading ci-heading--light">Isso já aconteceu com você?</h2>
			<ul class="ci-identificacao__list">
				<?php foreach ( $identificacao as $frase ) : ?>
					<li>&ldquo;<?php echo esc_html( $frase ); ?>&rdquo;</li>
				<?php endforeach; ?>
			</ul>
			<p class="ci-identificacao__closing">É justamente nesse espaço entre a venda e a segurança jurídica que nasce o Corretor Imbatível.</p>
			<a href="#solucao" class="ci-btn ci-btn--outline-gold">Quero conhecer a solução</a>
		</div>
	</section>

	<!-- SOLUÇÃO -->
	<section class="ci-section" id="solucao">
		<div class="ci-container ci-solucao">
			<h2 class="ci-heading">Conheça o Corretor Imbatível.</h2>
			<p class="ci-lede">
				O Corretor Imbatível reúne conhecimento jurídico aplicado à realidade do corretor de imóveis, ajudando o profissional a atuar de maneira mais organizada, documentada, segura e profissional em cada etapa da negociação — da captação até a assinatura do contrato.
			</p>
			<p class="ci-lede">
				O material não promete imunidade jurídica: ele ajuda você a reduzir riscos, aumentar sua segurança e adotar práticas preventivas reconhecidas pela legislação e pela jurisprudência.
			</p>
			<blockquote class="ci-pullquote ci-pullquote--left">Venda é consequência. Preparação vem antes.</blockquote>
		</div>
	</section>

	<!-- O QUE VOCÊ VAI APRENDER -->
	<section class="ci-section ci-section--muted" id="aprendizado">
		<div class="ci-container">
			<h2 class="ci-heading">O que você vai aprender</h2>

			<ol class="ci-numbered-list">
				<?php foreach ( $aprendizado as $i => $item ) : ?>
					<li class="ci-numbered-list__item">
						<span class="ci-numbered-list__number"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<span class="ci-numbered-list__body">
							<span class="ci-numbered-list__title"><?php echo esc_html( $item[0] ); ?></span>
							<span class="ci-numbered-list__text"><?php echo esc_html( $item[1] ); ?></span>
						</span>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<!-- CONTEÚDO DO EBOOK -->
	<section class="ci-section" id="conteudo">
		<div class="ci-container ci-ebook-content">
			<div class="ci-ebook-content__media"><?php get_template_part( 'template-parts/mockup' ); ?></div>
			<div class="ci-ebook-content__body">
				<h2 class="ci-heading">Dentro do Corretor Imbatível</h2>
				<p class="ci-lede">Conhecimento jurídico aplicado à realidade do corretor de imóveis.</p>
				<ol class="ci-chapter-list">
					<?php foreach ( $capitulos as $i => $capitulo ) : ?>
						<li class="ci-chapter-list__item">
							<span class="ci-chapter-list__label">Capítulo <?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<span class="ci-chapter-list__title"><?php echo esc_html( $capitulo ); ?></span>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</div>
	</section>

	<!-- TRANSFORMAÇÃO -->
	<section class="ci-section ci-section--muted" id="transformacao">
		<div class="ci-container">
			<h2 class="ci-heading">O que muda quando você começa a tratar sua atuação como um negócio profissional?</h2>
			<div class="ci-transformation">
				<div class="ci-transformation__col">
					<h3 class="ci-transformation__title ci-transformation__title--before">Sem uma rotina preventiva</h3>
					<ul class="ci-dash-list">
						<?php foreach ( $sem_rotina as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="ci-transformation__col">
					<h3 class="ci-transformation__title ci-transformation__title--after">Mentalidade Corretor Imbatível</h3>
					<ul class="ci-dash-list ci-dash-list--gold">
						<?php foreach ( $mentalidade_ci as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<blockquote class="ci-pullquote ci-pullquote--left">Não se trata de eliminar todos os riscos. Trata-se de estar muito mais preparado para eles.</blockquote>
		</div>
	</section>

	<!-- AUTORIDADE -->
	<section class="ci-section" id="especialista">
		<div class="ci-container ci-especialista">
			<div class="ci-especialista__photo">
				<?php if ( $author_photo ) : ?>
					<img src="<?php echo esc_url( $author_photo ); ?>" alt="Dr. Rodrigo Barbato Fabbris" loading="lazy" width="480" height="600">
				<?php else : ?>
					<div class="ci-image-placeholder" role="img" aria-label="Foto do Dr. Rodrigo Barbato Fabbris">[FOTO_RODRIGO_FABBRIS]</div>
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

	<!-- PARA QUEM É -->
	<section class="ci-section ci-section--muted" id="para-quem">
		<div class="ci-container">
			<h2 class="ci-heading">O Corretor Imbatível foi feito para quem quer levar a profissão a sério.</h2>
			<div class="ci-audience-grid">
				<?php foreach ( $para_quem as $item ) : ?>
					<div class="ci-audience-grid__item">
						<h3 class="ci-audience-grid__title"><?php echo esc_html( $item[0] ); ?></h3>
						<p class="ci-audience-grid__text"><?php echo esc_html( $item[1] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- OFERTA -->
	<section class="ci-section ci-section--dark ci-section--ruled ci-offer" id="oferta">
		<div class="ci-container ci-oferta">
			<h2 class="ci-heading ci-heading--light">Tenha o Corretor Imbatível ao seu lado na sua próxima negociação.</h2>

			<div class="ci-oferta__mockup"><?php get_template_part( 'template-parts/mockup' ); ?></div>

			<p class="ci-eyebrow">Você recebe</p>
			<p class="ci-oferta__product"><?php echo esc_html( $product_name ); ?></p>

			<div class="ci-oferta__price">
				<span class="ci-oferta__price-old"><?php echo esc_html( $price_old ); ?></span>
				<span class="ci-oferta__price-new">por <?php echo esc_html( $price_new ); ?></span>
				<span class="ci-oferta__installment">ou em até <?php echo esc_html( $installment ? $installment : '[PARCELAMENTO]' ); ?> no cartão</span>
			</div>

			<a href="<?php echo esc_url( $checkout_url ? $checkout_url : '#' ); ?>"
				class="ci-btn ci-btn--primary ci-btn--lg ci-js-cta"
				data-event="click_checkout"
				data-location="oferta"
				target="_blank" rel="noopener">
				QUERO ACESSAR AGORA
			</a>

			<p class="ci-oferta__microcopy">Pagamento processado pela Greenn &bull; Acesso digital &bull; Compra segura</p>
		</div>
	</section>

	<?php if ( $guarantee ) : ?>
	<!-- GARANTIA -->
	<section class="ci-section" id="garantia">
		<div class="ci-container ci-garantia">
			<h2 class="ci-heading">Garantia</h2>
			<p class="ci-lede"><?php echo esc_html( $guarantee ); ?></p>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( ! empty( $testimonials ) ) : ?>
	<!-- PROVA SOCIAL — só renderiza quando há depoimentos reais configurados -->
	<section class="ci-section ci-section--muted" id="prova-social">
		<div class="ci-container">
			<h2 class="ci-heading">O que dizem os corretores</h2>
			<div class="ci-testimonial-grid">
				<?php foreach ( $testimonials as $t ) : ?>
					<blockquote class="ci-testimonial">
						<p>&ldquo;<?php echo esc_html( $t[2] ?? '' ); ?>&rdquo;</p>
						<footer>
							<strong><?php echo esc_html( $t[0] ?? '' ); ?></strong>
							<?php if ( ! empty( $t[1] ) ) : ?><span><?php echo esc_html( $t[1] ); ?></span><?php endif; ?>
						</footer>
					</blockquote>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- FAQ -->
	<section class="ci-section" id="faq">
		<div class="ci-container ci-faq">
			<h2 class="ci-heading">Perguntas frequentes</h2>
			<div class="ci-faq__list">
				<?php foreach ( $faq_items as $i => $item ) : ?>
					<div class="ci-faq__item">
						<button class="ci-faq__question ci-js-faq" aria-expanded="false" aria-controls="faq-answer-<?php echo esc_attr( $i ); ?>">
							<?php echo esc_html( $item[0] ?? '' ); ?>
							<span class="ci-faq__icon" aria-hidden="true">+</span>
						</button>
						<div class="ci-faq__answer" id="faq-answer-<?php echo esc_attr( $i ); ?>">
							<p><?php echo esc_html( $item[1] ?? '' ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- CTA FINAL -->
	<section class="ci-section ci-cta-final" id="cta-final">
		<div class="ci-container">
			<h2 class="ci-heading">A próxima negociação começa antes do primeiro &ldquo;sim&rdquo;.</h2>
			<p class="ci-lede">Comece com mais conhecimento, organização e segurança para conduzir cada etapa da sua atuação profissional.</p>
			<a href="#oferta" class="ci-btn ci-btn--primary ci-btn--lg ci-js-cta" data-event="click_checkout" data-location="cta_final">
				<?php echo esc_html( $cta_primary ); ?>
			</a>
			<div class="ci-cta-final__mockup"><?php get_template_part( 'template-parts/mockup' ); ?></div>
		</div>
	</section>

</main>

<?php
get_footer();
