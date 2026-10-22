import Image from 'next/image';
import {type LandingId,money,catalogue,savings} from '@/lib/catalogue';
const visuals:Record<LandingId,{src:string;caption:string;detail:string;alt:string}>={
 ebook:{src:'/images/product-ebook-greenn.png',caption:'eBook Corretor Imbatível',detail:'Conhecimento jurídico',alt:'Mockup do eBook Corretor Imbatível em livro e tablet'},
 'manual-juridico':{src:'/images/product-manual-greenn.png',caption:'Manual Jurídico',detail:'Documentação e formalização',alt:'Mockup do Manual para Corretores de Imóveis e Imobiliárias em livro e tablet'},
 combo:{src:'/images/product-combo-greenn.png',caption:'Combo Completo',detail:'eBook + Manual Jurídico',alt:'Mockup do Combo Completo com o eBook Corretor Imbatível e o Manual Jurídico'},
};
export function ProductVisual({id,priority=false}:{id:LandingId;priority?:boolean}){
 const visual=visuals[id];
 return <figure className="publication"><div className="publication-image"><Image src={visual.src} alt={visual.alt} width={1254} height={1254} priority={priority} sizes="(max-width: 680px) 90vw, (max-width: 1000px) 55vw, 500px"/></div><figcaption>{visual.caption}<span>{visual.detail}</span></figcaption></figure>;
}
export function Price({id}:{id:LandingId}){return <p className="price">{money(catalogue[id].price)}</p>;}
export function ComboSaving(){return <p className="saving">Economia de {money(savings)} em relação à compra dos dois produtos separadamente.</p>;}
