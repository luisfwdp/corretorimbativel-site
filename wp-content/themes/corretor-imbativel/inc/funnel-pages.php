<?php
/** Explicit, idempotent page registration shared by wp-admin and WP-CLI. */
defined( 'ABSPATH' ) || exit;

function ci_funnel_page_plan() {
	if ( 'corretor-imbativel' !== get_stylesheet() ) { return new WP_Error( 'ci_theme', 'O tema Corretor Imbatível deve estar ativo.' ); }
	$titles = array( 'ebook' => 'Corretor Imbatível', 'manual-juridico' => 'Manual Jurídico para Corretores e Imobiliárias', 'combo' => 'Combo Completo Corretor Imbatível', 'upsell-manual' => 'Complemente com o Manual Jurídico', 'upsell-ebook' => 'Complemente com o eBook' );
	$plan = array();
	foreach ( $titles as $slug => $title ) {
		$template = 'page-' . $slug . '.php';
		if ( ! file_exists( get_template_directory() . '/' . $template ) ) { return new WP_Error( 'ci_template', 'Template ausente: ' . $template ); }
		$page = get_page_by_path( $slug, OBJECT, 'page' );
		if ( $page ) {
			$assigned = get_post_meta( $page->ID, '_wp_page_template', true );
			if ( ( $assigned && 'default' !== $assigned && $template !== $assigned ) || trim( $page->post_content ) || 'trash' === $page->post_status || (int) get_option( 'page_on_front' ) === (int) $page->ID || (int) get_option( 'page_for_posts' ) === (int) $page->ID ) {
				return new WP_Error( 'ci_conflict', 'Conflito em /' . $slug . '/. A página contém conteúdo, usa outro template ou está reservada como início/blog. Revise antes de associar. Nenhuma escrita foi iniciada.' );
			}
		}
		$plan[] = array( 'slug' => $slug, 'title' => $title, 'template' => $template, 'id' => $page ? (int) $page->ID : 0, 'status' => $page ? $page->post_status : 'ausente' );
	}
	return $plan;
}

function ci_register_funnel_pages( $publish_new = false ) {
	// Always redo preflight immediately before writes; callers enforce authorization.
	$plan = ci_funnel_page_plan();
	if ( is_wp_error( $plan ) ) { return $plan; }
	foreach ( $plan as &$item ) {
		$id = $item['id'];
		if ( ! $id ) {
			$id = wp_insert_post( array( 'post_type' => 'page', 'post_title' => $item['title'], 'post_name' => $item['slug'], 'post_status' => $publish_new ? 'publish' : 'draft' ), true );
			if ( is_wp_error( $id ) ) { return $id; }
		}
		update_post_meta( $id, '_wp_page_template', $item['template'] );
		if ( ci_is_upsell( $item['slug'] ) ) {
			update_post_meta( $id, '_yoast_wpseo_meta-robots-noindex', '1' );
			update_post_meta( $id, 'rank_math_robots', array( 'noindex', 'nofollow' ) );
		}
		$item['id'] = (int) $id;
	}
	unset( $item );
	flush_rewrite_rules( false );
	return $plan;
}

add_action( 'admin_menu', function () {
	add_theme_page( 'Páginas de venda', 'Páginas de venda', 'manage_options', 'ci-funnel-pages', 'ci_funnel_pages_screen' );
} );
function ci_funnel_pages_screen() {
	if ( ! current_user_can( 'manage_options' ) ) { return; }
	$plan = ci_funnel_page_plan();
	echo '<div class="wrap"><h1>Páginas de venda — Corretor Imbatível</h1><p>Confira os cinco endereços e associe os templates do tema. Páginas novas serão criadas como rascunhos. A homepage e os checkouts não serão alterados.</p>';
	$notice = get_transient( 'ci_pages_notice_' . get_current_user_id() );
	if ( $notice ) { echo '<div class="notice notice-info"><p>' . esc_html( $notice ) . '</p></div>'; delete_transient( 'ci_pages_notice_' . get_current_user_id() ); }
	if ( is_wp_error( $plan ) ) {
		echo '<div class="notice notice-error"><p>' . esc_html( $plan->get_error_message() ) . '</p></div></div>'; return;
	}
	echo '<table class="widefat striped"><thead><tr><th>Endereço</th><th>Template</th><th>Estado</th><th>Página</th></tr></thead><tbody>';
	foreach ( $plan as $item ) {
		printf( '<tr><td><code>/%s/</code></td><td><code>%s</code></td><td>%s</td><td>', esc_html( $item['slug'] ), esc_html( $item['template'] ), esc_html( $item['status'] ) );
		if ( $item['id'] ) { printf( '<a href="%s">Revisar página #%d</a>', esc_url( get_edit_post_link( $item['id'], 'raw' ) ), $item['id'] ); }
		else { echo 'A criar'; }
		echo '</td></tr>';
	}
	echo '</tbody></table><p>Depois de revisar os textos, artes e ofertas, publique cada página no editor do WordPress. Sem publicação, os endereços permanecem indisponíveis para visitantes.</p>';
	if ( ! get_option( 'permalink_structure' ) ) { echo '<p><strong>Permalinks simples estão ativos.</strong> Confira Configurações → Links permanentes antes de publicar.</p>'; }
	echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '"><input type="hidden" name="action" value="ci_register_funnel_pages">';
	wp_nonce_field( 'ci_register_funnel_pages' );
	submit_button( 'Criar rascunhos e associar templates' );
	echo '</form></div>';
}
add_action( 'admin_post_ci_register_funnel_pages', function () {
	if ( ! current_user_can( 'manage_options' ) ) { wp_die( 'Acesso negado.', '', array( 'response' => 403 ) ); }
	check_admin_referer( 'ci_register_funnel_pages' );
	$result = ci_register_funnel_pages( false );
	$message = is_wp_error( $result ) ? $result->get_error_message() : 'Templates associados. Páginas novas criadas em rascunho; conteúdo, títulos e status existentes preservados.';
	set_transient( 'ci_pages_notice_' . get_current_user_id(), $message, 60 );
	wp_safe_redirect( admin_url( 'themes.php?page=ci-funnel-pages' ) );
	exit;
} );
