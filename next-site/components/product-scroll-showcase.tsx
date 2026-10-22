import Image from "next/image";

import { ContainerScroll } from "@/components/ui/container-scroll-animation";
import { type LandingId } from "@/lib/catalogue";

const showcases: Record<
  LandingId,
  { eyebrow: string; headline: string; description: string; image: string; alt: string }
> = {
  ebook: {
    eyebrow: "Conhecimento para a atuação",
    headline:
      "Você conhece os riscos jurídicos que podem surgir durante uma negociação imobiliária?",
    description:
      "O eBook reúne sete capítulos para ajudar o corretor a compreender responsabilidades, cuidados e boas práticas da profissão.",
    image: "/images/product-ebook-greenn.png",
    alt: "Mockup do eBook Corretor Imbatível em livro e tablet",
  },
  "manual-juridico": {
    eyebrow: "Documentação em foco",
    headline:
      "Na corretagem, o que foi combinado também precisa ser bem documentado.",
    description:
      "O Manual apresenta orientações sobre documentos e acompanha cinco modelos em DOCX para download na área de membros.",
    image: "/images/product-manual-greenn.png",
    alt: "Mockup do Manual para Corretores de Imóveis e Imobiliárias em livro e tablet",
  },
  combo: {
    eyebrow: "Uma visão integrada",
    headline:
      "Conheça os riscos da corretagem. Entenda os documentos. Prepare-se melhor para negociar.",
    description:
      "O Combo reúne o eBook Corretor Imbatível e o Manual Jurídico em uma experiência de estudo complementar.",
    image: "/images/product-combo-greenn.png",
    alt: "Mockup do Combo Completo com o eBook Corretor Imbatível e o Manual Jurídico",
  },
};

export function ProductScrollShowcase({ id }: { id: LandingId }) {
  const showcase = showcases[id];
  const titleId = `${id}-scroll-title`;

  return (
    <section
      aria-labelledby={titleId}
      className="dark product-showcase overflow-hidden bg-[#0b1d2b] text-[#f4f2ec]"
    >
      <ContainerScroll
        titleComponent={
          <div className="mx-auto max-w-4xl px-1 sm:px-4">
            <h2
              id={titleId}
              className="mb-5 text-[clamp(1.85rem,4vw,3.75rem)] leading-[1.12] text-[#f8f6f0]"
            >
              {showcase.headline}
            </h2>
            <p className="mx-auto mb-0 max-w-2xl text-[#d4dce0]">
              {showcase.description}
            </p>
          </div>
        }
      >
        <div className="relative h-full w-full">
          <Image
            src={showcase.image}
            alt={showcase.alt}
            fill
            sizes="(max-width: 768px) calc(100vw - 40px), 768px"
            className="object-cover object-center"
          />
        </div>
      </ContainerScroll>
    </section>
  );
}
