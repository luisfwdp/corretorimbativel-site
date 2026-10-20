# Copy aprovada — implementação e validação

Data: 20/10/2026. Branch: `codex/copy-aprovada-next`.

## Prévia para avaliação

- URL: https://corretor-imbativel-next-preview-j4kuyocki.vercel.app
- Projeto separado: `corretor-imbativel-next-preview`.
- Equipe: `luisfwdp-2259s-projects`.
- Deployment: `dpl_GEk6yGvY7SmA45RSg42jGkTnWsGp`.
- Estado confirmado: READY. Ambiente preview, `target: null`.
- Commit da aplicação: `69d166ff32931100c486d3a6cfa8d4aa41a92ab3`.
- Build Vercel concluído em aproximadamente 22 segundos, mais implantação dos outputs.
- Proteção Vercel preservada. Para avaliar pelo endereço permanente, entrar com a conta autorizada do proprietário. Links temporários utilizados nos testes não foram versionados nem incluídos nos arquivos de entrega.

As seis rotas estão navegáveis. Não houve merge, promoção a produção, alteração do domínio oficial, DNS ou desativação do WordPress. Commits posteriores de documentação não alteram o código deste deployment.

## Implementado

As três headlines são exatamente as escolhidas pelo proprietário:

- eBook: “Você conhece os riscos jurídicos que podem surgir durante uma negociação imobiliária?”
- Manual: “Na corretagem, o que foi combinado também precisa ser bem documentado.”
- Combo: “Conheça os riscos da corretagem. Entenda os documentos. Prepare-se melhor para negociar.”

Subheadlines identificam imediatamente o produto e sua utilidade. O eBook vende conhecimento jurídico; o Manual concentra documentação; o Combo explica a complementaridade e a economia real. Permanecem sete capítulos do eBook, sete temas do Manual, cinco pilares, exemplos da rotina, autoridade documentada, ofertas e FAQs.

Foram removidas repetições e frases que avaliavam a seriedade do comprador. A autoridade usa somente formação e experiência já documentadas na transcrição do eBook. Exemplos continuam ilustrativos, sem se apresentar como depoimentos ou resultado real de cliente.

Upsells são opcionais, com valor adicional, total da jornada, explicação de nova compra em checkout separado e recusa clara. Receberam três FAQs cada, usando o Accordion existente adaptado de Motion Primitives/21st.dev. Não há simulação de one-click ou cobrança automática. O link “Conheça a coleção” no cabeçalho dos upsells foi corrigido para `/#produtos`.

Preços preservados: eBook R$ 147; Manual R$ 97; Combo R$ 197; soma avulsa R$ 244; economia R$ 47; adicional Manual R$ 50; adicional eBook R$ 100; ambas as jornadas R$ 197.

## Preservação visual e técnica

Sem alterações no CSS, cores, fontes, assets, componente Accordion de origem 21st.dev, componentes de motion ou dependências. As composições editoriais, sumários numerados, exemplos, tabela de complementaridade e comparativo de preços foram reaproveitados. Os cinco pilares do eBook usam a composição já existente no design system.

A homepage manteve texto e estrutura. Código de `app/page.tsx` e CSS idênticos à base. A comparação visual das capturas hospedadas, em desktop/mobile e nas versões completas/primeira dobra, está registrada em `reports/home-comparison.json`.

WordPress, `.cpanel.yml`, `deploy.sh` e lógica de configuração Greenn permaneceram inalterados. Não foram criados links de pagamento ou anunciados documentos editáveis, bônus, prazo de acesso, parcelamento ou garantia comercial não confirmados.

## Onde editar os textos

- `content/sales-copy.json`: primeiras dobras, CTA intermediário, ofertas e encerramentos.
- `content/ebook.json`, `manual-juridico.json` e `combo.json`: narrativa, conteúdo e FAQs.
- `content/upsells.json`: benefícios, introduções e FAQs dos complementos.
- `lib/catalogue.ts`: nomes, preços e rótulos dos CTAs habilitados.
- `components/authority.tsx`: credenciais documentadas do autor.
- `lib/metadata.ts`: descrições específicas; canonical e política de indexação preservados.

