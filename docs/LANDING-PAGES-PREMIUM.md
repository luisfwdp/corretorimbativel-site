# Landing pages editoriais — implementação para revisão

## Estado

Implementação na branch `codex/landing-pages-premium`, a partir de `7afdc2f`. Não foi feito merge para a branch de produção nem deploy. A autorização anterior de publicação não é utilizada nesta etapa: o pedido atual exige nova aprovação antes de publicar.

A auditoria HTTP confirmou homepage 200 e cinco URLs 404. A API pública listou apenas `sample-page`; a busca pública de mídia por “manual” não retornou itens. Não houve acesso autenticado ao WordPress/HostGator/Greenn. Os testes abaixo utilizam instalações isoladas de WordPress, não o banco de produção.

## Entrega por página

| Página | Estrutura implementada |
| --- | --- |
| `/ebook/` | Hero original, oito riscos, situações de identificação, apresentação do produto, aprendizado, aplicação à rotina, sete capítulos anotados, cinco pilares e comparação de postura, autoridade, público, exemplo hipotético R$ 800 mil × 6% = R$ 48 mil, oferta R$ 147, FAQ e fechamento. Conteúdo original preservado e ampliado. |
| `/manual-juridico/` | Hero solicitado, problemas documentais, importância da formalização, apresentação independente, sete temas comentados, três cenários educativos, contratos/propostas/distratos, comissão e registros, benefícios de organização, autoridade, público, oferta R$ 97, FAQ e fechamento. |
| `/combo/` | Hero solicitado com os dois produtos, relação entre conhecimento e documentação, problemas da rotina, apresentação separada dos produtos, sete capítulos do eBook, sete temas do Manual, comparação de usos, cinco pilares, benefícios, autoridade, público, comparação R$ 244 × R$ 197, economia R$ 47, FAQ e fechamento. |
| `/upsell-manual/` | Hero solicitado, produto complementar, três benefícios, R$ 50, total da jornada R$ 197, explicação do mecanismo de compra e recusa clara. |
| `/upsell-ebook/` | Hero solicitado, produto complementar, três benefícios, R$ 100, total da jornada R$ 197, explicação do mecanismo de compra e recusa clara. |

As três landings têm aproximadamente 1.270–1.515 palavras em configuração padrão de teste; os upsells têm aproximadamente 200–225. Contagem é apenas evidência de profundidade, não indicador de conversão.

O sumário e o escopo do Manual vêm do briefing do proprietário. Não foi recebido o arquivo original nem seu mockup. A conferência com o material real continua necessária; não se deve considerar a descrição uma auditoria do PDF. Não são prometidos modelos editáveis, depoimentos, garantia nova ou resultados jurídicos. Foto e credenciais são reaproveitadas da base e da transcrição original do eBook.

## Direção visual e skills

As cinco skills aprovadas foram instaladas no projeto. `skills-lock.json` registra fontes e hashes; os pacotes locais não entram no tema de produção. [DIRECAO-EDITORIAL.md](DIRECAO-EDITORIAL.md) registra plano e revisão contra o briefing.

- **frontend-design**: eBook como publicação; Manual com percurso documental; Combo com composição dos dois produtos e comparação. Elimina a composição curta compartilhada sem substituir o tema.
- **ui-ux-pro-max**: leitura mobile, medidas de texto, contraste, foco e reflow. A sugestão automática de outras cores/fontes não substituiu a marca.
- **emil-design-eng**: movimento seletivo e feedback de interação. Nenhuma dependência Motion/React/GSAP.
- **web-design-guidelines**: revisão de imagens, heading, teclado, foco, alvos, âncoras e motion. Regras obtidas da fonte oficial durante a implementação.
- **cro**: argumento completo por produto, contexto de uso, valor, objeções e CTAs. Não há promessa de aumento percentual de conversão sem dados reais.

### Motion: revisão aplicada

