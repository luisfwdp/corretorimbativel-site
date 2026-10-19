<?php
/** Product catalogue and shared sales components. Legacy theme mods remain untouched. */
defined( 'ABSPATH' ) || exit;

function ci_catalogue() {
	return array(
		'ebook' => array( 'name' => 'Corretor Imbatível — Manual Jurídico para Corretores de Imóveis', 'price' => 147, 'cta' => 'QUERO ACESSAR O CORRETOR IMBATÍVEL', 'summary' => 'Conhecimento jurídico aplicado à rotina do corretor de imóveis.' ),
		'manual-juridico' => array( 'name' => 'Manual Jurídico para Corretores de Imóveis e Imobiliárias', 'price' => 97, 'cta' => 'QUERO ACESSAR O MANUAL JURÍDICO', 'summary' => 'Orientações práticas sobre documentos, contratos e cuidados jurídicos nas negociações.' ),
		'combo' => array( 'name' => 'Corretor Imbatível — Combo Completo', 'price' => 197, 'cta' => 'QUERO O COMBO COMPLETO', 'summary' => 'A solução mais completa para quem deseja reunir conhecimento jurídico e materiais de apoio em uma única compra.' ),
		'upsell-manual' => array( 'name' => 'Manual Jurídico — oferta complementar', 'price' => 50, 'cta' => 'SIM, QUERO ADICIONAR O MANUAL', 'summary' => 'Complemente seu eBook com o Manual Jurídico.' ),
		'upsell-ebook' => array( 'name' => 'Corretor Imbatível — oferta complementar', 'price' => 100, 'cta' => 'SIM, QUERO ADICIONAR O EBOOK', 'summary' => 'Complemente seu Manual com o eBook Corretor Imbatível.' ),
	);
}

function ci_product( $key ) {
	$catalogue = ci_catalogue();
	if ( ! isset( $catalogue[ $key ] ) ) { return null; }
	$p = $catalogue[ $key ];
	$card_titles = array( 'ebook' => 'Corretor Imbatível', 'manual-juridico' => 'Manual Jurídico para Corretores e Imobiliárias', 'combo' => 'Corretor Imbatível + Manual Jurídico' );
	$p['card_title'] = get_theme_mod( 'ci_sales_' . $key . '_card_title', $card_titles[ $key ] ?? $p['name'] );
	foreach ( array( 'name', 'price', 'cta', 'summary', 'checkout', 'installment', 'guarantee', 'image', 'decline', 'mode', 'embed' ) as $field ) {
		$p[ $field ] = get_theme_mod( 'ci_sales_' . $key . '_' . $field, $p[ $field ] ?? '' );
	}
	if ( 'ebook' === $key ) {
		$p['name'] = get_theme_mod( 'ci_sales_ebook_name', get_theme_mod( 'ci_product_name', $catalogue['ebook']['name'] ) );
		$p['installment'] = get_theme_mod( 'ci_sales_ebook_installment', ci_sales_copy( get_theme_mod( 'ci_installment', '' ) ) );
		$p['guarantee'] = get_theme_mod( 'ci_sales_ebook_guarantee', ci_sales_copy( get_theme_mod( 'ci_guarantee_text', '' ) ) );
	}
	$p['id'] = $key;
	$p['price'] = ci_sales_price( $p['price'] );
	if ( 'ebook' === $key && ! $p['image'] ) { $p['image'] = get_theme_mod( 'ci_mockup_image', '' ); }
	$p['ready'] = (bool) get_theme_mod( 'ci_sales_' . $key . '_verified', false ) && $p['price'] > 0 && ci_sales_url( $p['checkout'] ) !== '';
	if ( ci_is_upsell( $key ) && 'native' === $p['mode'] ) {
		$p['ready'] = (bool) get_theme_mod( 'ci_sales_' . $key . '_verified', false ) && $p['price'] > 0 && trim( $p['embed'] ) !== '';
	}
	// A supplementary purchase also requires a real completion destination.
	if ( ci_is_upsell( $key ) && ! ci_sales_url( $p['decline'] ) ) { $p['ready'] = false; }
	return $p;
}

