# Migração controlada e rollback

## Isolamento atual

Nova branch `codex/nextjs-premium-preview`, diretório `next-site`, sem mudança em `wp-content`, deploy.sh, .cpanel.yml, uploads, banco, .env existente ou DNS. PR #2 permanece referência e fallback. O diretório de Next não é copiado pelo rsync do tema. Não executar Deploy HEAD no cPanel para publicar esta aplicação.

Projeto Vercel separado: `corretor-imbativel-next-preview`, equipe `luisfwdp-2259s-projects`. Criado sem conectar a branch padrão do WordPress e sem domínio personalizado. Publicar somente `target=preview`; não usar --prod/promote. A proteção Vercel permanece ativa. Preview e páginas complementares possuem noindex; robots de preview bloqueia todo crawling. Canonicals continuam no domínio oficial.

## Antes de qualquer mudança de domínio

1. Aprovar UI/copy, testar todas as seis rotas no preview, receber arte/arquivo real do Manual e homologar Greenn. Conferir os IDs corretos de analytics e as configurações editáveis atualmente no WordPress: elas não migram sozinhas para variáveis Vercel.
2. Inventariar todas as URLs existentes (além das seis), campanhas, mídias em /wp-content/uploads, sitemap, URLs www/sem-www, e quaisquer wp-json/wp-admin usados por integrações. Exportar os registros DNS atuais e TTL de cada registro afetado. Não copiar credenciais para o repositório.
3. Backup verificado de arquivos/banco/configuração da hospedagem. Registrar o destino anterior dos registros A/AAAA/CNAME da web, sem alterar MX/TXT/SPF/DKIM/DMARC ou servidores DNS.
4. Definir como o WordPress continuará acessível administrativamente sem o apex após o corte: acesso autorizado da hospedagem ou hostname aprovado com certificado e URLs corretas. Não criar subdomínio ou alterar siteurl/home automaticamente. O código do tema sozinho não constitui backup do WordPress.
5. Mídia: os dois assets usados aqui estão locais; outras URLs públicas da instalação precisam de inventário. Preservar/transferir as mídias antigas antes do corte ou definir redirects específicos. Não enviar /wp-admin e /wp-json indiscriminadamente a Next.
6. Preparar um build de produção separado, com domínio/canonical corretos, SITE_RELEASE=production, consentimento e IDs validados. `SITE_RELEASE` é independente de NODE_ENV: npm run build em preview continua noindex. Validar o build de produção antes de promover, sem copiar condições de teste para a conta real.

## Corte, apenas após aprovação expressa

1. Obter da Vercel os registros exatos exigidos para o domínio e, se for parte do inventário aprovado, www. Não usar um IP ou CNAME genérico presumido.
2. Agendar janela e, se aprovado, reduzir TTL previamente; esperar expiração do TTL anterior. Confirmar ausência de compras interrompidas no funil.
3. Associar o domínio ao projeto correto e alterar apenas os registros web aprovados. Não mudar nameservers ou registros de email. Aguardar certificado TLS válido e propagação; manter HostGator e WordPress ativos.
4. Confirmar seis rotas, URLs antigas/redirects, trailing slash, querystrings, HTTPS, canonical/OG/sitemap, indexação das três landings e noindex dos upsells. URLs antigas com barra final seguem redirect permanente do Next para a mesma rota sem barra, preservando querystring; testar especialmente o token com a Greenn antes de apontar o provedor.
5. Conferir pagamento, recusa, confirmação e entrega reais, analytics e conversões sem duplicação. Atualizar URLs pós-compra e campanhas apenas no momento acordado. Não usar uma URL de preview temporária em anúncios de produção.
6. Acompanhar erros, 404, performance de campo e métricas de negócio; Lighthouse local não equivale a Core Web Vitals de usuários reais.

## Rollback

Gatilhos: falha de checkout/entrega, perda de contexto do upsell, quebra de rotas importantes, problemas de certificado ou regressão crítica. Restaurar os valores DNS web exatos registrados antes do corte; manter email intacto. Aguardar propagação conforme TTL, testar WordPress/HTTPS e conferir destinos pós-compra/links Greenn que tenham sido alterados no corte. Reverter esses destinos conforme o registro da janela. Não excluir projeto Vercel nem arquivos novos para fazer rollback; preservar logs sem tokens e diagnosticar fora da produção.

Não restaurar banco indiscriminadamente se houver atividade posterior ao backup. Entrega e vendas estão na Greenn e devem ser reconciliadas independentemente do frontend. Não desligar a hospedagem antiga enquanto o fallback e a janela de observação estiverem ativos.
