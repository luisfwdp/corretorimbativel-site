# Prontidão comercial e plano de lançamento

Auditoria iniciada em 20/10/2026 e atualizada em 21/10/2026, horário de Brasília. Release configurado no commit `785407f`, branch `codex/greenn-checkouts`, com revisão no PR #5. Copy, design, produtos e publicação foram aprovados pelo responsável.

**Conclusão atual:** os três produtos públicos e o build de produção estão ativos e validados na Vercel. O domínio oficial já foi associado ao projeto, mas o DNS autoritativo continua apontando a web para a HostGator. Os dois complementos foram recriados como produtos independentes, ativos e aprovados, sem upsell próprio. As páginas nativas estão ligadas apenas aos produtos principais, eliminando o ciclo entre complementos.

## Evidências e limites desta auditoria

- Código Next.js: `.env.example`, `lib/commerce.ts`, `components/tracking.tsx`, `navigation.tsx`, `decline.tsx`, `app/layout.tsx`, metadados e documentos de migração.
- Projeto Vercel `corretor-imbativel-next-preview`, ID `prj_OroF7tfTxDA3GljRKjuszK0ovmcf`, equipe `luisfwdp-2259s-projects`: variáveis comerciais de produção configuradas; analytics mantido desativado; complementos mantidos como não verificados.
- Produção READY: https://corretor-imbativel-next-preview-ensqw4lch.vercel.app . `corretorimbativel.com.br` e `www.corretorimbativel.com.br` estão associados ao projeto; `www` redireciona permanentemente para a raiz. O DNS externo ainda não foi alterado.
- DNS público consultado por Google e confirmado nos registros críticos por Cloudflare. Respostas e horários em `evidencias/`. Consultas públicas não equivalem a exportação integral da zona ou teste de funcionamento de e-mail.
- Raiz oficial respondeu HTTP 200 e informou a API WordPress no cabeçalho Link. `.cpanel.yml` publica somente o tema WordPress; “Deploy HEAD” do cPanel não publica o Next.js.
- Houve configuração autenticada da Greenn e deploy de produção na Vercel, sem compra real, sem ativação de analytics e sem alteração de DNS. Não houve autenticação no cPanel/WordPress nem consulta a caixas postais.

## Ordem de execução e responsáveis

Legenda: **Codex** = preparação técnica automatizável; **Você** = dados, acesso delegado ou operação de conta; **Conjunto** = execução técnica condicionada aos dados e à autorização indicada. “Pode preparar” não significa já executado.

| Ordem | Ação | Responsável | Evidência para avançar |
|---|---|---|---|
| 1 | Confirmar os cinco produtos/ofertas, arquivos e regras comerciais | Você | Ficha de configuração preenchida e inventário de entrega |
| 2 | Criar ou conferir as ofertas Greenn e obter links corretos | Você, na Greenn | IDs de produto/oferta, preço, moeda e checkout conferidos |
| 3 | Escolher checkout separado ou integração nativa para os complementos | Você; Codex avalia a integração | Decisão registrada, elegibilidade e fluxo definidos |
| 4 | Definir conclusão, aceite, recusa, pagamento pendente e entrega | Conjunto | Mapa pós-compra e destinos oficiais, sem ciclos |
| 5 | Preparar e revisar a configuração por ambiente Vercel | Codex, após receber dados não secretos | Mapa de variáveis, sem habilitar oferta não homologada |
| 6 | Definir origem única de compra confirmada e analytics | Conjunto | GA4/Pixel corretos, produtor dos eventos e deduplicação documentados |
| 7 | Corrigir e homologar lacunas técnicas de tracking | Codex, em trabalho separado | DebugView/Test Events e consentimento verificados |
| 8 | Exportar zona DNS, inventariar serviços e validar backup do WordPress | Você/HostGator; Codex confere | Zona completa, endpoints, backup restaurável e acesso ao fallback |
| 9 | Homologar as jornadas financeiras em ambiente apropriado | Conjunto; cobrança real exige sua autorização específica | Aceite/recusa, valores, entrega e eventos comprovados |
| 10 | Preparar build de produção sem apontar o domínio | Codex, após autorização para essa preparação | Build com configuração de produção testado e sem falhas críticas |
| 11 | Aprovar projeto de produção, janela, valores DNS e rollback | Você | Aprovação expressa da publicação e dos registros a alterar |
| 12 | Preservar aliases administrativos, alterar só os registros web aprovados e validar | Conjunto, somente após a etapa 11 | Web/HTTPS, e-mail e serviços críticos aprovados |
| 13 | Monitorar e manter WordPress, DNS HostGator e e-mail ativos | Conjunto | Estabilidade observada e reconciliação comercial sem incidentes |

