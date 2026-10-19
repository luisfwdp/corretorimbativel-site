# Revisão final de conteúdo e conversão

Data: 19/10/2026. Branch: `codex/landing-pages-premium`. Código revisado: `57e496b`. Nenhum merge ou deploy realizado. Esta rodada acrescenta relatório e evidências; não altera templates, preços, links de pagamento nem homepage.

**Parecer: páginas completas e visualmente consistentes, com ressalvas de conteúdo e conversão antes da aprovação final. Ainda não estão homologadas para receber tráfego de vendas.** A presença das páginas não comprova funcionamento financeiro.

## Método e skills

- **frontend-design**: inspeção das aberturas, composição editorial, diferenciação dos produtos e coerência com a marca existente.
- **ui-ux-pro-max**: leitura, alvos de interação, hierarquia e reflow; consulta local específica sobre touch/readability e revisão das regras de acessibilidade, performance e entrega.
- **web-design-guidelines**: regras oficiais obtidas novamente nesta rodada; revisão do HTML/CSS/JS, teclado, imagens, foco, zoom e estados indisponíveis.
- **emil-design-eng**: propósito e duração do movimento, feedback, uso de ponteiro fino e respeito à preferência de redução de movimento.
- **cro**: produto e benefício compreensíveis, narrativa, colocação dos CTAs, comparação de valor e objeções. Sem dados de conversão/heatmap, este é um parecer qualitativo, não uma previsão de vendas.

Público: corretores e equipes imobiliárias. Conversão principal: landing → checkout específico Greenn. Origem do tráfego não confirmada; alinhamento com anúncios precisa de revisão por campanha. As duas ofertas complementares pertencem ao pós-compra.

## Resultado por página

| Página | Conteúdo e argumento | Oferta | Parecer |
| --- | --- | --- | --- |
| eBook | 1.271 palavras no main desktop; riscos, identificação, aplicação à rotina, sete capítulos, cinco pilares, autoridade, público, exemplo hipotético e sete FAQs. | R$ 147. Exemplo de R$ 800 mil × 6% = R$ 48 mil corretamente identificado como ilustrativo, sem promessa de retorno. | Completa. Revisar os trechos conclusivos herdados e acrescentar CTA intermediário. |
| Manual | 1.428 palavras; formalização, sete temas, três cenários práticos, contratos/propostas/distratos, comissão, registros, organização, autoridade e seis FAQs. | R$ 97. Diferenciado do eBook. Não oferece pack editável confirmado. | Completa como narrativa; sumário e descrição ainda precisam de confronto com o arquivo real. |
| Combo | 1.515 palavras; dois produtos apresentados separadamente, capítulos, comparação de usos, pilares, benefícios, público e seis FAQs. | R$ 147 + R$ 97 = R$ 244 separados; R$ 197 juntos; economia real de R$ 47. | Complementaridade clara e oferta mais completa. Antecipar a economia na abertura. |
| Upsell Manual | 225 palavras; produto complementar, três benefícios, compra adicional e recusa. | R$ 147 da compra inicial + R$ 50 adicionais = R$ 197 no total. | Valores claros. Não deve ser divulgado como cobrança automática concluída. |
| Upsell eBook | 207 palavras; ampliação do conhecimento, três benefícios, compra adicional e recusa. | R$ 97 da compra inicial + R$ 100 adicionais = R$ 197 no total. | Valores claros. Mesma pendência de integração financeira. |

A contagem considera texto visível no main; não mede qualidade nem conversão. No mobile, o Combo tem rótulos adicionais na comparação para manter o contexto da leitura.

## Correções e refinamentos recomendados

Estas sugestões **não foram aplicadas aos templates nesta rodada**, para manter as capturas e o parecer associados à versão submetida para validação.

