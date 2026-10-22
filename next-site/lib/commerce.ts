import 'server-only';
import {catalogue,ids,type ProductId,isUpsell} from './catalogue';
export type OfferConfig={url:string|null;verified:boolean;mode:'separate'|'native';decline:string|null;ready:boolean};
export function safeHttps(value:string|undefined,greennOnly=false):string|null {
 if(!value)return null;
 try {const u=new URL(value);if(u.protocol!=='https:'||u.username||u.password)return null;
 if(greennOnly&&!(u.hostname==='greenn.com.br'||u.hostname.endsWith('.greenn.com.br')))return null;
 return u.href;} catch{return null;}
}
const prefixes:Record<ProductId,string>={ebook:'EBOOK','manual-juridico':'MANUAL',combo:'COMBO','upsell-manual':'UPSELL_MANUAL','upsell-ebook':'UPSELL_EBOOK'};
export function getOffer(id:ProductId):OfferConfig{
 const prefix=prefixes[id];const url=safeHttps(process.env[`GREENN_${prefix}_URL`],true);
 const verified=process.env[`GREENN_${prefix}_VERIFIED`]==='true';
 const mode=process.env[`GREENN_${prefix}_MODE`]==='native'?'native':'separate';
 const decline=safeHttps(process.env[`GREENN_${prefix}_DECLINE_URL`]);
 return {url,verified,mode,decline,ready:!!url&&verified&&(!isUpsell(id)||!!decline)};
}
export function auditOffers(){
 const seen=new Map<string,ProductId>();
 for(const id of ids){const o=getOffer(id);if(!o.url)continue;const prior=seen.get(o.url);if(prior)throw new Error(`Checkout duplicado: ${prior} e ${id}. Configure ofertas independentes.`);seen.set(o.url,id);}
}
export const analyticsConfig={ga4:/^G-[A-Z0-9]+$/.test(process.env.GA4_ID||'')?(process.env.GA4_ID??null):null,pixel:/^\d{8,20}$/.test(process.env.META_PIXEL_ID||'')?(process.env.META_PIXEL_ID??null):null,enabled:process.env.SITE_RELEASE==='production'&&process.env.ANALYTICS_ENABLED==='true'};
export const manualImage=safeHttps(process.env.MANUAL_IMAGE_URL);
export const educational='Material educativo. Não substitui orientação jurídica individualizada nem garante resultados em uma negociação.';
export const productEvent=(id:ProductId)=>({item_id:id,item_name:catalogue[id].name,price:catalogue[id].price,quantity:1});