function ci_is_upsell( $key ) { return in_array( $key, array( 'upsell-manual', 'upsell-ebook' ), true ); }
function ci_sales_price( $value ) { return max( 0, round( (float) str_replace( ',', '.', (string) $value ), 2 ) ); }
function ci_money( $value ) { return 'R$ ' . number_format( (float) $value, 2, ',', '.' ); }
function ci_sales_url( $value ) {
	$url = esc_url_raw( (string) $value, array( 'https' ) );
	return 'https' === wp_parse_url( $url, PHP_URL_SCHEME ) && wp_parse_url( $url, PHP_URL_HOST ) ? $url : '';
}
function ci_sales_copy( $value ) { return preg_match( '/\[[A-Z_0-9]+\]/', (string) $value ) ? '' : (string) $value; }

function ci_current_product() {
	if ( is_front_page() ) { return ''; }
	foreach ( ci_catalogue() as $key => $unused ) {
		if ( is_page( $key ) || is_page_template( 'page-' . $key . '.php' ) ) { return $key; }
	}
	return '';
}

function ci_checkout_button( $key, $location = 'oferta' ) {
	$p = ci_product( $key );
	if ( ! $p || ! $p['ready'] ) {
		echo '<span class="ci-btn ci-btn--unavailable" role="status">Oferta indisponível no momento</span>';
		return;
	}
	if ( ci_is_upsell( $key ) && 'native' === $p['mode'] ) {
		// Exact official code, saved only by an administrator with unfiltered_html.
		// The provider owns authorization, payment and confirmation. Never rebuild its attributes.
		echo '<div class="ci-greenn-native" data-promotion="' . esc_attr( $key ) . '">';
		echo $p['embed']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- privileged official embed.
		echo '<noscript>Ative o JavaScript para consultar esta oferta na Greenn.</noscript></div>';
		return;
	}
	printf( '<a class="ci-btn ci-btn--primary ci-btn--lg ci-js-cta" href="%s" data-event="click_checkout" data-location="%s" data-checkout="%s">%s</a>', esc_url( ci_sales_url( $p['checkout'] ) ), esc_attr( $location ), esc_attr( $key ), esc_html( $p['cta'] ) );
}

function ci_product_visual( $key ) {
	if ( 'combo' === $key ) {
		echo '<div class="ci-product-pair">'; ci_product_visual( 'ebook' ); ci_product_visual( 'manual-juridico' ); echo '</div>';
		return;
	}
	if ( ci_is_upsell( $key ) ) { $key = 'upsell-manual' === $key ? 'manual-juridico' : 'ebook'; }
	$p = ci_product( $key );
	if ( $p['image'] ) {
		printf( '<img class="ci-mockup-image" src="%s" alt="%s" width="960" height="720" loading="lazy">', esc_url( $p['image'] ), esc_attr( $p['name'] ) );
	} elseif ( 'ebook' === $key ) {
		get_template_part( 'template-parts/mockup' );
	} else {
		// Editorial product identification, never the eBook cover presented as the Manual.
		echo '<div class="ci-product-identity"><p class="ci-eyebrow">DOCUMENTAÇÃO E PREVENÇÃO</p><p class="ci-product-identity__title">Manual Jurídico</p><p>para Corretores de Imóveis e Imobiliárias</p><span>Dr. Rodrigo Barbato Fabbris</span></div>';
	}
}

function ci_sales_offer( $key ) {
	$p = ci_product( $key );
	?>
	<section class="ci-section ci-section--dark ci-section--ruled ci-offer" id="oferta"><div class="ci-container ci-oferta">
		<p class="ci-eyebrow">Sua próxima negociação começa com preparo</p>
		<h2 class="ci-heading ci-heading--light"><?php echo esc_html( $p['name'] ); ?></h2>
		<div class="ci-oferta__mockup"><?php ci_product_visual( $key ); ?></div>
		<p class="ci-lede"><?php echo esc_html( $p['summary'] ); ?></p>
		<?php if ( 'combo' === $key ) :
			$total = ci_product( 'ebook' )['price'] + ci_product( 'manual-juridico' )['price']; ?>
			<dl class="ci-price-comparison"><div><dt>eBook</dt><dd><?php echo esc_html( ci_money( ci_product( 'ebook' )['price'] ) ); ?></dd></div><div><dt>Manual Jurídico</dt><dd><?php echo esc_html( ci_money( ci_product( 'manual-juridico' )['price'] ) ); ?></dd></div><div><dt>Comprando separadamente</dt><dd><?php echo esc_html( ci_money( $total ) ); ?></dd></div></dl>
			<?php if ( $total > $p['price'] ) : ?><p class="ci-savings">Economize <?php echo esc_html( ci_money( $total - $p['price'] ) ); ?> com o combo.</p><?php endif; ?>
		<?php endif; ?>
		<p class="ci-oferta__price-new"><?php echo esc_html( ci_money( $p['price'] ) ); ?></p>
		<?php if ( ci_sales_copy( $p['installment'] ) ) : ?><p><?php echo esc_html( $p['installment'] ); ?></p><?php endif; ?>
		<?php ci_checkout_button( $key ); ?>
		<p class="ci-oferta__microcopy">Conteúdo digital educativo · Pagamento pela Greenn</p>
		<?php if ( ci_sales_copy( $p['guarantee'] ) ) : ?><p><?php echo esc_html( $p['guarantee'] ); ?></p><?php endif; ?>
	</div></section>
	<?php
}

