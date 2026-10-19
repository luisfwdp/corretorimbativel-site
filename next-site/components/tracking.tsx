'use client';
import {useEffect,useRef,useSyncExternalStore} from 'react';
import {usePathname} from 'next/navigation';
import Script from 'next/script';
import {catalogue,isProduct,type ProductId} from '@/lib/catalogue';
import {readAttribution,safePageLocation} from '@/lib/attribution';
declare global {interface Window {dataLayer?:unknown[];gtag?:(...args:unknown[])=>void;fbq?:((...args:unknown[])=>void)&{queue?:unknown[][];loaded?:boolean;version?:string;push?:unknown;callMethod?:(...args:unknown[])=>void};}}
export function emit(event:string,id:ProductId,placement:string){
 let consent=false;try{consent=localStorage.getItem('ci-consent-v1')==='granted';}catch{}if(!consent)return;
 const product=catalogue[id];const data={currency:'BRL',value:product.price,items:[{item_id:id,item_name:product.name,price:product.price,quantity:1}],placement,...(id.startsWith('upsell-')?{promotion_id:id}:{})};
 if(window.gtag)window.gtag('event',event,{...data,page_location:safePageLocation(location.href)});else(window.dataLayer??=[]).push({event,...data});
 // Native Greenn token context must never be collected by Meta's automatic URL capture.
 if(window.fbq&&!location.pathname.startsWith('/upsell-')){const meta=event==='begin_checkout'?'InitiateCheckout':event==='view_item'?'ViewContent':null;if(meta)window.fbq('track',meta,{content_ids:[id],content_type:'product',value:product.price,currency:'BRL'});}
}
function subscribeConsent(listener:()=>void){window.addEventListener('storage',listener);window.addEventListener('ci:consent',listener);return()=>{window.removeEventListener('storage',listener);window.removeEventListener('ci:consent',listener);};}
function consentSnapshot(){try{return localStorage.getItem('ci-consent-v1')||'unknown';}catch{return 'unknown';}}
export function Tracking({config}:{config:{ga4:string|null;pixel:string|null;enabled:boolean}}){
 const path=usePathname();const last=useRef('');const consent=useSyncExternalStore(subscribeConsent,consentSnapshot,()=> 'unknown');
 useEffect(()=>{try{const values=readAttribution(location.search);if(Object.keys(values).length)sessionStorage.setItem('ci-attribution-v1',JSON.stringify({...JSON.parse(sessionStorage.getItem('ci-attribution-v1')||'{}'),...values}));window.dispatchEvent(new Event('ci:attribution'));}catch{}},[path]);
 
 useEffect(()=>{
  if(consent!=='granted'||!config.enabled)return;
  if(config.ga4&&!window.gtag){window.dataLayer??=[];window.gtag=(...args:unknown[])=>{window.dataLayer!.push(args);};window.gtag('js',new Date());window.gtag('config',config.ga4,{send_page_view:false,allow_google_signals:false,allow_ad_personalization_signals:false,page_location:safePageLocation(location.href),page_referrer:document.referrer?new URL(document.referrer).origin:''});}
  if(last.current===path)return;last.current=path;
  window.gtag?.('event','page_view',{page_location:safePageLocation(location.href),page_title:document.title,page_referrer:document.referrer?new URL(document.referrer).origin:''});
  const id=path.slice(1);if(isProduct(id))emit(id.startsWith('upsell-')?'view_promotion':'view_item',id,'page');
 },[path,consent,config]);
 const choose=(value:string)=>{try{localStorage.setItem('ci-consent-v1',value);}catch{}window.dispatchEvent(new Event('ci:consent'));};
 const pixelEnabled=consent==='granted'&&config.enabled&&!!config.pixel&&!path.startsWith('/upsell-');
 return <>{consent==='granted'&&config.enabled&&config.ga4?<Script id="ga4" strategy="afterInteractive" src={`https://www.googletagmanager.com/gtag/js?id=${config.ga4}`}/>:null}{pixelEnabled?<Script id="meta-pixel" strategy="afterInteractive">{`!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};n.queue=[];n.loaded=!0;n.version='2.0';t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init',${JSON.stringify(config.pixel)});`}</Script>:null}{config.enabled&&(config.ga4||config.pixel)&&consent==='unknown'?<aside className="consent" aria-label="Preferências de medição"><p>Podemos usar ferramentas de medição para entender visitas e melhorar estas páginas?</p><div><button type="button" className="button" onClick={()=>choose('granted')}>Permitir medição</button><button type="button" className="text-link" onClick={()=>choose('denied')}>Continuar sem medição</button></div></aside>:null}{config.enabled&&(config.ga4||config.pixel)&&consent!=='unknown'?<button type="button" className="privacy-preferences" onClick={()=>{if(consent==='granted'){choose('denied');location.reload();}else choose('unknown');}}>Preferências de privacidade</button>:null}</>;
}
