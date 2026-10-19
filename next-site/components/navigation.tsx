'use client';
import Link from 'next/link';
import {useSyncExternalStore,type ReactNode} from 'react';
import {catalogue,type ProductId} from '@/lib/catalogue';
import {readAttribution,withAttribution} from '@/lib/attribution';
import {emit} from './tracking';
function subscribe(listener:()=>void){window.addEventListener('popstate',listener);window.addEventListener('ci:attribution',listener);return()=>{window.removeEventListener('popstate',listener);window.removeEventListener('ci:attribution',listener);};}
function attributionSnapshot(){let saved:Record<string,string>={};try{saved=JSON.parse(sessionStorage.getItem('ci-attribution-v1')||'{}');}catch{}return JSON.stringify({...saved,...readAttribution(location.search)});}
function useAttributedHref(href:string){const raw=useSyncExternalStore(subscribe,attributionSnapshot,()=> '{}');return withAttribution(href,JSON.parse(raw));}
export function ProductLink({id,children,className='button'}:{id:ProductId;children:ReactNode;className?:string}){const target=useAttributedHref(`/${id}`);return <Link className={className} href={target} onClick={()=>emit('select_item',id,'home')}>{children}</Link>;}
export function CheckoutLink({id,url,location:placement,children}:{id:ProductId;url:string;location:string;children?:ReactNode}){const target=useAttributedHref(url);return <a className="button" href={target} data-checkout={id} onClick={()=>{if(id.startsWith('upsell-'))emit('select_promotion',id,placement);emit('begin_checkout',id,placement);}}>{children||catalogue[id].cta}<span aria-hidden="true" className="button-mark">↗</span></a>;}
