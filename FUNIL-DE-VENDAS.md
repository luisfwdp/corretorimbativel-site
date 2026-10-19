# Ecossistema de vendas — Corretor Imbatível

## Estado da entrega

Implementação para revisão na branch `codex/ecossistema-vendas`, baseada em `b22da7bd33d466267a8c26d749fb53c522c23497` do repositório https://github.com/luisfwdp/corretorimbativel-site. Nenhum deploy, compra, configuração da conta Greenn ou alteração no banco de produção foi realizado. Este documento prevalece sobre instruções antigas de preços e publicação.

As páginas e os mecanismos estão preparados. As vendas e os upsells **não estão homologados**. Sem um checkout configurado e a validação marcada, a página exibe “Oferta indisponível no momento”, sem link falso. Não publicar a mudança da home antes de completar a configuração comercial e a revisão visual.

## Auditoria — 19/10/2026

- Tema existente: `wp-content/themes/corretor-imbativel`, PHP 7.4+, sem build ou page builder. A landing editorial de `front-page.php` foi preservada em `page-ebook.php`; seus blocos de autoridade, oferta e FAQ passaram a componentes comuns.
- Foram lidos `README.md`, `DEPLOYMENT.md`, `TRACKING.md`, `CONTENT-GUIDE.md`, bootstrap, header, footer, Customizer, templates, CSS/JS, `.cpanel.yml`, `deploy.sh` e `references/ebook_full_text.txt`.
- `LANDING-PAGE-REDESIGN.md` é citado no tema anterior, mas não existe na árvore auditada. Nenhum `AGENTS.md` encontrado no repositório.
- A home pública respondeu HTTPS 200 e exibia R$ 97,00 com R$ 397,00 riscado. O preço anterior foi retirado da renderização; não há comprovação comercial para mantê-lo. Os valores legados no banco são preservados, mas não determinam o novo preço público.
- Checkout existente confirmado no HTML público e no código anterior: `https://payfast.greenn.com.br/123089`. A página do checkout respondeu, mas isso **não comprova produto, oferta, preço, cobrança ou entrega**. Não foi reutilizado nas novas configurações.
- Uploads identificados no HTML público (não foram modificados): logo `/wp-content/uploads/2026/08/cropped-Untitled-design-2.png`; mockup eBook `/wp-content/uploads/2026/08/ChatGPT-Image-8-de-ago.-de-2026-11_27_31.png`; foto `/wp-content/uploads/2026/08/Untitled-design-1.png`. Todos no domínio oficial. Os campos existentes continuam a fornecer essas imagens.
- O repositório contém apenas o SVG de fallback e a transcrição do eBook. Não contém o Manual separado, sua capa ou pack de documentos. O sumário do Manual foi preparado a partir do briefing, **ainda deve ser conferido com o arquivo real**. Não anunciamos documentos editáveis como itens incluídos.
- Enquanto faltar mockup do Manual, é exibida identificação tipográfica do produto, sem reutilizar a capa do eBook. A composição do Combo recebe automaticamente as duas artes quando configuradas. O mockup real do Manual e a composição final são pendências de aprovação visual.
- O GA4 existente é preservado. O último commit da base removeu Meta Pixel/CAPI porque pertenciam a outro produto. Nenhum Pixel antigo foi reativado; os eventos continuam compatíveis com `fbq` caso instalado corretamente por outra integração.
- A API pública de páginas retornou apenas `sample-page` na consulta inicial. Isso não informa rascunhos, páginas privadas nem todas as configurações do WordPress. O script faz nova verificação no banco alvo.
- O README informa aquisição por Meta/Instagram/WhatsApp. Não houve acesso às contas de anúncios, relatórios de campanha ou logs; não é possível enumerar anúncios ativos apontando à raiz. Atualizar campanhas específicas do eBook para `/ebook/` preservando UTMs. A raiz continua acessível, sem redirecionamento automático.
- `.cpanel.yml` aponta a `/home1/trendm93/corretorimbativel.com.br` e sincroniza apenas o tema com `rsync --delete`. `deploy.sh` recebe o destino como argumento e também usa `--delete`. Não há workflow GitHub Actions no repositório. O cPanel não foi acessado; branch efetivamente acompanhada, cron, webhook e alterações locais precisam ser conferidos antes de publicar. A branch padrão do GitHub é `claude/corretor-imbativel-landing-vbkg56`, diferente de `main` citada na documentação antiga.

