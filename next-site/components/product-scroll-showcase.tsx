import Image from "next/image";

import { ContainerScroll } from "@/components/ui/container-scroll-animation";

export function ProductScrollShowcase() {
  return (
    <section
      aria-labelledby="combo-scroll-title"
      className="dark overflow-hidden border-y border-[#354c5a] bg-[#0b1d2b] text-[#f8f6f0]"
    >
      <ContainerScroll
        titleComponent={
          <div className="mx-auto max-w-4xl px-4">
            <p className="small-label">Uma visão integrada</p>
            <h2
              id="combo-scroll-title"
              className="text-[clamp(2rem,4vw,4rem)] text-[#f8f6f0]"
            >
              Conheça os riscos da corretagem. Entenda os documentos.
              Prepare‑se melhor para negociar.
            </h2>
            <p className="mx-auto max-w-2xl text-[#d4dce0]">
              O Combo reúne o eBook Corretor Imbatível e o Manual Jurídico em
              uma experiência de estudo complementar.
            </p>
          </div>
        }
      >
        <div className="relative h-full w-full">
          <Image
            src="/images/product-combo-greenn.png"
            alt="Mockup do Combo Completo com o eBook Corretor Imbatível e o Manual Jurídico"
            fill
            sizes="(max-width: 768px) 92vw, 1024px"
            className="object-contain object-center"
          />
        </div>
      </ContainerScroll>
    </section>
  );
}
