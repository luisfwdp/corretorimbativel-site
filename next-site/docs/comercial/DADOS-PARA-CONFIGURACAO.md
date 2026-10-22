# Ficha de dados e configurações — preencher antes do lançamento

Vinculada a `PRONTIDAO-LANCAMENTO.md`. Campos vazios são pendências internas, não conteúdo do site. Não preencher senhas, tokens, dados de cartão, dados pessoais de compradores ou segredos de API neste arquivo versionado. IDs de produto, nomes de ofertas, links públicos e informações de configuração podem ser fornecidos para conferência. Segredos devem ser cadastrados diretamente no painel seguro ou via acesso delegado apropriado.

## 1. Você: confirmar no painel Greenn

Não criar produtos novos se já existirem; primeiro localizar os IDs corretos.

| Dado | eBook público | Manual público | Combo | Complemento Manual | Complemento eBook |
|---|---|---|---|---|---|
| Valor esperado | R$ 147,00 | R$ 97,00 | R$ 197,00 | R$ 50,00 | R$ 100,00 |
| ID do produto real | A fornecer | A fornecer | A fornecer | A fornecer | A fornecer |
| ID/nome da oferta | A fornecer | A fornecer | A fornecer | A fornecer | A fornecer |
| URL emitida pela Greenn | A fornecer | A fornecer | A fornecer | A fornecer | A fornecer |
| Arquivo(s)/acesso efetivamente entregues | eBook a conferir | Manual a conferir | Ambos a conferir | Manual a conferir | eBook a conferir |
| Produto/oferta inicial elegível | Não se aplica | Não se aplica | Não se aplica | eBook público de R$ 147 | Manual público de R$ 97 |
| Pagamentos habilitados | A confirmar | A confirmar | A confirmar | A confirmar | A confirmar |
| Parcelamento/juros | A confirmar | A confirmar | A confirmar | A confirmar | A confirmar |
| Condições e prazo de acesso | A confirmar | A confirmar | A confirmar | A confirmar | A confirmar |
| Pagamento aprovado: destino | A definir | A definir | A definir | A definir | A definir |
| Pagamento pendente: destino/instrução | A definir | A definir | A definir | A definir | A definir |
| Recusa do complemento: destino HTTPS | Não se aplica | Não se aplica | Não se aplica | Conclusão/acesso do eBook | Conclusão/acesso do Manual |
| Suporte e política de cancelamento | A confirmar | A confirmar | A confirmar | A confirmar | A confirmar |
| Responsável pela conferência | A definir | A definir | A definir | A definir | A definir |

Checklist Greenn a executar por você:

- [ ] Confirmar os cinco produtos/ofertas e o preço cobrado em cada checkout, sem efetuar pagamento nesta fase de inspeção.
- [ ] Conferir o PDF final do Manual e os arquivos efetivamente vinculados à entrega. Não anunciar editáveis/bonificações sem confirmação.
- [ ] Garantir que o Combo dê acesso aos dois materiais e não encaminhe aos complementos dos mesmos produtos.
- [ ] Definir o modo dos complementos: checkout separado ou nativo. Confirmar se a conta suporta a opção escolhida e quais métodos de pagamento funcionam.
- [ ] Conferir elegibilidade: primeira compra paga na oferta correta, item complementar ainda não adquirido e ausência de cancelamento/reembolso impeditivo conforme política definida.
- [ ] Excluir a oferta privada do eBook para amigos de R$ 97 da jornada pública de R$ 147 + R$ 50. Não fornecer seu link para uso nas páginas públicas.
- [ ] Configurar os destinos de aceite, recusa e conclusão; confirmar preservação da compra inicial na recusa. Não escolher uma página genérica sem acesso válido ao produto.
- [ ] Se nativo, obter código completo gerado pela Greenn, páginas de exemplo e configuração do modal de confirmação. Não incluir tokens de compradores nos exemplos enviados.
- [ ] Confirmar como a plataforma protege contra recompra indevida do mesmo complemento e como trata duplo clique e atualização.
- [ ] Confirmar regras de cancelamento/reembolso e concessão de acesso para compra inicial, complemento e Combo.
- [ ] Confirmar mecanismo oficial disponível para notificações de pagamento e conversões, autenticação de eventos e identificadores únicos.

## 2. Codex: preparação técnica possível depois desses dados

Sem mudança de copy/design:

- [ ] Conferir destinos HTTPS, domínio oficial Greenn, produto/oferta e preço declarado; comparar configuração com a matriz aprovada.
- [ ] Preparar variáveis Vercel com escopo de ambiente revisado. Valores ausentes mantêm o pagamento bloqueado.
- [ ] Manter `_VERIFIED=false` durante preparação; habilitar somente a oferta homologada, no momento aprovado.
- [ ] Se separado, conferir CTAs por produto, UTMs, destinos de recusa e confirmação de nova compra. A proteção de elegibilidade precisa existir efetivamente.
- [ ] Se nativo, preparar implementação adicional baseada no código oficial, com ciclo de vida React, token, confirmação e recusa. Não habilitar apenas mudando `_MODE`.
- [ ] Preparar correções de tracking e testes de consentimento, SDK e navegação descritos na auditoria.
- [ ] Preparar build e verificações de links, SEO e eventos sem disparar compra fictícia ou fazer pagamento.

## 3. Você + Codex: ficha de analytics

