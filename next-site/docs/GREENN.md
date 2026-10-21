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

Upsells exigem também `_DECLINE_URL` HTTPS real. `_MODE=native` registra que a jornada principal de pós-compra está hospedada na Greenn. As rotas de apoio do Next exibem o checkout separado do respectivo produto complementar; elas nunca executam o aceite nativo e o checkout separado ao mesmo tempo.

## Mecanismo oficial e limite verificado na conta

Fontes consultadas em 19/10/2026: https://ajuda.greenn.com.br/pt-br/article/criando-um-upsell-na-greenn-78muq1/ e https://ajuda.greenn.com.br/pt-br/article/criando-uma-pagina-de-upsell-na-greenn-1vxd6j/ . Os artigos descrevem produto/oferta, recusa, confirmação, código externo e página hospedada. Em 21/10/2026, a interface autenticada mostrou que a página de obrigado com upsell é vinculada ao **produto inicial inteiro**, sem seletor da oferta de origem.

Foram criadas duas páginas nativas: `Após eBook — Manual Jurídico por R$ 50` (`/one-click/7196`) e `Após Manual público — eBook por R$ 100` (`/one-click/7197`). Para eliminar o ciclo, cada complemento ganhou um produto próprio, sem upsell: Manual `199482` e eBook `199483`. As páginas nativas foram atualizadas para esses produtos e ligadas somente aos produtos principais `123089` e `141872`.

O produto eBook principal também contém a oferta privada para amigos. Por decisão comercial expressa, ela participa do mesmo upsell de Manual por R$ 50. As antigas ofertas complementares `jPi4sa` e `87Z6rU` foram desativadas nos produtos principais. Não acrescentar token a links avulsos nem enviar token a analytics.

Em 21/10/2026, as páginas de vendas dos produtos principais foram salvas no painel: eBook em `https://corretorimbativel.com.br/ebook` e Manual em `https://corretorimbativel.com.br/manual-juridico`.

As rotas `/upsell-manual` e `/upsell-ebook` permanecem como apoio fora da jornada nativa e apontam para os checkouts independentes dos produtos `199482` e `199483`. No fluxo pós-compra normal, o painel Greenn continua controlando o 1 clique. Downsell não foi definido ou implementado.

## Homologação obrigatória

Configurar produtos/ofertas de 147/97/197/50/100, arquivos reais, entrega, pós-compra por meio de pagamento, recusa e conclusão. Testar pagamento aprovado/recusado/pendente, cobrança do valor correto, aceite e recusa de cada complemento, elegibilidade sem compra anterior, entrega dos arquivos/acessos, reembolso e deduplicação. Uma compra pendente por PIX/boleto não deve ser tratada como pagamento confirmado.

Compra confirmada deve vir da integração oficial Greenn ou de backend autenticado com venda paga e deduplicação por transação. Esta aplicação não emite `purchase`, não possui webhook não autenticado e não entrega arquivos. Não reutiliza o checkout legado 123089 porque sua oferta atual não foi confirmada. Não inclui o link privado de amigos.

## Analytics

`GA4_ID`, `META_PIXEL_ID`, `ANALYTICS_ENABLED=true` e `SITE_RELEASE=production` habilitam a instalação depois de consentimento. IDs reais ainda não fornecidos. Preservar somente IDs confirmados do produto; a base havia removido um Pixel de outro produto.

Eventos: view_item, select_item, begin_checkout, view_promotion, select_promotion. Nenhum evento de compra por clique. Apenas links habilitados geram begin_checkout; âncoras à oferta não geram. Consentimento recusado impede envio. Evitar instalar outra cópia de GA4/Meta via GTM. Meta não é carregado nas páginas de upsell; validar a coleta automática com a plataforma antes de ampliar sua instalação para contexto pós-compra. A URL informada ao GA4 tem somente caminho e UTMs permitidas, sem token, hash, dados pessoais ou IDs de clique. UTMs e click IDs permitidos seguem nos links para atribuição do checkout, sem repassar parâmetros de pagamento.

Os eventos preparados não comprovam configuração de compra, deduplicação entre browser/servidor ou política final de consentimento em produção.
