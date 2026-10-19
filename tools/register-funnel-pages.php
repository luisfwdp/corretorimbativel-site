<?php
/**
 * WP-CLI: wp eval-file tools/register-funnel-pages.php [apply] [publish]
 * Default: read-only plan. No front-page option, content or existing status is changed.
 */
if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) { exit( 'Execute com WP-CLI.' ); }
if ( get_stylesheet() !== 'corretor-imbativel' ) { WP_CLI::error( 'O tema Corretor Imbatível deve estar ativo.' ); }
$apply = in_array( 'apply', $args ?? array(), true );
$publish = in_array( 'publish', $args ?? array(), true );
$pages = array( 'ebook' => 'Corretor Imbatível', 'manual-juridico' => 'Manual Jurídico para Corretores e Imobiliárias', 'combo' => 'Combo Completo Corretor Imbatível', 'upsell-manual' => 'Complemente com o Manual Jurídico', 'upsell-ebook' => 'Complemente com o eBook' );
// Preflight all collisions before making any writes.
foreach ( $pages as $slug => $title ) {
 $existing = get_page_by_path( $slug, OBJECT, 'page' );
 if ( ! file_exists( get_template_directory() . '/page-' . $slug . '.php' ) ) { WP_CLI::error( 'Template ausente: ' . $slug ); }
 if ( $existing ) {
  $template = get_post_meta( $existing->ID, '_wp_page_template', true );
  if ( ( $template && 'default' !== $template && 'page-' . $slug . '.php' !== $template ) || trim( $existing->post_content ) || 'trash' === $existing->post_status || (int) get_option( 'page_on_front' ) === (int) $existing->ID || (int) get_option( 'page_for_posts' ) === (int) $existing->ID ) {
   WP_CLI::error( 'Conflito em /' . $slug . '/. Revise a página existente antes de associar o template. Nenhuma escrita foi iniciada.' );
  }
 }
}
foreach ( $pages as $slug => $title ) {
 $existing = get_page_by_path( $slug, OBJECT, 'page' );
 WP_CLI::log( ( $existing ? 'Associar #' . $existing->ID : 'Criar' ) . ' /' . $slug . '/ → page-' . $slug . '.php' );
 if ( ! $apply ) { continue; }
 if ( $existing ) {
  $id = $existing->ID; // Preserve existing title/content/status, including drafts.
 } else {
  $id = wp_insert_post( array( 'post_type' => 'page', 'post_title' => $title, 'post_name' => $slug, 'post_status' => $publish ? 'publish' : 'draft' ), true );
  if ( is_wp_error( $id ) ) { WP_CLI::error( $id->get_error_message() ); }
 }
 update_post_meta( $id, '_wp_page_template', 'page-' . $slug . '.php' );
 // Recognized by Yoast and Rank Math if present; core robots also enforce noindex.
 if ( in_array( $slug, array( 'upsell-manual', 'upsell-ebook' ), true ) ) {
  update_post_meta( $id, '_yoast_wpseo_meta-robots-noindex', '1' );
  update_post_meta( $id, 'rank_math_robots', array( 'noindex', 'nofollow' ) );
 }
}
if ( $apply ) {
 if ( ! get_option( 'permalink_structure' ) ) { WP_CLI::warning( 'Permalinks simples estão ativos. Configure Nome do post no painel antes de publicar.' ); }
 flush_rewrite_rules( false ); // Soft flush only; do not rewrite .htaccess or production configuration.
 WP_CLI::success( 'Templates associados. Páginas existentes preservadas. Home e permalinks não foram alterados.' );
} else { WP_CLI::success( 'Simulação concluída; nenhuma alteração. Use apply para criar rascunhos.' ); }
