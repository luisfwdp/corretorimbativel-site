<?php
/** WP-CLI: wp eval-file tools/register-funnel-pages.php [apply] [publish]. Dry-run by default. */
if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) { exit( 'Execute com WP-CLI.' ); }
if ( ! function_exists( 'ci_funnel_page_plan' ) ) { WP_CLI::error( 'Atualize e ative o tema Corretor Imbatível antes de registrar as páginas.' ); }
$apply = in_array( 'apply', $args ?? array(), true );
$publish = in_array( 'publish', $args ?? array(), true );
$plan = ci_funnel_page_plan();
if ( is_wp_error( $plan ) ) { WP_CLI::error( $plan->get_error_message() ); }
foreach ( $plan as $item ) {
 WP_CLI::log( ( $item['id'] ? 'Associar #' . $item['id'] : 'Criar' ) . ' /' . $item['slug'] . '/ → ' . $item['template'] );
}
if ( ! $apply ) { WP_CLI::success( 'Simulação concluída; nenhuma alteração. Use apply para criar rascunhos.' ); return; }
$result = ci_register_funnel_pages( $publish );
if ( is_wp_error( $result ) ) { WP_CLI::error( $result->get_error_message() ); }
if ( ! get_option( 'permalink_structure' ) ) { WP_CLI::warning( 'Permalinks simples estão ativos. Confira Nome do post no painel antes de publicar.' ); }
WP_CLI::success( 'Templates associados. Páginas existentes preservadas. Home e permalinks não foram alterados.' );
