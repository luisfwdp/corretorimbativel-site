<?php
/**
 * Customizer: every field a non-developer needs to edit the offer, copy and tracking.
 *
 * @package Corretor_Imbativel
 */

defined( 'ABSPATH' ) || exit;

function ci_customize_register( $wp_customize ) {

	/* ---------------------------------------------------------------------
	 * PRODUCT / OFFER
	 * ------------------------------------------------------------------- */
	$wp_customize->add_section(
		'ci_offer',
		array(
			'title'    => __( 'Corretor Imbatível — Oferta', 'corretor-imbativel' ),
			'priority' => 10,
		)
	);

	$offer_fields = array(
		'ci_product_name'   => array( 'label' => 'Nome do produto', 'default' => 'Corretor Imbatível — Manual Jurídico para Corretores de Imóveis', 'type' => 'text' ),
		'ci_price_old'      => array( 'label' => 'Preço "de" (riscado)', 'default' => '', 'type' => 'text' ),
		'ci_price_new'      => array( 'label' => 'Preço "por"', 'default' => 'R$ 147,00', 'type' => 'text' ),
		'ci_installment'    => array( 'label' => 'Texto de parcelamento', 'default' => '', 'type' => 'text' ),
		'ci_checkout_url'   => array( 'label' => 'Checkout legado (preservado; novas páginas usam Vendas)', 'default' => '', 'type' => 'url' ),
		'ci_guarantee_text' => array( 'label' => 'Texto da garantia (deixe em branco para não exibir a seção)', 'default' => '', 'type' => 'text' ),
	);

	foreach ( $offer_fields as $id => $field ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => 'url' === $field['type'] ? 'esc_url_raw' : 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $field['label'],
				'section' => 'ci_offer',
				'type'    => $field['type'],
			)
		);
	}

	/* ---------------------------------------------------------------------
	 * COPY
	 * ------------------------------------------------------------------- */
	$wp_customize->add_section(
		'ci_copy',
		array(
			'title'    => __( 'Corretor Imbatível — Textos', 'corretor-imbativel' ),
			'priority' => 11,
		)
	);

	$copy_fields = array(
		'ci_hero_eyebrow'     => array( 'label' => 'Hero — eyebrow', 'default' => 'SEGURANÇA JURÍDICA PARA QUEM VIVE DO MERCADO IMOBILIÁRIO', 'type' => 'text' ),
		'ci_hero_headline'    => array( 'label' => 'Hero — headline', 'default' => 'Torne-se um Corretor Imbatível', 'type' => 'text' ),
		'ci_hero_subheadline' => array( 'label' => 'Hero — subheadline', 'default' => 'O Corretor Imbatível foi desenvolvido para ajudar corretores a entender os principais riscos jurídicos da profissão e conduzir negociações de maneira mais segura, documentada e profissional.', 'type' => 'textarea' ),
		'ci_cta_primary'      => array( 'label' => 'Texto do botão principal', 'default' => 'QUERO SER UM CORRETOR IMBATÍVEL', 'type' => 'text' ),
		'ci_cta_sticky'       => array( 'label' => 'Texto do CTA fixo (mobile)', 'default' => 'QUERO ACESSAR', 'type' => 'text' ),
	);

	foreach ( $copy_fields as $id => $field ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => 'textarea' === $field['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $field['label'],
				'section' => 'ci_copy',
				'type'    => $field['type'],
			)
		);
	}

	/* ---------------------------------------------------------------------
	 * AUTHOR
	 * ------------------------------------------------------------------- */
	$wp_customize->add_section(
		'ci_author',
		array(
			'title'    => __( 'Corretor Imbatível — Especialista', 'corretor-imbativel' ),
			'priority' => 12,
		)
	);

	$wp_customize->add_setting( 'ci_author_photo', array( 'default' => '' ) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'ci_author_photo',
			array(
				'label'   => 'Foto do Dr. Rodrigo Barbato Fabbris',
				'section' => 'ci_author',
			)
		)
	);

	/* ---------------------------------------------------------------------
	 * PRODUCT MOCKUP
	 * ------------------------------------------------------------------- */
	$wp_customize->add_setting( 'ci_mockup_image', array( 'default' => '' ) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'ci_mockup_image',
			array(
				'label'       => 'Mockup do eBook (capa + tablet)',
				'description' => 'Envie a arte oficial fornecida pelo design. Enquanto vazio, um mockup CSS é exibido no lugar.',
				'section'     => 'ci_offer',
			)
		)
	);

	/* ---------------------------------------------------------------------
	 * TESTIMONIALS — pipe-delimited, one per line: Nome | Cargo | Depoimento
	 * ------------------------------------------------------------------- */
	$wp_customize->add_setting(
		'ci_testimonials',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'ci_testimonials',
		array(
			'label'       => 'Depoimentos (um por linha: Nome | Cargo | Depoimento)',
			'description' => 'Deixe em branco para ocultar a seção.',
			'section'     => 'ci_copy',
			'type'        => 'textarea',
		)
	);

	/* ---------------------------------------------------------------------
	 * FAQ — pipe-delimited, one per line: Pergunta | Resposta
	 * ------------------------------------------------------------------- */
	$wp_customize->add_setting(
		'ci_faq',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'ci_faq',
		array(
			'label'       => 'FAQ (um por linha: Pergunta | Resposta)',
			'description' => 'Deixe em branco para usar o FAQ padrão.',
			'section'     => 'ci_copy',
			'type'        => 'textarea',
		)
	);

	/* ---------------------------------------------------------------------
	 * TRACKING
	 * ------------------------------------------------------------------- */
	$wp_customize->add_section(
		'ci_tracking',
		array(
			'title'    => __( 'Corretor Imbatível — Tracking', 'corretor-imbativel' ),
			'priority' => 13,
		)
	);

	$wp_customize->add_setting( 'ci_ga4_id', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'ci_ga4_id',
		array(
			'label'       => 'Google Analytics 4 — Measurement ID',
			'description' => 'Formato: G-XXXXXXXXXX. Deixe em branco para não carregar o GA4.',
			'section'     => 'ci_tracking',
			'type'        => 'text',
		)
	);

}
add_action( 'customize_register', 'ci_customize_register' );

/**
 * Parse "Field | Field | Field" textarea lines into an array of arrays.
 *
 * @param string $raw Raw textarea content.
 * @return array
 */
function ci_parse_pipe_lines( $raw ) {
	$lines  = array_filter( array_map( 'trim', explode( "\n", (string) $raw ) ) );
	$parsed = array();

	foreach ( $lines as $line ) {
		$parsed[] = array_map( 'trim', explode( '|', $line ) );
	}

	return $parsed;
}
