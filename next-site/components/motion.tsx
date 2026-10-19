'use client';
import {useEffect,type ReactNode} from 'react';
import {useInView,useReducedMotion} from 'motion/react';
import {useAnimate} from 'motion/react-mini';
export function EditorialReveal({children,className=''}:{children:ReactNode;className?:string}){
 const[scope,animate]=useAnimate();const inView=useInView(scope,{once:true,amount:.18});const reduce=useReducedMotion();
 useEffect(()=>{
  if(!inView||reduce!==false)return;
  const element=scope.current;
  const animation=animate(element,{opacity:[.85,1],transform:['translateY(10px)','translateY(0px)']},{duration:.36,ease:[.22,1,.36,1]});
  return()=>{animation.stop();if(element){element.style.opacity='';element.style.transform='';}};
 },[inView,reduce,animate,scope]);
 return <div ref={scope} className={className}>{children}</div>;
}
