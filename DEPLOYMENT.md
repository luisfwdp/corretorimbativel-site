> Atualização do ecossistema: consulte [FUNIL-DE-VENDAS.md](FUNIL-DE-VENDAS.md) antes de publicar. As referências abaixo a `main` e à instalação inicial são históricas; a branch padrão auditada é `claude/corretor-imbativel-landing-vbkg56`. O estado real do cPanel precisa ser conferido. Os scripts não criam páginas WordPress e `rsync` não é atômico.

# Deployment — HostGator / cPanel

Fluxo alvo:

```
Desenvolvimento local → commit → push (GitHub) → pull no cPanel (Git Version Control) → deploy.sh copia só o tema → site atualizado
```

O domínio de produção é `corretorimbativel.com.br`, já criado no cPanel (`br434.hostgator.com.br:2083`), apontando para o diretório `/corretorimbativel.com.br` conforme a tela de Domínios.

## 1. Instalar o WordPress no domínio (se ainda não instalado)

No cPanel, use **Softaculous / WordPress Manager** (visível na barra lateral) para instalar o WordPress na raiz do domínio `corretorimbativel.com.br`. Guarde as credenciais de admin fora do Git — nunca commitá-las.

## 2. Conectar o repositório Git no cPanel

1. No cPanel, abra **Git Version Control** (`Ferramentas → Git Version Control`; se não aparecer, peça à HostGator para habilitar o recurso no plano).
2. Clique em **Create** e configure:
   - **Clone a Repository**: marque essa opção.
   - **Clone URL**: a URL HTTPS deste repositório GitHub (`https://github.com/luisfwdp/corretorimbativel-site.git`).
   - **Repository Path**: um diretório **fora** do `public_html` do domínio, por exemplo `/home/USUARIO/repositories/corretorimbativel-site` — isso evita que o `.git` fique publicamente acessível.
   - **Repository Name**: `corretorimbativel-site`.
3. Se o repositório for privado, gere um **Personal Access Token** no GitHub (Settings → Developer settings → Fine-grained tokens, permissão apenas de leitura nesse repo) e use-o como senha ao autenticar o clone pelo cPanel (usuário = seu usuário GitHub, senha = o token). Não salve o token em nenhum arquivo do projeto.
4. Após clonado, o cPanel mostra o repositório na lista com um botão **Manage**, de onde é possível rodar **Pull or Deploy** nas atualizações seguintes.

## 3. Primeiro deploy do tema

Via **Terminal do cPanel** (ou SSH, se seu plano tiver acesso):

```bash
cd /home/USUARIO/repositories/corretorimbativel-site
git pull origin main
./deploy.sh /home/USUARIO/public_html
```

Ajuste `/home/USUARIO/public_html` para o caminho real do domínio `corretorimbativel.com.br` (confira em **Domínios** no cPanel — a coluna "Diretório" mostra o caminho exato, ex: `/corretorimbativel.com.br`).

O `deploy.sh`:
- só copia `wp-content/themes/corretor-imbativel` — nunca toca em `wp-config.php` nem em `wp-content/uploads`;
- usa `rsync --delete` restrito à pasta do tema, então arquivos removidos do tema no Git são removidos no servidor, mas nada fora dessa pasta é afetado;
- aborta (`set -e`) se qualquer etapa falhar, sem deixar o tema pela metade.

## 4. Ativar o tema

No wp-admin (`corretorimbativel.com.br/wp-admin`), vá em **Aparência → Temas** e ative "Corretor Imbatível". Depois siga `CONTENT-GUIDE.md` para preencher preço, checkout, textos e imagens.

## 5. Atualizações seguintes

Sempre que houver push para `main`:

```bash
cd /home/USUARIO/repositories/corretorimbativel-site
git pull origin main
./deploy.sh /home/USUARIO/public_html
```

Isso pode ser feito manualmente pelo Terminal do cPanel, ou automatizado com um **Cron Job** (cPanel → Cron Jobs) rodando esse mesmo bloco a cada X minutos/horas — trade-off: deploys um pouco atrasados em troca de zero intervenção manual. Para deploy imediato a cada push, seria necessário um GitHub Actions com acesso SSH ao servidor (exige plano HostGator com SSH liberado); não configurado aqui pois depende de credenciais que não devem transitar por este documento.

## O que NUNCA é sobrescrito ou apagado

- `wp-config.php`
- `wp-content/uploads/`
- Qualquer plugin ou outro tema instalado diretamente no servidor
- O `.git` do Git Version Control (fica fora do `public_html`, ver passo 2)

## Branches

- `main` — produção (o que está em `main` é o que vai para o servidor)
- `develop` — integração de features antes de promover para `main`
- `feature/*`, `hotfix/*` — trabalho em andamento

Nunca faça `git push` direto para `main` a partir do servidor — o fluxo é sempre local → GitHub → `git pull` no servidor.
