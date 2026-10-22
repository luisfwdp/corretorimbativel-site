import test from 'node:test';
import assert from 'node:assert/strict';
import fs from 'node:fs';

const read=path=>fs.readFileSync(new URL(path,import.meta.url),'utf8');

test('SEO discovery files cover public pages and exclude post-purchase offers',()=>{
 const sitemap=read('../app/sitemap.ts');
 const robots=read('../app/robots.ts');
 const llms=read('../public/llms.txt');
 for(const path of ['/ebook','/manual-juridico','/combo']){
  assert.match(sitemap,new RegExp(path.replace('/','\\/')));
  assert.match(llms,new RegExp(`https:\\/\\/corretorimbativel\\.com\\.br${path.replace('/','\\/')}`));
 }
 assert.doesNotMatch(sitemap,/upsell-/);
 assert.match(robots,/OAI-SearchBot/);
 assert.match(robots,/userAgent:'\*',allow:'\/'/);
 assert.match(robots,/privateOffers/);
});

test('Public landing pages expose canonical metadata and structured product data',()=>{
 const metadata=read('../lib/metadata.ts');
 const structured=read('../lib/structured-data.ts');
 const page=read('../app/[slug]/page.tsx');
 assert.match(metadata,/alternates:\{canonical:url\}/);
 assert.match(metadata,/openGraph:/);
 assert.match(metadata,/twitter:/);
 assert.match(metadata,/isUpsell\(id\).*index:false/);
 for(const type of ['Organization','Person','WebSite','BreadcrumbList','Product','Offer'])assert.match(structured,new RegExp(`"${type}"`));
 assert.match(page,/upsell\?null:<JsonLd/);
});