## Páginas, produtos e preços

Domínio único: https://corretorimbativel.com.br. Nenhum subdomínio novo.

| URL | Template | Oferta |
| --- | --- | --- |
| `/` | `front-page.php` | Escolha entre os três produtos, Combo em destaque |
| `/ebook/` | `page-ebook.php` | Corretor Imbatível — Manual Jurídico para Corretores de Imóveis — R$ 147,00 |
| `/manual-juridico/` | `page-manual-juridico.php` | Manual Jurídico para Corretores de Imóveis e Imobiliárias — R$ 97,00 |
| `/combo/` | `page-combo.php` | Corretor Imbatível — Combo Completo — R$ 197,00 |
| `/upsell-manual/` | `page-upsell-manual.php` | Complemento Manual — R$ 50,00; jornada R$ 197,00 |
| `/upsell-ebook/` | `page-upsell-ebook.php` | Complemento eBook — R$ 100,00; jornada R$ 197,00 |

Combo: eBook R$ 147 + Manual R$ 97 = R$ 244; Combo R$ 197; economia R$ 47. A comparação e os totais são calculados a partir das configurações, evitando valores de economia desatualizados.

Há apenas uma home curta; as páginas comerciais têm H1 próprio, FAQ, autoridade, oferta e CTA final. O Combo também apresenta os cinco pilares da landing existente: Formalização, Organização, Registro, Conhecimento e Prevenção. O conteúdo educativo não promete resultados jurídicos garantidos.

## Campos editáveis

Aparência → Personalizar → **Vendas — [produto]**. Os cinco grupos usam chaves `ci_sales_{slug}_{campo}`.

| Campo | Uso |
| --- | --- |
| `name`, `card_title`, `summary`, `cta` | Nome, título curto do card na home, texto da oferta e botão |
| `price` | Preço numérico em reais, sem `R$` e sem separador de milhar; exemplo `147.00` |
| `checkout` | URL HTTPS específica do produto/oferta; vazio por padrão |
| `verified` | Marcar somente após confirmar produto, preço, entrega e fluxo do checkout |
| `installment`, `guarantee` | Condições confirmadas; vazias por padrão, sem promessa inventada |
| `image` | Mockup oficial do eBook ou Manual; Combo compõe os dois |
| `decline` | Somente upsells: destino real de conclusão/recusa, fornecido/configurado no fluxo Greenn |
| `mode` | Somente upsells: `separate` (padrão, nova compra) ou `native` (código oficial) |
| `embed` | Somente upsells: código completo gerado pela Greenn; editável apenas por administrador com `unfiltered_html` |

Todos os campos antigos permanecem registrados e os valores do banco são preservados. Nome, mockup, parcelamento sem marcador e garantia do eBook podem aproveitar o campo legado quando não existe configuração nova. Headline, subheadline, FAQ, depoimentos, autor e logo existentes continuam em uso. Os novos preços têm campos próprios para impedir que o antigo preço promocional de R$ 97 reapareça no eBook. Os CTAs novos seguem o texto oficial solicitado.

O checkout legado `ci_checkout_url` fica preservado para auditoria, sem uso comercial automático. O campo privado `ci_sales_friends_checkout` existe na seção Oferta, mas **nenhum template, metadado ou objeto JavaScript o lê**. A oferta de amigos de R$ 97 deve circular somente por link direto. Não enviar o link privado nesta documentação pública.

Política de privacidade usa a página configurada no WordPress; Termos usam `ci_terms_url`. Links vazios não são renderizados. Foto ausente recebe monograma; depoimentos vazios ficam ocultos. Não há marcadores de parcelamento, foto ou depoimentos visíveis por padrão.

## Checkouts e fluxos

