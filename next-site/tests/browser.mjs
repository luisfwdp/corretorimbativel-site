import assert from 'node:assert/strict';
import fs from 'node:fs/promises';
import path from 'node:path';
import {chromium} from '@playwright/test';
import AxeBuilder from '@axe-core/playwright';
const base=process.env.CI_NEXT_URL||'http://127.0.0.1:9430';
const out=process.env.CI_NEXT_RESULTS||'/workspace/scratch/corretor-next-preview';
if(!/^http:\/\/127\.0\.0\.1:\d+$/.test(base))throw Error('Local test only; use separate preview verification for hosted environments.');
const paths=['','ebook','manual-juridico','combo','upsell-manual','upsell-ebook'];
const report={routes:[],accessibility:[],interactions:[],errors:[]};
await fs.mkdir(out,{recursive:true});
const b=await chromium.launch({executablePath:'/usr/bin/chromium',args:['--no-sandbox'],headless:true});
for(const width of [1440,768,390,320]){
 const ctx=await b.newContext({viewport:{width,height:width===1440?1000:844},reducedMotion:'reduce'});const p=await ctx.newPage();p.on('pageerror',e=>report.errors.push(e.message));
 for(const slug of paths){
  const r=await p.goto(base+'/'+slug,{waitUntil:'networkidle'});assert.equal(r.status(),200);assert.match(r.headers()['x-robots-tag'],/noindex/);
  await p.evaluate(async()=>{await document.fonts.ready;await Promise.all([...document.images].map(i=>{i.loading='eager';return i.decode().catch(()=>{});}));});
  assert.equal(await p.locator('h1').count(),1);assert.equal(await p.locator('link[rel=canonical]').count(),1);
  assert.equal(new URL(await p.locator('link[rel=canonical]').getAttribute('href')).href,'https://corretorimbativel.com.br'+(slug?'/'+slug:'/'));
  const overflow=await p.evaluate(()=>({width:innerWidth,scroll:document.documentElement.scrollWidth}));assert.ok(overflow.scroll<=width,`${slug} overflow ${width}: ${overflow.scroll}`);
  const clipped=await p.locator('main h1,main h2,main h3,main p,main a.button,main td,main dt,main dd').evaluateAll(els=>els.filter(el=>{if(!el.getClientRects().length)return false;const r=el.getBoundingClientRect();return r.right>innerWidth+1||r.left< -1||el.scrollWidth>el.clientWidth+2;}).map(el=>el.tagName+'.'+el.className));assert.deepEqual(clipped,[],`Clipped ${slug} ${width}`);
  const text=await p.locator('main').innerText();const words=text.trim().split(/\s+/).length;
  if(slug&&!slug.startsWith('upsell-')){assert.ok(words>1100,`${slug} narrative ${words}`);assert.equal(await p.locator('.intermediate-cta .button').count(),1);assert.equal(await p.locator('.content-syllabus>li').count(),slug==='combo'?14:7);assert.ok(await p.locator('#faq details').count()>=6);}
  if(slug==='combo')for(const amount of ['244','197','47'])assert.ok(text.includes(amount));
  if(slug==='upsell-manual')assert.match(text,/50,00/);if(slug==='upsell-ebook')assert.match(text,/100,00/);
  assert.doesNotMatch(text,/\[(FOTO|GARANTIA|DEPOIMENTO)|lorem ipsum|Na maioria das vezes|Proteja sua comissão/);
  assert.equal(await p.locator('main [data-checkout]').count(),0,'Real checkouts are unconfigured');
  const missing=await p.locator('main img').evaluateAll(imgs=>imgs.filter(i=>!i.complete||!i.naturalWidth).map(i=>i.src));assert.deepEqual(missing,[]);
  report.routes.push({slug:slug||'home',width,words,images:'loaded',horizontalOverflow:false});
  if(width===1440||width===390){
   const axe=await new AxeBuilder({page:p}).withTags(['wcag2a','wcag2aa','wcag21a','wcag21aa']).analyze();report.accessibility.push({slug:slug||'home',width,violations:axe.violations.map(v=>({id:v.id,impact:v.impact,nodes:v.nodes.map(n=>n.target)}))});
   await p.evaluate(()=>scrollTo(0,0));await p.screenshot({path:path.join(out,(slug||'home')+'-'+(width===1440?'desktop':'mobile')+'-hero.png')});await p.screenshot({path:path.join(out,(slug||'home')+'-'+(width===1440?'desktop':'mobile')+'.png'),fullPage:true});
  }
 }
 await ctx.close();
}
const c=await b.newContext({viewport:{width:390,height:844},reducedMotion:'reduce'});const p=await c.newPage();
await p.goto(base+'/?utm_source=review&utm_campaign=next&token=do-not-copy');
await p.evaluate(()=>localStorage.setItem('ci-consent-v1','granted'));
const ebook=p.locator('#produtos a[href^="/ebook"]');await assert.doesNotReject(()=>p.waitForFunction(()=>document.querySelector('#produtos a[href^="/ebook"]')?.href.includes('utm_source=review')));
assert.ok(!(await ebook.getAttribute('href')).includes('token'));await ebook.click();await p.waitForURL('**/ebook?**');
assert.match(p.url(),/utm_source=review/);await p.locator('#hero .button').click();await p.waitForURL('**#oferta');
assert.equal(await p.evaluate(()=>(window.dataLayer||[]).filter(e=>e.event==='begin_checkout'||e.event==='purchase').length),0);
await p.goto(base+'/ebook');await p.keyboard.press('Tab');assert.equal(await p.locator(':focus').innerText(),'Pular para o conteúdo');await p.keyboard.press('Enter');assert.equal(await p.evaluate(()=>document.activeElement.id),'main');
const faq=p.locator('#faq details').first();await faq.locator('summary').click();assert.equal(await faq.getAttribute('open'),'');
await p.goto(base+'/upsell-manual?token=keep-for-provider');await p.locator('button.decline').click();assert.ok(await p.locator('#decline-guidance').isVisible());assert.ok(p.url().includes('token=keep-for-provider'));
await p.goto(base+'/combo');await p.addStyleTag({content:'html{font-size:200%!important}'});assert.ok(await p.evaluate(()=>document.documentElement.scrollWidth<=innerWidth),'200% typography reflows');
const sitemap=await(await p.request.get(base+'/sitemap.xml')).text();assert.ok(!sitemap.includes('upsell-'));
assert.match(await(await p.request.get(base+'/robots.txt')).text(),/Disallow: \//);
assert.equal((await p.request.get(base+'/does-not-exist')).status(),404);assert.equal((await p.request.get(base+'/opengraph-image')).status(),200);
report.interactions.push('Home → landing with UTMs, excludes payment token','Offer anchor emits no checkout/purchase','Keyboard skip/focus','Native FAQ','Explicit refusal preserves original URL','200% typography reflow','Preview noindex, sitemap excludes upsells, 404 and OG');await c.close();
const nojs=await b.newContext({javaScriptEnabled:false});const q=await nojs.newPage();await q.goto(base+'/ebook');await q.locator('#faq summary').first().click();assert.equal(await q.locator('#faq details').first().getAttribute('open'),'');assert.ok(await q.locator('main').innerText());report.interactions.push('SSR narrative and FAQ work with JS disabled');await nojs.close();
await b.close();await fs.writeFile(path.join(out,'browser-report.json'),JSON.stringify(report,null,2));console.log(JSON.stringify({routes:report.routes.length,axeScans:report.accessibility.length,violations:report.accessibility.filter(a=>a.violations.length),errors:report.errors,interactions:report.interactions},null,2));assert.deepEqual(report.errors,[]);assert.deepEqual(report.accessibility.flatMap(a=>a.violations),[]);console.log('PASS');
