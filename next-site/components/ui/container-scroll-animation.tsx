"use client";

import React, { useEffect, useRef, useState } from "react";
import {
  motion,
  type MotionValue,
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
  const [reduceMotion, setReduceMotion] = useState(false);
  const { scrollYProgress } = useScroll({ target: containerRef });

  useEffect(() => {
    const mediaQuery = window.matchMedia("(max-width: 768px)");
    const motionQuery = window.matchMedia("(prefers-reduced-motion: reduce)");
    const updateViewport = (event?: MediaQueryListEvent) => {
      setIsMobile(event?.matches ?? mediaQuery.matches);
    };
    const updateMotion = (event?: MediaQueryListEvent) => {
      setReduceMotion(event?.matches ?? motionQuery.matches);
    };

    updateViewport();
    updateMotion();
    mediaQuery.addEventListener("change", updateViewport);
    motionQuery.addEventListener("change", updateMotion);
    return () => {
      mediaQuery.removeEventListener("change", updateViewport);
      motionQuery.removeEventListener("change", updateMotion);
    };
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
          reduceMotion={reduceMotion}
        />
        <Card rotate={rotate} scale={scale} reduceMotion={reduceMotion}>
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
      }}
      className="scroll-publication mx-auto mt-8 aspect-square w-full max-w-3xl bg-[#102737] p-2 md:mt-10 md:p-4"
    >
      <div className="h-full w-full overflow-hidden bg-[#0b1d2b]">
        {children}
      </div>
    </motion.div>
  );
}
