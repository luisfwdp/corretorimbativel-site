import type {MetadataRoute} from 'next';
import {released} from '@/lib/metadata';
import {site} from '@/lib/catalogue';
const privateOffers=['/upsell-manual','/upsell-ebook'];
export default function robots():MetadataRoute.Robots{return released?{rules:[{userAgent:'*',allow:'/'},{userAgent:'OAI-SearchBot',allow:'/',disallow:privateOffers}],sitemap:`${site.url}/sitemap.xml`}:{rules:{userAgent:'*',disallow:'/'}};}
