# Inventário autenticado da Greenn

Inspeção e configuração realizadas em 20 e 21/10/2026 no painel da conta, sem transações ou ativação de analytics. As aulas do eBook e do Manual foram publicadas na área de membros.

## Produtos existentes

| Produto Greenn | ID | Oferta ativa aprovada | Página de vendas atual | Entrega verificada |
| --- | ---: | --- | --- | --- |
| eBook Corretor Imbatível | `123089` | Oferta pública aprovada de `R$ 147,00`; link `https://payfast.greenn.com.br/123089/offer/0qEOa5` | `https://corretorimbativel.com.br/ebook` | Greenn Club, aula publicada com o PDF definitivo; arquivo antigo de entrega direta removido |
| Manual Jurídico para Corretores de Imóveis e Imobiliárias | `141872` | Oferta ativa/aprovada de `R$ 97,00`; link `https://payfast.greenn.com.br/141872/offer/ZUSxQ1` | `https://corretorimbativel.com.br/manual-juridico` | Greenn Club, aula publicada com o PDF definitivo protegido; cinco arquivos DOCX mantidos para download; PDF antigo removido da entrega direta |
| Combo Completo Corretor Imbatível — eBook + Manual Jurídico | `199450` | Oferta ativa/aprovada de `R$ 197,00`; link `https://payfast.greenn.com.br/199450/offer/iEN8Vn` | `https://corretorimbativel.com.br/combo` | Greenn Club, acesso vinculado às turmas do eBook e do Manual |
| Manual Jurídico — Complemento após eBook | `199482` | Oferta ativa/aprovada de `R$ 50,00`; link `https://payfast.greenn.com.br/199482/offer/3ZTVhJ` | `https://corretorimbativel.com.br/upsell-manual` | Greenn Club, turma `Compradores do Manual Jurídico`; produto sem upsell |
| eBook Corretor Imbatível — Complemento após Manual | `199483` | Oferta ativa/aprovada de `R$ 100,00`; link `https://payfast.greenn.com.br/199483/offer/LzV3lU` | `https://corretorimbativel.com.br/upsell-ebook` | Greenn Club, turma `EBOOK CORRETOR IMBATIVEL | Primeira Turma`; produto sem upsell |

O checkout legado do produto `123089`, de `R$ 197,00`, permanece separado e não é usado no site. A nova oferta pública de `R$ 147,00` está ativa e aprovada. A oferta privada de amigos, de `R$ 97,00`, foi criada separadamente no link `https://payfast.greenn.com.br/123089/offer/Jzg1nf` e não deve ser publicada no site.

O checkout do produto `141872` foi conferido no painel e na página de pagamento como ativo e aprovado por `R$ 97,00`. A entrega pelo Club está vinculada a todas as ofertas e à turma `Compradores do Manual Jurídico`. A descrição do produto foi corrigida para corresponder exatamente aos cinco DOCX finais.

Os mockups aprovados foram aplicados também aos dois produtos complementares. As antigas ofertas `jPi4sa` (`R$ 50,00`) e `87Z6rU` (`R$ 100,00`), antes inseridas nos produtos principais, foram desativadas. Em 21/10, a conferência final encontrou as páginas de vendas do eBook e do Manual apontando indevidamente para esses checkouts antigos; a correção para as rotas oficiais foi preparada e depende do salvamento final no painel.

## Matriz ainda necessária

| Jornada | Produto/arquivo entregue | Preço | Situação em 20/10/2026 |
| --- | --- | ---: | --- |
| eBook público | PDF do eBook | R$ 147,00 | Oferta ativa/aprovada (`0qEOa5`); entrega pelo Club publicada |
| eBook privado para amigos | PDF do eBook | R$ 97,00 | Oferta separada criada (`Jzg1nf`); manter fora do site |
| Manual público | Manual + cinco DOCX | R$ 97,00 | Oferta ativa/aprovada (`ZUSxQ1`); aula protegida publicada; integração ativa; PDF antigo removido |
| Combo | PDF do eBook + PDF do Manual | R$ 197,00 | Produto `199450` ativo/aprovado; acesso às duas turmas vinculado |
| Complemento Manual após eBook | Manual | R$ 50,00 | Produto `199482`, oferta `3ZTVhJ` ativa/aprovada; entrega pelo Club vinculada; sem upsell próprio |
| Complemento eBook após Manual | PDF do eBook | R$ 100,00 | Produto `199483`, oferta `LzV3lU` ativa/aprovada; entrega pelo Club vinculada; sem upsell próprio |

As páginas de vendas a configurar na Greenn são:

- eBook: `https://corretorimbativel.com.br/ebook`
- Manual Jurídico: `https://corretorimbativel.com.br/manual-juridico`
- Combo: `https://corretorimbativel.com.br/combo`

## Upsell nativo e escopo real

O recurso está disponível na conta em **Produtos > Checkouts > Upsell**. O painel oferece duas modalidades:

- página de upsell hospedada pela Greenn;
- botão/código HTML para página externa.

O formulário da página permite selecionar produto e oferta, definir texto de aceite, texto e destino de recusa, confirmação visual e personalização. Foram criadas e preservadas as páginas `Após eBook — Manual Jurídico por R$ 50` (`/one-click/7196`) e `Após Manual público — eBook por R$ 100` (`/one-click/7197`), sem teste financeiro.

Ao ligar uma página à etapa **Venda mais** do produto inicial, o painel não oferece filtro pela oferta que originou a compra. A vinculação alcança todas as ofertas do produto. A solução adotada foi separar os itens adicionais em produtos sem upsell e desativar as antigas ofertas complementares dentro dos produtos principais. A configuração ativa ficou assim:

- produto eBook `123089` → página `/one-click/7196` → produto Manual complementar `199482` por R$ 50;
- produto Manual `141872` → página `/one-click/7197` → produto eBook complementar `199483` por R$ 100;
- produtos complementares `199482` e `199483` → sem upsell próprio.

A oferta privada de amigos no produto `123089` recebe o mesmo Manual por R$ 50, conforme decisão comercial expressa. O Combo permanece em produto separado e não recebe esses upsells.

## Bloqueios observados

- A conta informa que a validação documental para liberar saques ainda está pendente.
- O Combo está ativo e entrega as duas turmas existentes pelo Greenn Club.
- A oferta privada de amigos existe e deve permanecer fora dos CTAs públicos.
- Os dois complementos novos estão ativos e aprovados; as ofertas antigas equivalentes estão inativas.
- As duas páginas nativas estão salvas e ligadas aos produtos principais.
- Não houve compra, cobrança ou teste financeiro.
