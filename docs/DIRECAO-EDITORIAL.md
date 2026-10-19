# Direção editorial — landings Corretor Imbatível

Branch: `codex/landing-pages-premium`. Sem deploy ou alteração de configurações comerciais. Homepage preservada.

## Skills aplicadas

Instaladas e verificadas: `anthropics/skills@frontend-design`, `nextlevelbuilder/ui-ux-pro-max-skill@ui-ux-pro-max`, `vercel-labs/agent-skills@web-design-guidelines`, `emilkowalski/skills@emil-design-eng`, `coreyhaines31/marketingskills@cro`. Versões de conteúdo registradas em `skills-lock.json`; arquivos de trabalho locais em `.agents/skills/`, fora do tema publicado.

Frontend-design orienta composição e autocrítica; UI/UX Pro Max apoia medidas de leitura, foco e responsividade; Emil orienta movimento; Web Design Guidelines audita a implementação; CRO organiza argumento, oferta e objeções. Nenhuma skill pode substituir o briefing, alterar preços ou criar prova social.

## Diagnóstico

A home pública responde 200 com três produtos. As cinco URLs de venda retornaram 404 na auditoria; a API pública listou apenas `sample-page`. Templates já existem no Git, mas isso não cria registros no WordPress. Não houve acesso ao banco ou painel de produção.

O eBook contém a narrativa original, que será preservada e ampliada com resultado prático, explicação dos capítulos e exemplo comercial hipotético. Manual e Combo compartilham uma composição curta; precisam de narrativas independentes. Upsells precisam explicar melhor o complemento e oferecer uma recusa visível sem fingir confirmação financeira.

## Tokens e composição

- Marinho profundo `#0F2436`: autoridade e seções de argumento.
- Marinho escuro `#081420`: base institucional.
- Dourado `#C9A227`: ação e pequenos detalhes, não texto corrido sobre branco.
- Dourado claro `#E4C468`: acentos legíveis em fundos escuros.
- Off-white existente `#FBFAF7`: papel e leitura.
- Branco `#FFFFFF`: espaço editorial.
- Playfair Display 600/700 para títulos; Lato 400/700 para leitura e controles.
- Texto de 16–18px; medidas de 60–72 caracteres em desktop; títulos com balanceamento; espaçamento baseado em 8px. Sem novos arquivos de fonte.

### eBook — a publicação e o argumento

Hero com manchete à esquerda e mockup à direita. Conteúdo original completo, dividido por pausas editoriais, blocos claros/escuros e um sumário anotado de sete capítulos. Exemplo de imóvel de R$ 800 mil × 6% = R$ 48 mil explicitamente hipotético, sem promessa de retorno ou proteção garantida da comissão.

### Manual — o cuidado documental

Hero sobre off-white, identificação do produto independente e percurso visual de uma negociação: combinação → formalização → registro. Sete temas do sumário fornecido, com contexto de uso e cuidados. Exemplos são cenários educativos, não cláusulas prontas ou promessa de documentos editáveis. O arquivo real do Manual e sua arte não foram fornecidos; a conferência final permanece pendente.

### Combo — a relação entre os dois materiais

Abertura marinho com os dois produtos. Comparação editorial entre entender o risco e organizar a atuação, seguida dos conteúdos, complementaridade e benefícios. Quadro de valores com soma e economia calculadas das configurações existentes. Sem contagem regressiva ou escassez.

### Upsells — uma decisão simples

Produto complementar, três razões concretas para adicioná-lo, preço, total da jornada e recusa clara. Mecanismo Greenn existente preservado. Código nativo só opera quando fornecido e validado; alternativa informa nova compra. Sem `purchase` em cliques.

## Motion e acessibilidade

Entrada curta em apenas alguns marcos editoriais; conteúdo visível por padrão e sem dependência de JavaScript. Sem parallax, loops, scroll-jacking ou bibliotecas novas. Transform/opacity; feedback de botão entre 120–180ms. Hover apenas para ponteiro fino. Respeitar alteração de `prefers-reduced-motion` em tempo real. FAQ nativo, foco visível, skip link, âncoras e espaço para CTA fixo.

## Revisão do plano contra o briefing

Não usaremos grades de cards repetidos para todos os argumentos. A numeração será reservada aos capítulos e etapas reais. Paleta e tipografia recomendadas automaticamente pela UI/UX Pro Max foram tratadas como referência; a marca existente prevalece. As animações não escondem texto de venda e não afetam a homepage. Nenhuma dependência React, GSAP, Tailwind ou Motion será adicionada.

## Integridade

`front-page.php`, `main.css`, `funnel.css`, `main.js`, links/preços e campos Greenn ficam preservados. As extensões de CSS/JS carregam somente nas cinco páginas. Compararemos a homepage antes/depois por HTML, assets carregados e screenshot em WordPress isolado.