| Informação | Quem fornece/decide | Pendente |
|---|---|---|
| Measurement ID GA4 correto, formato G-… | Você, na propriedade | Sim |
| Pixel/dataset Meta correto | Você, no Gerenciador de Eventos | Sim |
| GTM existente e tags instaladas no WordPress/Greenn | Você confirma; Codex inventaria o que puder acessar | Sim |
| Domínios reais do checkout para análise cross-domain | Você fornece os links reais | Sim |
| Quem envia `purchase` para GA4 | Conjunto, após verificar integração oficial | Sim |
| Quem envia `Purchase` para Meta e se há browser + CAPI | Conjunto | Sim |
| ID da venda e ID de evento comum para deduplicação | Greenn/integrador; Codex confere o contrato | Sim |
| Como pagamento pendente/aprovado/estornado é notificado | Greenn/integrador | Sim |
| Autenticidade das notificações e política de retries | Greenn/integrador | Sim |
| Consentimento no site e checkout e política de privacidade vigente | Você aprova; Codex implementa a configuração acordada | Sim |
| Acesso delegado a DebugView e Test Events | Você | Sim |

`purchase` e `Purchase` nunca serão emitidos apenas porque o visitante chegou ao upsell, visitou uma URL de obrigado ou clicou no botão. As jornadas contam valores reais por transação: 147 + 50; 97 + 100; ou uma única compra de 197 para o Combo.

Se for necessário backend, será preciso definir infraestrutura de armazenamento durável e tratamento autenticado de eventos. Isso ainda não existe nesta aplicação. Não criar um endpoint financeiro sem especificação do provedor e plano de idempotência.

## 4. Você/HostGator: dados de domínio, e-mail e fallback

- [ ] Exportação completa e atualizada da zona DNS, com todos os tipos, valores e TTLs. Não enviar senha do painel.
- [ ] Confirmar onde o domínio está registrado e quem tem permissão de editar a zona autoritativa HostGator.
- [ ] Confirmar que DNS e Titan continuarão ativos e contratados após a migração da web.
- [ ] Informar se cPanel/FTP são acessados pelos aliases do domínio ou por hostname independente. Ambos os aliases hoje acompanham a raiz.
- [ ] Inventariar clientes de e-mail, remetentes SMTP, integrações e scripts que usam a raiz ou `mail`, `autodiscover` e `autoconfig`.
- [ ] Conferir DKIM efetivamente usado pela Titan a partir da configuração/cabeçalho de mensagem. Não presumir que o seletor público `default` é o da Titan.
- [ ] Informar subdomínios, verificações e serviços fora das seis rotas Next.js.
- [ ] Backup WordPress de arquivos/banco/configuração, guardado em local privado, com procedimento de restauração testado.
- [ ] Acesso independente à origem WordPress e certificado/hostname utilizável durante o corte.
- [ ] Lista de URLs antigas, mídias, campanhas e integrações `wp-json`/callbacks necessárias.

Codex pode ler a exportação, comparar registros, preparar redirects, diff DNS e roteiro de rollback. Esta auditoria não autoriza executar qualquer alteração DNS ou apontar o domínio.

## 5. Homologação: evidência que precisa ser produzida

Não executar transações reais sem autorização específica, mesmo se houver intenção de estornar depois. A documentação Greenn menciona teste de compra e cupom de 100%; isso não prova comportamento de cobrança de cartão, nem autoriza criar pedidos nesta conta. Confirmar ambiente e procedimento suportados antes de testar.

| Cenário | Resultado esperado | Quem executa/confirma |
|---|---|---|
| Abrir cada checkout | Produto, valor e moeda corretos; sem cobrança ao visitar | Você/conta; Codex confere links quando fornecidos |
| eBook aprovado | Uma compra de 147; eBook entregue; complemento correto para elegível | Conjunto, com procedimento autorizado |
| Manual aprovado | Uma compra de 97; Manual entregue; complemento correto | Conjunto, com procedimento autorizado |
| Combo aprovado | Uma compra de 197; dois materiais entregues; sem upsell duplicado | Conjunto, com procedimento autorizado |
| Aceitar complemento Manual | Uma cobrança adicional de 50; Manual entregue; total 197 | Conjunto, com procedimento autorizado |
| Aceitar complemento eBook | Uma cobrança adicional de 100; eBook entregue; total 197 | Conjunto, com procedimento autorizado |
| Recusar ambos os complementos | Sem cobrança adicional; compra inicial e acesso preservados | Conjunto |
| Pendente/recusado/abandono | Sem Purchase de pagamento aprovado e sem entrega indevida | Conjunto |
| Duplo clique, voltar, atualizar, reabrir | Sem duplicidade financeira ou oferta indevida de item já comprado | Conjunto, em ambiente/procedimento aprovado |
| Entrar sem primeira compra / oferta de amigos / comprador Combo | Sem acesso indevido ao complemento reduzido | Conjunto |
| Reentrega/repetição de notificação | Sem nova conversão ou concessão duplicada indevida | Codex, conforme integração escolhida |
| Consentir, recusar e revogar medição | Comportamento de tags conforme configuração e política aprovadas | Codex + você |
| Reembolso/estorno | Reconciliação de evento e acesso conforme política | Você/Greenn; Codex no backend se houver |
| Corte DNS | Web/TLS, e-mail, webmail, cliente habitual, cPanel/FTP e serviços inventariados funcionando | Conjunto, após autorização de DNS |

## 6. Autorizações futuras separadas

- Escolha do modo de upsell e de eventual implementação adicional de integração/tracking.
- Procedimento e limites de transações de homologação, inclusive método e valor permitido; estorno não presumido.
- Projeto final de produção, janela e conjunto exato de mudanças DNS.
- Publicação/merge e ativação dos CTAs validados, com critério de rollback.

A aprovação do PR #4 e da preparação comercial não substitui essas autorizações. Até elas existirem, manter a prévia atual e os pagamentos não homologados bloqueados.
