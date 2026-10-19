import type {MetadataRoute} from 'next';
import {released} from '@/lib/metadata';
import {site} from '@/lib/catalogue';
export default function robots():MetadataRoute.Robots{return {rules:released?{userAgent:'*',allow:'/',disallow:['/upsell-manual','/upsell-ebook']}:{userAgent:'*',disallow:'/'},...(released?{sitemap:`${site.url}/sitemap.xml`}:{})};}
