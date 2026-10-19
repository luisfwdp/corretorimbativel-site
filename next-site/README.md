# Corretor Imbatível — preview Next.js

Aplicação isolada do WordPress. Root Directory na Vercel: `next-site`.

```bash
npm ci
npm run dev
npm run build
npm run start
npm run typecheck
npm run lint
npm test
node tests/browser.mjs
```

Node 24; versões de runtime travadas no package-lock. Sem banco, login ou entrega próprios. Pagamentos/arquivos continuam na Greenn. O ambiente padrão é preview, sem indexação e sem coletores de analytics ativos.

- `content/*.json`: narrativas completas importadas do WordPress/PR #2 e refinadas conforme auditoria. `scripts/import-wordpress.mjs` é ferramenta de reprodução contra WordPress LOCAL; não executar contra produção. Reimportar sobrescreve o conteúdo, portanto revise o diff.
- `lib/catalogue.ts`: nomes, preços e CTAs centralizados.
- `lib/commerce.ts`: configurações de checkouts, confirmação manual de validação e IDs de medição. Variáveis são server-side; nenhum segredo deve usar NEXT_PUBLIC.
- `.env.example`: configuração documentada, sem links inventados. Cole links reais em variáveis do projeto Vercel, não em arquivos versionados com credenciais.
- `components/ui/accordion.tsx`: componente adaptado de Motion Primitives, selecionado no 21st.dev; procedência e MIT em `docs/21ST-REVIEW.md`.
- Fontes locais Playfair Display e Lato, sob OFL. Assets originais do eBook e autor otimizados para WebP. O Manual não utiliza capa inventada.

Preview e commit implantado em `docs/VERCEL-PREVIEW.md`. Consulte `docs/MIGRACAO.md`, `docs/GREENN.md` e `docs/VALIDACAO.md` para bloqueios, resultados e rollback. Não mudar SITE_RELEASE para production nem conectar o domínio antes da aprovação expressa.
