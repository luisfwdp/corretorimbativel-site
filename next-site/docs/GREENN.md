# Greenn — integração e pendências

## Ofertas independentes

| Variável-base | Produto | Preço |
| --- | --- | --- |
| GREENN_EBOOK | eBook | R$ 147 |
| GREENN_MANUAL | Manual | R$ 97 |
| GREENN_COMBO | Os dois produtos | R$ 197 |
| GREENN_UPSELL_MANUAL | Manual para comprador do eBook | R$ 50 |
| GREENN_UPSELL_EBOOK | eBook para comprador do Manual | R$ 100 |

Cada base possui `_URL` e `_VERIFIED`. Somente URL HTTPS no domínio greenn.com.br/subdomínio + confirmação explícita habilita um CTA. Uma URL idêntica para produtos diferentes causa falha de build. Confirmar produto/preço/entrega na conta antes de marcar VERIFIED. O preço exibido não altera o preço da plataforma.

Upsells exigem também `_DECLINE_URL` HTTPS real e `_MODE=separate`. Nesse modo, a página informa que o complemento é nova compra em checkout separado. A visita não cobra automaticamente. Falta de recusa real mantém o aceite bloqueado; a recusa local revela instruções e não simula conclusão.

## Mecanismo oficial verificado

Fonte consultada em 19/10/2026: https://ajuda.greenn.com.br/pt-br/article/criando-um-upsell-na-greenn-78muq1/ . O artigo descreve ofertas pós-compra, seleção do produto/oferta, recusa, confirmação e código para páginas externas. Código gerado e contexto da compra anterior, incluindo token, são necessários. A plataforma também documenta página de upsell própria: https://ajuda.greenn.com.br/pt-br/article/criando-uma-pagina-de-upsell-na-greenn-1vxd6j/ . A interface e as condições da conta ainda precisam de conferência autenticada.

**Não há código oficial de uma oferta desta conta disponível. Por isso não foi criado um script que imita a cobrança nativa.** `_MODE=native` mantém o pagamento bloqueado nesta versão. A integração do embed externo em React (montagem, navegação, CSP, confirmação, contexto e recusa) é uma pendência explícita se esse modo for escolhido. O suporte geral documentado pela Greenn não confirma habilitação, preço ou entrega da conta.

O caminho pronto para configuração nesta entrega é o checkout separado, com explicação de nova compra. Para cobrança pós-compra nativa, usar o código exato fornecido pela Greenn e homologar em ambiente apropriado antes de habilitar. Não acrescentar token a links avulsos nem enviar token a analytics. Não remover os parâmetros originais da URL do upsell. Não confundir uma página visual com o fluxo financeiro concluído.

Elegibilidade: o site não tem prova autenticada da primeira compra. No modo separado, a Greenn precisa assegurar que as ofertas reduzidas sejam acessíveis apenas conforme a regra comercial. Noindex não é controle de acesso. Downsell não foi definido ou implementado.

## Homologação obrigatória

Configurar produtos/ofertas de 147/97/197/50/100, arquivos reais, entrega, pós-compra por meio de pagamento, recusa e conclusão. Testar pagamento aprovado/recusado/pendente, cobrança do valor correto, aceite e recusa de cada complemento, elegibilidade sem compra anterior, entrega dos arquivos/acessos, reembolso e deduplicação. Uma compra pendente por PIX/boleto não deve ser tratada como pagamento confirmado.

Compra confirmada deve vir da integração oficial Greenn ou de backend autenticado com venda paga e deduplicação por transação. Esta aplicação não emite `purchase`, não possui webhook não autenticado e não entrega arquivos. Não reutiliza o checkout legado 123089 porque sua oferta atual não foi confirmada. Não inclui o link privado de amigos.

## Analytics

`GA4_ID`, `META_PIXEL_ID`, `ANALYTICS_ENABLED=true` e `SITE_RELEASE=production` habilitam a instalação depois de consentimento. IDs reais ainda não fornecidos. Preservar somente IDs confirmados do produto; a base havia removido um Pixel de outro produto.

Eventos: view_item, select_item, begin_checkout, view_promotion, select_promotion. Nenhum evento de compra por clique. Apenas links habilitados geram begin_checkout; âncoras à oferta não geram. Consentimento recusado impede envio. Evitar instalar outra cópia de GA4/Meta via GTM. Meta não é carregado nas páginas de upsell; validar a coleta automática com a plataforma antes de ampliar sua instalação para contexto pós-compra. A URL informada ao GA4 tem somente caminho e UTMs permitidas, sem token, hash, dados pessoais ou IDs de clique. UTMs e click IDs permitidos seguem nos links para atribuição do checkout, sem repassar parâmetros de pagamento.

Os eventos preparados não comprovam configuração de compra, deduplicação entre browser/servidor ou política final de consentimento em produção.
