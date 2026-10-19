import Link from 'next/link';
import {Header,Footer} from '@/components/shell';
export default function NotFound(){return <><Header offer={false}/><main id="main" tabIndex={-1} className="not-found shell"><p className="small-label">Página não encontrada</p><h1>Vamos voltar à coleção?</h1><p>O endereço acessado não corresponde a uma página disponível.</p><Link className="button" href="/">Conhecer os materiais</Link></main><Footer/></>;}