`PROPOSTA-COMPLETA.md` foi atualizado com as headlines escolhidas e as subheadlines implementadas. A auditoria anterior permanece como registro da decisão editorial. Os arquivos de conteúdo são dados estruturados estáticos; não dependem de leitura de Markdown em produção.

## Testes realizados

| Verificação | Resultado |
|---|---|
| TypeScript e ESLint | Aprovados |
| Testes existentes de preços, UTMs e configuração de pagamento | Aprovados |
| Build local de produção com Webpack | Aprovado; seis rotas estáticas |
| Build padrão Next.js/Turbopack na Vercel | Aprovado |
| Local: seis rotas em 1440, 768, 390 e 320 px | 24 combinações aprovadas |
| Local: axe WCAG 2 A/AA e 2.1 A/AA em desktop/mobile | 12 verificações, sem violações detectadas |
| Vercel: seis rotas em 1440 e 390 px | 12 combinações aprovadas; capturas reais do deployment |
| Vercel: axe nas mesmas rotas/larguras | 12 verificações, sem violações detectadas |
| JavaScript e imagens nas páginas testadas | Sem erros ou imagens quebradas |
| Texto, CTAs e capítulos | Sem corte/overflow; CTAs intermediários presentes; 7/7/14 itens nos sumários |
| Headline aprovada, âncoras e descrições distintas | Aprovados |
| SEO | Um H1, canonical oficial por rota, metadados e OG; preview noindex; upsells fora do sitemap |
| Teclado e conteúdo sem JavaScript | Skip link, foco e FAQ aprovados |
| Texto ampliado a 200% no cenário mobile testado | Sem transbordamento horizontal |
| Motion | Revelação única; termina; não repete; movimento reduzido cancela e desativa hover |
| Tracking e navegação | Home leva à landing com UTMs; token não propagado; clique em oferta sem checkout não emite checkout/purchase |
| Recusa | Instruções de fallback visíveis; preservação da compra anterior explicitada |

O Turbopack local não pôde abrir um processo/porta interna no sandbox. O build local foi validado com Webpack, sem alterar o comando ou a configuração do projeto; o build padrão funcionou na Vercel. Resultados automatizados de acessibilidade não constituem certificação. Não foi feito teste com leitor de tela humano, dispositivos físicos ou tráfego comercial real. Não foi executada nova medição de Core Web Vitals de campo nesta etapa.

Relatórios desta rodada estão em `reports/`. As capturas entregues no ZIP incluem primeira dobra e página completa, desktop e mobile, para cada uma das seis rotas.

## Estado real dos CTAs

Os cinco checkouts ainda não têm configuração financeira validada. Por isso, o preview conserva “Conhecer a oferta” como navegação interna e “Oferta indisponível no momento” no bloco de pagamento. Não se trata de compra habilitada.

Os rótulos de aceitação preparados para quando as ofertas forem validadas são:

- “Quero acessar o Corretor Imbatível”.
- “Quero acessar o Manual Jurídico”.
- “Quero o Combo Completo”.
- “Adicionar o Manual por R$ 50,00”.
- “Adicionar o eBook por R$ 100,00”.

O fluxo exige URL específica, verificação e, nos complementos, destino de recusa válido. O modo nativo permanece pendente e bloqueado. Nenhum pagamento foi realizado nesta revisão.

## Pendências para lançamento

1. Aprovação da apresentação desta prévia e das quebras das headlines em mobile.
2. Conferência do PDF final e da arte oficial do Manual; o visual atual é um índice editorial, não uma capa fictícia ou arquivo de entrega confirmado.
3. Configurar e homologar as cinco ofertas Greenn: produto, preço, elegibilidade, cobrança, entrega e acesso. Não reutilizar checkout de outro produto.
4. Testar aceite, recusa e conclusão de cada complemento com o mecanismo efetivamente escolhido. Só anunciar integração nativa após validação oficial; a redação atual corresponde a compra separada.
5. Confirmar condições efetivas de acesso, parcelamento e políticas aplicáveis antes de anunciá-las.
6. Configurar e homologar os IDs de GA4/Meta, consentimento e conversão por confirmação real de pagamento, sem duplicidade.
7. Somente após autorização específica: preparar release de produção, revisar indexação das páginas públicas, manter upsells noindex e executar o plano de DNS/rollback em `../MIGRACAO.md`. WordPress permanece como fallback.
