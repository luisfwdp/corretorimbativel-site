# Validação da migração — preview, não lançamento comercial

Data: 19/10/2026. Aplicação: `next-site`, branch `codex/nextjs-premium-preview`. WordPress/PR #2 são a referência oficial. Sem merge, mudança de DNS ou desativação da hospedagem antiga.

## Entrega

Seis rotas reais com App Router: `/`, `/ebook`, `/manual-juridico`, `/combo`, `/upsell-manual` e `/upsell-ebook`. Conteúdo principal medido no navegador: 1.298 palavras no eBook, 1.479 no Manual e 1.559 no Combo. Os upsells têm 219 e 208 palavras. A homepage permanece uma escolha curta entre os três produtos. Contagem indica preservação de profundidade, não previsão de conversão.

Os sete capítulos do eBook, os sete temas do Manual, os pilares, a autoridade, as FAQs e o exemplo hipotético de comissão estão presentes. Copy revista para retirar frequência sem fonte, proteção presumida da comissão e chancela genérica da jurisprudência. CTAs intermediários presentes em cada landing. Combo explica os dois produtos, R$ 244 separados, R$ 197 juntos e economia de R$ 47 já na abertura. Adicionais mostram R$ 147 + R$ 50 e R$ 97 + R$ 100, ambos totalizando R$ 197.

O arquivo original e a arte do Manual não foram recebidos. A descrição segue o escopo do proprietário e ainda exige conferência com o produto entregue. Não foi criada capa fictícia: há um índice editorial com texto sobre seus focos. Não há pack editável, depoimento, urgência artificial ou garantia nova. A foto, a arte do eBook e a biografia vêm do projeto anterior; a transcrição do eBook fundamenta a biografia.

## Skills aplicadas

frontend-design: aberturas próprias e coleção jurídica. ui-ux-pro-max: escala, reflow, foco e alvos. cro: narrativa completa, comparação e CTAs intermediários. emil-design-eng: motion seletivo e feedback. web-design-guidelines: revisão de imagens, semântica, teclado, indexação e performance. Fontes/repositórios estão no skills-lock do projeto pai; a avaliação do componente 21st.dev está em 21ST-REVIEW.md.

| Antes | Depois | Por quê |
| --- | --- | --- |
| WordPress com CSS/JS legados como referência | Componentes server para conteúdo e pequenas ilhas client | Isolar a migração e reduzir código de interação. |
| Trecho longo entre apresentação e oferta | CTA intermediário por produto | Dar próximo passo após a demonstração de valor. |
| Economia do Combo concentrada na oferta | Economia também na abertura | Facilitar comparação desde o início. |
| Potencial animação de altura do accordion upstream | details/summary com indicador animado | FAQ acessível sem JS, sem relayout animado. |
| Hook Motion consultava preferência apenas na montagem nesta versão | Assinatura de matchMedia e cancelamento no efeito | Responder à mudança de preferência durante a sessão. |

## Testes locais no build final

- Next 16.4.2, React 19.3.1, Motion 14.4.0, Tailwind 4.3.3, Node 24. Build e TypeScript aprovados. ESLint sem avisos/erros. Lockfile versionado; auditoria npm de dependências de produção sem vulnerabilidades reportadas na data.
- `tests/browser.mjs`: **24 combinações**, seis rotas em 1440, 768, 390 e 320px. HTTP 200, imagens carregadas, um H1, canonical, noindex, preços, conteúdo completo, capítulo/tema contado, ausência de cortes e rolagem horizontal. **12 varreduras axe** em desktop/mobile sem violações detectadas nas regras WCAG 2 A/AA e 2.1 A/AA.
- FAQ funcional com JS desativado, skip link/teclado, recusa explícita, texto ampliado a 200%, 404, imagem OG, robots e sitemap sem upsells.
- Homepage → landing preserva UTMs; token e parâmetros de pagamento não são copiados. Âncora de oferta não dispara begin_checkout ou purchase. Checkouts sem confirmação estão indisponíveis.
- `tests/motion.mjs`: revelação seletiva termina, não repete ao revisitar, troca de preferência cancela movimento e hover fica sem transformação em redução de movimento. Correção foi reexecutada com sucesso.
- Duas suítes de configuração (`npm test`): preços, economia e jornadas; filtragem de atribuição; preservação de parâmetros; exclusão de tokens da URL de analytics; rejeição de HTTP/hosts indevidos/credenciais em URL; bloqueio sem verificação/recusa; rejeição de checkout repetido; modo nativo pendente permanece bloqueado. Nenhum pagamento ou abertura de checkout real.
- WordPress, .cpanel.yml e deploy.sh sem diferenças em relação à base da migração (`202edd5`). A homepage de produção ainda responde como WordPress com os três preços. A inspeção pública do HTML não identificou IDs GA4/Meta; é necessário recebê-los ou conferi-los no painel autenticado.

