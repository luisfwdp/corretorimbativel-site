# Tracking

## Configuração

Em **Aparência → Personalizar → Corretor Imbatível — Tracking**:

- **Google Analytics 4 — Measurement ID**: formato `G-XXXXXXXXXX`. Enquanto vazio, o GA4 não é carregado (nenhum ID fictício foi inserido no código).

O script só é impresso no `<head>` quando o campo está preenchido (`functions.php`, função `ci_tracking_head()`), então não há impacto de performance nem chamadas de rede desnecessárias antes da configuração.

Não há integração com Meta Pixel/Conversions API no tema no momento (removida — o Pixel colado anteriormente era de outro produto). `assets/js/main.js` já checa `typeof window.fbq === 'function'` antes de disparar qualquer evento, então religar o Meta Pixel no futuro (quando o Pixel correto do Corretor Imbatível estiver em mãos) é só reintroduzir o snippet de carregamento do `fbq` — os eventos de conversão abaixo já ficam prontos para ele automaticamente, sem precisar editar `main.js`.

## Eventos de conversão implementados

Todos em `assets/js/main.js`, disparados via `gtag('event', ...)` (GA4) quando o script está carregado:

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
