/* Integration and design checks against local WordPress. No production writes. */
const assert=require('node:assert/strict');
const fs=require('node:fs');
const path=require('node:path');
const {launch,assets,ready}=require('./browser-support.cjs');
const {default:AxeBuilder}=require('@axe-core/playwright');
const base=process.env.CI_EDITORIAL_URL||'http://127.0.0.1:9410';
const before=process.env.CI_BASELINE_URL||'http://127.0.0.1:9411';
const output=process.env.CI_EDITORIAL_RESULTS||'/tmp/ci-editorial-tests';
for(const url of [base,before])assert.match(url,/^http:\/\/127\.0\.0\.1:\d+$/);
fs.mkdirSync(output,{recursive:true});
(async()=>{
 const b=await launch();const issues=[];const report={homepage:[],accessibility:[],content:[],motion:[]};
 // Actual rendered homepage HTML and pixels must remain identical to the base theme.
 for(const width of [1440,390]){
  const p=await b.newPage({viewport:{width,height:1000}});await assets(p);
  const snapshots=[];
  for(const origin of [before,base]){
   const r=await p.goto(origin+'/',{waitUntil:'networkidle'});assert.equal(r.status(),200);await ready(p);
   assert.equal(await p.locator('#ci-editorial-css, #ci-editorial-js').count(),0,'No editorial assets on homepage');
   const body=await p.locator('body').innerHTML();
   const normalized=body.replaceAll(origin,'http://example.test');
   snapshots.push({html:normalized,png:await p.screenshot({fullPage:true})});
  }
  assert.equal(snapshots[0].html,snapshots[1].html,`Home HTML at ${width}`);
  assert.ok(snapshots[0].png.equals(snapshots[1].png),`Home pixels at ${width}`);
  report.homepage.push({width,html:'identical',pixels:'identical'});await p.close();
 }
 const paths=['ebook','manual-juridico','combo','upsell-manual','upsell-ebook'];
 const auditContext=await b.newContext({viewport:{width:1440,height:1000}});
 const p=await auditContext.newPage();await assets(p);
 p.on('pageerror',e=>issues.push(e.message));
 for(const slug of paths){
  await p.goto(`${base}/${slug}/`,{waitUntil:'networkidle'});await ready(p);
  assert.equal(await p.locator('body.ci-editorial').count(),1);
  assert.equal(await p.locator('#ci-editorial-css').count(),1);
  assert.equal(await p.locator('#ci-editorial-js').count(),1);
  const text=await p.locator('main').innerText();
  const words=text.trim().split(/\s+/).length;
  assert.ok(words>(slug.startsWith('upsell')?180:1100),`${slug} complete narrative (${words})`);
  const results=await new AxeBuilder({page:p}).withTags(['wcag2a','wcag2aa','wcag21a','wcag21aa']).analyze();
  report.accessibility.push({slug,violations:results.violations.map(v=>({id:v.id,impact:v.impact,nodes:v.nodes.map(n=>({target:n.target,summary:n.failureSummary}))}))});
  if(results.violations.length)fs.writeFileSync(path.join(output,slug+'-axe.json'),JSON.stringify(results.violations,null,2));
  if(!slug.startsWith('upsell')){
   assert.equal(await p.locator('#oferta').count(),1);
   assert.ok(await p.locator('#especialista').count());assert.ok(await p.locator('#para-quem').count());
   assert.ok(await p.locator('#faq details').count()>=6);
   assert.equal(await p.locator('.ci-syllabus li').count(),slug==='combo'?14:7);
   assert.ok(await p.locator('#hero .ci-offer-anchor').count(),'Missing checkout navigates to actual offer');
  }else{
   const decline=p.locator('.ci-decline-fallback');assert.equal(await decline.count(),1);
   await decline.click();assert.equal(await decline.getAttribute('aria-expanded'),'true');
   assert.equal(await p.locator('#ci-decline-guidance').isVisible(),true);
   await decline.click();assert.equal(await p.locator('#ci-decline-guidance').isVisible(),false);
  }
  if(slug==='ebook')assert.match(text,/R\$ 48\.000/);
  assert.doesNotMatch(text,/\[(?:FOTO|GARANTIA|PARCELAMENTO|DEPOIMENTO)[^\]]*\]/);
  report.content.push({slug,words});
 }
 await auditContext.close();
 // Long content, smaller phone, landscape, tablet, and 200% text zoom.
 for(const [width,height]of[[320,700],[390,844],[768,1024],[1024,768]]){
  const q=await b.newPage({viewport:{width,height}});await assets(q);
  for(const slug of paths){
   await q.goto(`${base}/${slug}/`,{waitUntil:'networkidle'});
   const overflow=await q.evaluate(()=>({width:innerWidth,scroll:document.documentElement.scrollWidth}));
   assert.ok(overflow.scroll<=overflow.width,`${slug} at ${width}: overflow`);
   // Catch clipped overflowing elements that body overflow-x:hidden could conceal.
   const outside=await q.locator('main').evaluateAll(roots=>Array.from(roots[0].querySelectorAll('h1,h2,h3,p,table,figure,.ci-btn')).filter(el=>{
    if(!el.getClientRects().length)return false;const r=el.getBoundingClientRect();return r.right>innerWidth+1 || r.left< -1;
   }).map(el=>el.tagName+'.'+el.className));
   assert.deepEqual(outside,[],`${slug} clipped content at ${width}`);
  }
  await q.close();
 }
 const zoom=await b.newPage({viewport:{width:390,height:844}});await assets(zoom);
 for(const slug of paths){
  await zoom.goto(`${base}/${slug}/`);await zoom.addStyleTag({content:'html {font-size: 200% !important;}'});
  assert.ok(await zoom.evaluate(()=>document.documentElement.scrollWidth<=innerWidth),`${slug} 200% text zoom`);
  const clipped=await zoom.locator('main h1,main h2,main h3,main p,main td,main dt,main dd').evaluateAll(elements=>elements.filter(e=>e.getClientRects().length&&e.clientWidth>0&&e.scrollWidth>e.clientWidth+2).map(e=>e.tagName+'.'+e.className));
  assert.deepEqual(clipped,[],`${slug} text clipping at 200%`);
 }
 await zoom.close();
 // Keyboard and reduced motion, including toggling the preference after load.
 const a=await b.newPage({viewport:{width:390,height:844},reducedMotion:'reduce'});await assets(a);
 await a.goto(base+'/ebook/');await a.keyboard.press('Tab');
 assert.equal(await a.locator(':focus').innerText(),'Pular para o conteúdo');
 await a.keyboard.press('Enter');assert.equal(await a.evaluate(()=>document.activeElement.id),'main');
 await a.locator('#solucao').scrollIntoViewIfNeeded();await a.waitForTimeout(100);
 assert.equal(await a.evaluate(()=>document.getAnimations().filter(x=>x.playState==='running').length),0);
 report.motion.push('Reduced motion starts without running animations');
 await a.emulateMedia({reducedMotion:'no-preference'});await a.locator('#aprendizado').scrollIntoViewIfNeeded();
 await a.emulateMedia({reducedMotion:'reduce'});await a.waitForTimeout(50);
 assert.equal(await a.evaluate(()=>document.getAnimations().filter(x=>x.playState==='running').length),0);
 report.motion.push('Preference changes cancel editorial motion');
 await a.close();
 const sitemap=await b.newContext().then(async c=>{const r=await c.request.get(base+'/wp-sitemap-posts-page-1.xml');const t=await r.text();await c.close();return t;});
 assert.ok(!sitemap.includes('upsell-'));
 assert.deepEqual(issues,[],'Browser errors');
 fs.writeFileSync(path.join(output,'report.json'),JSON.stringify(report,null,2));
 const violations=report.accessibility.flatMap(x=>x.violations.map(v=>({slug:x.slug,...v})));
 console.log(JSON.stringify(report,null,2));
 await b.close();assert.deepEqual(violations,[],'Automated WCAG violations');
 console.log('PASS: unchanged homepage HTML/pixels, five complete narratives, WCAG scan, 20 viewport combinations, zoom, keyboard, motion, refusal and sitemap.');
})().catch(e=>{console.error(e);process.exit(1)});
