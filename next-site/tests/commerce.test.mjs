// Tests configuration logic only. No navigation or payment. Legacy URL is NOT an approved offer.
import test from 'node:test';
import assert from 'node:assert/strict';
import fs from 'node:fs';
import ts from 'typescript';
const compile=file=>ts.transpileModule(fs.readFileSync(new URL(file,import.meta.url),'utf8'),{compilerOptions:{module:ts.ModuleKind.ES2022,target:ts.ScriptTarget.ES2022}}).outputText;
const catalogueURL='data:text/javascript;base64,'+Buffer.from(compile('../lib/catalogue.ts')).toString('base64');
const source=compile('../lib/commerce.ts').replace("import 'server-only';",'').replace("'./catalogue'",JSON.stringify(catalogueURL));
const{getOffer,safeHttps,auditOffers}=await import('data:text/javascript;base64,'+Buffer.from(source).toString('base64'));
const legacy='https://payfast.greenn.com.br/123089';
test('Payment gates reject missing confirmation and missing refusal',()=>{
 const saved={...process.env};try{
 for(const key of Object.keys(process.env))if(key.startsWith('GREENN_'))delete process.env[key];
 assert.equal(getOffer('ebook').ready,false);
 process.env.GREENN_EBOOK_URL=legacy;assert.equal(getOffer('ebook').ready,false);
 process.env.GREENN_EBOOK_VERIFIED='true';assert.equal(getOffer('ebook').ready,true);
 process.env.GREENN_UPSELL_MANUAL_URL=legacy;process.env.GREENN_UPSELL_MANUAL_VERIFIED='true';assert.equal(getOffer('upsell-manual').ready,false);
 process.env.GREENN_UPSELL_MANUAL_DECLINE_URL='https://example.invalid/completion';assert.equal(getOffer('upsell-manual').ready,true);
 process.env.GREENN_UPSELL_MANUAL_MODE='native';assert.equal(getOffer('upsell-manual').ready,true,'Native post-purchase offers keep their verified standalone fallback');
 assert.throws(auditOffers,/Checkout duplicado/);
 }finally{for(const key of Object.keys(process.env))if(key.startsWith('GREENN_'))delete process.env[key];for(const[key,value]of Object.entries(saved))if(key.startsWith('GREENN_'))process.env[key]=value;}
});
test('HTTPS and official payment host validation reject unsafe and unrelated links',()=>{
 for(const x of ['javascript:alert(1)','http://payfast.greenn.com.br/123089','https://greenn.com.br.example.invalid/x','https://user:pass@payfast.greenn.com.br/123089'])assert.equal(safeHttps(x,true),null);
 assert.equal(safeHttps(legacy,true),legacy);assert.equal(safeHttps('https://example.invalid/finish'), 'https://example.invalid/finish');
});
