# Tracking

## Configuração

Em **Aparência → Personalizar → Corretor Imbatível — Tracking**:

- **Google Analytics 4 — Measurement ID**: formato `G-XXXXXXXXXX`. Enquanto vazio, o GA4 não é carregado (nenhum ID fictício foi inserido no código).
- **Meta Pixel ID**: já vem preenchido com `2257513981770004` (o Pixel configurado para este projeto). Enquanto vazio, o Pixel não é carregado.
- **Meta Conversion API — Access Token**: opcional. Cole aqui o token gerado em *Gerenciador de Eventos do Meta → Configurações → Conversions API → Gerar token de acesso*. **Importante**: esse token é uma credencial sensível (diferente do Pixel ID, que é público) — ele fica salvo apenas no banco de dados do WordPress (tabela de opções), nunca em nenhum arquivo do tema nem no Git. Nunca cole esse valor em `functions.php`, `customizer.php` ou qualquer outro arquivo versionado.

Os scripts só são impressos no `<head>` quando o respectivo campo está preenchido (`functions.php`, função `ci_tracking_head()`), então não há impacto de performance nem chamadas de rede desnecessárias antes da configuração.

## Meta Conversions API (server-side)

Quando **Meta Pixel ID** e **Meta Conversion API — Access Token** estão ambos preenchidos, `functions.php` (`ci_meta_capi_send_pageview()`) envia, a cada carregamento de página, um evento `PageView` diretamente para `graph.facebook.com` — além do Pixel do navegador, sem depender de JavaScript no cliente. Isso melhora a correspondência de eventos (`Event Match Quality`) e reduz perda de dados por bloqueadores de anúncio.

- O evento do navegador (`fbq('track', 'PageView', ...)`) e o evento server-side usam o **mesmo `eventID`** por requisição (`ci_pageview_event_id()`), para que o Meta deduplique os dois automaticamente e não conte a mesma visita duas vezes.
- A chamada ao Graph API é assíncrona/non-blocking (`wp_remote_post` com `blocking => false`), então não atrasa o carregamento da página.
- Só é enviado `PageView`. Os demais eventos (`click_checkout`, `begin_checkout`, `scroll_50/90`, `faq_open`) continuam client-side apenas (ver tabela abaixo).

### Sobre o evento `Purchase`

A compra acontece no checkout da **Greenn** (domínio externo, fora do WordPress), então este tema não tem como disparar `Purchase` nem via Pixel nem via Conversions API — ele não sabe quando/se a compra foi concluída. Para rastrear `Purchase` (essencial para otimização de campanhas), configure o Pixel ID e o token da Conversions API **diretamente no painel da Greenn** (a maioria das plataformas de checkout tem integração nativa com Meta Ads nas configurações de pixels/integrações). Isso garante que o evento de compra real seja enviado no momento certo, com o valor e moeda corretos.

## Eventos de conversão implementados

Todos em `assets/js/main.js`, disparados via `gtag('event', ...)` (GA4) e `fbq('trackCustom', ...)` (Meta Pixel) quando os respectivos scripts estão carregados:

| Evento | Quando dispara |
|---|---|
| `view_landing_page` | Ao carregar a página |
| `click_checkout` | Clique em qualquer CTA (`data-event="click_checkout"`), com parâmetro `cta_location` (`hero`, `oferta`, `sticky`, `cta_final`) |
| `begin_checkout` | Clique no CTA da seção Oferta especificamente |
| `scroll_50` | Usuário rola 50% da página |
| `scroll_90` | Usuário rola 90% da página |
| `faq_open` | Usuário expande uma pergunta do FAQ, com o texto da pergunta |

## UTM passthrough

`main.js` lê `utm_source`, `utm_medium`, `utm_campaign`, `utm_content`, `utm_term` da URL atual e os anexa automaticamente a qualquer CTA cujo `href` seja uma URL absoluta (ou seja, o link de checkout da Greenn), preservando a atribuição da campanha até o checkout.

## Adicionando novos eventos

Use o helper `ciTrack('nome_do_evento', { chave: 'valor' })` já definido em `main.js` — ele cobre GA4 e Meta Pixel automaticamente.
