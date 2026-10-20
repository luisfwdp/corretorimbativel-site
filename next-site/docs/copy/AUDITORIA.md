# Auditoria de copy — proposta para aprovação

Data: 20/10/2026. Base: `9d83e9f`, branch isolada `codex/proposta-copy-conversao`.

**Diagnóstico B: há voz e argumento comercial reais.** A copy atual usa situações da corretagem, conteúdo detalhado e cautela jurídica. O trabalho é aprofundar a diferenciação e tornar benefícios e decisões mais claros, preservando essa voz.

Nenhum texto do aplicativo foi alterado. A [proposta completa](PROPOSTA-COMPLETA.md) contém as cinco páginas. Os títulos de seção e indicações de posição nesse documento são instruções editoriais; somente os blocos de texto propostos destinam-se ao visitante.

## Skills utilizadas

Instaladas localmente, sem instalação global, a partir de [coreyhaines31/marketingskills](https://github.com/coreyhaines31/marketingskills), licença MIT:

| Skill | Versão lida | Aplicação |
|---|---|---|
| copywriting | 2.3.1 | Proposta de valor, narrativa, headlines e CTAs |
| copy-editing | 2.2.0 | Sete passagens de revisão, consistência e precisão |
| marketing-psychology | 2.0.0 | Identificação, autoridade pertinente, comparação de valores e escolha voluntária |
| cro, já existente | 2.0.3 | Oferta, objeções e clareza do próximo passo |

As três instalações aprovadas estão registradas com origem e hashes no `skills-lock.json`. As instruções instaladas e as referências `ai-tells.md` e `checklist.md` foram lidas. Não havia arquivo de contexto product-marketing no projeto. O briefing e os materiais existentes foram usados como contexto.

## Dez oportunidades prioritárias

Os trechos atuais abaixo são transcrições dos arquivos Next.js, não reconstruções de memória. As propostas são recomendações editoriais; não há teste A/B ou aumento de conversão comprovado.

### 1. Explicar o eBook na primeira dobra, além de mobilizar a preocupação com comissão

**Atual, hero.tsx:** “Sua próxima comissão pode depender do que você faz antes da negociação dar problema.”

**Proposta:** “Entenda os cuidados jurídicos por trás da sua próxima negociação.”

**Complemento:** “O eBook Corretor Imbatível explica direitos, deveres e pontos de atenção da corretagem. Uma leitura para compreender sua atuação, reconhecer riscos e fazer perguntas mais precisas antes de assumir compromissos.”

**Por quê:** conserva o foco preventivo e explicita o aprendizado oferecido. A discussão sobre comissão permanece nas seções de identificação e valor, sem carregar sozinha a promessa principal.

### 2. Encurtar a headline do Manual e colocar o benefício documental em primeiro plano

**Atual, hero.tsx:** “Uma negociação imobiliária pode começar com um aperto de mão. Mas sua segurança profissional não deveria depender apenas disso.”

**Proposta:** “Dê atenção ao que precisa ficar registrado em cada negociação.”

**Por quê:** a leitura no mobile chega mais cedo ao foco do produto. A situação do acordo verbal continua na abertura, com condições, prazos e versões da proposta.

### 3. Mostrar a complementaridade do Combo antes de pedir a compra

**Atual, hero.tsx:** “Conhecimento jurídico para entender os riscos. Orientação prática para organizar suas negociações. Tudo em um único combo.”

**Proposta:** “Entenda os riscos da corretagem e os cuidados com os documentos da negociação.”

**Complemento:** “O Combo Completo reúne o eBook Corretor Imbatível e o Manual Jurídico. Conhecimento sobre a profissão e orientação documental por R$ 197,00, com economia de R$ 47,00 em relação à compra separada.”

**Por quê:** nomeia os dois materiais e traz uma vantagem verificável já na primeira dobra. A comparação de R$ 244,00 com R$ 197,00 continua na oferta, sem preço anterior fictício.

### 4. Transformar a apresentação de conteúdo em situações de uso

**Atual, ebook.json:** “Conheça a importância de registrar propostas, visitas, negociações e acordos.”

**Proposta:** “Relacione visitas, propostas e comunicações ao histórico da intermediação. Assim, você entende por que esses registros merecem atenção ao acompanhar o trabalho realizado.”

**Por quê:** aproxima o tema da consulta e da organização do atendimento. Evita prometer que um conjunto de registros basta para assegurar uma comissão.

### 5. Convidar o público sem julgar quem ainda não comprou

**Atual, ebook.json:** “O Corretor Imbatível foi feito para quem quer levar a profissão a sério.”

**Proposta:** “Para quem precisa tomar decisões além da apresentação do imóvel.”

**Por quê:** identifica a responsabilidade do leitor sem sugerir que a compra é prova de seriedade profissional. Os perfis iniciantes, experientes e gestores recebem razões concretas para ler.

### 6. Trocar o tom de autocontenção interna por uma descrição clara da entrega

**Atual, combo.json:** “A oferta apresenta os dois materiais de leitura. Não anuncia um pack de documentos editáveis como item incluído.”

**Proposta:** “Você recebe dois materiais digitais de leitura: o eBook Corretor Imbatível e o Manual Jurídico para Corretores de Imóveis e Imobiliárias.”

**Por quê:** descreve positivamente a oferta. A limitação sobre editáveis fica respondida com clareza no FAQ e na oferta do Manual, sem ser repetida como argumento central.

### 7. Conectar as credenciais do autor ao assunto que o leitor quer entender

**Atual, authority.tsx:** “Direito e mercado imobiliário na mesma trajetória.”

**Proposta:** “Conteúdo de um advogado que também conhece a atuação do corretor.”

**Por quê:** explica a pertinência da dupla atuação e introduz as credenciais existentes. Mantém o nome, a formação e a experiência documentados; não cria número de clientes, processos ou resultados.

### 8. Dar ao upsell do Manual um benefício e um preço explícitos

**Atual, upsell.tsx:** “Você já garantiu o conhecimento. Agora complemente sua preparação com o Manual Jurídico.”

**Proposta:** “Complemente seu eBook com orientação documental por mais R$ 50,00.”

**Por quê:** a escolha passa a ser compreendida sem procurar o preço em outro bloco. A página explica que os R$ 50,00 são adicionais aos R$ 147,00, totalizando R$ 197,00, e preserva a utilidade do eBook sozinho.

### 9. Explicitar o aprofundamento oferecido no upsell do eBook

**Atual, upsell.tsx:** “Você já tem o Manual Jurídico. Agora amplie seu conhecimento com o Corretor Imbatível.”

**Proposta:** “Aprofunde seu estudo da corretagem com o eBook por mais R$ 100,00.”

**Por quê:** liga o complemento aos direitos, deveres e limites da profissão. Explica adicional de R$ 100,00 sobre R$ 97,00, total de R$ 197,00, sem vender novamente o mesmo foco documental.

### 10. Fazer o botão e a microcopy descreverem o próximo passo real

**Atual, catalogue.ts:** “Sim, quero adicionar o Manual”. **Atual, offers.tsx, sem checkout configurado:** “Conhecer a oferta” e “Oferta indisponível no momento”.

**Proposta para checkout separado validado:** “Adicionar o Manual por R$ 50,00”. Microcopy: “Você seguirá para um checkout separado da Greenn para revisar e autorizar esta nova compra.”

**Por quê:** reduz ambiguidade sobre o preço e a cobrança. O estado atual de indisponibilidade é uma proteção deliberada; deve permanecer enquanto a configuração financeira não estiver validada. Alterar o rótulo não habilita um upsell real.

## O que deve permanecer

Preços, nomes oficiais, estrutura das páginas, conteúdo dos capítulos e cinco pilares editoriais. Permanecem a comparação de valores do Combo, o exemplo matemático expressamente hipotético, os avisos educacionais, a identificação do autor e a recusa sem pressão. A homepage está fora desta revisão.

## Evidências e limites

- Fontes auditadas: `components/hero.tsx`, `authority.tsx`, `offers.tsx`, `upsell.tsx`, `decline.tsx`, `content.tsx`, `lib/catalogue.ts`, `lib/commerce.ts` e os três JSONs em `content/`.
- O eBook tem transcrição disponível em `references/ebook_full_text.txt`; seus sete capítulos e as credenciais usadas foram conferidos nessa fonte.
- O escopo do Manual vem do briefing do proprietário e da implementação aprovada. O PDF final não está disponível para conferência independente. Antes da publicação, o proprietário precisa conferir se a descrição dos sete temas corresponde ao arquivo entregue.
- Não há entrevistas de compradores, relatórios de conversão ou resultados de experimentos fornecidos. As situações são exemplos ilustrativos, nunca depoimentos.
- Os cinco pilares são uma síntese editorial já utilizada no projeto, não uma metodologia com eficácia cientificamente comprovada.
- Nome comercial do eBook contém “Manual Jurídico”; o produto separado também se chama Manual Jurídico. A copy usa rótulos consistentes “eBook” e “Manual” e explica a diferença no FAQ. Não renomeia os produtos.

## Revisão editorial e comercial realizada

Sete passagens: clareza; voz profissional; benefício de cada conteúdo; comprovação; situações específicas; identificação sem alarmismo; expectativas de compra e acesso. A última passagem tratou da redução de dúvidas, nunca de uma promessa de risco jurídico zero.

Revisão interna por quatro perspectivas, conforme copy-editing: conversão (8/10), UX writing (8/10), leitor cético (8/10) e marca (9/10). São autoavaliações editoriais do assistente, sem participantes externos, validação de advogado ou evidência de desempenho. Os ajustes decorrentes foram: explicitar adicional e total nos upsells, remover promessa de padronização de equipe e evitar qualquer alegação de entrega imediata. A aprovação de conteúdo e a conferência do Manual continuam pendentes.

Marketing-psychology aplicado: identificação por tarefas concretas; autoridade pertinente ao conteúdo; comparação com soma real dos preços; escolha voluntária nos complementos. Não foram usados escassez, prova social inventada ou exploração do gasto anterior para pressionar o comprador.

## Pendências antes da implementação/publicação

1. Aprovar esta proposta de copy e a headline escolhida em cada página.
2. Conferir o PDF e a arte oficial do Manual com o escopo descrito. Nenhum mockup fictício foi autorizado como representação definitiva.
3. Validar separadamente os cinco checkouts Greenn, seus valores, entrega, elegibilidade e destinos de aceite/recusa. Não há teste financeiro real concluído nesta etapa.
4. Confirmar condições efetivas de acesso, parcelamento e políticas aplicáveis. Até lá, manter a redação neutra que orienta a conferência no checkout.
5. Após aprovação, implementar somente textos e conferir quebras de linha, overflow, ordem de leitura e CTAs nas cinco páginas, especialmente 320/390 px. Esta auditoria de texto não substitui um novo teste visual depois da implementação.

A aprovação da copy não autoriza merge, deploy em produção ou DNS. O fluxo nativo pós-compra exige configuração oficial da Greenn e teste; a redação preparada nesta entrega corresponde ao checkout separado. Não foi criado downsell.
