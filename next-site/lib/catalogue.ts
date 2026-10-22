export const site = {name:'Corretor Imbatível',url:'https://corretorimbativel.com.br',author:'Dr. Rodrigo Barbato Fabbris'};
export const catalogue = {
 ebook:{name:'Corretor Imbatível — Manual Jurídico para Corretores de Imóveis',short:'Corretor Imbatível',label:'eBook',price:147,cta:'Quero acessar o Corretor Imbatível',summary:'Conhecimento jurídico aplicado à rotina do corretor de imóveis.',title:'Corretor Imbatível | Manual Jurídico para Corretores'},
 'manual-juridico':{name:'Manual Jurídico para Corretores de Imóveis e Imobiliárias',short:'Manual Jurídico',label:'Manual',price:97,cta:'Quero acessar o Manual Jurídico',summary:'Orientações práticas sobre documentos, contratos e cuidados jurídicos nas negociações.',title:'Manual Jurídico para Corretores e Imobiliárias'},
 combo:{name:'Corretor Imbatível — Combo Completo',short:'Combo Completo',label:'A opção mais completa',price:197,cta:'Quero o Combo Completo',summary:'Conhecimento jurídico e orientação documental em uma única compra.',title:'Combo Completo Corretor Imbatível'},
 'upsell-manual':{name:'Manual Jurídico — oferta complementar',short:'Complemente seu eBook',label:'Oferta complementar',price:50,cta:'Adicionar o Manual por R$ 50,00',summary:'Complemente seu eBook com orientações sobre documentação e formalização.',title:'Complemente seu eBook | Corretor Imbatível'},
 'upsell-ebook':{name:'Corretor Imbatível — oferta complementar',short:'Complemente seu Manual',label:'Oferta complementar',price:100,cta:'Adicionar o eBook por R$ 100,00',summary:'Amplie o conhecimento jurídico com o eBook Corretor Imbatível.',title:'Complemente seu Manual | Corretor Imbatível'},
} as const;
export type ProductId=keyof typeof catalogue;
export type LandingId='ebook'|'manual-juridico'|'combo';
export const ids=Object.keys(catalogue) as ProductId[];
export const isProduct=(id:string):id is ProductId=>Object.hasOwn(catalogue,id);
export const isUpsell=(id:ProductId)=>id.startsWith('upsell-');
export const money=(price:number)=>new Intl.NumberFormat('pt-BR',{style:'currency',currency:'BRL'}).format(price);
export const separateTotal=catalogue.ebook.price+catalogue['manual-juridico'].price;
export const savings=separateTotal-catalogue.combo.price;
