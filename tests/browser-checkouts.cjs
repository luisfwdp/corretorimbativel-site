/* Isolated WordPress configured with example.invalid fixtures, never real payments. */
const {chromium}=require('playwright');
const assert=require('node:assert/strict');
(async()=>{
 const browser=await chromium.launch({executablePath:'/usr/bin/chromium',headless:true,args:['--no-sandbox']});
 const page=await browser.newPage({viewport:{width:375,height:812}});
 await page.addInitScript(()=>{
  window.ciEvents=[];window.gtag=(...args)=>window.ciEvents.push(args);
  document.addEventListener('click',e=>{if(e.target.closest('a'))e.preventDefault()});
 });
 const base=process.env.CI_CHECKOUT_URL||'http://127.0.0.1:9401';
 assert.match(base,/^http:\/\/127\.0\.0\.1:\d+$/);
 await page.goto(base+'/?utm_source=qa');
 await page.locator('[data-product="ebook"]').click();
 assert.equal((await page.evaluate(()=>ciEvents)).filter(e=>e[1]==='select_item').length,1);
 for(const slug of ['ebook','manual-juridico','combo','upsell-manual','upsell-ebook']){
  await page.goto(`${base}/${slug}/?utm_source=qa&utm_campaign=funnel`);
  const cta=page.locator('[data-checkout]').first();
  const href=await cta.getAttribute('href');
  const url=new URL(href);
  assert.equal(url.hostname,'example.invalid');assert.equal(url.pathname,`/checkout/${slug}`);
  assert.equal(url.searchParams.get('existing'),'keep');assert.equal(url.searchParams.get('utm_source'),'qa');
  assert.equal(await page.locator('.ci-btn--unavailable').count(),0);
  if(!slug.startsWith('upsell')){
   await page.locator('.ci-header__offer').click();
   assert.equal((await page.evaluate(()=>ciEvents)).filter(e=>e[1]==='begin_checkout').length,0,'Anchor is not checkout');
  }
  await cta.click();
  const events=await page.evaluate(()=>ciEvents);
  const begin=events.filter(e=>e[1]==='begin_checkout');assert.equal(begin.length,1,slug);
  assert.equal(begin[0][2].items[0].item_id,slug);assert.equal(begin[0][2].currency,'BRL');
  assert.equal(events.filter(e=>e[1]==='purchase').length,0);
  if(slug.startsWith('upsell')){
   assert.equal(events.filter(e=>e[1]==='select_promotion').length,1);
   assert.equal(new URL(await page.locator('a.ci-decline').getAttribute('href')).pathname,`/completion/${slug}`);
  }else{
   await page.evaluate(()=>{document.activeElement.blur();window.scrollTo(0,document.getElementById('conteudo').offsetTop+100);});
   await page.waitForTimeout(150);
   assert.equal(await page.locator('#ci-sticky-cta').getAttribute('aria-hidden'),'false');
   await page.locator('summary').first().focus();
   assert.equal(await page.locator('#ci-sticky-cta').getAttribute('aria-hidden'),'true','Sticky must not cover keyboard focus');
  }
 }
 await browser.close();console.log('PASS: configured checkouts for 5 offers, product events, anchor distinction, UTMs, decline links, sticky accessibility; no purchase event. Fixture URLs only.');
})().catch(e=>{console.error(e);process.exit(1)});