| Antes | Depois | Motivo |
| --- | --- | --- |
| Tratamento visual quase igual entre produtos | Aberturas e ritmos próprios, com assinatura compartilhada | Diferenciar a escolha sem fragmentar a marca |
| Componentes sem uma sequência editorial de leitura | Sumário anotado, cenários e comparação contextual | Transformar tópicos em um argumento compreensível |
| Movimento genérico disponível no CSS legado | Extensão com poucos marcos, uma vez, 360ms | Evitar entradas repetitivas em cada bloco |
| CTA fixo apenas condicionado ao hero | Também considera oferta, fechamento e foco | Evitar cobertura de conteúdo/controles no mobile |
| Conteúdo potencialmente oculto por entradas | Conteúdo visível por padrão; movimento usa WAAPI | Leitura funciona sem JS e sem animação |
| Hover comum em qualquer dispositivo | Movimento de 3px só com ponteiro fino e sem redução de movimento | Evitar hover preso ao toque e respeitar acessibilidade |

A preferência por movimento reduzido é observada também após o carregamento. Não há loops, parallax, scroll-jacking ou animação de altura/largura. O FAQ usa `details/summary` nativos.

## Integridade da homepage e da infraestrutura

Os arquivos `front-page.php`, `main.css`, `funnel.css`, `main.js`, `inc/funnel.php`, `header.php` e `footer.php` ficaram idênticos ao commit base. O catálogo, os preços, os checkouts e a lógica financeira não foram alterados. Também permanecem intactos `.cpanel.yml`, `deploy.sh`, uploads, plugins e configurações sensíveis.

Os novos CSS/JS são enfileirados apenas quando o contexto corresponde a uma das cinco páginas; não carregam na home. No WordPress isolado, a homepage anterior e a nova tiveram HTML do body e screenshots idênticos em 1440px e 390px, com as mesmas configurações e normalização apenas da origem localhost.

O `functions.php` passou a carregar a extensão editorial e o utilitário de páginas. Não existe execução automática que crie páginas, altere checkouts ou escreva opções da home ao ativar/carregar o tema.

## Checkouts e upsells

Campos e mecanismos existentes preservados. Se um checkout real estiver configurado e validado, os CTAs usam o mesmo helper e os mesmos eventos por produto.

Enquanto faltar configuração, o CTA principal das landings navega para a oferta da própria página; não dispara `begin_checkout`. A oferta mostra o estado real de indisponibilidade do pagamento. Nenhum checkout fictício foi adicionado ao tema.

Nos upsells, o aceite continua bloqueado até a configuração necessária. Quando o destino de recusa estiver preenchido, o link segue esse destino. Sem ele, há botão explícito de recusa que revela instruções para fechar a página e consultar a compra inicial. Esse fallback não finge conclusão na Greenn nem cancela compras.

O código nativo oficial da Greenn continua sob a configuração já existente, sem alteração dos atributos gerados e sem múltiplas cópias do embed na página. Na alternativa de checkout separado, a página informa que se trata de nova compra. `purchase` não é disparado por nenhum dos novos scripts.

Os cinco checkouts/ofertas, o código nativo, o token, a autorização, as condições, a entrega e o destino pós-compra continuam dependendo da conta real. URLs `example.invalid` só são usadas em fixtures locais de testes, nunca como configuração pública.

## Páginas WordPress: resolver os 404

A atualização dos arquivos não cria registros no banco. Há agora duas formas explícitas de preparar as páginas:

### Pelo painel, sem Terminal

Depois da aprovação e atualização do tema:

1. Abrir **Aparência → Páginas de venda**.
2. Conferir as cinco URLs, templates e estados apresentados. A abertura da tela é somente leitura.
3. Clicar **Criar rascunhos e associar templates**. A ação exige usuário com `manage_options`, requisição POST e nonce válido.
4. Revisar cada página no editor e publicar as aprovadas. Os registros novos são rascunhos; o botão de preparação não publica.
5. Conferir permalinks, URLs públicas, configurações comerciais e entrega antes de enviar tráfego.

O procedimento detecta conteúdo existente, template conflitante, página na lixeira e slugs reservados como home/blog antes de iniciar escritas. Não apaga conteúdo nem força a substituição. Se houver conflito, a tela o apresenta para revisão manual. Repetir não duplica páginas.

### Por WP-CLI

```bash
wp --path=/caminho/wordpress eval-file /caminho/repositorio/tools/register-funnel-pages.php
wp --path=/caminho/wordpress eval-file /caminho/repositorio/tools/register-funnel-pages.php apply
```

