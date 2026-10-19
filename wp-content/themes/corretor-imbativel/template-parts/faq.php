<?php
defined( 'ABSPATH' ) || exit;
$faq_items = $args['items'] ?? array();
?>
<section class="ci-section" id="faq"><div class="ci-container ci-faq">
 <h2 class="ci-heading">Perguntas frequentes</h2>
 <div class="ci-faq__list">
 <?php foreach ( $faq_items as $item ) : ?>
 <details><summary><?php echo esc_html( $item[0] ?? '' ); ?></summary><p><?php echo esc_html( $item[1] ?? '' ); ?></p></details>
 <?php endforeach; ?>
 </div>
</div></section>
