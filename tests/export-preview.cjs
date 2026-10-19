/* Export a review-only static bundle; never uploads or deploys it. */
const fs=require('node:fs');const path=require('node:path');const assert=require('node:assert/strict');
const {launch,assets,ready}=require('./browser-support.cjs');
const base=process.env.CI_EDITORIAL_URL||'http://127.0.0.1:9410';
const out=process.env.CI_PREVIEW_DIR||'/tmp/ci-premium-preview';
assert.match(base,/^http:\/\/127\.0\.0\.1:\d+$/);
const theme=path.resolve(__dirname,'../wp-content/themes/corretor-imbativel');
const names={'ebook':'eBook Corretor Imbatível','manual-juridico':'Manual Jurídico','combo':'Combo Completo','upsell-manual':'Complemento — Manual','upsell-ebook':'Complemento — eBook'};
(async()=>{
 fs.mkdirSync(path.join(out,'assets'),{recursive:true});
 assert.ok(process.env.CI_EBOOK_IMAGE&&process.env.CI_AUTHOR_IMAGE,'Provide verified image fixtures for portable previews');
 fs.copyFileSync(process.env.CI_EBOOK_IMAGE,path.join(out,'assets/ebook.png'));
 fs.copyFileSync(process.env.CI_AUTHOR_IMAGE,path.join(out,'assets/autor.png'));
 fs.copyFileSync(path.join(theme,'assets/images/logo.svg'),path.join(out,'assets/logo.svg'));
 const css=['main','funnel','editorial'].map(x=>fs.readFileSync(path.join(theme,`assets/css/${x}.css`),'utf8')).join('\n');
 const js=['main','editorial'].map(x=>fs.readFileSync(path.join(theme,`assets/js/${x}.js`),'utf8')).join('\n');
 const b=await launch();
 for(const [device,width,height]of[['desktop',1440,1000],['mobile',390,844]]){
  const p=await b.newPage({viewport:{width,height}});await assets(p);
  for(const slug of Object.keys(names)){
   await p.goto(`${base}/${slug}/`,{waitUntil:'networkidle'});await ready(p);
   await p.screenshot({path:path.join(out,`${slug}-${device}-hero.png`)});
   await p.screenshot({path:path.join(out,`${slug}-${device}.png`),fullPage:true});
   if(device==='desktop'){
    let html=await p.content();
    const data=JSON.stringify(await p.evaluate(()=>window.ciData)).replace(/</g,'\\u003c');
    html=html.replace(/<script\b[^>]*>[\s\S]*?<\/script>/gi,'');
    html=html.replace(/<link\b[^>]*\bid=["']ci-(?:main|funnel|editorial)-css["'][^>]*>/gi,'');
    html=html.replaceAll('https://corretorimbativel.com.br/wp-content/uploads/2026/08/ChatGPT-Image-8-de-ago.-de-2026-11_27_31.png','assets/ebook.png');
    html=html.replaceAll('https://corretorimbativel.com.br/wp-content/uploads/2026/08/Untitled-design-1.png','assets/autor.png');
    html=html.replaceAll(base+'/wp-content/themes/corretor-imbativel/assets/images/logo.svg','assets/logo.svg');
    html=html.replaceAll(base,'https://corretorimbativel.com.br');
    html=html.replace('</head>',`<style>${css}</style></head>`).replace('</body>',`<script>var ciData=${data};\n${js}</script></body>`);
    fs.writeFileSync(path.join(out,slug+'.html'),html);
   }
  }
  await p.close();
 }
 await b.close();
 const cards=Object.entries(names).map(([slug,name])=>`<article><h2>${name}</h2><a href="${slug}.html">Abrir página interativa</a><div class="images"><a href="${slug}-desktop.png"><img src="${slug}-desktop-hero.png" alt="Prévia desktop de ${name}"></a><a href="${slug}-mobile.png"><img src="${slug}-mobile-hero.png" alt="Prévia mobile de ${name}"></a></div></article>`).join('');
 fs.writeFileSync(path.join(out,'index.html'),`<!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow"><title>Corretor Imbatível — revisão das landings</title><style>body{margin:0;background:#fbfaf7;color:#0f2436;font:17px/1.7 system-ui,sans-serif}main{max-width:1160px;margin:auto;padding:40px 24px}h1,h2{font-family:Georgia,serif;line-height:1.2}h1{font-size:42px}h2{font-size:30px}article{margin:64px 0;border-top:2px solid #c9a227;padding-top:24px}a{color:#0f2436;text-underline-offset:5px}.images{display:grid;grid-template-columns:3fr 1fr;gap:24px;align-items:start;margin-top:24px}img{display:block;width:100%;height:auto;border:1px solid #dcd7ca}.note{border-left:3px solid #c9a227;padding-left:20px;max-width:80ch}@media(max-width:640px){.images{grid-template-columns:1fr}h1{font-size:32px}}</style></head><body><main><p>Corretor Imbatível · revisão de implementação</p><h1>Cinco páginas, uma identidade editorial.</h1><p class="note">Prévia estática exportada de WordPress isolado. Nenhuma publicação em produção foi realizada. Os checkouts reais não foram configurados nem testados financeiramente. O Manual usa identificação tipográfica até o recebimento de sua arte oficial; o conteúdo precisa da conferência do arquivo real. A homepage está preservada e não faz parte deste redesenho.</p><p>Abra cada página para experimentar os links internos, FAQ, recusa local e comportamento responsivo. Os textos e estilos são os mesmos dos templates. Clique nas imagens para ver as capturas completas. As fontes usam Google Fonts; sem internet, o navegador exibe as alternativas locais.</p>${cards}</main></body></html>`);
 console.log('Review bundle exported to '+out);
})().catch(e=>{console.error(e);process.exit(1)});
