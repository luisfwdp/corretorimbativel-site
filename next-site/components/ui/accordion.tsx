'use client';
/** Adapted from ibelick/Motion Primitives Accordion, MIT (2024 ibelick).
 * Selected through 21st.dev; provenance/license in docs/21ST-REVIEW.md.
 * Native details replaces context/cloneElement/height animation for SSR and keyboard support.
 */
import {useEffect,useRef,useState,type ReactNode} from 'react';
import {useReducedMotion} from 'motion/react';
import {useAnimate} from 'motion/react-mini';
export function Accordion({children}:{children:ReactNode}){return <div className="faq-list">{children}</div>;}
export function AccordionItem({question,children}:{question:string;children:ReactNode}){
 const[expanded,setExpanded]=useState(false);const reduce=useReducedMotion();const[scope,animate]=useAnimate();const keyboard=useRef(false);
 useEffect(()=>{const controls=animate(scope.current,{transform:`rotate(${expanded?45:0}deg)`},{duration:reduce||keyboard.current?0:.16,ease:[.22,1,.36,1]});return()=>controls.stop();},[expanded,reduce,animate,scope]);
 return <details onToggle={e=>setExpanded(e.currentTarget.open)}><summary onKeyDown={()=>{keyboard.current=true;}} onPointerDown={()=>{keyboard.current=false;}}>{question}<span ref={scope} className="faq-mark" aria-hidden="true">+</span></summary><div className="faq-answer">{children}</div></details>;
}
