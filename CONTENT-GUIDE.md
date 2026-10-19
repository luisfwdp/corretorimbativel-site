# Edição de conteúdo

Consulte [FUNIL-DE-VENDAS.md](FUNIL-DE-VENDAS.md) para a tabela completa dos campos e das ofertas.

Em Aparência → Personalizar, cada grupo **Vendas — [produto]** controla nome, preço, CTA, texto, checkout e validação, parcelamento e garantia. Imagens têm campos próprios para eBook e Manual; o Combo usa ambos. Não reaproveitar um checkout para um produto diferente sem conferir a oferta e entrega na Greenn.

Os grupos antigos Oferta, Textos, Especialista e Tracking são preservados. Headline, FAQ e depoimentos da landing original continuam editáveis; logo e foto continuam usando os uploads do WordPress. Preço e checkout legados não determinam a nova oferta pública. O preço do eBook agora usa `ci_sales_ebook_price` com padrão R$ 147,00.

Upsells têm modo de nova compra ou código oficial Greenn. O código executável só pode ser salvo por administrador com `unfiltered_html`; não alterar os atributos gerados pela Greenn. Configurar confirmação, destino de recusa e testar todo o fluxo antes de marcar validação.

Campos opcionais vazios não anunciam garantia ou parcelamento. Não inserir marcadores, depoimentos sem comprovação, urgência artificial ou materiais editáveis não confirmados. O mockup oficial do Manual e seu arquivo de conteúdo ainda precisam ser conferidos antes de publicar.

O checkout para amigos é privado e nunca é lido pelas páginas públicas. Divulgá-lo apenas diretamente aos destinatários da oferta.
