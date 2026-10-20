# Prontidão comercial e plano de lançamento

Auditoria de 20/10/2026, horário de Brasília. Aplicação auditada: `69d166f`; documentação de entrega: `95215cf`. Branch desta auditoria: `codex/prontidao-comercial`. PR #4 aberto, em rascunho, sem merge. Copy e design aprovados e preservados.

**Conclusão: apresentação pronta para validação; operação comercial ainda não homologada.** A migração da web para a Vercel é tecnicamente viável mantendo e-mail e DNS na infraestrutura atual, mas não pode ser certificada como sem impacto antes do inventário e dos testes abaixo. Há dependências DNS concretas a resolver antes do corte.

## Evidências e limites desta auditoria

- Código Next.js: `.env.example`, `lib/commerce.ts`, `components/tracking.tsx`, `navigation.tsx`, `decline.tsx`, `app/layout.tsx`, metadados e documentos de migração.
- Projeto Vercel `corretor-imbativel-next-preview`, ID `prj_OroF7tfTxDA3GljRKjuszK0ovmcf`, equipe `luisfwdp-2259s-projects`: **zero variáveis cadastradas visíveis e zero variáveis de produção ocultas**, conforme resposta autenticada de listagem sem descriptografia. Isso descreve este projeto, não outras contas/projetos.
- Prévia atual READY: https://corretor-imbativel-next-preview-j4kuyocki.vercel.app . O domínio oficial não está associado ao projeto auditado.
- DNS público consultado por Google e confirmado nos registros críticos por Cloudflare. Respostas e horários em `evidencias/`. Consultas públicas não equivalem a exportação integral da zona ou teste de funcionamento de e-mail.
- Raiz oficial respondeu HTTP 200 e informou a API WordPress no cabeçalho Link. `.cpanel.yml` publica somente o tema WordPress; “Deploy HEAD” do cPanel não publica o Next.js.
- Não houve acesso à conta Greenn, autenticação no cPanel/WordPress, consulta a caixas postais, pagamento, configuração remota, deploy ou alteração de DNS nesta etapa.

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

**Bloqueios para lançamento hoje:** checkouts não configurados; entrega/eligibilidade não confirmadas; ausência de homologação financeira; analytics de compra sem produtor definido; inventário DNS/cPanel incompleto; acesso ao fallback e backup não testados. Sem aprovação de publicação, o processo para antes das etapas de produção.

## 1. Configuração Greenn que falta, produto por produto

“Falta” abaixo significa não fornecido ou não comprovado ao projeto. O produto pode já existir na conta; não criar duplicatas antes de conferir.

| Oferta | Valor | O que conferir na Greenn | O que falta na aplicação |
|---|---:|---|---|
| eBook | R$ 147,00 | Produto e oferta do eBook; moeda BRL; arquivo correto; entrega; pagamento; pós-compra por status | `GREENN_EBOOK_URL`, `GREENN_EBOOK_VERIFIED` |
| Manual Jurídico | R$ 97,00 | Produto separado; oferta de R$ 97; PDF final; conteúdo incluído; entrega; pós-compra | `GREENN_MANUAL_URL`, `GREENN_MANUAL_VERIFIED` |
| Combo Completo | R$ 197,00 | Oferta específica; concessão dos dois materiais; soma avulsa R$ 244 não é preço cobrado; sem duplicar concessões desnecessárias | `GREENN_COMBO_URL`, `GREENN_COMBO_VERIFIED` |
| Complemento Manual | R$ 50,00 adicionais | Oferta vinculada ao Manual; comprador elegível do eBook; entrega apenas do complemento; não cobrar o Manual público de R$ 97 | `GREENN_UPSELL_MANUAL_URL`, `_VERIFIED`, `_MODE`, `_DECLINE_URL` |
| Complemento eBook | R$ 100,00 adicionais | Oferta vinculada ao eBook; comprador elegível do Manual; entrega apenas do complemento; não cobrar o eBook público de R$ 147 | `GREENN_UPSELL_EBOOK_URL`, `_VERIFIED`, `_MODE`, `_DECLINE_URL` |

Para todas: confirmar nome no checkout, vendedor responsável, formas de pagamento realmente habilitadas, parcelamento/juros, política de acesso, suporte e políticas de cancelamento/reembolso aplicáveis. A página não configura esses itens na plataforma.