**Pendências para o lançamento completo:** correção final das páginas de vendas do eBook e do Manual no painel; inventário/exportação autenticada do DNS/cPanel; preservação de `cpanel` e `ftp`; teste financeiro somente se autorizado em separado; analytics permanece desligado até definição e homologação.

## 1. Configuração Greenn, produto por produto

| Oferta | Valor | Estado autenticado na Greenn | Estado na aplicação |
|---|---:|---|---|
| eBook | R$ 147,00 | Produto `123089`, oferta `0qEOa5` ativa/aprovada; PDF definitivo publicado no Club | URL configurada e `GREENN_EBOOK_VERIFIED=true` |
| Manual Jurídico | R$ 97,00 | Produto `141872`, oferta `ZUSxQ1` ativa/aprovada; PDF protegido e cinco DOCX para download | URL configurada e `GREENN_MANUAL_VERIFIED=true` |
| Combo Completo | R$ 197,00 | Produto `199450`, oferta `iEN8Vn` ativa/aprovada; duas turmas vinculadas | URL configurada e `GREENN_COMBO_VERIFIED=true` |
| Complemento Manual | R$ 50,00 adicionais | Produto `199482`, oferta `3ZTVhJ` ativa/aprovada; entrega ao Manual; página nativa `/one-click/7196` ligada ao eBook principal | URL nova, `_VERIFIED=true`, `_MODE=native`; CTA do fallback Next permanece bloqueado |
| Complemento eBook | R$ 100,00 adicionais | Produto `199483`, oferta `LzV3lU` ativa/aprovada; entrega ao eBook; página nativa `/one-click/7197` ligada ao Manual principal | URL nova, `_VERIFIED=true`, `_MODE=native`; CTA do fallback Next permanece bloqueado |

Para todas: confirmar nome no checkout, vendedor responsável, formas de pagamento realmente habilitadas, parcelamento/juros, política de acesso, suporte e políticas de cancelamento/reembolso aplicáveis. A página não configura esses itens na plataforma.

- URLs de produtos diferentes não podem ser reutilizadas por conveniência. O guard atual rejeita URLs exatamente iguais; ele **não verifica** se duas URLs diferentes apontam à mesma oferta, nem consulta o preço na Greenn. A conferência da conta continua obrigatória.
- A aplicação aceita HTTPS em `greenn.com.br` e subdomínios. Se a conta fornecer um domínio oficial diferente, confirmar procedência e adaptar a validação após revisão; não contornar o bloqueio nem encurtar links.
- `_VERIFIED=true` é uma declaração manual de homologação, não uma verificação automática da Greenn. Mantê-la falsa até comprovar oferta e entrega.
- Não reutilizar o checkout legado sem verificar a oferta atual. O checkout de amigos do eBook a R$ 97 é privado, não entra nos CTAs públicos e não tem variável dedicada no aplicativo. O preço R$ 97 do Manual é de outro produto.
- O upsell do produto eBook também aparece para a oferta privada de amigos a R$ 97. Isso foi aprovado expressamente: amigos podem adquirir o Manual por R$ 50. O Combo e os produtos complementares permanecem separados e sem encadeamento.
- Não há entrega de arquivos no Next.js. A concessão correta de acesso depende da configuração Greenn, inclusive no Combo e nas compras complementares.
- Oferta de R$ 50/R$ 100 acessível por link direto precisa de proteção de elegibilidade no provedor ou de implementação autenticada. `noindex`, URL pouco divulgada, UTM e um parâmetro contendo ID não comprovam compra anterior.

