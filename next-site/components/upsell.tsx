import {catalogue,money,type ProductId} from '@/lib/catalogue';
import {getOffer,educational} from '@/lib/commerce';
import {salesCopy} from '@/lib/sales-copy';
import copy from '@/content/upsells.json';
import {ProductVisual} from './products';
import {PaymentAction} from './offers';
import {Decline} from './decline';
import {Accordion,AccordionItem} from './ui/accordion';

export function Upsell({id}:{id:ProductId}){
 const key=id==='upsell-manual'?'upsell-manual':'upsell-ebook';
 const manual=key==='upsell-manual';const p=catalogue[key];
 const base=catalogue[manual?'ebook':'manual-juridico'];const config=getOffer(key);
 const hero=salesCopy[key].hero;const c=copy[key];
 const benefits=manual?['Formalização do serviço','Função dos documentos','Registros da intermediação']:['Direitos e deveres','Contexto da comissão','Boas práticas'];
 return <>
  <section className="upsell-hero" id="hero"><div className="shell upsell-grid"><div>
   <h1>{hero.headline}</h1><p className="hero-sub">{hero.subheadline}</p>
   <div className="upsell-decision" id="oferta"><p>Valor adicional {manual?'do Manual Jurídico':'do eBook Corretor Imbatível'}</p><p className="price">{money(p.price)}</p>
    <p className="journey-total">Compra inicial {manual?'do eBook':'do Manual'}: {money(base.price)}. Complemento opcional: {money(p.price)}. <strong>Total com os dois materiais: {money(base.price+p.price)}.</strong></p>
    <p className="purchase-notice">{config.mode==='native'?'No fluxo pós-compra, a Greenn pode apresentar este complemento em um clique. Nesta página de apoio, o botão abre um checkout separado para você revisar o valor e autorizar o pagamento. Visitar a página não gera cobrança.':'Esta oferta é uma nova compra, em checkout separado da Greenn. Você revisará o valor e autorizará o pagamento. Visitar esta página não gera cobrança.'}</p>
    <PaymentAction id={key}/><Decline url={config.decline} label={manual?'Não, obrigado. Quero continuar apenas com o eBook.':'Não, obrigado. Quero continuar apenas com o Manual.'}/>
    <p className="decision-note">Recusar o complemento não cancela sua compra anterior. Consulte as instruções de acesso {manual?'do eBook':'do Manual'}.</p>
   </div>
  </div><div className="upsell-visual"><ProductVisual id={manual?'manual-juridico':'ebook'} priority/></div></div></section>
  <section className="upsell-benefits narrative muted"><div className="shell">
   <h2>{c.introduction.title}</h2>{c.introduction.paragraphs.map(text=><p key={text}>{text}</p>)}
   <h2>O que o complemento acrescenta</h2><dl className="benefit-columns">{c.benefits.map((text,i)=><div key={text}><dt>{benefits[i]}</dt><dd>{text}</dd></div>)}</dl><p>{c.note}</p><p className="legal-note">{educational}</p>
  </div></section>
  <section className="faq-section" id="faq"><div className="shell faq-grid"><div><h2>Antes de decidir</h2><p>Entenda o complemento, o valor adicional e o próximo passo da compra.</p></div><Accordion>{c.faqs.map(item=><AccordionItem key={item.question} question={item.question}><p>{item.answer}</p></AccordionItem>)}</Accordion></div></section>
 </>;
}
