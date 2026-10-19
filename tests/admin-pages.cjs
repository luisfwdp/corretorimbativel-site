/* Default credentials belong exclusively to this throwaway Playground installation. */
const assert=require('node:assert/strict');
const {launch,assets}=require('./browser-support.cjs');
const base=process.env.CI_EDITORIAL_URL||'http://127.0.0.1:9410';
assert.match(base,/^http:\/\/127\.0\.0\.1:\d+$/);
(async()=>{
 const browser=await launch();const context=await browser.newContext();const page=await context.newPage();await assets(page);
 await page.goto(base+'/wp-login.php');
 await page.locator('#user_login').fill('admin');await page.locator('#user_pass').fill('password');
 await Promise.all([page.waitForURL('**/wp-admin/**'),page.locator('#wp-submit').click()]);
 const before=await context.request.get(base+'/wp-json/wp/v2/pages?per_page=100&_fields=id,slug').then(r=>r.json());
 await page.goto(base+'/wp-admin/themes.php?page=ci-funnel-pages');
 assert.equal(await page.locator('table.widefat tbody tr').count(),5);
 const afterRead=await context.request.get(base+'/wp-json/wp/v2/pages?per_page=100&_fields=id,slug').then(r=>r.json());
 assert.deepEqual(before,afterRead,'GET must not mutate pages');
 const invalid=await context.request.post(base+'/wp-admin/admin-post.php',{form:{action:'ci_register_funnel_pages'}});
 assert.equal(invalid.status(),403,'Missing nonce must reject registration');
 await page.getByRole('button',{name:'Criar rascunhos e associar templates'}).click();
 await page.waitForSelector('.notice-info');
 assert.match(await page.locator('.notice-info').innerText(),/Templates associados/);
 assert.equal(await page.locator('table.widefat tbody tr').count(),5);
 const after=await context.request.get(base+'/wp-json/wp/v2/pages?per_page=100&_fields=id,slug').then(r=>r.json());
 assert.deepEqual(before,after,'Valid repeated association must not duplicate pages');
 const anonymous=await browser.newContext();
 const denied=await anonymous.request.post(base+'/wp-admin/admin-post.php',{form:{action:'ci_register_funnel_pages'}});
 assert.ok([400,403,401].includes(denied.status()),'Anonymous action must be rejected');
 await anonymous.close();await context.close();await browser.close();
 console.log('PASS: authenticated setup screen, read-only GET, nonce rejection, explicit association, no duplicates and anonymous rejection.');
})().catch(e=>{console.error(e);process.exit(1)});