## 2. Mapa dos upsells e fronteira financeira

### Jornada A: eBook para Manual

1. Visitante vai de `/` para `/ebook` e, com checkout habilitado, para a oferta Greenn de R$ 147.
2. Pagamento pendente, recusado ou abandonado não autoriza tratar o visitante como comprador pago. Conferir em que estado a Greenn executa o redirecionamento.
3. Após o pagamento, a Greenn apresenta a página nativa `/one-click/7196` com o produto `199482` por R$ 50.
4. **Aceite no modo nativo:** a Greenn executa o mecanismo de 1 clique conforme a configuração da conta. O Next.js não inicia uma segunda cobrança paralela.
5. Complemento aprovado: Greenn entrega o Manual; eBook anterior permanece disponível. Registrar duas transações reais: R$ 147 e R$ 50. Total da jornada: R$ 197.
6. Complemento pendente/recusado: manter somente a entrega confirmada da primeira compra; não exibir confirmação do complemento nem repetir cobrança automaticamente.
7. **Recusa:** destino direto da aula do eBook no Greenn Club, sem cancelar a compra anterior.

### Jornada B: Manual para eBook

O fluxo é equivalente: `/manual-juridico` → checkout de R$ 97 → página nativa `/one-click/7197` → produto `199483` por R$ 100 → entrega do eBook quando o complemento for aprovado. Recusa leva diretamente à aula do Manual. Duas transações reais, R$ 97 e R$ 100; total R$ 197.

### Combo e término das jornadas

`/combo` → checkout específico de R$ 197 → confirmação e entrega dos dois produtos. Não apresentar um dos mesmos complementos a quem já comprou o Combo. Após completar uma jornada de dois produtos, não encadear o upsell inverso. Não há downsell definido, precificado ou implementado; não o anunciar como pronto.

### Limite encontrado no mecanismo nativo Greenn

A documentação oficial relida em 20/10/2026 descreve produto/oferta, botão “Não Comprar”, página de obrigado, código externo, contexto da compra e atributos `data-greenn-*`. Também descreve confirmação e compra imediata conforme a configuração. A inspeção autenticada em 21/10 comprovou que a página de obrigado é escolhida no nível do produto inicial, sem filtro da oferta de origem.

A configuração automática foi ativada sem compra real. O ciclo foi eliminado com produtos complementares independentes e sem upsell. As páginas `/one-click/7196` e `/one-click/7197` estão ativas nos produtos principais. Ainda será necessário:

- homologar token, voltar/atualizar, duplo clique, aceite, recusa e status de pagamento em teste autorizado;
- Definir a regra de confirmação em conjunto. Não habilitar cobrança imediata nesta auditoria. A documentação permite comportamentos diferentes, e o valor de atributos gerados não pode ser presumido.
- Manter as rotas Next de upsell fora do fluxo ativo; elas ainda explicam checkout separado e não devem ser apresentadas como a página nativa.

**Recomendação operacional:** manter `_MODE=native` no código. O checkout e o 1 clique pertencem à página hospedada pela Greenn; as rotas Next permanecem como fallback indisponível até eventual integração específica.

### Riscos de cobrança duplicada e controles exigidos

