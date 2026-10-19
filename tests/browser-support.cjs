const fs = require('node:fs');
const {chromium} = require('playwright');
const resources = new Map();
async function launch() {
 return chromium.launch({executablePath:process.env.CI_CHROMIUM||'/usr/bin/chromium',headless:true,args:['--no-sandbox']});
}
async function assets(page) {
 await page.route('https://**/*',async route=>{
  try {
   const url=route.request().url();
   const fixture=url.includes('ChatGPT-Image-8-de-ago.-de-2026-11_27_31.png') ? process.env.CI_EBOOK_IMAGE : (url.includes('Untitled-design-1.png') ? process.env.CI_AUTHOR_IMAGE : '');
   if(fixture){await route.fulfill({contentType:'image/png',body:fs.readFileSync(fixture)});return;}
   if(!resources.has(url))resources.set(url,(async()=>{
    const response=await fetch(url);
    if(!response.ok)throw new Error('External resource unavailable');
    return {status:response.status,headers:{'content-type':response.headers.get('content-type')||'application/octet-stream','access-control-allow-origin':'*'},body:Buffer.from(await response.arrayBuffer())};
   })());
   await route.fulfill(await resources.get(url));
  }catch(e){await route.abort();}
 });
}
async function ready(page) {
 await page.evaluate(async()=>{
  await document.fonts.ready;
  await Promise.all(Array.from(document.images).map(img=>{img.loading='eager';return img.decode().catch(()=>{});}));
 });
}
module.exports={launch,assets,ready};