O primeiro comando simula; o segundo cria rascunhos e associa templates. `apply publish` continua disponível para criação de páginas novas em ambiente autorizado; não muda o status das existentes. O comando e o painel compartilham a mesma implementação. Soft flush apenas; não alteram a estrutura de permalinks ou `.htaccess`.

## Testes realizados

- PHP: lint de todo o tema e procedimentos; execução em WordPress 6.8/PHP 8.3 e 7.4.
- JS: `node --check`; nenhum erro JavaScript nas navegações testadas.
- Regressão: seis rotas × quatro viewports, 24 combinações (1440, 820, 375 e 320px), preços, CTAs, canonical único, descrição, FAQ, UTMs, imagens e sitemap.
- Narrativas: cinco páginas completas; capítulos/temas contados; exemplo de comissão e economia corretos; nenhum marcador visível.
- Design adicional: 20 combinações de viewport para as cinco páginas, incluindo orientação landscape; texto a 200% sem rolagem horizontal nem corte dos blocos de texto.
- Acessibilidade: axe com regras WCAG 2 A/AA e 2.1 A/AA, sem violações nas cinco páginas em desktop; teclado, skip link, FAQ sem JS, recusa e movimento reduzido testados separadamente. Uma varredura automatizada não equivale a certificação de acessibilidade.
- Motion: entrada seletiva ocorre uma vez e termina; troca da preferência cancela movimento; hover do mockup desativado em redução de movimento.
- Performance local: CLS abaixo de 0,1 nas cinco páginas, em teste com imagens verificadas e proxy de fontes. Os valores de LCP locais não comprovam desempenho de produção. A extensão adiciona aproximadamente 6,7KB gzip de CSS + JS; nenhuma biblioteca no navegador.
- Compra simulada: cinco URLs reservadas de teste, preço/ID do produto nos eventos, UTMs e parâmetros preservados, navegação interna distinguida de checkout, um `begin_checkout` por clique, sem `purchase`, recusa e CTA fixo sem cobrir foco.
- Registro: simulação, repetição idempotente, bloqueio por conteúdo/home, criação em rascunho, preservação de status, associação de templates e noindex dos upsells.
- Administração: login na instalação descartável, GET sem mutações, rejeição de nonce ausente, associação explícita sem duplicações e rejeição de usuário anônimo.
- Homepage: comparação de arquivos, HTML e pixels nos dois tamanhos citados.

Relatórios e screenshots foram gerados fora do tema. Os testes usam SQLite do Playground, não MySQL/cPanel, e emulação de viewport, não inspeção em aparelhos físicos.

## Prévia e reprodução

O pacote de revisão contém `index.html`, cinco páginas HTML interativas e capturas completas/hero em desktop e mobile. Não é um deploy e não cria páginas WordPress. As imagens reais do eBook e do autor são cópias verificadas por HTTPS; o Manual permanece com identificação tipográfica. Google Fonts depende de internet na prévia portátil.

Executar testes conforme [tests/VALIDACAO.md](../tests/VALIDACAO.md). Os novos scripts são `editorial-browser.cjs`, `admin-pages.cjs`, `motion-performance.cjs`, `registration.php` e `export-preview.cjs`. Dependências de teste ficam fora do tema: Playwright, axe e WordPress Playground.

## Publicação — somente após nova aprovação

1. Revisar o PR e as prévias; conferir o Manual original e a arte oficial; configurar/validar as ofertas reais.
2. Após aprovação, integrar a branch ao fluxo já utilizado no GitHub/cPanel. Fazer backup e comparação dos arquivos da hospedagem; o rsync existente usa `--delete` dentro do tema.
3. Aplicar o tema e preparar as páginas pelo painel ou WP-CLI. Revisar e publicar os cinco registros. Não alterar a homepage.
4. Conferir os cinco endereços em produção, condições reais, entrega, upsells, pixels/consentimento, SEO e campanhas. Só considerar o fluxo financeiro homologado após teste no ambiente apropriado.

Não há acesso autenticado à hospedagem ou à Greenn nesta entrega. A criação/publicação dos registros de produção, os materiais do Manual e os testes financeiros são pendências explícitas. As páginas foram renderizadas e testadas no WordPress isolado, não apenas verificadas como arquivos PHP.