| Risco | Controle a validar | Responsável |
|---|---|---|
| Duplo clique, voltar, atualizar ou reabrir oferta | Proteção de duplicidade/estado no provedor; depois de complemento pago, impedir nova compra indevida | Greenn/conta; Codex integra o estado disponível |
| Dois mecanismos ativos no mesmo aceite | Um único caminho por oferta; nunca abrir checkout avulso e executar script nativo juntos | Codex + configuração Greenn |
| Usar checkout de Combo como complemento | Conferência de ID, valor e produto de cada oferta | Você + Codex |
| Receber a mesma confirmação várias vezes | Idempotência de eventos e concessões por ID de transação | Greenn; backend adicional se adotado |
| Redirecionar compra pendente como se estivesse paga | Condicionar fluxo e entrega à confirmação real | Greenn + integração |
| Voltar ao upsell inverso ou ofertar item do Combo novamente | Destinos terminais e elegibilidade por itens já adquiridos | Você/Greenn; Codex conforme API disponível |
| Reembolsar uma transação afetar acesso de outra | Política para compra inicial, complemento e Combo; reconciliar acessos por transação | Você/Greenn |

Bloquear duplo clique na interface é uma ajuda, mas não substitui controle financeiro no provedor. O site atual não mantém histórico autenticado de compras nem dispõe de backend de idempotência de cobranças.

## 3. Variáveis e procedimento de ativação

Os nomes completos estão em `.env.example`. Configure no projeto e no ambiente correto; valores de produção não devem ser copiados indiscriminadamente a previews.

| Configuração | Estado atual no projeto auditado | Condição para usar |
|---|---|---|
| Cinco `GREENN_*_URL` | Ausentes | Links emitidos pela conta e conferidos |
| Cinco `GREENN_*_VERIFIED` | Ausentes; padrão false | Homologação documentada de cada oferta |
| `GREENN_UPSELL_MANUAL_MODE`, `GREENN_UPSELL_EBOOK_MODE` | Ausentes; padrão separate | Decisão do modo; native não está implementado |
| `GREENN_UPSELL_MANUAL_DECLINE_URL`, `GREENN_UPSELL_EBOOK_DECLINE_URL` | Ausentes | Destinos reais distintos conforme a jornada |
| `GA4_ID`, `META_PIXEL_ID` | Ausentes | IDs corretos fornecidos e permissões de teste |
| `ANALYTICS_ENABLED` | Ausente; padrão desativado | Homologação de medição e consentimento |
| `SITE_RELEASE` | Ausente; padrão preview | Usar production somente no build de lançamento aprovado |
| `MANUAL_IMAGE_URL` | Ausente | Arte oficial aprovada; opcional tecnicamente, pendente editorialmente |

São páginas estáticas: alterar variáveis na Vercel requer **novo build/deployment** para refletir textos de estado, links, tracking e indexação. Alterar o painel não atualiza o build já pronto. O nome do ambiente Vercel e `SITE_RELEASE` são controles independentes. Testar configuração de lançamento em um build isolado, sem apontar o domínio e sem ativar compras reais inadvertidamente.

Posso preparar o mapa e a validação das variáveis automaticamente após receber os dados. Tokens, senhas e segredos de APIs devem ser inseridos por você no painel seguro ou por acesso delegado apropriado; nunca em arquivos Git, links compartilhados ou na ficha de coleta.

## 4. GA4 e Meta Pixel: ativação sem compra duplicada

### O que existe e o que ainda falta

- Há instalação condicionada a `SITE_RELEASE=production`, `ANALYTICS_ENABLED=true`, IDs válidos e consentimento do visitante.
- Há `page_view` GA4 manual, `view_item`, `select_item`, `begin_checkout`, `view_promotion` e `select_promotion`. Links de compra bloqueados não disparam `begin_checkout`.
- Meta mapeia `ViewContent` e `InitiateCheckout` fora dos upsells. O site não emite `purchase` GA4 nem `Purchase` Meta.
- Não existe endpoint de confirmação, webhook implementado, armazenamento durável de idempotência ou integração CAPI/Measurement Protocol. Ativar os IDs não preenche essas lacunas.

### Achados técnicos a resolver antes de habilitar a medição

