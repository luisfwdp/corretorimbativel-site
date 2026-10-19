import {Fragment,createElement,type ReactNode} from 'react';
import ebook from '@/content/ebook.json';
import manual from '@/content/manual-juridico.json';
import combo from '@/content/combo.json';
import {type LandingId} from '@/lib/catalogue';
import {EditorialReveal} from './motion';
import {PrimaryAction} from './offers';
import {Accordion,AccordionItem} from './ui/accordion';
export type ContentNode=string|{tag:string;children:ContentNode[];kind?:string;scope?:string};
export type ContentSection={id:string;blocks:ContentNode[]};
const sources={ebook,'manual-juridico':manual,combo};
export function sourceFor(id:LandingId){return sources[id];}
const allowed=new Set(['h2','h3','p','blockquote','ul','ol','li','dl','dt','dd','table','thead','tbody','tr','th','td','caption','strong','em','article','div','span']);
function block(node:ContentNode,key:number):ReactNode{
 if(typeof node==='string')return <Fragment key={key}>{node}</Fragment>;
 const tag=allowed.has(node.tag)?node.tag:'div';
 return createElement(tag,{key,className:node.kind?`content-${node.kind}`:undefined,...(node.scope?{scope:node.scope}:{}),...(tag==='table'?{role:'table'}:{}),...(tag==='tr'?{role:'row'}:{}),...(tag==='td'?{role:'cell'}:{}),...(tag==='th'?{role:node.scope==='row'?'rowheader':'columnheader'}:{})},node.children.map(block));
}
const reveal=new Set(['solucao','conteudo','mentalidade']);
const dark=new Set(['identificacao','formalizacao','cuidados','mentalidade','valor-comissao','conteudo-combo']);
export function Narrative({id}:{id:LandingId}){
 const data=sources[id];const anchor=id==='ebook'?'conteudo':id==='manual-juridico'?'conteudo':'complementaridade';
 return <>{(data.sections as ContentSection[]).map((section,i)=>{
 const isDark=dark.has(section.id)||(id==='combo'&&section.id==='conteudo');
 return <Fragment key={section.id}><section className={`narrative section-${section.id} ${isDark?'dark':'paper'} ${i%3===1&&!isDark?'muted':''}`} id={section.id}><div className="shell">{reveal.has(section.id)?<EditorialReveal className="narrative-content">{section.blocks.map(block)}</EditorialReveal>:<div className="narrative-content">{section.blocks.map(block)}</div>}</div></section>{section.id===anchor?<section className="intermediate-cta" aria-label="Conheça a oferta"><div className="shell flex flex-col gap-6 md:flex-row md:items-center md:justify-between"><div><p className="small-label">O próximo passo</p><h2>{id==='combo'?'Os dois focos, em uma única compra.':id==='ebook'?'Leve esse conhecimento para sua rotina.':'Dê mais atenção aos documentos da negociação.'}</h2></div><PrimaryAction id={id} placement="conteudo"/></div></section>:null}</Fragment>;
 })}</>;
}
export function Faq({id}:{id:LandingId}){return <section className="faq-section" id="faq"><div className="shell faq-grid"><div><p className="small-label">Antes de escolher</p><h2>Perguntas frequentes.</h2><p>Clareza sobre o material, a compra e os limites do conteúdo educativo.</p></div><Accordion>{sources[id].faqs.map(item=><AccordionItem key={item.question} question={item.question}><p>{item.answer}</p></AccordionItem>)}</Accordion></div></section>;}
