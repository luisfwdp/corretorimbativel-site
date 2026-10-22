import type {Metadata} from 'next';
import {catalogue,site,type ProductId,isUpsell} from './catalogue';
export const productDescriptions:Record<ProductId,string>={
 ebook:'Estude direitos, deveres, comissão e cuidados da corretagem com o eBook Corretor Imbatível. Conteúdo educativo por R$ 147,00.',
 'manual-juridico':'Conheça os cuidados com contratos, propostas, distratos e registros da intermediação. Manual Jurídico digital por R$ 97,00.',
 combo:'Reúna o eBook Corretor Imbatível e o Manual Jurídico por R$ 197,00. Economia de R$ 47,00 em relação à compra separada.',
 'upsell-manual':'Oferta opcional do Manual Jurídico por mais R$ 50,00 para compradores do eBook. Confira o valor adicional e as condições da compra.',
 'upsell-ebook':'Oferta opcional do eBook por mais R$ 100,00 para compradores do Manual. Confira o valor adicional e as condições da compra.',
};
export const released=process.env.SITE_RELEASE==='production';
export function metadataFor(id?:ProductId):Metadata {
 const title=id?catalogue[id].title:'Corretor Imbatível | Segurança jurídica na corretagem';
 const description=id?productDescriptions[id]:'Conheça o eBook, o Manual Jurídico e o Combo Completo do Corretor Imbatível e escolha o material ideal para sua atuação profissional.';
 const path=id?`/${id}`:'/';const url=new URL(path,site.url).href;
 const imageOrigin=!released&&process.env.VERCEL_URL?`https://${process.env.VERCEL_URL}`:site.url;
 return {title,description,alternates:{canonical:url},robots:!released||(id&&isUpsell(id))?{index:false,follow:false}:{index:true,follow:true},openGraph:{title,description,url,siteName:site.name,locale:'pt_BR',type:'website',images:[{url:`${imageOrigin}/opengraph-image`,width:1200,height:630,alt:site.name}]},twitter:{card:'summary_large_image',title,description,images:[`${imageOrigin}/opengraph-image`]}};
}
