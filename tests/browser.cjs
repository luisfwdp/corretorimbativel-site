/* Run against isolated WordPress only: node tests/browser.cjs.
 * Dependencies: Playwright and Chromium; never points at production by default.
 */
const { chromium } = require('playwright');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const base = process.env.CI_TEST_URL || 'http://127.0.0.1:9400';
assert.match(base, /^http:\/\/(127\.0\.0\.1|localhost):\d+$/, 'Use isolated local WordPress only');
const output = process.env.CI_SCREENSHOTS || '/tmp/ci-screenshots';
fs.mkdirSync(output, { recursive: true });
const pages = ['', 'ebook/', 'manual-juridico/', 'combo/', 'upsell-manual/', 'upsell-ebook/'];
(async () => {
 const browser = await chromium.launch({executablePath: process.env.CI_CHROMIUM || '/usr/bin/chromium', headless:true, args:['--no-sandbox']});
 const errors = [];
 const resources = new Map();
 let checks = 0;
 for (const [device, width, height] of [['desktop',1440,1000],['tablet',820,1180],['mobile',375,812],['small-mobile',320,700]]) {
  const page = await browser.newPage({ viewport: {width,height} });
  page.on('pageerror', e => errors.push(e.message));
  // Fetch external images/fonts through Node's configured proxy and CA trust.
  // Chromium in this container does not inherit that CA store; TLS remains verified.
  await page.route('https://**/*', async route => {
   try {
    const url=route.request().url();
    const fixture=url.includes('ChatGPT-Image-8-de-ago.-de-2026-11_27_31.png') ? process.env.CI_EBOOK_IMAGE : (url.includes('Untitled-design-1.png') ? process.env.CI_AUTHOR_IMAGE : '');
    if(fixture){ await route.fulfill({status:200,contentType:'image/png',body:fs.readFileSync(fixture)});return; }
    if(!resources.has(url)) resources.set(url,(async()=>{const r=await fetch(url);return {status:r.status,headers:{'content-type':r.headers.get('content-type')||'application/octet-stream','access-control-allow-origin':'*'},body:Buffer.from(await r.arrayBuffer())};})());
    await route.fulfill(await resources.get(url));
   }
   catch(e) { await route.abort(); }
  });
  await page.addInitScript(() => { window.ciEvents=[]; window.gtag=(...args)=>window.ciEvents.push(args); });
  for (const path of pages) {
   const response=await page.goto(base+'/'+path+'?utm_source=qa&utm_campaign=ecosystem', {waitUntil:'networkidle'});
   assert.equal(response.status(),200,path);
   assert.equal(await page.locator('h1').count(),1,path);
   assert.equal(await page.locator('link[rel="canonical"]').count(),1,path);
   assert.equal(await page.locator('meta[name="description"]').count(),1,path);
   assert.equal(await page.locator('link[rel="canonical"]').getAttribute('href'),base+'/'+path);
   const text = await page.locator('main').innerText();
   assert.doesNotMatch(text,/\[(?:PARCELAMENTO|FOTO|DEPOIMENTO|GARANTIA)[^\]]*\]/);
   const overflow=await page.evaluate(()=>document.documentElement.scrollWidth>window.innerWidth);
   assert.equal(overflow,false,`${device} ${path} horizontal overflow`);
   if (!path) {
    assert.equal(await page.locator('.ci-product-card').count(),3);
    assert.match(text,/R\$ 147,00/);assert.match(text,/R\$ 97,00/);assert.match(text,/R\$ 197,00/);
    assert.match(await page.locator('[data-product="ebook"]').getAttribute('href'),/utm_source=qa/);
    await page.locator('[data-product="ebook"]').click({noWaitAfter:true});
    await page.waitForURL('**/ebook/**');
    // Return to home for its screenshot.
    await page.goto(base+'/?utm_source=qa&utm_campaign=ecosystem',{waitUntil:'networkidle'});
   } else {
    assert.equal(await page.locator('[data-checkout]').count(),0,'No unverified checkout');
    assert.ok(await page.locator('.ci-btn--unavailable').count()>0);
    if(path==='ebook/'){assert.match(text,/R\$ 147,00/);assert.doesNotMatch(text,/R\$ (?:97|397),00/);}
    if(path==='combo/'){assert.match(text,/R\$ 244,00/);assert.match(text,/R\$ 47,00/);}
    if(path.startsWith('upsell-')){
     assert.match(await page.locator('meta[name="robots"]').getAttribute('content'),/noindex/);
     assert.match(text,/nova compra/);
     assert.match(text,/R\$ 197,00/);
     assert.equal(await page.locator('#ci-sticky-cta').count(),0);
     assert.ok((await page.evaluate(()=>window.ciEvents)).some(x=>x[1]==='view_promotion'));
    }
    if(await page.locator('details').count()){
     const detail=page.locator('details').first(); await detail.locator('summary').click();
     assert.equal(await detail.getAttribute('open'),'');
     await page.waitForTimeout(40);
     assert.ok((await page.evaluate(()=>window.ciEvents)).some(x=>x[1]==='faq_open'));
    }
    const events=await page.evaluate(()=>window.ciEvents);
    assert.ok(events.some(x=>x[1]==='view_item'));
    assert.ok(!events.some(x=>x[1]==='purchase'||x[1]==='begin_checkout'));
   }
   const broken=await page.locator('img').evaluateAll(imgs=>imgs.filter(i=>i.complete && i.naturalWidth===0).map(i=>i.src));
   assert.deepEqual(broken,[],`${device} ${path} images`);
   await page.screenshot({path:`${output}/${device}-${path.replace('/','')||'home'}.png`,fullPage:true});
   checks++;
  }
  await page.close();
 }
 // FAQ remains accessible without JavaScript.
 const nojs=await browser.newPage({javaScriptEnabled:false});await nojs.goto(base+'/ebook/');
 await nojs.locator('summary').first().click();assert.equal(await nojs.locator('details').first().getAttribute('open'),'');
 await nojs.close();
 assert.deepEqual(errors,[],'Browser JS exceptions');
 await browser.close();console.log(`PASS: ${checks} route/viewport combinations, FAQ without JS, prices, SEO, UTMs, disabled checkout, tracking and images.`);
})().catch(e=>{console.error(e);process.exit(1)});
