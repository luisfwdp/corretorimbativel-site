import {chromium} from '@playwright/test';
import assert from 'node:assert/strict';
import fs from 'node:fs/promises';
const base=process.env.CI_NEXT_URL||'http://127.0.0.1:9432';assert.match(base,/^http:\/\/127\.0\.0\.1:\d+$/);
const b=await chromium.launch({executablePath:process.env.PLAYWRIGHT_EXECUTABLE_PATH||'/usr/bin/chromium',args:['--no-sandbox']});
try{
const p=await b.newPage({viewport:{width:1440,height:1000},reducedMotion:'no-preference'});await p.goto(base+'/ebook',{waitUntil:'networkidle'});await p.addStyleTag({content:'html{scroll-behavior:auto!important}'});
await p.locator('#solucao').scrollIntoViewIfNeeded();await p.waitForTimeout(40);const running=await p.locator('#solucao').evaluate(e=>e.getAnimations({subtree:true}).filter(a=>a.playState==='running').length);assert.ok(running>0);
await p.waitForTimeout(450);assert.equal(await p.locator('#solucao').evaluate(e=>e.getAnimations({subtree:true}).filter(a=>a.playState==='running').length),0);
await p.locator('#hero').scrollIntoViewIfNeeded();await p.locator('#solucao').scrollIntoViewIfNeeded();await p.waitForTimeout(30);assert.equal(await p.locator('#solucao').evaluate(e=>e.getAnimations({subtree:true}).filter(a=>a.playState==='running').length),0,'Reveal runs once');
await p.locator('#conteudo').scrollIntoViewIfNeeded();await p.emulateMedia({reducedMotion:'reduce'});await p.waitForTimeout(40);assert.equal(await p.evaluate(()=>document.getAnimations().filter(a=>a.playState==='running').length),0);
await p.locator('#hero').scrollIntoViewIfNeeded();await p.locator('.publication img').hover();assert.equal(await p.locator('.publication img').evaluate(e=>getComputedStyle(e).transform),'none');
const report={singleReveal:true,revealEnds:true,revisitDoesNotReplay:true,reducedMotionCancels:true,reducedMotionDisablesHover:true};await fs.mkdir(process.env.CI_NEXT_RESULTS||'/workspace/scratch/corretor-next-preview',{recursive:true});await fs.writeFile((process.env.CI_NEXT_RESULTS||'/workspace/scratch/corretor-next-preview')+'/motion-report.json',JSON.stringify(report,null,2));console.log(JSON.stringify(report));
}finally{await b.close();}
