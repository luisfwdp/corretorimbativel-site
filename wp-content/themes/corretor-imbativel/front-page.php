<?php
/**
 * Corretor Imbatível — landing page front-page template.
 *
 * @package Corretor_Imbativel
 */

defined( 'ABSPATH' ) || exit;

get_header();

$eyebrow      = get_theme_mod( 'ci_hero_eyebrow' );
$headline     = get_theme_mod( 'ci_hero_headline' );
$subheadline  = get_theme_mod( 'ci_hero_subheadline' );
$cta_primary  = get_theme_mod( 'ci_cta_primary' );
$price_old    = get_theme_mod( 'ci_price_old' );
$price_new    = get_theme_mod( 'ci_price_new' );
$installment  = get_theme_mod( 'ci_installment' );
$checkout_url = get_theme_mod( 'ci_checkout_url' );
$guarantee    = get_theme_mod( 'ci_guarantee_text' );
$product_name = get_theme_mod( 'ci_product_name' );
$mockup_image = get_theme_mod( 'ci_mockup_image' );
$author_photo = get_theme_mod( 'ci_author_photo' );

$testimonials = ci_parse_pipe_lines( get_theme_mod( 'ci_testimonials', '' ) );
$faq_override = ci_parse_pipe_lines( get_theme_mod( 'ci_faq', '' ) );