function ci_sales_customize( $wp_customize ) {
	foreach ( ci_catalogue() as $key => $p ) {
		$section = 'ci_sales_' . $key;
		$wp_customize->add_section( $section, array( 'title' => 'Vendas — ' . $p['name'], 'priority' => 15 ) );
		$fields = array( 'name' => 'Nome', 'price' => 'Preço em reais (ex.: 147.00)', 'cta' => 'Texto do CTA', 'summary' => 'Texto da oferta', 'checkout' => 'Checkout HTTPS específico desta oferta', 'verified' => 'Confirmei produto, preço, entrega e fluxo deste checkout', 'installment' => 'Parcelamento confirmado (opcional)', 'guarantee' => 'Garantia confirmada (opcional)' );
		if ( ! ci_is_upsell( $key ) ) {
			$fields['card_title'] = 'Título curto do card na home';
			$card_titles = array( 'ebook' => 'Corretor Imbatível', 'manual-juridico' => 'Manual Jurídico para Corretores e Imobiliárias', 'combo' => 'Corretor Imbatível + Manual Jurídico' );
			$p['card_title'] = $card_titles[ $key ];
		}
		if ( ci_is_upsell( $key ) ) { $fields['decline'] = 'URL HTTPS de conclusão / recusa (fornecida pela Greenn)'; }
		foreach ( $fields as $field => $label ) {
			$id = $section . '_' . $field;
			$type = 'verified' === $field ? 'checkbox' : ( in_array( $field, array( 'checkout', 'decline' ), true ) ? 'url' : 'text' );
			$sanitize = 'checkbox' === $type ? 'rest_sanitize_boolean' : ( 'url' === $type ? 'ci_sales_url' : ( 'price' === $field ? 'ci_sales_price' : 'sanitize_text_field' ) );
			$wp_customize->add_setting( $id, array( 'default' => $p[ $field ] ?? ( 'verified' === $field ? false : '' ), 'sanitize_callback' => $sanitize ) );
			$wp_customize->add_control( $id, array( 'section' => $section, 'label' => $label, 'type' => $type ) );
		}
		if ( ci_is_upsell( $key ) ) {
			$id = $section . '_mode';
			$wp_customize->add_setting( $id, array( 'default' => 'separate', 'sanitize_callback' => 'ci_greenn_mode' ) );
			$wp_customize->add_control( $id, array( 'section' => $section, 'label' => 'Mecanismo da oferta complementar', 'type' => 'select', 'choices' => array( 'separate' => 'Nova compra em checkout separado', 'native' => 'Upsell oficial Greenn (exige código e teste pós-compra)' ) ) );
			if ( current_user_can( 'unfiltered_html' ) ) {
				$id = $section . '_embed';
				$wp_customize->add_setting( $id, array( 'default' => '', 'sanitize_callback' => 'ci_greenn_embed' ) );
				$wp_customize->add_control( $id, array( 'section' => $section, 'label' => 'Código oficial completo: botão + script gerados pela Greenn', 'description' => 'Cole exatamente o código desta oferta. Não altere data-greenn-*. Mantenha o modal de confirmação na Greenn. Teste uma compra antes de marcar a validação.', 'type' => 'textarea' ) );
			}
		}
		if ( in_array( $key, array( 'ebook', 'manual-juridico' ), true ) ) {
			$id = $section . '_image';
			$wp_customize->add_setting( $id, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array( 'section' => $section, 'label' => 'Mockup oficial deste produto' ) ) );
		}
	}
	// This private offer is deliberately never read by any public template or JS.
	$wp_customize->add_setting( 'ci_sales_friends_checkout', array( 'default' => '', 'sanitize_callback' => 'ci_sales_url' ) );
	$wp_customize->add_control( 'ci_sales_friends_checkout', array( 'section' => 'ci_offer', 'label' => 'Checkout privado para amigos — nunca exibido no site', 'type' => 'url' ) );
	$wp_customize->add_setting( 'ci_terms_url', array( 'default' => '', 'sanitize_callback' => 'ci_sales_url' ) );
	$wp_customize->add_control( 'ci_terms_url', array( 'section' => 'ci_offer', 'label' => 'URL dos Termos de Uso (opcional)', 'type' => 'url' ) );
}
add_action( 'customize_register', 'ci_sales_customize' );

