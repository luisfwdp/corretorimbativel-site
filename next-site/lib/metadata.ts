import type {Metadata} from 'next';
import {catalogue,site,type ProductId,isUpsell} from './catalogue';
export const released=process.env.SITE_RELEASE==='production';
export function metadataFor(id?:ProductId):Metadata {
 const title=id?catalogue[id].title:'Corretor Imbatível | Segurança jurídica na corretagem';
 const description=id?catalogue[id].summary:'Conheça o eBook, o Manual Jurídico e o Combo Completo do Corretor Imbatível e escolha o material ideal para sua atuação profissional.';
 const path=id?`/${id}`:'/';const url=new URL(path,site.url).href;
 const imageOrigin=!released&&process.env.VERCEL_URL?`https://${process.env.VERCEL_URL}`:site.url;
 return {title,description,alternates:{canonical:url},robots:!released||(id&&isUpsell(id))?{index:false,follow:false}:{index:true,follow:true},openGraph:{title,description,url,siteName:site.name,locale:'pt_BR',type:'website',images:[{url:`${imageOrigin}/opengraph-image`,width:1200,height:630,alt:site.name}]},twitter:{card:'summary_large_image',title,description,images:[`${imageOrigin}/opengraph-image`]}};
}
