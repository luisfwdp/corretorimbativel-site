import {notFound} from 'next/navigation';
import {ids,isProduct,isUpsell,type LandingId} from '@/lib/catalogue';
import {metadataFor} from '@/lib/metadata';
import {productStructuredData} from '@/lib/structured-data';
import {JsonLd} from '@/components/json-ld';
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
export default async function Page({params}:{params:Promise<{slug:string}>}){const{slug}=await params;if(!isProduct(slug))notFound();const upsell=isUpsell(slug);const landingId=slug as LandingId;return <>{upsell?null:<JsonLd data={productStructuredData(landingId)}/>}<Header offer={!upsell} collectionHref="/#produtos"/><main className={`edition edition-${slug}`} id="main" tabIndex={-1}>{upsell?<Upsell id={slug}/>:<><Hero id={landingId}/><ProductScrollShowcase id={landingId}/><Narrative id={landingId}/><Authority/><Offer id={landingId}/><Faq id={landingId}/><Closing id={landingId}/></>}</main><Footer/></>;}
