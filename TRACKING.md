# Tracking

Consulte [FUNIL-DE-VENDAS.md](FUNIL-DE-VENDAS.md#tracking-e-seo) para eventos, parâmetros, UTMs e requisitos de conversão real.

O GA4 usa o campo existente `ci_ga4_id`. Nenhum Pixel removido na base foi reativado. Eventos são enviados a `gtag` e, se disponível por integração correta, `fbq`. A instalação e o consentimento devem ser homologados no WordPress real.

Eventos por produto: `view_item`, `select_item`, `begin_checkout`; ofertas complementares: `view_promotion`, `select_promotion`. Eventos legados `view_landing_page`, `click_checkout`, `faq_open`, `scroll_50` e `scroll_90` continuam disponíveis.

O tema não dispara `purchase`. Cliques e abertura de páginas não comprovam venda. Usar integração oficial Greenn ou backend autenticado, confirmar estado pago e deduplicar pelo ID da transação antes de registrar compra. Não foi criado webhook sem autenticação confirmada.

UTMs passam da home às landings e aos checkouts. Tokens da Greenn não são copiados para links ou parâmetros de eventos; se usar upsell nativo, conferir também o tratamento da URL coletada pelo analytics.
