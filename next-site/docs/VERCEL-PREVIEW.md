# Resultado do preview

## Atualização de copy — 20/10/2026

Nova prévia READY: https://corretor-imbativel-next-preview-j4kuyocki.vercel.app

Commit da aplicação: `69d166f`. Deployment: `dpl_GEk6yGvY7SmA45RSg42jGkTnWsGp`. Branch isolada: `codex/copy-aprovada-next`. Sem merge, DNS ou publicação no domínio oficial. Ver [implementação e testes da copy](copy/IMPLEMENTACAO.md).

## Prévia anterior, mantida como histórico

- **URL:** https://corretor-imbativel-next-preview-1fa281q98.vercel.app
- **Target:** preview (a API retorna `target: null`; o campo deve ser omitido na criação).
- **Status:** READY.
- **Commit da aplicação implantada:** `186dd5640ec964a63c1656de9a5c7908ca77826a`.
- **Framework:** Next.js 16.4.2 / App Router.
- **Build e publicação do preview:** aproximadamente 26 segundos entre início do build e READY.
- **Deployment:** `dpl_5kXLQ37Ftcip7M1J6CyfGzpKyodr`.
- **Projeto:** corretor-imbativel-next-preview (`prj_OroF7tfTxDA3GljRKjuszK0ovmcf`).
- **Equipe:** luisfwdp-2259s-projects.
- **PR de revisão:** https://github.com/luisfwdp/corretorimbativel-site/pull/3 (draft, empilhado na branch do PR #2).

A proteção padrão da Vercel foi mantida. O proprietário pode entrar com sua conta; links temporários usados nos testes não foram versionados. Somente endereços automáticos `*.vercel.app` estão associados ao projeto, sem o domínio oficial. Não houve alteração de DNS, merge, promoção da versão final a produção ou desativação do WordPress.

## Páginas

- `/`: escolha entre os três produtos.
- `/ebook`: eBook, R$ 147.
- `/manual-juridico`: Manual, R$ 97.
- `/combo`: os dois por R$ 197; economia R$ 47.
- `/upsell-manual`: adicional R$ 50; jornada R$ 197.
- `/upsell-ebook`: adicional R$ 100; jornada R$ 197.

Todas as seis rotas foram testadas no deployment final em 1440px e 390px, incluindo conteúdo, imagens, noindex, FAQ e recusa, sem erros JavaScript ou violações axe detectadas nos testes. Canonicals apontam para o domínio oficial; o OG do preview utiliza a imagem do próprio deployment. O preview inteiro permanece fora da indexação; os upsells continuam noindex também no eventual build de produção.

## Registro da implantação

A primeira solicitação usou `target: "preview"`, mas foi classificada como production pela API no projeto recém-criado. Ela foi cancelada durante BUILDING, antes de READY (`dpl_CM9SXqffDgNgUsMHWU9yZEL6sqJ5`). Nenhum domínio personalizado estava associado. A criação foi refeita omitindo target conforme a documentação oficial, e os dois deployments seguintes foram confirmados como preview (`target: null`). A atribuição automática de domínios personalizados foi desativada no projeto separado. Não se alterou a produção do Corretor Imbatível.

Relatórios adicionados depois do commit da aplicação não alteram o código implantado. Não há automação de produção ou merge nesta entrega. O diretório WordPress e os comandos cPanel existentes permanecem preservados.

## Validação comercial ainda pendente

A visita ao preview não efetua cobrança. Links reais e verificação das cinco ofertas, elegibilidade, destinos de recusa/conclusão, cobrança e entrega ainda precisam da conta Greenn. O modo nativo não foi simulado. Faltam também arquivo/arte do Manual, IDs corretos de analytics e homologação final. Ver [GREENN.md](GREENN.md), [VALIDACAO.md](VALIDACAO.md) e [MIGRACAO.md](MIGRACAO.md).
