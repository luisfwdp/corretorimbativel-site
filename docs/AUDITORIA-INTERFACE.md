# Auditoria de interface — branch premium

Fonte: `vercel-labs/web-interface-guidelines/main/command.md`, lida durante esta rodada. Revisão com as restrições do briefing e a infraestrutura WordPress existente.

```text
wp-content/themes/corretor-imbativel/inc/editorial.php:6 - aprovado: CSS/JS restritos às cinco páginas.
wp-content/themes/corretor-imbativel/inc/editorial.php:16 - aprovado: skip link com destino focável.
wp-content/themes/corretor-imbativel/inc/editorial.php:31 - aprovado: imagem de abertura eager/prioritária; outras lazy; dimensões/alt presentes.
wp-content/themes/corretor-imbativel/inc/editorial.php:67 - aprovado: fallback é navegação real à oferta, sem evento de checkout.
wp-content/themes/corretor-imbativel/assets/css/editorial.css:24 - aprovado: foco visível e skip link acessível por teclado.
wp-content/themes/corretor-imbativel/assets/css/editorial.css:202 - aprovado: FAQ nativo e alvos adequados; sem JS obrigatório.
wp-content/themes/corretor-imbativel/assets/css/editorial.css:231 - aprovado: hover apenas em ponteiro fino, com movimento permitido.
wp-content/themes/corretor-imbativel/assets/css/editorial.css:287 - aprovado: comparação reflow em mobile, preservando cabeçalhos e relações da tabela.
wp-content/themes/corretor-imbativel/assets/css/editorial.css:297 - aprovado: movimento reduzido desativa transições/transformações decorativas.
wp-content/themes/corretor-imbativel/assets/js/editorial.js:25 - aprovado: troca de preferência cancela animações em andamento.
wp-content/themes/corretor-imbativel/assets/js/editorial.js:45 - aprovado: CTA fixo considera oferta, fechamento e foco.
wp-content/themes/corretor-imbativel/inc/funnel-pages.php:72 - aprovado: ação de registro autenticada, POST e nonce; GET não modifica páginas.
```

Axe não apontou violações nas cinco páginas em desktop, nas regras WCAG 2 A/AA e 2.1 A/AA verificadas. Testes adicionais cobriram teclado, texto a 200%, orientação landscape, recusa, motion e ausência de cortes dos blocos. Não equivale a certificação de acessibilidade ou teste com todos os leitores de tela/aparelhos físicos.

Limites: plugins, consentimento e scripts financeiros reais não estão presentes no ambiente isolado; precisam ser homologados na instalação da hospedagem. Mockup e arquivo real do Manual não fornecidos. Nenhuma confirmação de compra é derivada de navegação ou clique.
