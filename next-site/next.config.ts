import type { NextConfig } from 'next';
const config: NextConfig = {
 poweredByHeader: false,
 trailingSlash: false,
 allowedDevOrigins: ['127.0.0.1'],
 async headers() {
  const preview = process.env.SITE_RELEASE !== 'production';
  return [{source:'/:path*',headers:[
   {key:'X-Content-Type-Options',value:'nosniff'},
   {key:'Referrer-Policy',value:'strict-origin-when-cross-origin'},
   {key:'Permissions-Policy',value:'camera=(), microphone=(), geolocation=()'},
   ...(preview?[{key:'X-Robots-Tag',value:'noindex, nofollow'}]:[]),
  ]}, ...['/upsell-manual','/upsell-ebook'].map(source=>({source,headers:[{key:'X-Robots-Tag',value:'noindex, nofollow'}]}))];
 },
};
export default config;
