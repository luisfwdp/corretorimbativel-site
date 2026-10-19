import Image from 'next/image';
import {type LandingId,money,catalogue,savings} from '@/lib/catalogue';
import {manualImage} from '@/lib/commerce';
export function ProductVisual({id,priority=false}:{id:LandingId;priority?:boolean}){
 if(id==='combo')return <div className="product-pair"><ProductVisual id="ebook" priority={priority}/><ProductVisual id="manual-juridico" priority={priority}/></div>;
 if(id==='ebook')return <figure className="publication"><div className="publication-image"><Image src="/images/ebook.webp" alt="eBook Corretor Imbatível: mockup original da publicação digital" width={1122} height={1402} priority={priority} sizes="(max-width: 680px) 90vw, (max-width: 1000px) 55vw, 500px"/></div><figcaption>eBook Corretor Imbatível<span>Conhecimento jurídico</span></figcaption></figure>;
 if(manualImage)return <figure className="publication"><Image src={manualImage} unoptimized alt={catalogue['manual-juridico'].name} width={960} height={1200} priority={priority}/><figcaption>Manual Jurídico<span>Documentação e formalização</span></figcaption></figure>;
 return <aside className="manual-index" aria-label="Foco do Manual Jurídico"><p className="small-label">Documentação e formalização</p><p className="manual-index-title">Manual Jurídico</p><p>para Corretores de Imóveis e Imobiliárias</p><ul><li>Contratos de intermediação</li><li>Propostas e distratos</li><li>Comissão e registros</li></ul><p className="manual-index-credit">Dr. Rodrigo Barbato Fabbris</p></aside>;
}
export function Price({id}:{id:LandingId}){return <p className="price">{money(catalogue[id].price)}</p>;}
export function ComboSaving(){return <p className="saving">Economia de {money(savings)} em relação à compra dos dois produtos separadamente.</p>;}
