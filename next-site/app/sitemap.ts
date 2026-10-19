import type {MetadataRoute} from 'next';
import {site} from '@/lib/catalogue';
export default function sitemap():MetadataRoute.Sitemap{return ['','/ebook','/manual-juridico','/combo'].map(path=>({url:site.url+path,changeFrequency:'monthly',priority:path?0.8:1}));}