| Oferta | Valor esperado | Checkout novo |
| --- | --- | --- |
| eBook público | R$ 147 | Pendente de confirmação |
| Manual público | R$ 97 | Pendente de confirmação |
| Combo público | R$ 197 | Pendente de confirmação |
| Manual complementar | R$ 50 | Pendente de confirmação / código oficial |
| eBook complementar | R$ 100 | Pendente de confirmação / código oficial |
| eBook para amigos | R$ 97 | Privado, fora das páginas públicas |

Fluxos previstos:

1. Home → eBook → checkout R$ 147 → pagamento confirmado pela Greenn → `/upsell-manual/` → aceite R$ 50 ou recusa → conclusão e acesso aos materiais comprados.
2. Home → Manual → checkout R$ 97 → pagamento confirmado → `/upsell-ebook/` → aceite R$ 100 ou recusa → conclusão e acesso.
3. Home → Combo → checkout R$ 197 → confirmação → entrega dos dois produtos.

O tema não configura a conta Greenn e não libera arquivos ou acesso. Produtos, ofertas, condições, entrega, destino após a compra e destinos de recusa precisam ser configurados na plataforma. Para PIX/boleto, verificar em que momento há redirecionamento e impedir oferta financeira nativa antes da confirmação exigida pela Greenn.

## Greenn: recursos oficiais verificados

Documentação consultada em 19/10/2026:

