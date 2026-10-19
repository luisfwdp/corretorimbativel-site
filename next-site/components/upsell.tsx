import {catalogue,money,type ProductId} from '@/lib/catalogue';
import {getOffer,educational} from '@/lib/commerce';
import {ProductVisual} from './products';
import {PaymentAction} from './offers';
import {Decline} from './decline';
export function Upsell({id}:{id:ProductId}){
 const manual=id==='upsell-manual';const p=catalogue[id];const base=catalogue[manual?'ebook':'manual-juridico'];const config=getOffer(id);
 const benefits=manual?[
 ['Conecte a leitura à documentação','Observe como contratos, propostas e distratos participam das diferentes etapas da negociação.'],
 ['Dê atenção à formalização','Compreenda a finalidade dos documentos e os cuidados que merecem análise antes de utilizá-los.'],
 ['Olhe para os registros da intermediação','Reflita sobre as informações que ajudam a compreender o trabalho realizado e os acordos feitos.'],
 ]:[
 ['Entenda melhor sua atuação','Estude o papel do corretor, sua base jurídica e os limites da atividade profissional.'],
 ['Amplie o olhar sobre os riscos','Conheça situações que podem gerar divergências sobre responsabilidade, documentação e comissão.'],
 ['Relacione os documentos às boas práticas','Complemente seu estudo com uma visão mais ampla de organização, registro e prevenção.'],
 ];
 return <><section className="upsell-hero" id="hero"><div className="shell upsell-grid"><div><p className="small-label">Uma escolha complementar ao seu material</p><h1>{manual?'Você já garantiu o conhecimento. Agora complemente sua preparação com o Manual Jurídico.':'Você já tem o Manual Jurídico. Agora amplie seu conhecimento com o Corretor Imbatível.'}</h1><p className="hero-sub">{manual?'Você já garantiu o Corretor Imbatível. Agora pode complementar seu material com orientações práticas sobre contratos, propostas, distratos e documentação da intermediação.':'Complemente o Manual Jurídico com o eBook Corretor Imbatível e tenha uma visão mais ampla dos direitos, responsabilidades, riscos e boas práticas da corretagem imobiliária.'}</p><div className="upsell-decision" id="oferta"><p>Adicione {manual?'o Manual Jurídico':'o eBook Corretor Imbatível'} por mais</p><p className="price">{money(p.price)}</p><p className="journey-total">Compra inicial de {money(base.price)} + complemento de {money(p.price)} = <strong>{money(base.price+p.price)} no total.</strong></p><p className="purchase-notice">{config.mode==='native-pending'?'A oferta pós-compra depende de confirmação da Greenn. Nenhuma cobrança é feita ao visitar esta página.':'Esta oferta é uma nova compra, em checkout separado. Ao continuar, você revisará o valor e autorizará o pagamento. Nenhuma cobrança é feita ao visitar esta página.'}</p><PaymentAction id={id}/><Decline url={config.decline} label={manual?'Não, obrigado. Quero continuar apenas com o eBook.':'Não, obrigado. Quero continuar apenas com o Manual.'}/></div></div><div className="upsell-visual"><ProductVisual id={manual?'manual-juridico':'ebook'} priority/></div></div></section><section className="upsell-benefits narrative muted"><div className="shell"><h2>{manual?'Do conhecimento aos cuidados documentais.':'Dos cuidados documentais a uma visão mais ampla da profissão.'}</h2><p>O complemento tem um foco próprio e pode ser estudado em conjunto com o material que você escolheu.</p><dl className="benefit-columns">{benefits.map(([title,text])=><div key={title}><dt>{title}</dt><dd>{text}</dd></div>)}</dl><p className="legal-note">{educational}</p></div></section></>;
}
