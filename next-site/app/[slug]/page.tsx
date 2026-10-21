import {notFound} from 'next/navigation';
import {ids,isProduct,isUpsell,type LandingId} from '@/lib/catalogue';
import {metadataFor} from '@/lib/metadata';
import {Header,Footer} from '@/components/shell';
import {Hero} from '@/components/hero';
import {Narrative,Faq} from '@/components/content';
import {Authority} from '@/components/authority';
import {Offer,Closing} from '@/components/offers';
import {Upsell} from '@/components/upsell';
import {ProductScrollShowcase} from '@/components/product-scroll-showcase';
export const dynamicParams=false;
export function generateStaticParams(){return ids.map(slug=>({slug}));}
export async function generateMetadata({params}:{params:Promise<{slug:string}>}){const{slug}=await params;return isProduct(slug)?metadataFor(slug):{};}
export default async function Page({params}:{params:Promise<{slug:string}>}){const{slug}=await params;if(!isProduct(slug))notFound();const upsell=isUpsell(slug);return <><Header offer={!upsell} collectionHref="/#produtos"/><main className={`edition edition-${slug}`} id="main" tabIndex={-1}>{upsell?<Upsell id={slug}/>:<><Hero id={slug as LandingId}/>{slug==='combo'?<ProductScrollShowcase/>:null}<Narrative id={slug as LandingId}/><Authority/><Offer id={slug as LandingId}/><Faq id={slug as LandingId}/><Closing id={slug as LandingId}/></>}</main><Footer/></>;}
