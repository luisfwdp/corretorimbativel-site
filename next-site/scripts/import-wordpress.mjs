// Audit-friendly import from rendered official WordPress reference; local only.
import fs from 'node:fs/promises';
import {load} from 'cheerio';
const excluded = new Set(['hero','especialista','oferta','faq','cta-final','prova-social']);
const tags=new Set(['h2','h3','p','blockquote','ul','ol','li','dl','dt','dd','table','thead','tbody','tr','th','td','caption','strong','em','article']);
const skipClasses=['ci-syllabus__number','ci-numbered-list__number','ci-volume-aside','ci-mobile-column'];
for(const slug of ['ebook','manual-juridico','combo']){
 const html=await (await fetch('http://127.0.0.1:9410/'+slug+'/')).text(); const $=load(html);
 const transform=node=>{
  if(node.type==='text'){const text=node.data.replace(/\s+/g,' ');return text.trim()?text:null;}
  if(node.type!=='tag')return null;
  const el=$(node);const classes=(el.attr('class')||'').split(/\s+/);
  if(['img','svg','figure','a','button','script','noscript'].includes(node.name)||skipClasses.some(c=>classes.includes(c)))return null;
  let tag=tags.has(node.name)?node.name:'div';
  if(node.name==='span')tag=classes.some(c=>c.endsWith('__title'))?'strong':'span';
  const children=(node.children||[]).map(transform).flat().filter(Boolean);
  if(!children.length)return null;
  let kind=classes.includes('ci-syllabus')?'syllabus':classes.includes('ci-numbered-list')?'topics':classes.includes('ci-scenarios')?'scenarios':classes.includes('ci-editorial-benefits')?'benefits':classes.includes('ci-principles')?'principles':classes.includes('ci-transformation')?'transformation':classes.includes('ci-complement-table')?'comparison':undefined;
  if(tag==='div'&&!kind&&(node.parent?.name==='dl'||$(node.parent).hasClass('ci-transformation')))kind='group';
  if(tag==='div'&&!kind)return children;
  return {tag,children,...(kind?{kind}:{}),...(node.name==='th'?{scope:el.attr('scope')}:{}),...(node.name==='span'?{kind:tag==='strong'?'':'inline'}:{})};
 };
 const sections=$('main section[id]').toArray().filter(n=>!excluded.has($(n).attr('id'))).map(n=>({id:$(n).attr('id'),blocks:$(n).children().toArray().map(transform).flat(Infinity).filter(Boolean)}));
 // Preserve original FAQ wording, then refine product scope and avoid unsubstantiated outcomes.
 const faqs=$('#faq details').toArray().map(n=>({question:$(n).find('summary').text().trim(),answer:$(n).find('p').text().trim()}));
 let json=JSON.stringify({slug,sourceCommit:'57e496b',sections,faqs},null,2);
 const replacements=[
 ['Na maioria das vezes, ele começa muito antes:','Ele pode começar muito antes:'],
 ['Proteja sua comissão e sua atuação sem o respaldo de uma equipe jurídica interna.','Compreenda os cuidados com sua comissão e reconheça quando buscar orientação jurídica.'],
 ['Reduza riscos jurídicos e conflitos internos entre corretores.','Revise os cuidados de organização e formalização da equipe.'],
 ['O material não promete imunidade jurídica: ele ajuda você a reduzir riscos, aumentar sua segurança e adotar práticas preventivas reconhecidas pela legislação e pela jurisprudência.','A proposta é ampliar seu conhecimento sobre os cuidados jurídicos da intermediação e ajudar a reconhecer situações que exigem orientação individualizada.'],
 ['Não se trata de eliminar todos os riscos. Trata-se de estar muito mais preparado para eles.','Conhecer os riscos ajuda a reconhecer os cuidados que cada negociação exige.'],
 ['Esta página descreve os materiais de leitura e seus temas. Não anuncia um pack de documentos editáveis como parte da oferta. Considere incluídos apenas os itens expressamente apresentados na descrição do produto no checkout.','A oferta apresentada aqui contempla os materiais de leitura descritos na página. Documentos editáveis não são apresentados como itens incluídos. Confira a descrição da entrega no checkout antes de comprar.'],
 ['Para corretores de imóveis autônomos, profissionais vinculados a imobiliárias, gestores imobiliários e imobiliárias que querem reduzir riscos jurídicos durante negociações imobiliárias.','Para corretores autônomos, profissionais vinculados a imobiliárias e gestores que desejam compreender os cuidados jurídicos e documentais da intermediação.'],
 ['boas práticas avançadas de documentação e prevenção de litígios','cuidados de documentação e atuação preventiva'],
 ];
 for(const [from,to]of replacements)json=json.replaceAll(from,to);
 await fs.writeFile('content/'+slug+'.json',json+'\n');
}
console.log('Imported three complete narratives, chapters, pillars and FAQs from local WordPress.');