| Arquivo e linha da base | Achado | Preparação Codex, em etapa própria |
|---|---|---|
| `components/tracking.tsx:8–13` | `emit()` verifica consentimento, mas não verifica diretamente `config.enabled`. Pode enfileirar eventos em um dataLayer com flag desligada, se já houver consentimento local. Isso não prova transmissão sem SDK, mas é insuficiente como garantia de desligamento com tags externas. | Centralizar também o bloqueio de ambiente/flag nos emissores e testar configuração desligada |
| `components/tracking.tsx:26–30` | A primeira emissão de `ViewContent` pode ocorrer antes de o Pixel ser inicializado; o efeito não aguarda a prontidão do SDK | Inicializar/filar eventos de forma determinística e testar entrada direta e SPA |
| `components/tracking.tsx:30` | Há `fbq('init')`, mas não há emissão explícita de `PageView` Meta | Definir e testar uma única emissão por navegação elegível, após consentimento |
| `components/tracking.tsx:29–30` | Não carregar o Pixel no upsell em entrada direta é uma proteção parcial. Em navegação SPA, um SDK carregado anteriormente permanece na página | Auditar captura automática e URLs com contexto/token antes de permitir fluxo nativo; evitar coleta desse contexto |
| Propriedade GA4/Pixel/GTM externos | Sem acesso à conta não é possível verificar medição aprimorada de histórico, eventos automáticos, GTM e tags Greenn | Inventário único de tags, confirmar medição de SPA, sanitização e ausência de disparos duplicados |

Estes são achados de leitura de código, não falhas de cobrança observadas. Não foram corrigidos nesta auditoria. A correção não exige mudar copy ou design, mas requer trabalho técnico e homologação antes de ativar analytics de lançamento.

### Escolher um único produtor por destino

**Caminho preferencial, se suportado e comprovado na conta:** usar a integração oficial Greenn como produtora dos eventos de pagamento confirmado. Ela precisa transmitir produto, valor efetivamente pago e identificador de transação. Confirmar na conta se há GA4, Meta browser/CAPI e deduplicação para os dois complementos; não presumir que o suporte a Pixel implica suporte a todos esses eventos.

**Alternativa, se a integração oficial não atender:** preparar backend a partir de confirmação autenticada conforme especificação real Greenn. Validar autenticidade, status pago, produto/oferta, valor e moeda; quando necessário, consultar a API oficial para conferir a venda. Não aceitar simplesmente um POST público ou a visita a uma URL de obrigado. Usar armazenamento durável, restrição única e reprocessamento seguro. Não foi implementado nesta etapa.

| Destino | Regra de deduplicação e valor |
|---|---|
| GA4 `purchase` | `transaction_id` estável da venda Greenn; `currency=BRL`; itens e valor da transação real. Um único produtor principal; não depender só de recarregamento, localStorage ou deduplicação implícita da ferramenta |
| Meta `Purchase` | Se houver browser + CAPI, mesmo `event_name` e `event_id` para a mesma venda e Pixel/dataset. Se não houver ID compatível entre canais, manter um produtor de Purchase por destino até resolver |
| Backend adicional | Chave única por provedor + transação + destino + tipo de evento; registrar envio, tentativas e status. Repetição de webhook não pode gerar nova conversão independente |

**Exemplos comerciais, não IDs ou eventos reais:** eBook paga 147; complemento paga 50. São duas compras e receita total 197. Manual paga 97; complemento paga 100. Combo é uma compra de 197. **Nunca enviar uma terceira compra de 197 representando a jornada já contabilizada**, nem mandar 197 como valor do adicional de 50/100. Se houver desconto/parcelamento, conferir a definição de receita paga adotada, juros e itens na origem; não substituir o valor confirmado pelo preço do catálogo.

Não contar PIX/boleto pendente, tentativa recusada, clique em aceite ou recusa como compra. Definir também a conciliação de reembolsos/estornos; não disparar Purchase negativo improvisado.