## Navegador na Vercel

O preview é protegido e foi inspecionado com o acesso temporário oficial de compartilhamento. As requisições passam pelo proxy/CA confiáveis do ambiente; não se desabilitou TLS nem a proteção do projeto. O teste `tests/preview-browser.mjs` segue os redirects de autenticação do próprio deployment no fetch autenticado e renderiza os recursos reais no Chromium. Cookies/URL de acesso não são gravados no Git ou nos relatórios.

Seis rotas em desktop 1440×1000 e mobile 390×844, respostas 200, imagens sem quebra, um H1, conteúdo completo, meta noindex, FAQ, recusa e ausência de overflow. **12 varreduras axe hospedadas sem violações detectadas.** Sem erros JavaScript nas navegações registradas. Evidência em `docs/reports/hosted-browser.json` após a validação do deployment final. Capturas completas e de abertura acompanham o pacote de revisão.

## Performance: limites observados

Auditorias Lighthouse locais com build otimizado, emulação mobile/desktop e Chromium. Não são métricas de usuários reais ou da hospedagem Vercel. Os resultados numéricos finais estão em `docs/reports/lighthouse-summary.json`.

Rodada final do eBook após reduzir as fontes locais: mobile 97 em performance, LCP 2,7s, TBT 50ms, CLS 0. Referências anteriores ao último subset das fontes: Manual mobile 92, LCP 3,1s, TBT 130ms, CLS 0; Combo desktop 100, LCP 0,7s, TBT 20ms, CLS 0. As primeiras rodadas do eBook ficaram entre 74 e 79; o resultado final não deve ser interpretado como garantia de estabilidade entre ambientes. Acessibilidade e boas práticas 100 nas três auditorias. SEO 69 porque o preview está intencionalmente bloqueado para indexação. Isso não autoriza remover noindex no ambiente de revisão.

Ainda há espaço de melhoria no tempo de renderização do título no mobile: o LCP local final de 2,7s está acima da referência de 2,5s. A redução de fontes manteve o conjunto necessário ao português e retirou um peso não utilizado. Não declaro aprovação dos Core Web Vitals. Antes de tráfego pago, medir o deployment em condições de rede/dispositivo representativas e ajustar o que os dados mostrarem. O projeto usa imagens locais WebP (eBook ~87KB e autor ~55KB), fontes locais WOFF2 e Motion Mini; não há fonte remota bloqueando o carregamento ou dependência de WordPress para renderizar.

## Comparação visual

As capturas do WordPress/PR #2 e do Next foram colocadas lado a lado em desktop e mobile para as cinco páginas de produto/complemento. Preservados: marca, fontes, paleta, conteúdo, preços e ordem comercial. Mudanças: composição mais ampla, Manual sem capa simulada, ritmo de conteúdo, economia no hero e CTAs intermediários. A comparação demonstra diferenças de apresentação; não comprova aumento de conversão ou equivalência de performance entre plataformas.

## Pendências para aprovação e lançamento

- Aprovação humana das seis páginas e da migração; PR #2 e PR #3 continuam sem merge.
- Arquivo/arte oficial do Manual, versão exata dos materiais entregues e revisão final da biografia pelo autor.
- Cinco ofertas Greenn, destinos de recusa/conclusão e teste real de cobrança, elegibilidade, confirmação e entrega. Upsell nativo demanda código oficial e integração/homologação; no momento o código prepara checkout separado e bloqueia nativo não integrado. Downsell não foi definido.
- IDs corretos de GA4/Meta, consentimento e integração de compra confirmada sem duplicação. Nenhum purchase é disparado pelo frontend.
- Inventário das demais URLs/mídias do WordPress, backup verificado, DNS atual e estratégia de acesso administrativo ao fallback. Aplicar o roteiro em MIGRACAO.md só após aprovação expressa.
- Aparelhos físicos, Safari/VoiceOver e desempenho de campo. A varredura axe não constitui certificação de acessibilidade.
