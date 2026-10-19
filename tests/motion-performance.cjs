const assert=require('node:assert/strict');const fs=require('node:fs');
const {launch,assets}=require('./browser-support.cjs');
const base=process.env.CI_EDITORIAL_URL||'http://127.0.0.1:9410';
assert.match(base,/^http:\/\/127\.0\.0\.1:\d+$/);
(async()=>{
 const b=await launch();const p=await b.newPage({viewport:{width:1440,height:1000},reducedMotion:'no-preference'});await assets(p);
 await p.addInitScript(()=>{
  window.ciVitals={cls:0,lcp:0};
  new PerformanceObserver(list=>list.getEntries().forEach(e=>{if(!e.hadRecentInput)window.ciVitals.cls+=e.value;})).observe({type:'layout-shift',buffered:true});
  new PerformanceObserver(list=>list.getEntries().forEach(e=>window.ciVitals.lcp=e.startTime)).observe({type:'largest-contentful-paint',buffered:true});
 });
 const vitals=[];
 for(const slug of['ebook','manual-juridico','combo','upsell-manual','upsell-ebook']){
  await p.goto(`${base}/${slug}/`,{waitUntil:'networkidle'});await p.evaluate(()=>document.fonts.ready);await p.waitForTimeout(100);
  const v=await p.evaluate(()=>window.ciVitals);vitals.push({slug,...v});
  assert.ok(v.cls<=.1,`${slug} CLS lab budget (${v.cls})`);
 }
 await p.goto(base+'/ebook/',{waitUntil:'networkidle'});
 const landmark=p.locator('#solucao h2');await landmark.scrollIntoViewIfNeeded();await p.waitForTimeout(40);
 assert.equal(await landmark.evaluate(el=>el.getAnimations().filter(a=>a.playState==='running').length),1,'One purposeful reveal');
 await p.waitForTimeout(400);
 assert.equal(await landmark.evaluate(el=>el.getAnimations().length),0,'Reveal ends cleanly');
 await p.locator('#hero').scrollIntoViewIfNeeded();await landmark.scrollIntoViewIfNeeded();await p.waitForTimeout(40);
 assert.equal(await landmark.evaluate(el=>el.getAnimations().length),0,'Reveal plays only once');
 await p.locator('#hero').scrollIntoViewIfNeeded();await p.locator('.ci-publication__image').first().hover();await p.waitForTimeout(320);
 assert.notEqual(await p.locator('.ci-publication__image').first().evaluate(el=>getComputedStyle(el).transform),'none','Subtle mockup hover');
 await p.emulateMedia({reducedMotion:'reduce'});await p.waitForTimeout(30);
 assert.equal(await p.locator('.ci-publication__image').first().evaluate(el=>getComputedStyle(el).transform),'none','Reduced motion removes hover movement');
 await b.close();fs.mkdirSync('/tmp/ci-editorial-tests',{recursive:true});fs.writeFileSync('/tmp/ci-editorial-tests/vitals.json',JSON.stringify(vitals,null,2));
 console.log(JSON.stringify(vitals));console.log('PASS: single reveal, interruption-safe reduced motion, mockup microinteraction and CLS lab budget. LCP values are local observations, not production guarantees.');
})().catch(e=>{console.error(e);process.exit(1)});