### Checklist de ativação da medição

1. Você fornece Measurement ID da propriedade GA4 e ID do Pixel/dataset correto, com acesso delegado para homologação; confirma se já há GTM ou tags na Greenn/WordPress.
2. Conjunto escolhe o produtor de compra confirmada e identifica quem configura cada evento. Não instalar a mesma tag simultaneamente por código e GTM.
3. Codex prepara correções acima e testes em ambiente isolado, mantendo copy/design.
4. Você configura, quando suportado, o mesmo contexto de propriedade e medição entre site e checkout. Validar cross-domain, autorreferências e atribuição; UTMs sozinhas não garantem preservação da sessão GA4. Não inventar linker `_gl` ou parâmetros do provedor.
5. Testar concessão, recusa e revogação de consentimento, navegação SPA e entrada direta. A política e o consentimento do checkout precisam ser compatíveis com a medição do site.
6. GA4 DebugView/Tag Assistant e Meta Test Events/Diagnostics: comprovar eventos de navegação uma vez; não registrar compra por clique; confirmar uma compra por transação aprovada; testar repetição/atualização e complementos.
7. Confirmar ausência de tokens e dados pessoais em URLs/payloads. A sanitização explícita do site não substitui a revisão dos eventos automáticos dos fornecedores.
8. Ativar flags somente no build homologado. Segredos de CAPI/Measurement Protocol permanecem no servidor; não são IDs públicos e não podem ir para o navegador.

## 5. Domínio, DNS e e-mail: estado observado

| Registro/serviço | Observado em 20/10/2026 | Tratamento na migração |
|---|---|---|
| NS | `ns434.hostgator.com.br`, `ns435.hostgator.com.br` | Manter nameservers; sem transferência de registro necessária |
| Raiz A | `216.172.161.43`, TTL observado 14400 s | Registrar para rollback; Vercel recomendou, para este projeto, `216.198.79.1` e `64.29.17.1` |
| Raiz AAAA | Sem resposta AAAA nas consultas | Reconsultar na janela; não deixar destino IPv6 antigo se existir depois |
| `www` | CNAME para a raiz | Projeto Vercel já configurado para redirecionar `www` à raiz com status 308; destino CNAME recomendado `efe95d024463269a.vercel-dns-017.com.` |
| MX | prioridade 10 `mx1.titan.email`, 20 `mx2.titan.email` | Preservar exatamente; serviço de e-mail independente do destino A da web |
| TXT SPF | `v=spf1 include:spf.titan.email ~all` | Preservar; este valor não depende do A da raiz |
| `default._domainkey` TXT | Chave DKIM pública encontrada | Preservar; não confirma qual seletor é usado pela Titan. Conferir cabeçalhos reais com o proprietário |
| `_dmarc` TXT | NXDOMAIN nas consultas Google e Cloudflare | Registrar como achado atual; não criar/alterar política durante esta auditoria |
| `webmail` | CNAME para `titan.hostgator.com.br` | Preservar; não acompanha o A da raiz |
| `mail`, `autodiscover`, `autoconfig` | A para `216.172.161.43` | Preservar e conferir quais clientes/serviços os utilizam |
| `_autodiscover._tcp` SRV | `0 0 443 cpanelemaildiscovery.cpanel.net` | Preservar e inventariar dependência |
| `cpanel` e `ftp` | CNAME para `corretorimbativel.com.br` | **Dependência a corrigir antes do corte:** hoje seguirão a raiz para a Vercel |
| Raiz CAA | Sem resposta CAA na consulta | Revalidar ao preparar certificado; não alterar política sem necessidade demonstrada |

**É possível migrar apenas a hospedagem web. Não há fundamento para afirmar agora que todos os serviços estão protegidos.** MX/Titan e SPF observados permitem manter o e-mail sem mover nameservers; cPanel e FTP são dependências reais da raiz. Clientes de e-mail, scripts ou integrações podem usar o apex diretamente mesmo com MX externo, o que só o inventário autenticado esclarece.

