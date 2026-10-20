// Protected preview only. Access file lives outside Git, supplied by official Vercel sharing.
import fs from 'node:fs/promises';
import assert from 'node:assert/strict';
import {chromium} from '@playwright/test';
import AxeBuilder from '@axe-core/playwright';
const access=JSON.parse(await fs.readFile(process.env.CI_PREVIEW_ACCESS_FILE||'/tmp/ci-next-preview-access.json','utf8'));
const root=new URL(access.url);assert.match(root.hostname,/^corretor-imbativel-next-preview-[a-z0-9]+\.vercel\.app$/);
const base=root.origin;const out=process.env.CI_NEXT_RESULTS||'/workspace/scratch/corretor-next-preview/hosted';await fs.mkdir(out,{recursive:true});const report={deployment:base,results:[],errors:[]};
const browser=await chromium.launch({executablePath:'/usr/bin/chromium',args:['--no-sandbox'],headless:true});
for(const width of [1440,390]){
 const ctx=await browser.newContext({viewport:{width,height:width===1440?1000:844},reducedMotion:'reduce'});
 await ctx.route('https://**/*',async route=>{
  const url=new URL(route.request().url());
  if(url.origin!==base){await route.abort();return;}
  try{const requestHeaders={...route.request().headers()};let current=url;const cookies=[];let response;
   for(let redirects=0;redirects<5;redirects++){
    response=await fetch(current,{headers:requestHeaders,redirect:'manual'});cookies.push(...response.headers.getSetCookie());
    if(response.status<300||response.status>=400||!response.headers.has('location'))break;
    const next=new URL(response.headers.get('location'),current);assert.equal(next.origin,base,'Follow only the authorized deployment');
    requestHeaders.cookie=[requestHeaders.cookie,...cookies.map(c=>c.split(';')[0])].filter(Boolean).join('; ');current=next;
   }
   const headers=Object.fromEntries(response.headers);
   for(const k of ['content-encoding','content-length','transfer-encoding'])delete headers[k];if(cookies.length)headers['set-cookie']=cookies.join('\n');
   await route.fulfill({status:response.status,headers,body:Buffer.from(await response.arrayBuffer())});
  }catch{await route.abort();}
 });
 const p=await ctx.newPage();p.on('pageerror',e=>report.errors.push(e.message));await p.goto(access.url,{waitUntil:'networkidle'});
 for(const slug of ['','ebook','manual-juridico','combo','upsell-manual','upsell-ebook']){
  const r=await p.goto(base+'/'+slug,{waitUntil:'networkidle'});assert.equal(r.status(),200);
  await p.evaluate(async()=>{await document.fonts.ready;await Promise.all([...document.images].map(i=>{i.loading='eager';return i.decode().catch(()=>{});}));});
  assert.equal(await p.locator('main h1').count(),1);const text=await p.locator('main').innerText();if(slug&&!slug.startsWith('upsell'))assert.ok(text.split(/\s+/).length>1100);
  assert.ok(await p.evaluate(()=>document.documentElement.scrollWidth<=innerWidth));assert.match(await p.locator('meta[name=robots]').getAttribute('content'),/noindex/);
  const broken=await p.locator('main img').evaluateAll(imgs=>imgs.filter(i=>!i.complete||!i.naturalWidth).map(i=>i.getAttribute('alt')));assert.deepEqual(broken,[]);
  const axe=await new AxeBuilder({page:p}).withTags(['wcag2a','wcag2aa','wcag21a','wcag21aa']).analyze();
  report.results.push({slug:slug||'home',width,status:r.status(),words:text.split(/\s+/).length,violations:axe.violations.map(v=>({id:v.id,impact:v.impact})),brokenImages:broken});
  await p.evaluate(()=>scrollTo({top:0,behavior:'instant'}));await p.screenshot({path:`${out}/${slug||'home'}-${width===1440?'desktop':'mobile'}-hero.png`});await p.screenshot({path:`${out}/${slug||'home'}-${width===1440?'desktop':'mobile'}.png`,fullPage:true});
 }
 await p.goto(base+'/ebook?utm_source=preview&utm_campaign=review');await p.locator('#hero .button').click();assert.ok(p.url().includes('#oferta'));const faq=p.locator('#faq details').first();await faq.locator('summary').click();assert.equal(await faq.getAttribute('open'),'');
 await p.goto(base+'/upsell-manual');await p.locator('button.decline').click();assert.ok(await p.locator('#decline-guidance').isVisible());await ctx.close();
}
await browser.close();await fs.writeFile(out+'/report.json',JSON.stringify(report,null,2));console.log(JSON.stringify(report,null,2));assert.deepEqual(report.errors,[]);assert.deepEqual(report.results.flatMap(r=>r.violations),[]);console.log('PASS: authenticated hosted preview, six routes, desktop/mobile, content, images, FAQ, refusal and noindex.');
