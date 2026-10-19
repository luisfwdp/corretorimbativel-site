<?php
defined( 'ABSPATH' ) || exit;
$key = $args['product']; $manual = 'upsell-manual' === $key;
$p = ci_product( $key ); $complement = $manual ? 'manual-juridico' : 'ebook';
$base = ci_product( $manual ? 'ebook' : 'manual-juridico' );
$decline_label = $manual ? 'Não, obrigado. Quero continuar apenas com o eBook.' : 'Não, obrigado. Quero continuar apenas com o Manual.';
$benefits = $manual ? array(
 'Conecte a leitura à documentação' => 'Observe como contratos, propostas e distratos participam das diferentes etapas da negociação.',
 'Dê atenção à formalização' => 'Compreenda a finalidade dos documentos e os cuidados que merecem análise antes de utilizá-los.',
 'Olhe para os registros da intermediação' => 'Reflita sobre as informações que ajudam a compreender o trabalho realizado e os acordos feitos.',
) : array(
 'Entenda melhor sua atuação' => 'Estude o papel do corretor, sua base jurídica e os limites da atividade profissional.',
 'Amplie o olhar sobre os riscos' => 'Conheça situações que podem gerar divergências sobre responsabilidade, documentação e comissão.',
 'Relacione os documentos às boas práticas' => 'Complemente seu estudo com uma visão mais ampla de organização, registro e prevenção.',
);
?>
<main id="main" tabindex="-1">
 <section class="ci-hero ci-upsell" id="hero"><div class="ci-container ci-hero__grid">
  <div class="ci-hero__content">
   <p class="ci-kicker">Uma escolha complementar ao seu material</p>
   <h1 class="ci-hero__headline"><?php echo $manual ? 'Você já garantiu o conhecimento. Agora complemente sua preparação com o Manual Jurídico.' : 'Você já tem o Manual Jurídico. Agora amplie seu conhecimento com o Corretor Imbatível.'; ?></h1>
   <p class="ci-hero__sub"><?php echo $manual ? 'Você já garantiu o Corretor Imbatível. Agora pode complementar seu material com orientações práticas sobre contratos, propostas, distratos e documentação da intermediação.' : 'Complemente o Manual Jurídico com o eBook Corretor Imbatível e tenha uma visão mais ampla dos direitos, responsabilidades, riscos e boas práticas da corretagem imobiliária.'; ?></p>
   <div class="ci-upsell-decision" id="oferta">
    <p class="ci-price-label">Adicione <?php echo $manual ? 'o Manual Jurídico' : 'o eBook Corretor Imbatível'; ?> por</p>
    <p class="ci-editorial-price"><?php echo esc_html( ci_money( $p['price'] ) ); ?></p>
    <p class="ci-journey-total">Compra inicial de <?php echo esc_html( ci_money( $base['price'] ) ); ?> + complemento de <?php echo esc_html( ci_money( $p['price'] ) ); ?> = <strong><?php echo esc_html( ci_money( $base['price'] + $p['price'] ) ); ?> no total.</strong></p>
    <?php if ( 'native' === $p['mode'] ) : ?><p class="ci-purchase-notice">Esta oferta adiciona uma compra à sua jornada. Confira o valor e confirme o pagamento na etapa exibida pela Greenn.</p>
    <?php else : ?><p class="ci-purchase-notice">Esta oferta é uma nova compra, em checkout separado. Ao continuar, você revisará o valor e autorizará o pagamento. Nenhuma cobrança é feita ao visitar esta página.</p><?php endif; ?>
    <?php ci_checkout_button( $key, 'upsell' ); ?>
    <?php if ( ci_sales_url( $p['decline'] ) ) : ?>
     <a class="ci-decline" href="<?php echo esc_url( ci_sales_url( $p['decline'] ) ); ?>"><?php echo esc_html( $decline_label ); ?></a>
    <?php else : ?>
     <button class="ci-decline ci-decline-fallback" type="button" aria-expanded="false" aria-controls="ci-decline-guidance"><?php echo esc_html( $decline_label ); ?></button>
     <p id="ci-decline-guidance" class="ci-decline-guidance" hidden>Você pode fechar esta página e consultar as instruções da sua compra inicial. Recusar este complemento não cancela a compra anterior.</p>
     <noscript><p>Se não desejar o complemento, feche esta página e consulte as instruções da sua compra inicial.</p></noscript>
    <?php endif; ?>
   </div>
  </div>
  <div class="ci-hero__media"><?php ci_editorial_visual( $complement, true ); ?></div>
 </div></section>
 <section class="ci-section ci-paper ci-upsell-benefits" id="complemento"><div class="ci-container ci-split">
  <div class="ci-section-intro"><h2><?php echo $manual ? 'Do conhecimento aos cuidados documentais.' : 'Dos cuidados documentais a uma visão mais ampla da profissão.'; ?></h2><p>O complemento tem um foco próprio e pode ser estudado em conjunto com o material que você escolheu.</p></div>
  <dl class="ci-editorial-benefits"><?php foreach ( $benefits as $title => $text ) : ?><div><dt><?php echo esc_html( $title ); ?></dt><dd><?php echo esc_html( $text ); ?></dd></div><?php endforeach; ?></dl>
 </div></section>
 <section class="ci-section ci-upsell-note"><div class="ci-container"><p>Os materiais têm finalidade educacional. Não substituem orientação jurídica individualizada e não garantem resultados.<?php if ( $manual ) : ?> A oferta do Manual não anuncia documentos editáveis como itens incluídos.<?php endif; ?></p></div></section>
</main>