Antes de aprovar DNS, você/HostGator precisa fornecer exportação integral da zona com TTLs, confirmar acesso administrativo independente do apex e identificar uso de ftp/cpanel/mail/autodiscover. Na preparação do corte, preservar os aliases administrativos em destino HostGator confirmado, ou substituir o endereço usado pelos administradores por hostname oficial de serviço validado. Alterar esses CNAME/A também exige aprovação; nada foi modificado.

Não cancelar a hospedagem, a zona DNS ou o pacote Titan ao migrar a web. Confirmar com a HostGator o vínculo contratual desses serviços. Manter SPF, DKIM, DMARC existente se houver na exportação, MX, SRV, registros de verificação e outros subdomínios. Não criar um segundo SPF na raiz.

A zona completa pode conter verificações e seletores não descobertos por consultas públicas. Este snapshot não é um plano de reconstrução integral do DNS. Os TTLs são respostas de resolvedores; os valores de edição precisam ser conferidos no painel autoritativo.

## 6. Plano de publicação e rollback

### Preparação, antes de autorizar o corte

- Você exporta zona DNS e inventário de serviços; Codex compara com o snapshot público e prepara um diff dos registros propostos. Nada de mudança de nameservers.
- Você obtém backup restaurável de arquivos, banco e configuração WordPress em armazenamento privado, com acesso ao cPanel e origem fora do domínio principal. O Git contém o tema, não um backup completo do site.
- Conjunto confirma acesso ao WordPress de origem com hostname/certificado apropriados ou método autorizado da hospedagem. Não mudar `home/siteurl`, criar subdomínios ou alterar banco sem plano aprovado. Acesso apenas por IP pode não funcionar devido ao vhost/HTTPS.
- Codex inventaria, a partir de dados fornecidos, URLs antigas, mídias, anúncios, callbacks, `/wp-json`, `/wp-admin` e serviços usados por plugins. Definir redirects específicos; não redirecionar toda a raiz ao eBook nem enviar rotas WordPress indiscriminadamente ao Next.
- Confirmar qual projeto será produção: reutilizar o projeto separado ou criar outro exige decisão. Garantir que o fluxo Git de produção não publique automaticamente branches de revisão ou o tema via cPanel.
- Preparar e testar o build de produção que será efetivamente publicado, com suas variáveis finais; promover um preview pode gerar outro build e não equivale a publicar o artefato já testado.
- Preparar release de produção sem apontar domínio: três ofertas públicas operacionais; complementos só se homologados; metadados oficiais, `SITE_RELEASE=production`, indexação pública correta, upsells noindex e acesso público ao build de lançamento. A proteção atual de preview não deve bloquear clientes em produção.
- O plano exato veio da configuração autenticada do projeto: raiz com A `216.198.79.1` e `64.29.17.1`; `www` com CNAME `efe95d024463269a.vercel-dns-017.com.`. A Vercel marcou os domínios como verificados, porém ainda `misconfigured` enquanto o DNS público continua na HostGator. Esses valores devem ser reconfirmados imediatamente antes do corte.
- Fixar responsáveis, janela e critérios de sucesso. Se for aprovada redução de TTL, fazê-la previamente e aguardar o TTL anterior dos registros afetados. O A observado tem 14400 s, aproximadamente quatro horas; isso não garante propagação universal em quatro horas.

### Execução, somente com aprovação de publicação/DNS

