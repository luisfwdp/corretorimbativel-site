"use client";

import React, { useEffect, useRef, useState } from "react";
import {
  motion,
  type MotionValue,
  useReducedMotion,
  useScroll,
  useTransform,
} from "framer-motion";

type ContainerScrollProps = {
  titleComponent: React.ReactNode;
  children: React.ReactNode;
};

type HeaderProps = {
  translate: MotionValue<number>;
  titleComponent: React.ReactNode;
  reduceMotion: boolean;
};

type CardProps = {
  rotate: MotionValue<number>;
  scale: MotionValue<number>;
  children: React.ReactNode;
  reduceMotion: boolean;
};

export function ContainerScroll({
  titleComponent,
  children,
}: ContainerScrollProps) {
  const containerRef = useRef<HTMLDivElement>(null);
  const [isMobile, setIsMobile] = useState(false);
  const prefersReducedMotion = useReducedMotion() ?? false;
  const { scrollYProgress } = useScroll({ target: containerRef });

  useEffect(() => {
    const mediaQuery = window.matchMedia("(max-width: 768px)");
    const updateViewport = (event?: MediaQueryListEvent) => {
      setIsMobile(event?.matches ?? mediaQuery.matches);
    };

    updateViewport();
    mediaQuery.addEventListener("change", updateViewport);
    return () => mediaQuery.removeEventListener("change", updateViewport);
  }, []);

  const rotate = useTransform(scrollYProgress, [0, 1], [20, 0]);
  const scale = useTransform(
    scrollYProgress,
    [0, 1],
    isMobile ? [0.7, 0.9] : [1.05, 1],
  );
  const translate = useTransform(scrollYProgress, [0, 1], [0, -100]);

  return (
    <div
      ref={containerRef}
      className="relative flex h-[48rem] items-center justify-center px-5 py-8 md:h-[72rem] md:px-20 md:py-16"
    >
      <div className="relative w-full py-8 md:py-20 [perspective:1000px]">
        <Header
          translate={translate}
          titleComponent={titleComponent}
          reduceMotion={prefersReducedMotion}
        />
        <Card
          rotate={rotate}
          scale={scale}
          reduceMotion={prefersReducedMotion}
        >
          {children}
        </Card>
      </div>
    </div>
  );
}

export function Header({
  translate,
  titleComponent,
  reduceMotion,
}: HeaderProps) {
  return (
    <motion.div
      data-scroll-motion="title"
      style={{ translateY: reduceMotion ? 0 : translate }}
      className="mx-auto max-w-5xl text-center"
    >
      {titleComponent}
    </motion.div>
  );
}

export function Card({ rotate, scale, children, reduceMotion }: CardProps) {
  return (
    <motion.div
      data-scroll-motion="card"
      style={{
        rotateX: reduceMotion ? 0 : rotate,
        scale: reduceMotion ? 1 : scale,
        boxShadow:
          "0 0 #0000004d, 0 9px 20px #0000004a, 0 37px 37px #00000042, 0 84px 50px #00000026, 0 149px 60px #0000000a, 0 233px 65px #00000003",
      }}
      className="mx-auto mt-8 aspect-square w-full max-w-3xl rounded-[30px] border-4 border-[#c6a45b] bg-[#0b1d2b] p-2 shadow-2xl md:mt-10 md:p-4"
    >
      <div className="h-full w-full overflow-hidden rounded-2xl bg-[#0b1d2b]">
        {children}
      </div>
    </motion.div>
  );
}
