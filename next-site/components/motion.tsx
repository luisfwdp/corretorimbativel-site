'use client';
import {useEffect,useRef,type ReactNode} from 'react';
import {useInView} from 'motion/react';
import {useReducedMotionPreference} from './use-reduced-motion';
import {useAnimate} from 'motion/react-mini';
export function EditorialReveal({children,className=''}:{children:ReactNode;className?:string}){
 const[scope,animate]=useAnimate();const inView=useInView(scope,{once:true,amount:.18});const reduce=useReducedMotionPreference();const played=useRef(false);
 useEffect(()=>{
  if(!inView||reduce||played.current)return;
  played.current=true;
  const element=scope.current;
  const animation=animate(element,{opacity:[.85,1],transform:['translateY(10px)','translateY(0px)']},{duration:.36,ease:[.22,1,.36,1]});
  return()=>{animation.stop();if(element){element.style.opacity='';element.style.transform='';}};
 },[inView,reduce,animate,scope]);
 return <div ref={scope} className={className}>{children}</div>;
}
