# Corretor Imbatível — tema WordPress

Tema existente ampliado para uma home de escolha, três produtos e duas ofertas complementares. Sem page builder ou build step; mantém a identidade editorial, Playfair Display/Lato e campos legados do Customizer.

**[FUNIL-DE-VENDAS.md](FUNIL-DE-VENDAS.md)** contém a auditoria, preços atuais, arquitetura, recursos oficiais da Greenn, campos editáveis, procedimento idempotente de páginas e publicação, testes e pendências.

A implementação está preparada para validação. Checkouts novos ficam vazios e desabilitados até confirmação; upsell visual não equivale a integração financeira homologada. Nenhum deploy em produção foi realizado.

- Tema: `wp-content/themes/corretor-imbativel/`
- Home: `front-page.php`; landing original preservada: `page-ebook.php`
- Templates independentes: `page-manual-juridico.php`, `page-combo.php`, `page-upsell-manual.php`, `page-upsell-ebook.php`
- Componentes: `template-parts/`; catálogo e configurações: `inc/funnel.php`
- CSS/JS diretos em `assets/`; PHP 7.4+ e WordPress 6.0+
- Registro de páginas: `tools/register-funnel-pages.php` (WP-CLI, simulação por padrão)

O banco do WordPress, os uploads e os arquivos sensíveis não são versionados. Confira o mecanismo real do cPanel antes de utilizar os scripts de deploy existentes.