- URLs de produtos diferentes não podem ser reutilizadas por conveniência. O guard atual rejeita URLs exatamente iguais; ele **não verifica** se duas URLs diferentes apontam à mesma oferta, nem consulta o preço na Greenn. A conferência da conta continua obrigatória.
- A aplicação aceita HTTPS em `greenn.com.br` e subdomínios. Se a conta fornecer um domínio oficial diferente, confirmar procedência e adaptar a validação após revisão; não contornar o bloqueio nem encurtar links.
- `_VERIFIED=true` é uma declaração manual de homologação, não uma verificação automática da Greenn. Mantê-la falsa até comprovar oferta e entrega.
- Não reutilizar o checkout legado sem verificar a oferta atual. O checkout de amigos do eBook a R$ 97 é privado, não entra nos CTAs públicos e não tem variável dedicada no aplicativo. O preço R$ 97 do Manual é de outro produto.
- A elegibilidade dos complementos precisa considerar a **oferta e a transação inicial**, não apenas o nome do produto: o checkout privado do eBook para amigos a R$ 97 não pode entrar automaticamente na jornada pública de R$ 147 + R$ 50. Excluir também compradores que já têm o complemento, compras reembolsadas/canceladas e o Combo, conforme regra comercial confirmada.
- Não há entrega de arquivos no Next.js. A concessão correta de acesso depende da configuração Greenn, inclusive no Combo e nas compras complementares.
- Oferta de R$ 50/R$ 100 acessível por link direto precisa de proteção de elegibilidade no provedor ou de implementação autenticada. `noindex`, URL pouco divulgada, UTM e um parâmetro contendo ID não comprovam compra anterior.

## 2. Mapa dos upsells e fronteira financeira

### Jornada A: eBook para Manual

1. Visitante vai de `/` para `/ebook` e, com checkout habilitado, para a oferta Greenn de R$ 147.
2. Pagamento pendente, recusado ou abandonado não autoriza tratar o visitante como comprador pago. Conferir em que estado a Greenn executa o redirecionamento.
3. Após pagamento confirmado e elegibilidade validada, apresentar `/upsell-manual` com adicional de R$ 50.
4. **Aceite no modo separado:** abrir o checkout específico do complemento de R$ 50. O cliente revisa e autoriza uma segunda compra. Não enviar o contexto/token do pagamento anterior ao checkout avulso por conta própria.
5. Complemento aprovado: Greenn entrega o Manual; eBook anterior permanece disponível. Registrar duas transações reais: R$ 147 e R$ 50. Total da jornada: R$ 197.
6. Complemento pendente/recusado: manter somente a entrega confirmada da primeira compra; não exibir confirmação do complemento nem repetir cobrança automaticamente.
7. **Recusa:** destino real de conclusão/acesso do eBook, sem cancelar a compra anterior. É preciso fornecer esse destino HTTPS; o fallback atual só mostra instruções, não conclui uma operação na Greenn.

### Jornada B: Manual para eBook

O fluxo é equivalente: `/manual-juridico` → checkout de R$ 97 → pagamento confirmado → `/upsell-ebook` → aceite para checkout adicional de R$ 100 → entrega do eBook quando o complemento for aprovado. Recusa leva à conclusão/acesso do Manual. Duas transações reais, R$ 97 e R$ 100; total R$ 197.

### Combo e término das jornadas

`/combo` → checkout específico de R$ 197 → confirmação e entrega dos dois produtos. Não apresentar um dos mesmos complementos a quem já comprou o Combo. Após completar uma jornada de dois produtos, não encadear o upsell inverso. Não há downsell definido, precificado ou implementado; não o anunciar como pronto.

### Se for escolhido o mecanismo nativo Greenn

A documentação oficial relida em 20/10/2026 descreve produto/oferta, botão “Não Comprar”, página de obrigado, código externo, contexto da compra e atributos `data-greenn-*`. Também descreve confirmação e compra imediata conforme a configuração. Suporte documentado não comprova habilitação ou condições desta conta.

A configuração `_MODE=native` atualmente resulta em `native-pending` e mantém o aceite bloqueado. Não basta alterar a variável. Será necessário:

- Você fornecer o código oficial completo da oferta, sem dados de compradores, e confirmar os ajustes na conta.
- Codex adaptar montagem/desmontagem do script ao App Router, integridade dos atributos, confirmação e preservação do contexto. Não substituir o mecanismo oficial por chamada financeira inventada.
- Homologar token, acesso direto sem compra, voltar/atualizar, duplo clique, troca de rota, recusa e status de pagamento. Respeitar o formato de URL e barras exigido pelo provedor; redirects do Next precisam preservar o contexto.
- Definir a regra de confirmação em conjunto. Não habilitar cobrança imediata nesta auditoria. A documentação permite comportamentos diferentes, e o valor de atributos gerados não pode ser presumido.
- Revisar, com sua aprovação futura, a microcopy que hoje explica “nova compra em checkout separado”. Ela não pode descrever incorretamente um fluxo nativo. Copy e design permanecem intocados agora.

**Recomendação operacional:** manter os complementos bloqueados até a escolha e homologação de um modo. O checkout separado é o caminho já preparado no código; ainda exige controle de elegibilidade e configuração da plataforma. Não classificar esse caminho como one-click.

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
| Raiz A | `216.172.161.43`, TTL observado 14400 s | Registrar para rollback; destino novo somente o exigido pela Vercel |
| Raiz AAAA | Sem resposta AAAA nas consultas | Reconsultar na janela; não deixar destino IPv6 antigo se existir depois |
| `www` | CNAME para a raiz | Vai acompanhar a raiz; decidir canonical/redirect e incluir www na configuração futura Vercel |
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
- Plano exato de A/AAAA/CNAME, domínio raiz/www, verificação e TLS deve vir da Vercel para o projeto final. Não foi solicitado vínculo de domínio nesta auditoria; nenhum destino genérico foi presumido.
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
