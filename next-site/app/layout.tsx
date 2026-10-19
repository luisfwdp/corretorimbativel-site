import type {Metadata,Viewport} from 'next';
import localFont from 'next/font/local';
import {Tracking} from '@/components/tracking';
import {analyticsConfig,auditOffers} from '@/lib/commerce';
import {site} from '@/lib/catalogue';
import './globals.css';
const playfair=localFont({src:[{path:'../public/fonts/playfair-regular.woff2',weight:'400'}],variable:'--font-playfair',display:'swap',fallback:['Georgia']});
const lato=localFont({src:[{path:'../public/fonts/lato-regular.woff2',weight:'400'},{path:'../public/fonts/lato-bold.woff2',weight:'700'}],variable:'--font-lato',display:'swap',fallback:['Arial']});
export const metadata:Metadata={metadataBase:new URL(site.url),applicationName:site.name,icons:{icon:'/images/logo.svg'}};
export const viewport:Viewport={width:'device-width',initialScale:1,themeColor:'#102737'};
export default function RootLayout({children}:{children:React.ReactNode}){auditOffers();return <html lang="pt-BR"><body className={`${playfair.variable} ${lato.variable}`}><a className="skip-link" href="#main">Pular para o conteúdo</a>{children}<Tracking config={analyticsConfig}/></body></html>;}