- [Criando um Upsell na Greenn](https://ajuda.greenn.com.br/pt-br/article/criando-um-upsell-na-greenn-78muq1/), atualizado em 24/09/2026: Produtos → Checkouts → Upsell → Criar Upsell; selecionar produto e oferta. Há botão de não comprar, método alternativo, página de obrigado e modal de confirmação. Para página externa, copiar **Código na minha página** completo e apontar a página de obrigado do produto principal para a URL externa. A Greenn acrescenta informações necessárias; preservar `token` na chegada e os atributos gerados `data-greenn-upsell` e `data-greenn-one-click`. Sem compra anterior o upsell não fica disponível.
- [Criando uma página de Upsell na Greenn](https://ajuda.greenn.com.br/pt-br/article/criando-uma-pagina-de-upsell-na-greenn-1vxd6j/), atualizado em 11/09/2026: alternativa de página hospedada na própria plataforma, com link gerado e editor. O projeto mantém as páginas WordPress solicitadas; não usa contagem regressiva ou escassez artificial.
- [Adicionando uma Página de Obrigado 2.0](https://ajuda.greenn.com.br/pt-br/article/adicionando-uma-pagina-de-obrigado-20-n19q1/), atualizado em 17/10/2026: produto → Venda Mais → Montar meu funil de venda → link externo; permite diferenciar destinos por método de pagamento. A interface da conta deve ser conferida porque os artigos descrevem caminhos diferentes.
- [Documentação Webhook — Greenn](https://ajuda.greenn.com.br/pt-br/article/documentacao-webhook-greenn-cbbxsl/): eventos `saleUpdated` com `currentStatus`, incluindo `paid`, `refused`, `refunded`, `chargedback`, `waiting_payment`, e identificação da venda/produto. A autenticação e entrega efetivas precisam ser confirmadas na configuração atual da conta.

### Modo nativo (preparado, não homologado)

Criar as ofertas de R$ 50 e R$ 100, gerar cada código oficial e configurar o modal de confirmação. Colar o código completo no grupo correspondente do Customizer, definir modo nativo e destino real de recusa. Esse campo é código executável de fornecedor, restrito a administradores com `unfiltered_html`; não recebe dados da URL nem de visitantes. Não preencher com script inventado ou de terceiros. O tema renderiza o código exatamente como salvo; cobrança, token, confirmação e entrega pertencem ao mecanismo oficial. Nenhum atributo da Greenn é reconstruído. Manter a URL de entrada sem redirecionamentos que descartem o token. Não há proteção de elegibilidade própria: a Greenn deve validá-la no servidor.

Testar uma compra pelo fluxo original (a documentação aceita cupom de 100% para verificar contexto, mas isso sozinho não confirma uma cobrança paga), verificar botão, confirmação, valor, entrega, recusa, expiração/ausência de token e cada método de pagamento. Só então marcar a validação. O tema não afirma que uma visita é uma compra e não implementa cobrança automática própria.

### Modo separado (alternativa preparada)

Padrão enquanto não há código nativo. Exibe expressamente “nova compra, em checkout separado”. O botão aponta ao checkout específico após validação; o cliente autoriza outro pagamento. O complemento e a entrega precisam ser configurados com os valores próprios; não usar o checkout público do Manual de R$ 97 na oferta de R$ 50 nem o eBook de R$ 147 na de R$ 100. A recusa usa o destino real configurado, sem simular conclusão. Sem destino, a aceitação fica desabilitada e a página orienta consultar a compra inicial.

## Tracking e SEO

GA4 já configurado no site continua carregando pelo campo `ci_ga4_id`. `fbq` só é chamado se já existir uma instalação correta. Não há IDs ou tokens novos no repositório.

| Evento | Gatilho |
| --- | --- |
| `view_landing_page` | Carregamento, preservado |
| `view_item` | Página de produto com ID, nome, BRL e preço |
| `select_item` | Escolha de produto na home |
| `begin_checkout` | Clique real em checkout configurado, inclusive CTA hero/final/sticky |
| `click_checkout` | Mesmo clique, evento legado preservado |
| `view_promotion` | Visualização de página de oferta complementar; não comprova compra prévia |
| `select_promotion` | Clique no aceite complementar ou botão oficial identificado; significa intenção, não cobrança confirmada |
| `faq_open`, `scroll_50`, `scroll_90` | Interações existentes |

Não há emissor de `purchase` no tema. Não usar parâmetros da URL, abertura de upsell ou clique para comprovar pagamento. Para conversão real, escolher integração oficial da Greenn ou backend autenticado que confira venda paga, produto, valor e identidade do evento; deduplicar por ID da transação e produto antes de enviar GA4/Meta. Não foi criado endpoint de webhook sem conhecer seu mecanismo de autenticação. O controle de consentimento do WordPress e de seus plugins deve ser revisado na homologação com os pixels corretos.

As cinco UTMs passam da home à landing e ao checkout, preservando os outros parâmetros do destino. Não se copiam dados de cartão, tokens de pagamento ou dados pessoais da URL para links ou eventos. No modo nativo, o token deve permanecer na URL atual para o script oficial; o carregador GA4 do tema remove `token` de `page_location` sem alterar a URL real; configurar também quaisquer coletores externos para não armazenar esse token.

Títulos, descrições, canonical e Open Graph usam o contexto de cada página. Imagem OG só é incluída se configurada; nenhuma imagem inexistente é anunciada. Se Yoast/Rank Math/AIOSEO estiverem ativos, eles assumem metadados: configurar e conferir seus campos para evitar duplicação. Upsells recebem `noindex,nofollow`, exclusão do sitemap nativo e metadados de noindex para Yoast/Rank Math pelo procedimento WP-CLI. Conferir sitemaps de outros plugins. `noindex` não é controle de acesso.

## Registro seguro das páginas

Enviar PHP pelo Git não cria páginas no banco. O arquivo `tools/register-funnel-pages.php` é executado manualmente via WP-CLI, a partir do checkout do repositório. Não é carregado pelo tema nem expõe endpoint público.

No clone de homologação, com tema ativo:

```bash
wp --path=/caminho/wordpress eval-file /caminho/repositorio/tools/register-funnel-pages.php
wp --path=/caminho/wordpress eval-file /caminho/repositorio/tools/register-funnel-pages.php apply
```

O primeiro comando apenas descreve o plano; o segundo cria rascunhos. Depois, revisar cada página no painel e publicar quando aprovada. Para um banco de homologação vazio, `apply publish` cria as páginas novas já publicadas. O argumento `publish` **não muda o status de páginas já existentes**. A repetição não duplica páginas nem altera títulos, conteúdo ou status existentes.

Há preflight de todos os slugs/templates; conteúdo existente, template conflitante, lixeira ou associação como home/blog interrompem o procedimento antes das escritas. Em falhas operacionais durante a escrita pode haver criação parcial: corrigir o erro e repetir, pois os registros já criados são reaproveitados. Não há transação que prometa atomicidade.

A home usa a hierarquia `front-page.php` e não exige um novo registro. As demais páginas têm tanto nome reconhecido por slug quanto `Template Name` registrado e associação `_wp_page_template`. Não alteramos `show_on_front`, `page_on_front` nem conteúdo antigo da home. Se houver uma página de posts configurada em um slug de produto, resolver o conflito antes do registro.

Se não houver WP-CLI, criar no painel os cinco slugs exatos, selecionar seus templates e revisar antes de publicar. Em Configurações → Links permanentes, manter a estrutura amigável existente; se estiver em modo simples, selecionar Nome do post após revisão do impacto em URLs antigas. O script só faz soft flush, sem editar `.htaccess`. Conferir rewrite do Apache, HTTPS, `home`/`siteurl` e certificados no servidor.

## Deploy e retorno

1. Revisar o PR e a branch no GitHub. Não fazer merge/publicação antes de configurar e testar as ofertas.
2. No cPanel, confirmar checkout, branch acompanhada e se existe cron/webhook externo. Não apontar publicação automática para a branch de trabalho.
3. Fazer backup do tema instalado (incluindo arquivos não versionados) e snapshot do banco com theme mods, páginas e opções. `rsync --delete` pode remover alterações feitas diretamente no tema; comparar antes. Uploads e configurações sensíveis ficam fora da sincronização.
4. Criar homologação isolada, instalar a mesma base WordPress/plugins, copiar as configurações autorizadas e aplicar a branch somente nela. Não substituir o tema por outro. O formulário de consentimento também precisa ser testado.
5. Rodar a simulação WP-CLI, registrar páginas em rascunho, validar artes, conteúdo do Manual, preços, checkouts, entrega, recusa e tracking. Preparar os metadados do plugin SEO, se existir.
6. Após aprovação da revisão, integrar a branch no fluxo de publicação realmente utilizado. Antes de copiar, executar `rsync -avn --delete` entre a pasta do tema do checkout e a pasta do tema do domínio e revisar a lista. O `.cpanel.yml` existente faz o deploy diretamente, sem dry-run nem backup próprio.
7. Sincronizar somente `wp-content/themes/corretor-imbativel/` pelo mecanismo revisado; executar o script de páginas separadamente. Publicar as páginas aprovadas, conferir permalinks, limpar caches e atualizar anúncios do eBook para `/ebook/`.
8. Conferir todas as URLs públicas em desktop/tablet/mobile e repetir o fluxo Greenn controlado, incluindo entrega e pós-compra. Só liberar tráfego após a homologação.

Para retorno: restaurar o backup do tema ou o commit anterior pelo mesmo fluxo revisado. Reverter arquivos não remove páginas ou configurações do banco: identificar os IDs criados nesta publicação e retorná-los a rascunho pelo painel, sem apagar páginas antigas. Restaurar configurações pelo snapshot se necessário. Não houve escrita automática no banco de produção nesta entrega.

O script de deploy anterior usa `set -e`, mas isso não oferece troca atômica de pasta: uma falha de rsync pode deixar uma cópia parcial. Por isso backup, comparação e conferência posterior são necessários. Não foram alterados `wp-config.php`, `.env`, uploads, credenciais, `.cpanel.yml` ou o banco de produção.

## Validação e pendências

Resultados técnicos desta branch são registrados em `tests/VALIDACAO.md`. Testes de interface com URLs de teste não comprovam funcionamento financeiro.

Antes da publicação faltam: cinco links/ofertas confirmados (e link privado mantido fora da divulgação); código nativo se escolhido; destinos de recusa e pós-compra; conferência do Manual real; mockup oficial do Manual e composição visual final; condições de parcelamento/garantia se anunciadas; entrega dos materiais; pixels/consentimento; homologação de cobrança, reembolso e deduplicação de conversões; revisão das campanhas; confirmação do mecanismo cPanel e aprovação da publicação.