| Prioridade | Local | Achado | Correção proposta |
| --- | --- | --- | --- |
| Necessária: precisão de copy | `page-ebook.php:138` | “Na maioria das vezes” introduz uma frequência sem fonte. | “Ele pode começar muito antes: quando uma negociação importante é conduzida sem a formalização adequada.” |
| Necessária: limite da promessa | `page-ebook.php:97` | “Proteja sua comissão ... sem o respaldo de uma equipe jurídica interna” pode sugerir proteção garantida ou substituição de apoio jurídico. | “Compreenda os cuidados com sua comissão e reconheça quando buscar orientação jurídica.” |
| Necessária: precisão de copy | `page-ebook.php:178` | Reconhecimento genérico de práticas pela legislação/jurisprudência não vem acompanhado de referência específica na landing. O texto-fonte aborda jurisprudência, mas não sustenta uma chancela geral. | “A proposta é ampliar seu conhecimento sobre os cuidados jurídicos da intermediação e ajudar a reconhecer situações que exigem orientação individualizada.” |
| Recomendada: benefício concreto | `page-ebook.php:99` | “Reduza riscos jurídicos e conflitos internos” descreve um resultado mais amplo do que a leitura demonstra. | “Revise os cuidados de organização e formalização da equipe.” |
| Alta: conversão | `page-ebook.php:215`, `template-parts/landing-manual.php:conteudo`, `template-parts/landing-combo.php:complementaridade` | CTAs presentes no hero, oferta e fechamento, mas faltam após a demonstração de conteúdo. No desktop, hero→botão da oferta está separado por cerca de 9.565/7.998/9.275px respectivamente. O eBook tem outro botão em identificação, mas ele leva à solução, não à compra. | Inserir uma chamada por página após conteúdo/complementaridade, usando o helper existente e o checkout do próprio produto quando validado. Evitar acrescentar botões a cada bloco. |
| Alta: comparação comercial | `template-parts/landing-combo.php:11` | R$ 197 e os dois produtos aparecem na abertura; a economia de R$ 47 só é explicitada na oferta, mais abaixo. | Acrescentar perto do preço: “Os dois materiais por R$ 197. Economia de R$ 47 em relação à compra separada.” Usar os valores calculados existentes. |
| Necessária: fidelidade do material | `inc/editorial.php:44`, `inc/editorial-content.php:16` | Manual sem arquivo e mockup oficiais. A identidade tipográfica é uma alternativa visual, não evidência da capa real. | Conferir PDF e oferta real; substituir a composição pela arte aprovada ou obter aprovação explícita para mantê-la como identificação editorial. Conferir Manual, Combo e upsell Manual. |
| Recomendada: clareza da oferta | `inc/editorial-content.php:32`, `template-parts/upsell.php:45` | “Não anuncia um pack” soa como nota da implementação; remeter o que está incluído somente ao checkout deixa a objeção parcialmente aberta. | Após confirmar a entrega, dizer exatamente quais arquivos compõem cada oferta. Se só houver leitura, informar diretamente, sem insinuar modelos editáveis. |

Os caminhos da tabela são relativos a `wp-content/themes/corretor-imbativel/`. Não há necessidade de alterar preços, links Greenn ou a estrutura da homepage para esses refinamentos.

## Mockups, placeholders e afirmações

- **eBook:** a imagem é o asset original já utilizado pelo site; aparece no eBook, Combo e upsell eBook. A capa não foi substituída por imagem de outro produto. Isso confirma a procedência no projeto, não uma nova conferência do PDF entregue pela Greenn.
- **Manual:** não há mockup oficial fornecido; a composição de título está visível no Manual, Combo e upsell Manual. Portanto, o requisito de mockups reais dos dois produtos ainda não está integralmente atendido.
- **Autor:** foto e credenciais conferidas contra os assets e a transcrição do eBook no repositório. A transcrição lista a comissão da OAB/PR nas gestões 2016/2019 e 2025/2027. Não houve consulta independente aos registros profissionais. Revisão final do autor continua apropriada.
- Não foram encontrados marcadores de preenchimento, depoimentos fictícios, contadores artificiais ou garantias novas na configuração testada. Existem avisos comerciais reais de indisponibilidade, descritos abaixo.
- As páginas preservam a finalidade educativa e a necessidade de orientação individualizada. As ressalvas da copy do eBook acima impedem atestar que todo o texto já esteja no grau de precisão desejado.
- Campos editáveis de produção podem substituir headline, FAQ, depoimentos e outras informações. A configuração real precisa de conferência: o relatório não valida dados do Customizer aos quais não houve acesso.

## Mobile e interações

Qualidade de tipografia, paleta e leitura preservada; colunas se reorganizam, cenários ficam em sequência e a comparação do Combo mantém os rótulos dos dois materiais. Todas as imagens do main carregaram nos dois tamanhos capturados.

| Antes / estado observado | Depois / conduta recomendada | Por quê |
| --- | --- | --- |
| Revelações seletivas, uma vez, sem esconder conteúdo por padrão | Manter | Movimento apoia a leitura sem criar espera obrigatória. |
| Mockup com deslocamento discreto só em ponteiro fino | Manter | Evita hover persistente no toque. |
| Preferência de movimento reduzido remove movimento decorativo e cancela animações em andamento | Manter | Preserva conforto e acessibilidade. |
| Headlines longas solicitadas; primeiro CTA de aceite dos upsells em y=848px e y=812px no viewport 390×844 | Considerar condensar o espaço anterior ao aceite, preservando preço e aviso de compra | O upsell Manual exige pequena rolagem antes de mostrar o aceite; não é quebra de layout, mas há atrito. Não reduzir fonte do aviso nem esconder recusa. |

