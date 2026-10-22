import type {Metadata,Viewport} from 'next';
import localFont from 'next/font/local';
import {Tracking} from '@/components/tracking';
import {analyticsConfig,auditOffers} from '@/lib/commerce';
import {site} from '@/lib/catalogue';
import './globals.css';
const stix=localFont({src:'../public/fonts/stix-two-text-variable.ttf',variable:'--font-stix',display:'swap',fallback:['Georgia'],weight:'400 700'});
const lato=localFont({src:[{path:'../public/fonts/lato-regular.woff2',weight:'400'},{path:'../public/fonts/lato-bold.woff2',weight:'700'}],variable:'--font-lato',display:'swap',fallback:['Arial']});
export const metadata:Metadata={metadataBase:new URL(site.url),applicationName:site.name,icons:{icon:'/images/logo.svg'}};
export const viewport:Viewport={width:'device-width',initialScale:1,themeColor:'#102737'};
export default function RootLayout({children}:{children:React.ReactNode}){auditOffers();return <html lang="pt-BR"><body className={`${stix.variable} ${lato.variable}`}><a className="skip-link" href="#main">Pular para o conteúdo</a>{children}<Tracking config={analyticsConfig}/></body></html>;}