$faq_default = array(
	array( 'Para quem é o Corretor Imbatível?', 'Para corretores de imóveis autônomos, profissionais vinculados a imobiliárias, gestores imobiliários e imobiliárias que querem reduzir riscos jurídicos durante negociações imobiliárias.' ),
	array( 'Preciso ter conhecimento jurídico prévio?', 'Não. O conteúdo foi escrito para ser acessível a corretores sem formação jurídica, traduzindo a legislação em orientações práticas para o dia a dia da corretagem.' ),
	array( 'O conteúdo serve para corretores iniciantes?', 'Sim. O material apresenta desde os conceitos fundamentais da profissão até boas práticas avançadas de documentação e prevenção de litígios.' ),
	array( 'Como recebo o produto?', '[FORMA_DE_ENTREGA]' ),
	array( 'O acesso é digital?', '[TIPO_DE_ACESSO]' ),
	array( 'Como funciona o pagamento?', 'O pagamento é processado integralmente pela plataforma de checkout. Formas de pagamento e parcelamento: ' . ( $installment ? esc_html( $installment ) : '[PARCELAMENTO]' ) . '.' ),
	array( 'O eBook substitui uma consulta com advogado?', 'Não. O conteúdo possui finalidade educacional e informativa e não substitui a análise jurídica individualizada de um caso concreto por um advogado.' ),
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
				<div class="ci-hero__actions">
					<a href="#oferta" class="ci-btn ci-btn--primary ci-btn--lg ci-js-cta" data-event="click_checkout" data-location="hero">
						<?php echo esc_html( $cta_primary ); ?>
					</a>
					<a href="#solucao" class="ci-link-arrow">Conheça o conteúdo ↓</a>
				</div>
			</div>
			<div class="ci-hero__media">
				<?php get_template_part( 'template-parts/mockup' ); ?>
			</div>
		</div>
	</section>

	<!-- A DOR -->
	<section class="ci-section" id="dor">
		<div class="ci-container">
			<h2 class="ci-heading">Um negócio mal conduzido pode custar muito mais do que uma comissão.</h2>
			<div class="ci-card-grid">
				<?php foreach ( $dores as $dor ) : ?>
					<div class="ci-card">
						<h3 class="ci-card__title"><?php echo esc_html( $dor[0] ); ?></h3>
						<p class="ci-card__text"><?php echo esc_html( $dor[1] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- IDENTIFICAÇÃO -->
	<section class="ci-section ci-section--dark" id="identificacao">
		<div class="ci-container ci-identificacao">
			<h2 class="ci-heading ci-heading--light">Se você trabalha com imóveis, provavelmente já viveu alguma dessas situações.</h2>
			<ul class="ci-identificacao__list">
				<?php foreach ( $identificacao as $frase ) : ?>
					<li>&ldquo;<?php echo esc_html( $frase ); ?>&rdquo;</li>
				<?php endforeach; ?>
			</ul>
			<p class="ci-identificacao__closing">O Corretor Imbatível nasceu justamente para mudar esse cenário.</p>
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
		</div>
	</section>

	<!-- O QUE VOCÊ VAI APRENDER -->
	<section class="ci-section" id="aprendizado">
		<div class="ci-container">
			<h2 class="ci-heading">O que você vai aprender</h2>
			<div class="ci-card-grid">
				<?php foreach ( $aprendizado as $item ) : ?>
					<div class="ci-card ci-card--accent">
						<h3 class="ci-card__title"><?php echo esc_html( $item[0] ); ?></h3>
						<p class="ci-card__text"><?php echo esc_html( $item[1] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ANTES x DEPOIS -->
	<section class="ci-section ci-section--muted" id="antes-depois">
		<div class="ci-container">
			<h2 class="ci-heading">Antes e depois do Corretor Imbatível</h2>
			<div class="ci-compare">
				<div class="ci-compare__col">
					<h3 class="ci-compare__title ci-compare__title--before">Corretor despreparado</h3>
					<ul>
						<li>Negocia na informalidade.</li>
						<li>Depende de acordos verbais.</li>
						<li>Tem documentação desorganizada.</li>
						<li>Descobre problemas quando já aconteceram.</li>
					</ul>
				</div>
				<div class="ci-compare__col">
					<h3 class="ci-compare__title ci-compare__title--after">Corretor Imbatível</h3>
					<ul>
						<li>Valoriza a formalização.</li>
						<li>Registra sua atuação.</li>
						<li>Entende melhor seus direitos e responsabilidades.</li>
						<li>Trabalha com uma mentalidade preventiva.</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- SOBRE O ESPECIALISTA -->
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
			<h2 class="ci-heading">Para quem é o Corretor Imbatível</h2>
			<p class="ci-lede">Não importa se você está começando agora ou já atua há anos: conhecimento jurídico e organização profissional são ativos que acompanham toda a carreira.</p>
			<div class="ci-card-grid ci-card-grid--5">
				<?php foreach ( $para_quem as $item ) : ?>
					<div class="ci-card">
						<h3 class="ci-card__title"><?php echo esc_html( $item[0] ); ?></h3>
						<p class="ci-card__text"><?php echo esc_html( $item[1] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- PRODUTO -->
	<section class="ci-section" id="produto">
		<div class="ci-container ci-produto">
			<div class="ci-produto__media"><?php get_template_part( 'template-parts/mockup' ); ?></div>
			<div class="ci-produto__content">
				<h2 class="ci-heading"><?php echo esc_html( $product_name ); ?></h2>
				<p class="ci-lede">Conhecimento jurídico aplicado à realidade do corretor de imóveis.</p>
				<ul class="ci-produto__list">
					<li>Introdução à atuação segura do corretor</li>
					<li>O corretor de imóveis: conceito e atuação</li>
					<li>Base jurídica: o que diz a lei</li>
					<li>Corretor angariador x corretor vendedor</li>
					<li>A importância da documentação na intermediação</li>
					<li>Boas práticas na intermediação imobiliária</li>
					<li>Considerações finais e orientação do especialista</li>
				</ul>
			</div>
		</div>
	</section>

	<!-- OFERTA -->
	<section class="ci-section ci-section--dark" id="oferta">
		<div class="ci-container ci-oferta">
			<h2 class="ci-heading ci-heading--light">Você recebe</h2>
			<p class="ci-oferta__product"><?php echo esc_html( $product_name ); ?></p>

			<div class="ci-oferta__price">
				<span class="ci-oferta__price-old"><?php echo esc_html( $price_old ); ?></span>
				<span class="ci-oferta__price-new">por <?php echo esc_html( $price_new ); ?></span>
				<?php if ( $installment && '[PARCELAMENTO]' !== $installment ) : ?>
					<span class="ci-oferta__installment"><?php echo esc_html( $installment ); ?></span>
				<?php endif; ?>
			</div>

			<a href="<?php echo esc_url( $checkout_url ? $checkout_url : '#' ); ?>"
				class="ci-btn ci-btn--primary ci-btn--lg ci-js-cta"
				data-event="click_checkout"
				data-location="oferta"
				target="_blank" rel="noopener">
				<?php echo esc_html( $cta_primary ); ?>
			</a>
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

	<!-- PROVA SOCIAL -->
	<section class="ci-section ci-section--muted" id="prova-social">
		<div class="ci-container">
			<h2 class="ci-heading">O que dizem os corretores</h2>
			<div class="ci-card-grid ci-card-grid--3">
				<?php if ( ! empty( $testimonials ) ) : ?>
					<?php foreach ( $testimonials as $t ) : ?>
						<blockquote class="ci-testimonial">
							<p>&ldquo;<?php echo esc_html( $t[2] ?? '' ); ?>&rdquo;</p>
							<footer>
								<strong><?php echo esc_html( $t[0] ?? '' ); ?></strong>
								<?php if ( ! empty( $t[1] ) ) : ?><span><?php echo esc_html( $t[1] ); ?></span><?php endif; ?>
							</footer>
						</blockquote>
					<?php endforeach; ?>
				<?php else : ?>
					<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
						<blockquote class="ci-testimonial ci-testimonial--placeholder">
							<p>[DEPOIMENTO_0<?php echo esc_html( $i ); ?>]</p>
							<footer><strong>[NOME_DEPOENTE_0<?php echo esc_html( $i ); ?>]</strong></footer>
						</blockquote>
					<?php endfor; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>

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
			<h2 class="ci-heading">Sua próxima negociação pode começar com mais preparo.</h2>
			<p class="ci-lede">Torne conhecimento jurídico e organização profissional parte da sua atuação no mercado imobiliário.</p>
			<a href="#oferta" class="ci-btn ci-btn--primary ci-btn--lg ci-js-cta" data-event="click_checkout" data-location="cta_final">
				<?php echo esc_html( $cta_primary ); ?>
			</a>
		</div>
	</section>

</main>

<?php
get_footer();