1. Registrar snapshot fresco, commit/release anterior e candidato, valores/TTLs antes e depois e destinos Greenn que serão alterados. Confirmar backups e possibilidade de rollback.
2. Preservar o acesso a cPanel/FTP conforme plano autorizado, sem depender do apex que será migrado.
3. Associar raiz/www ao projeto escolhido e aplicar somente os registros web e de verificação explicitamente aprovados. Preservar demais registros e nameservers.
4. Validar resolução em mais de um resolvedor, IPv4/IPv6, certificado e redirects raiz/www. Durante a propagação, origem antiga e nova podem receber visitantes; ambas precisam ter fluxos válidos.
5. Validar seis rotas, URLs legadas, mídias, UTM, querystrings, barras e contexto de upsell. Revalidar callback/redirect da Greenn: preview temporário não deve ser destino de campanha ou pós-compra definitivo.
6. Você valida envio/recebimento de e-mail e acesso por webmail/cliente habitual; administradores validam cPanel/FTP e integrações usadas. Codex não envia e-mails a terceiros nesta auditoria.
7. Confirmar jornadas comerciais e analytics conforme autorização de testes. Teste com cobrança real, inclusive nova tentativa ou reembolso, precisa ser autorizado especificamente.
8. Monitorar erros, 404, SSL, acessos, compra confirmada e entrega. Manter HostGator/WordPress/Titan e registros de rollback disponíveis por toda a janela de observação acordada.

### Gatilhos e procedimento de rollback

Gatilhos: quebra de checkout ou entrega, cobrança indevida/duplicada, perda de contexto de upsell, falha de e-mail ou acesso administrativo crítico, certificado inválido ou rotas relevantes indisponíveis. Medição quebrada pode exigir suspender campanhas em vez de trocar DNS; decidir conforme gravidade e manter pagamentos sob controle do provedor.

1. Responsável pela janela comunica a decisão; interromper novas ações de publicação. Se houver suspeita de cobrança duplicada, desativar a oferta afetada no provedor por operador autorizado; não confiar só em DNS ou deploy, pois uma aba aberta pode continuar operando.
2. Restaurar os registros web **do snapshot imediatamente anterior ao corte**, inclusive existência/ausência de AAAA e tratamento de www, mantendo e-mail intacto. `216.172.161.43` é o A observado nesta auditoria, não substitui um snapshot futuro validado.
3. Reverter destinos de pós-compra/callback/campanhas alterados, conforme o registro da janela; não enviar comprador a uma versão que não entende seu contexto. Restaurar alterações auxiliares de DNS somente conforme o plano de dependências, sem perder acesso administrativo.
4. Confirmar WordPress e HTTPS na origem e aguardar propagação, que não é instantânea. Manter ambas as plataformas disponíveis enquanto houver caches antigos.
5. Reconciliar vendas, complementos e entregas na Greenn durante a janela. **Rollback de DNS não estorna pagamento nem revoga/entrega automaticamente produtos.** Não refazer compra para “corrigir” acesso.
6. Não restaurar banco antigo indiscriminadamente se houver atividade posterior ao backup. Preservar evidências sem tokens/dados de cartão e corrigir em preview.

## Fontes verificadas e referências

- Greenn, upsell e código externo, relido nesta auditoria: https://ajuda.greenn.com.br/pt-br/article/criando-um-upsell-na-greenn-78muq1/ . O artigo informa atualização em 24/09/2026 e descreve confirmação, token e compra imediata conforme configuração.
- Greenn, página de upsell: https://ajuda.greenn.com.br/pt-br/article/criando-uma-pagina-de-upsell-na-greenn-1vxd6j/ . As configurações concretas desta conta permanecem não verificadas.
- DNS: evidências públicas anexas; nenhum registro alterado.
- Referências para a etapa de instrumentação: https://developers.google.com/analytics/devguides/collection/ga4/reference/events#purchase e https://developers.facebook.com/docs/marketing-api/conversions-api/deduplicate-pixel-and-server-events/ . Não comprovam integração habilitada na conta Greenn.

A ficha complementar `DADOS-PARA-CONFIGURACAO.md` reúne o que você precisa fornecer ou configurar. Esta entrega é de auditoria e preparação documental: nenhum fluxo financeiro, tracking, copy ou design foi alterado.
