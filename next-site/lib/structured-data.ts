import { catalogue, site, type LandingId } from "./catalogue";
import { productDescriptions } from "./metadata";

const organizationId = `${site.url}/#organization`;
const authorId = `${site.url}/#author`;

const productImages: Record<LandingId, string> = {
  ebook: "/images/product-ebook-greenn.png",
  "manual-juridico": "/images/product-manual-greenn.png",
  combo: "/images/product-combo-greenn.png",
};

const organization = {
  "@type": "Organization",
  "@id": organizationId,
  name: site.name,
  url: site.url,
  logo: `${site.url}/images/logo.svg`,
};

const author = {
  "@type": "Person",
  "@id": authorId,
  name: site.author,
  jobTitle: "Advogado e corretor de imóveis",
};

export function homeStructuredData() {
  return {
    "@context": "https://schema.org",
    "@graph": [
      organization,
      author,
      {
        "@type": "WebSite",
        "@id": `${site.url}/#website`,
        name: site.name,
        url: site.url,
        inLanguage: "pt-BR",
        publisher: { "@id": organizationId },
      },
    ],
  };
}

export function productStructuredData(id: LandingId) {
  const product = catalogue[id];
  const url = `${site.url}/${id}`;

  return {
    "@context": "https://schema.org",
    "@graph": [
      organization,
      author,
      {
        "@type": "BreadcrumbList",
        "@id": `${url}#breadcrumb`,
        itemListElement: [
          {
            "@type": "ListItem",
            position: 1,
            name: "Corretor Imbatível",
            item: site.url,
          },
          {
            "@type": "ListItem",
            position: 2,
            name: product.short,
            item: url,
          },
        ],
      },
      {
        "@type": "Product",
        "@id": `${url}#product`,
        name: product.name,
        description: productDescriptions[id],
        image: `${site.url}${productImages[id]}`,
        url,
        inLanguage: "pt-BR",
        brand: { "@id": organizationId },
        creator: { "@id": authorId },
        offers: {
          "@type": "Offer",
          url,
          priceCurrency: "BRL",
          price: product.price.toFixed(2),
          availability: "https://schema.org/InStock",
          itemCondition: "https://schema.org/NewCondition",
          seller: { "@id": organizationId },
        },
      },
    ],
  };
}
