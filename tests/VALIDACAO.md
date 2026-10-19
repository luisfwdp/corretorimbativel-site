# Validação da branch

Executada em 19/10/2026, exclusivamente em instalações WordPress Playground locais. Nenhum teste comprou produtos ou alterou a produção.

## Resultados

- Sintaxe PHP: todos os 18 arquivos do tema/procedimento verificados inicialmente; arquivos alterados depois foram novamente verificados. JS validado com `node --check`; diff sem erros de whitespace.
- WordPress 6.8 + PHP 8.3: **24 combinações aprovadas**, seis rotas em 1440×1000, 820×1180, 375×812 e 320×700. HTTP 200, um H1, canonical único por página, descrição, preços, ausência de marcadores visíveis, UTMs entre home e landing, checkouts sem validação desabilitados, FAQs, eventos, imagens e ausência de rolagem horizontal. FAQ também testado sem JavaScript.
- WordPress 6.8 + PHP 7.4: **cinco ofertas com fixtures aprovadas**. Produto correto no evento, preservação de UTMs e parâmetros preexistentes, clique de navegação interna não contado como checkout, apenas um `begin_checkout` por clique, `select_promotion`, links de recusa e acessibilidade do CTA fixo.
- `tests/wordpress.php` executado via Blueprint/WP-CLI: catálogo, preço legado de R$ 97 sem afetar o eBook de R$ 147, totais das duas jornadas e do Combo, rejeição de protocolos inseguros, checkouts sem validação, requisito de recusa, modo nativo sem código, preservação exata de embed de teste, permissão para salvar código e registros de páginas/templates.
- Registro WP-CLI executado em simulação e duas vezes com `apply publish` no banco isolado. Cinco slugs associados aos templates, sem duplicação.
- Sitemap XML nativo consultado: home, eBook, Manual e Combo presentes; upsells ausentes.
- Screenshots das 24 combinações gerados fora do tema; home desktop/mobile e upsell mobile inspecionados visualmente. Imagens públicas originais foram baixadas por HTTPS com validação de certificado para fixtures locais de navegador. Fontes externas foram obtidas por Node com proxy e CA configurados; não se desabilitou TLS. A capa do Manual continua pendente.

As URLs `https://example.invalid/...` existem somente nos testes, para interceptar e inspecionar a navegação sem compra. Não são configuração comercial do tema, não foram enviadas à Greenn e não são utilizadas por padrão no código público.

## Reprodução

Dependências de teste externas ao tema: Node 24, `@wp-playground/cli`, Playwright e Chromium. Instalar em diretório de ferramentas separado ou usar dependências existentes. Não há dependências de Node em produção.

Iniciar ambiente isolado (ajustar caminhos absolutos para seu clone):

```bash
NODE_USE_ENV_PROXY=1 wp-playground-cli server --wp=6.8 --php=8.3 --port=9400 --workers=1 \
  --mount=/caminho/repositorio/wp-content/themes/corretor-imbativel:/wordpress/wp-content/themes/corretor-imbativel \
  --mount=/caminho/repositorio/tools:/tools \
  --mount=/caminho/repositorio/tests:/tests \
  --blueprint=/caminho/repositorio/tests/blueprint.json
NODE_USE_ENV_PROXY=1 node tests/browser.cjs
```

O Blueprint configura propositalmente preço/checkout **legados** para testar que não habilitam ou alteram a nova oferta. Referências às imagens públicas servem apenas para reproduzir o visual. Para evitar instabilidade de rede, é possível fornecer cópias verificadas pelos parâmetros `CI_EBOOK_IMAGE` e `CI_AUTHOR_IMAGE`. `CI_SCREENSHOTS` controla o diretório de screenshots.

Para o teste de checkouts, usar outra instalação isolada em `127.0.0.1:9401` com PHP 7.4 e acrescentar ao Blueprint, após os testes de WordPress, um passo `runPHP` com este código:

```php
<?php
require '/wordpress/wp-load.php';
foreach (ci_catalogue() as $key => $p) {
    set_theme_mod('ci_sales_'.$key.'_checkout', 'https://example.invalid/checkout/'.$key.'?existing=keep');
    set_theme_mod('ci_sales_'.$key.'_verified', true);
    if (ci_is_upsell($key)) {
        set_theme_mod('ci_sales_'.$key.'_decline', 'https://example.invalid/completion/'.$key);
    }
}
```

Executar `node tests/browser-checkouts.cjs`. O teste bloqueia a navegação por cliques e inspeciona eventos e links; não abre nem valida uma operação financeira. O modo nativo tem apenas teste de renderização de fixture, sem executar um script Greenn inventado.

## Homologação ainda necessária

Conta e ofertas Greenn reais, scripts oficiais, elegibilidade/token, autorização e valor cobrado, PIX/boleto/cartão, confirmação/recusa, entrega, acesso, reembolso, pixels/consentimento e deduplicação de `purchase`. Também faltam a conferência do Manual e sua arte, os plugins/configurações reais de produção, regras Apache/cPanel e validação por uma pessoa antes de publicar.

As instalações locais usam SQLite do Playground, não o banco MySQL da HostGator. Os testes aprovados verificam o comportamento WordPress do tema; não atestam a infraestrutura nem a integração financeira em produção.

## Rodada editorial premium

Branch `codex/landing-pages-premium`: detalhes, resultados e limitações em [docs/LANDING-PAGES-PREMIUM.md](../docs/LANDING-PAGES-PREMIUM.md#testes-realizados). Além dos 24 cenários de regressão, foram executados comparação de homepage por HTML/pixels, cinco varreduras axe sem violações, 20 cenários de layout, texto a 200%, motion, administração e testes adicionais de registro. A versão atual do Blueprint inclui os testes de registro compartilhado.

Para executar os testes adicionais, usar os mesmos mounts do comando acima, a aplicação atual em `127.0.0.1:9410`, e a base `7afdc2f` em outra instalação `127.0.0.1:9411`, com as mesmas opções e imagens. Ambos devem ter o tema ativo, permalinks amigáveis e cinco páginas associadas. Os scripts aceitam `CI_EDITORIAL_URL` e `CI_BASELINE_URL`.

```bash
NODE_USE_ENV_PROXY=1 node tests/editorial-browser.cjs
NODE_USE_ENV_PROXY=1 node tests/admin-pages.cjs
NODE_USE_ENV_PROXY=1 node tests/motion-performance.cjs
```

Axe exige o pacote `@axe-core/playwright` nas ferramentas de teste, fora do tema. O teste administrativo usa as credenciais públicas padrão da instalação descartável do Playground e bloqueia hosts diferentes de localhost. Não executá-lo contra produção.

A instalação de PHP 7.4 com os checkouts de teste pode usar `CI_CHECKOUT_URL=http://127.0.0.1:9412 node tests/browser-checkouts.cjs`. Os links são fixtures reservadas; não há cobrança nem teste de entrega.

Exportação das prévias (imagens verificadas e ferramentas precisam estar disponíveis):

```bash
CI_EBOOK_IMAGE=/caminho/ebook.png CI_AUTHOR_IMAGE=/caminho/autor.png \
CI_PREVIEW_DIR=/caminho/previews NODE_USE_ENV_PROXY=1 node tests/export-preview.cjs
```

As capturas e os relatórios ficam fora do tema. O pacote HTML permite revisar layout e interações, mas não equivale a implantação WordPress nem validação de pagamento.
