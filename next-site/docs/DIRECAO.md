# Direção antes da implementação

Fonte: WordPress + PR #2, branch-base 202edd5; valores, sumários e identidade são referências oficiais. WordPress e cPanel não são alterados.

Tokens: azul tinta #102737; azul profundo #0b1d2b; dourado #c6a45b; ouro para texto #796023; papel #f8f6f0; cinza texto #495b66. Playfair Display para títulos, Lato para leitura e interface. Valores usam algarismos tabulares.

Conceito: uma coleção de publicações jurídicas para a rotina imobiliária. Conteúdo de leitura, não interface SaaS. Aberturas assimétricas: eBook como publicação em destaque; Manual como roteiro documental sem capa inventada; Combo como conjunto dos dois focos com economia explícita. Homepage curta preserva a escolha de três produtos.

Esquema: header com marca → abertura texto/asset → tensão e contexto → conteúdo anotado → CTA intermediário → uso prático/pilares → autoridade → público → oferta/comparação → FAQ → fechamento.

Revisão contra briefing: não usar tabelas decorativas, numeração sem sequência, gradientes ou repetição de cards. A única repetição de cards serve à comparação dos três produtos na home. Preservar todas as seções das landings; remover apenas exageros e copy ambígua identificados na auditoria. O Manual tem uma identificação textual sem formato de capa/objeto físico enquanto a arte real não chegar.

Motion: poucos marcos com Motion para React e `initial={false}`/conteúdo SSR visível. Feedback de toque e hover CSS, detalhes sem animação de altura, redução de movimento inclusive após carregamento. Sem cursor customizado, parallax ou loops.

UIUX Pro Max consultada por design-system para legal/editorial: aderência à autoridade, preços transparentes, contraste e foco. Sugestões automáticas de EB Garamond/outras cores descartadas em favor da marca aprovada. CRO: CTA por produto em hero/conteúdo/oferta/final; economia do Combo no hero; sem depoimentos ou garantias fabricados. Hipóteses de melhoria precisam de dados após lançamento, não constituem aumento de conversão comprovado.
