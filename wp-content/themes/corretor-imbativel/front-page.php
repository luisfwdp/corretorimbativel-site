<?php
/** Short product selection home. The original landing is preserved in page-ebook.php. */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main">
 <section class="ci-home-hero" id="hero"><div class="ci-container">
  <p class="ci-eyebrow">CORRETOR IMBATÍVEL</p>
  <h1>Sua carreira imobiliária merece mais segurança jurídica.</h1>
  <p class="ci-lede">Conheça os materiais do Corretor Imbatível e escolha a solução ideal para fortalecer sua atuação profissional, documentar negociações e compreender os principais riscos jurídicos da corretagem.</p>
 </div></section>
 <section class="ci-product-selection" aria-label="Escolha seu produto"><div class="ci-container">
  <div class="ci-product-grid">
   <?php foreach ( array( 'ebook', 'manual-juridico', 'combo' ) as $key ) : $p = ci_product( $key ); ?>
   <article class="ci-product-card <?php echo 'combo' === $key ? 'ci-product-card--featured' : ''; ?>">
    <p class="ci-eyebrow"><?php echo 'combo' === $key ? 'MAIS COMPLETO' : ( 'ebook' === $key ? '01 / EBOOK' : '02 / MANUAL JURÍDICO' ); ?></p>
    <h2><?php echo esc_html( $p['card_title'] ); ?></h2>
    <p class="ci-product-card__summary"><?php echo esc_html( $p['summary'] ); ?></p>
    <p class="ci-product-card__price"><?php echo esc_html( ci_money( $p['price'] ) ); ?></p>
    <a class="ci-btn ci-btn--primary ci-js-product" data-product="<?php echo esc_attr( $key ); ?>" data-name="<?php echo esc_attr( $p['name'] ); ?>" data-price="<?php echo esc_attr( $p['price'] ); ?>" href="<?php echo esc_url( home_url( '/' . $key . '/' ) ); ?>"><?php echo 'ebook' === $key ? 'CONHECER O EBOOK' : ( 'combo' === $key ? 'CONHECER O COMBO' : 'CONHECER O MANUAL' ); ?></a>
   </article>
   <?php endforeach; ?>
  </div>
  <p class="ci-home-credit">Conteúdo de Dr. Rodrigo Barbato Fabbris · Advogado e corretor de imóveis</p>
 </div></section>
</main>
<?php get_footer(); ?>