function ci_greenn_mode( $value ) { return 'native' === $value ? 'native' : 'separate'; }
function ci_greenn_embed( $value ) {
	return current_user_can( 'unfiltered_html' ) ? (string) $value : null;
}

function ci_sales_tracking_data() {
	$key = ci_current_product(); $p = ci_product( $key );
	return $p ? array( 'id' => $key, 'name' => $p['name'], 'price' => $p['price'], 'promotion' => ci_is_upsell( $key ) ) : null;
}

function ci_sales_seo() {
	$key = ci_current_product();
	$titles = array( 'ebook' => 'Corretor Imbatível | Manual Jurídico para Corretores', 'manual-juridico' => 'Manual Jurídico para Corretores e Imobiliárias', 'combo' => 'Combo Completo Corretor Imbatível', 'upsell-manual' => 'Complemente seu eBook | Corretor Imbatível', 'upsell-ebook' => 'Complemente seu Manual | Corretor Imbatível' );
	$p = ci_product( $key );
	return array( 'title' => $titles[ $key ] ?? 'Corretor Imbatível | Segurança jurídica na corretagem', 'description' => $p ? $p['summary'] : 'Conheça o eBook, o Manual Jurídico e o Combo Completo do Corretor Imbatível e escolha o material ideal para sua atuação profissional.', 'url' => is_front_page() ? home_url( '/' ) : get_permalink(), 'image' => $p ? $p['image'] : get_theme_mod( 'ci_mockup_image', '' ) );
}
add_filter( 'pre_get_document_title', function ( $title ) { return ( is_front_page() || ci_current_product() ) ? ci_sales_seo()['title'] : $title; } );
add_filter( 'wp_robots', function ( $robots ) {
	if ( ci_is_upsell( ci_current_product() ) ) { $robots['noindex'] = true; $robots['nofollow'] = true; unset( $robots['index'], $robots['follow'] ); }
	return $robots;
} );
add_action( 'wp_head', function () {
	if ( ! is_front_page() && ! ci_current_product() ) { return; }
	// Let installed SEO plugins own metadata; configure their fields at deployment.
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) { return; }
	remove_action( 'wp_head', 'rel_canonical' );
	$s = ci_sales_seo();
	printf( '<meta name="description" content="%s"><link rel="canonical" href="%s"><meta property="og:type" content="website"><meta property="og:locale" content="pt_BR"><meta property="og:title" content="%s"><meta property="og:description" content="%s"><meta property="og:url" content="%s">', esc_attr( $s['description'] ), esc_url( $s['url'] ), esc_attr( $s['title'] ), esc_attr( $s['description'] ), esc_url( $s['url'] ) );
	if ( $s['image'] ) { printf( '<meta property="og:image" content="%s">', esc_url( $s['image'] ) ); }
}, 1 );

// Prevent the public WP sitemap from advertising the private offers.
add_filter( 'wp_sitemaps_posts_query_args', function ( $args, $post_type ) {
	if ( 'page' === $post_type ) {
		$ids = get_posts( array( 'post_type' => 'page', 'fields' => 'ids', 'posts_per_page' => -1, 'post_status' => 'publish', 'meta_query' => array( array( 'key' => '_wp_page_template', 'value' => array( 'page-upsell-manual.php', 'page-upsell-ebook.php' ), 'compare' => 'IN' ) ) ) );
		foreach ( array( 'upsell-manual', 'upsell-ebook' ) as $slug ) { $page = get_page_by_path( $slug ); if ( $page ) { $ids[] = $page->ID; } }
		$args['post__not_in'] = array_unique( array_merge( $args['post__not_in'] ?? array(), $ids ) );
	}
	return $args;
}, 10, 2 );
