import {ImageResponse} from 'next/og';
import {readFile} from 'node:fs/promises';
import path from 'node:path';
export const alt='Corretor Imbatível — conhecimento jurídico para corretores de imóveis';
export const size={width:1200,height:630};
export const contentType='image/png';
export default async function Image(){const font=await readFile(path.join(process.cwd(),'public/fonts/playfair-regular.ttf'));return new ImageResponse(<div style={{display:'flex',width:'100%',height:'100%',background:'#102737',color:'#f8f6f0',padding:72,flexDirection:'column',justifyContent:'space-between'}}><div style={{display:'flex',fontSize:24,color:'#e3c981',letterSpacing:3}}>Corretor Imbatível</div><div style={{display:'flex',fontFamily:'Playfair',fontSize:76,lineHeight:1.12,maxWidth:1000}}>Sua carreira imobiliária merece mais segurança jurídica.</div><div style={{display:'flex',borderTop:'1px solid #526572',paddingTop:24,fontSize:24}}>eBook · Manual Jurídico · Combo Completo</div></div>,{...size,fonts:[{name:'Playfair',data:font.buffer.slice(font.byteOffset,font.byteOffset+font.byteLength),weight:400,style:'normal'}]});}
