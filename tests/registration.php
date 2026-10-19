<?php
/** Explicit registration checks against isolated local WordPress. */
if ( ! defined( 'WP_CLI' ) || ! WP_CLI || ! preg_match( '~^http://(127\.0\.0\.1|localhost):[0-9]+$~', home_url() ) ) { exit( 'Use apenas WordPress local isolado.' ); }
function ci_registration_assert( $ok, $message ) { if ( ! $ok ) { throw new RuntimeException( $message ); } }
$initial = ci_funnel_page_plan();
ci_registration_assert( ! is_wp_error( $initial ), 'Initial plan must pass' );
$home = array( (string) get_option( 'show_on_front' ), (int) get_option( 'page_on_front' ), (int) get_option( 'page_for_posts' ), (string) get_option( 'permalink_structure' ) );
$ebook = get_page_by_path( 'ebook' );
$upsell = get_page_by_path( 'upsell-manual' );
$saved_content = $ebook->post_content;
$saved_status = $ebook->post_status;
$new_id = 0;
try {
 wp_update_post( array( 'ID' => $ebook->ID, 'post_content' => 'Existing editorial content must remain untouched.' ) );
 $conflict = ci_funnel_page_plan();
 ci_registration_assert( is_wp_error( $conflict ), 'Content collision must block registration' );
 ci_registration_assert( is_wp_error( ci_register_funnel_pages() ), 'Apply must repeat preflight' );
 ci_registration_assert( get_post( $ebook->ID )->post_content === 'Existing editorial content must remain untouched.', 'Content must be preserved' );
 wp_update_post( array( 'ID' => $ebook->ID, 'post_content' => $saved_content ) );
 update_option( 'page_on_front', $ebook->ID );
 ci_registration_assert( is_wp_error( ci_funnel_page_plan() ), 'Homepage must never be reassigned' );
 update_option( 'page_on_front', $home[1] );
 wp_update_post( array( 'ID' => $ebook->ID, 'post_status' => 'draft' ) );
 ci_register_funnel_pages( true );
 ci_registration_assert( get_post_status( $ebook->ID ) === 'draft', 'Publish argument must preserve existing draft status' );
 wp_update_post( array( 'ID' => $ebook->ID, 'post_status' => $saved_status ) );
 wp_update_post( array( 'ID' => $upsell->ID, 'post_name' => 'temporary-ci-upsell-fixture' ) );
 $created = ci_register_funnel_pages( false );
 ci_registration_assert( ! is_wp_error( $created ), 'Create missing page' );
 $new = get_page_by_path( 'upsell-manual' ); $new_id = $new ? $new->ID : 0;
 ci_registration_assert( $new && 'draft' === $new->post_status, 'Admin setup must create drafts' );
 ci_register_funnel_pages( false );
 ci_registration_assert( get_page_by_path( 'upsell-manual' )->ID === $new_id, 'Repeat must not duplicate page' );
 ci_registration_assert( 'page-upsell-manual.php' === get_post_meta( $new_id, '_wp_page_template', true ), 'Template must be assigned' );
 ci_registration_assert( '1' === get_post_meta( $new_id, '_yoast_wpseo_meta-robots-noindex', true ), 'Upsell must remain noindex' );
 ci_registration_assert( $home === array( (string) get_option( 'show_on_front' ), (int) get_option( 'page_on_front' ), (int) get_option( 'page_for_posts' ), (string) get_option( 'permalink_structure' ) ), 'Reading/permalink settings must remain intact' );
 WP_CLI::success( 'Registration: collisions, homepage preservation, draft creation, status preservation, template assignment, noindex and idempotence passed.' );
} finally {
 if ( $new_id ) { wp_delete_post( $new_id, true ); }
 wp_update_post( array( 'ID' => $upsell->ID, 'post_name' => 'upsell-manual' ) );
 wp_update_post( array( 'ID' => $ebook->ID, 'post_content' => $saved_content, 'post_status' => $saved_status ) );
 update_option( 'page_on_front', $home[1] );
 flush_rewrite_rules( false );
}