O mockup fica abaixo do primeiro bloco textual no mobile. Isso prioriza a leitura e o CTA, mas significa que o produto visual não está inteiramente na primeira tela. É uma escolha revisável, não um erro de responsividade.

## Evidência da nova rodada

- WordPress isolado 6.8/PHP 8.3; cinco páginas renderizadas, não apenas lint dos arquivos.
- Reexecutado `tests/editorial-browser.cjs`: homepage com HTML e pixels idênticos à base em 1440 e 390px; conteúdo completo; 20 combinações de layout em 320, 390, 768 e 1024px; texto a 200%; teclado; FAQ/recusa; redução de movimento e sitemap.
- Axe: zero violações detectadas nas cinco páginas em desktop (1440px) e nas cinco em mobile (390px), regras WCAG 2 A/AA e 2.1 A/AA. Não é certificação nem teste de todos os leitores de tela.
- Novas capturas completas e de abertura: desktop 1440×1000 e mobile 390×844; também detalhes das ofertas. Nenhuma compra foi realizada.
- Evidências: `docs/reports/final-review-layout.json` (texto, posição dos CTAs, imagens e axe mobile) e `docs/reports/final-review-regression.json` (regressão nesta rodada).
- Inspeção visual das aberturas das cinco páginas em desktop/mobile e dos detalhes de oferta, incluindo a comparação do Combo e os adicionais. Capturas completas acompanham a entrega para revisão humana integral.

Limites: emulação Chromium, sem aparelho físico/Safari, plugins de produção ou banco MySQL da hospedagem. As métricas locais anteriores não demonstram Core Web Vitals reais. Não foi feita nova medição de performance de produção nesta rodada.

## Pendências para publicação

1. Resolver os trechos de copy identificados; revisar apresentação com os CTAs intermediários e a economia antecipada do Combo.
2. Receber/conferir o Manual original, descrição exata de entrega e arte oficial. Confirmar a versão do eBook e validar a biografia com o autor.
3. Configurar e homologar **cinco ofertas diferentes** na Greenn: eBook R$ 147, Manual R$ 97, Combo R$ 197, adicional Manual R$ 50, adicional eBook R$ 100. O checkout privado de amigos não deve aparecer publicamente.
4. Decidir e configurar o mecanismo real de pós-compra: embed oficial com contexto/elegibilidade/autorização ou checkout separado claramente identificado como nova compra; configurar os destinos reais de recusa e conclusão. Um link público de adicional com preço reduzido não comprova restrição a compradores: a elegibilidade precisa ser tratada na Greenn.
5. Testar no ambiente apropriado valor efetivamente cobrado, aceite/recusa, confirmação, entrega dos arquivos/acesso, pagamento recusado, reembolso e rastreamento oficial sem `purchase` duplicado. Não remover o bloqueio de venda apenas para fazer os botões parecerem funcionais.
6. Registrar/associar as cinco páginas no WordPress, revisar rascunhos e só publicar com aprovação. Enviar PHP pelo Git não cria os registros. Usar Aparência → Páginas de venda ou o procedimento WP-CLI documentado. A auditoria anterior de produção encontrou cinco 404; essa situação precisa ser conferida após a publicação autorizada.
7. Após aprovação expressa, seguir o fluxo GitHub/cPanel existente com backup e revisão do deploy. Conferir HTTPS, permalinks, indexação das landings, noindex dos upsells, canonical/OG, configuração comercial real, UTMs e fluxo homepage → landing → Greenn. Conferir anúncios específicos apontando para `/ebook/`.
8. Realizar teste final com plugins, consentimento, Safari e aparelhos reais. Downsell não faz parte da implementação e não deve ser apresentado como existente.

**Estado atual dos botões nas capturas:** “CONHECER A OFERTA” leva à seção da oferta porque não há checkout validado no ambiente padrão. “Oferta indisponível no momento” é o bloqueio verdadeiro de pagamento, não um placeholder ou CTA aprovado para lançamento. O aceite do upsell permanece bloqueado. A recusa sem URL real apenas revela instruções locais; ainda não comprova conclusão no provedor.

## Capturas e pacote

Entrega em `/workspace/scratch/revisao-final-corretor/`: cinco HTMLs de prévia, índice, vinte capturas de página/abertura, dez detalhes de oferta e evidência JSON. As prévias não substituem WordPress ou integração Greenn. Os arquivos `*-desktop.png` e `*-mobile.png` são capturas completas; `*-hero.png` mostra a abertura e `*-oferta.png` mostra um viewport na região da oferta.

O ZIP de revisão inclui este relatório e as evidências. As capturas representam o commit revisado, sem aplicar as sugestões desta auditoria e com pagamentos bloqueados. A homepage não foi redesenhada.
