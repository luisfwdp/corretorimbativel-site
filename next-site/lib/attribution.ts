export const attributionKeys=['utm_source','utm_medium','utm_campaign','utm_term','utm_content','fbclid','gclid'] as const;
export function readAttribution(search:string){
 const p=new URLSearchParams(search);const out:Record<string,string>={};
 for(const key of attributionKeys){const v=p.get(key);if(v&&v.length<=500)out[key]=v;}
 return out;
}
export function withAttribution(href:string,values:Record<string,string>){
 if(href.startsWith('#'))return href;
 const u=new URL(href,'https://corretorimbativel.com.br');
 for(const key of attributionKeys){if(values[key]&&!u.searchParams.has(key))u.searchParams.set(key,values[key]);}
 return href.startsWith('/')?u.pathname+u.search+u.hash:u.href;
}
export function safePageLocation(href:string){const u=new URL(href);const safe=new URL(u.pathname,u.origin);for(const [key,value]of Object.entries(readAttribution(u.search)))if(key.startsWith('utm_'))safe.searchParams.set(key,value);return safe.href;}
