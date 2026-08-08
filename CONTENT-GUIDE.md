# Guia de Edição de Conteúdo

Todo o conteúdo editável fica em **Aparência → Personalizar** no wp-admin. Não é necessário mexer em código para nenhum dos itens abaixo.

## Oferta

Personalizar → **Corretor Imbatível — Oferta**

| Campo | O que controla |
|---|---|
| Nome do produto | Título usado na seção "Produto" e na seção "Oferta" |
| Preço "de" (riscado) | Atualmente `R$ 497,00` |
| Preço "por" | Atualmente `R$ 197,00` |
| Texto de parcelamento | Ex: "em até 12x". Hoje está com o placeholder `[PARCELAMENTO]` |
| Link de checkout (Greenn) | Atualmente `https://payfast.greenn.com.br/123089` |
| Mockup do eBook | Envie a arte oficial (capa + tablet). Enquanto vazio, exibe um mockup CSS |
| Texto da garantia | **Deixe vazio para ocultar a seção de garantia.** Só preencha quando houver garantia confirmada |

## Textos

Personalizar → **Corretor Imbatível — Textos**

| Campo | Onde aparece |
|---|---|
| Hero — eyebrow | Texto pequeno acima da headline |
| Hero — headline | Título principal (H1) |
| Hero — subheadline | Parágrafo abaixo da headline |
| Texto do botão principal | Todos os CTAs "QUERO SER UM CORRETOR IMBATÍVEL" |
| Texto do CTA fixo (mobile) | Barra fixa no rodapé do mobile |
| Depoimentos | Uma linha por depoimento: `Nome \| Cargo \| Depoimento`. Deixe vazio para manter os placeholders `[DEPOIMENTO_01]` etc. |
| FAQ | Uma linha por pergunta: `Pergunta \| Resposta`. Deixe vazio para usar o FAQ padrão (baseado no conteúdo real do eBook) |

## Especialista

Personalizar → **Corretor Imbatível — Especialista**

- **Foto do Dr. Rodrigo Barbato Fabbris**: envie a foto profissional oficial. Enquanto vazio, exibe o placeholder `[FOTO_RODRIGO_FABBRIS]`.
- A bio, credenciais e formação exibidas na seção "Sobre o Especialista" foram extraídas literalmente do capítulo "Sobre o Autor" do eBook enviado — não são editáveis pelo Customizer para evitar divergência com o material oficial. Para alterar, edite diretamente `front-page.php`, seção `#especialista`.

## Tracking

Personalizar → **Corretor Imbatível — Tracking** — veja `TRACKING.md` para detalhes.

## Logo

Aparência → Personalizar → **Identidade do site → Logo**. Envie o arquivo oficial (`logo-corretor-imbativel.svg` ou `.png`) fornecido pelo design — ele substitui automaticamente o SVG de fallback em `assets/images/logo.svg`.

## Seções com conteúdo fixo (não vêm do Customizer)

Estas seções usam texto direto de `front-page.php`, porque são copy estrutural do produto e não dados comerciais que mudam com frequência. Para alterar, edite o arquivo diretamente (com cuidado para manter `esc_html()` em qualquer string dinâmica):

- Seção "A dor" (8 cards de dores da profissão)
- Seção "Identificação" (frases de identificação)
- Seção "O que você vai aprender"
- Seção "Antes x Depois"
- Seção "Para quem é"
- Lista de capítulos na seção "Produto"

## Produtos separados (eBook vs. Kit Jurídico)

O eBook menciona a existência de um **Kit Jurídico Corretor Imbatível** (contratos, propostas, distratos, notificação extrajudicial) como produto complementar vendido separadamente pelo autor. Esta landing page vende **exclusivamente o eBook** — nenhuma menção de venda ao Kit Jurídico foi incluída na oferta.

Para lançar uma página própria do Kit Jurídico no futuro sem misturar as ofertas:

1. Duplique `front-page.php` como `page-kit-juridico.php`.
2. Crie uma página no WordPress com slug `/kit-juridico` e associe o template.
3. Ajuste `ci_product_name`, preço e checkout via um segundo grupo de theme mods (ou hardcode nesse template, já que ele não é a home).
