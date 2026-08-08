# Corretor Imbatível — Landing Page

Tema WordPress custom (sem page builders) para a landing page de alta conversão do infoproduto **Corretor Imbatível**, manual jurídico para corretores de imóveis assinado pelo Dr. Rodrigo Barbato Fabbris.

## Objetivo

Converter visitantes de tráfego pago (Meta/Instagram/WhatsApp) em compradores do eBook, com foco mobile-first, performance alta e copy 100% baseada no conteúdo real fornecido — nenhum dado comercial ou jurídico foi inventado (veja `CONTENT-GUIDE.md`).

## Requisitos

- WordPress 6.0+
- PHP 7.4+
- Sem dependência de plugins pagos ou page builders (Elementor/Divi/WPBakery)

## Estrutura

```
wp-content/themes/corretor-imbativel/
├── assets/
│   ├── css/main.css       # Design system completo (mobile-first)
│   ├── js/main.js         # Sticky CTA, FAQ, scroll tracking, UTM passthrough
│   └── images/logo.svg    # Logo recriada a partir da identidade visual enviada
├── template-parts/
│   └── mockup.php         # Mockup do produto (usa imagem enviada ou fallback CSS)
├── inc/
│   └── customizer.php     # Todos os campos editáveis (Aparência → Personalizar)
├── functions.php
├── header.php / footer.php
├── front-page.php         # A landing page em si
├── index.php
└── style.css               # Apenas o cabeçalho do tema (WordPress exige)
```

## Instalação

1. Copie `wp-content/themes/corretor-imbativel` para o `wp-content/themes/` da instalação WordPress.
2. Em **Aparência → Temas**, ative "Corretor Imbatível".
3. Em **Configurações → Leitura**, defina "Sua última publicação" ou uma página estática como home — o template `front-page.php` é carregado automaticamente pelo WordPress na home.
4. Vá em **Aparência → Personalizar** e preencha os campos descritos em `CONTENT-GUIDE.md` (preço, checkout, textos, foto do especialista, tracking).

## Desenvolvimento

Não há build step (sem Node/webpack) — CSS e JS são editados diretamente em `assets/`. Isso mantém o projeto leve e fácil de dar manutenção sem dependências externas.

## Edição de conteúdo

Veja `CONTENT-GUIDE.md` — cobre onde alterar preço, checkout, headline, FAQ, depoimentos e imagens, tudo via **Aparência → Personalizar** (recursos nativos do WordPress, sem plugins pagos).

## Git & Deployment

Veja `DEPLOYMENT.md` para o fluxo completo de deploy via Git no cPanel/HostGator.

## Tracking

Veja `TRACKING.md` para GA4, Meta Pixel e os eventos de conversão implementados.

## Placeholders pendentes

Estes campos precisam ser preenchidos com dados reais antes do lançamento:

- `[GARANTIA]` — deixe o campo "Texto da garantia" vazio no Customizer para a seção continuar oculta até haver uma garantia confirmada.
- `[DEPOIMENTO_01]`, `[DEPOIMENTO_02]`, `[DEPOIMENTO_03]` — preencha o campo "Depoimentos" no Customizer.
- `[FORMA_DE_ENTREGA]`, `[TIPO_DE_ACESSO]` — respostas do FAQ sobre como o produto é entregue e o tipo de acesso; edite via campo "FAQ" no Customizer.
- `[PARCELAMENTO]` — preencha o campo "Texto de parcelamento".
- Logo oficial (`assets/images/logo.svg`) e foto do Dr. Rodrigo foram recriadas/deixadas como placeholder porque os arquivos originais enviados no chat não chegaram como upload de arquivo (apenas o PDF do eBook foi recebido como arquivo). Envie os arquivos originais (logo.png/.svg e foto) e eu troco por upload real via `Aparência → Personalizar → Logo do site` e `Especialista → Foto do Dr. Rodrigo Barbato Fabbris`, sem precisar mexer em código.
- Mockup do eBook: o CSS fallback está ativo; para usar a arte real (a imagem 3D do livro + tablet que você mostrou), envie o arquivo em **Personalizar → Oferta → Mockup do eBook**.
