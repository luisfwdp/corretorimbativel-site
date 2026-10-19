<?php
/** eBook: supplied transcription. Manual: scope explicitly supplied in the brief. */
defined( 'ABSPATH' ) || exit;
function ci_editorial_chapter_data( $key ) {
	if ( 'ebook' === $key ) {
		return array(
			array( 'Introdução', 'Uma visão do papel do corretor em decisões patrimoniais importantes e da relação entre preparo, conhecimento jurídico e atuação profissional.' ),
			array( 'O Corretor de Imóveis: Conceito e Atuação', 'O que caracteriza a atividade de corretagem, suas atribuições e os limites que precisam ser observados ao aproximar as partes.' ),
			array( 'Base Jurídica: O que diz a Lei', 'Uma apresentação da legislação da profissão e das regras do contrato de corretagem, conectando conceitos jurídicos à realidade do trabalho.' ),
			array( 'Corretor Angariador x Corretor Vendedor', 'As diferenças entre as duas atuações e a importância de reconhecer os papéis de cada profissional, inclusive nas discussões sobre remuneração.' ),
			array( 'A Importância da Documentação na Intermediação', 'Por que contratos, propostas, comunicações e registros ajudam a compreender o trabalho realizado e os acordos feitos durante uma negociação.' ),
			array( 'Boas Práticas na Intermediação Imobiliária', 'Cuidados que atravessam o atendimento, a análise de informações, a formalização e o acompanhamento da negociação, com uma perspectiva preventiva.' ),
			array( 'Considerações Finais', 'Uma retomada dos principais pontos da leitura e da importância de unir conhecimento, ética e organização no exercício da profissão.' ),
		);
	}
	return array(
		array( 'Contrato de Intermediação Imobiliária', 'Entenda a importância de registrar a relação de intermediação, o serviço combinado e as condições que merecem atenção antes do início do trabalho.' ),
		array( 'Proposta de Compra', 'Conheça os cuidados com a formalização das condições apresentadas pelas partes, para que preço, prazos e demais pontos não fiquem apenas na conversa.' ),
		array( 'Contrato Particular de Compra e Venda', 'Observe o papel da documentação na definição dos compromissos entre comprador e vendedor e reconheça situações que exigem análise jurídica específica.' ),
		array( 'Distrato Imobiliário', 'Compreenda por que a desistência ou o encerramento de uma negociação também precisa de atenção à documentação e aos compromissos anteriormente assumidos.' ),
		array( 'Notificação Extrajudicial de Cobrança de Comissão', 'Entenda a finalidade da comunicação formal sobre a remuneração e a importância de avaliar os fatos e os registros antes de qualquer medida de cobrança.' ),
		array( 'Atuação do Corretor e Provas da Intermediação', 'Reconheça o valor dos registros que ajudam a demonstrar a participação do corretor e a reconstruir as etapas do atendimento e da negociação.' ),
		array( 'Considerações Finais', 'Reúna os cuidados documentais em uma perspectiva de organização e prevenção, respeitando as particularidades de cada caso.' ),
	);
}

function ci_editorial_faq_data( $key ) {
	$combo = 'combo' === $key;
	return array(
		array( $combo ? 'O que está incluído no Combo Completo?' : 'O Manual Jurídico é o mesmo material que o eBook?', $combo ? 'O Combo reúne o eBook Corretor Imbatível e o Manual Jurídico para Corretores de Imóveis e Imobiliárias. O eBook aborda a atuação profissional e sua base jurídica; o Manual concentra as orientações sobre documentação e formalização.' : 'São produtos separados. O eBook Corretor Imbatível apresenta conhecimentos jurídicos sobre a profissão. O Manual Jurídico concentra as orientações sobre documentos, contratos, propostas, distratos e registros da intermediação.' ),
		array( 'Preciso ter formação em Direito?', 'O conteúdo é voltado a corretores e profissionais do mercado imobiliário. A proposta é aproximar os cuidados jurídicos da rotina profissional, sem substituir a análise de um advogado sobre situações concretas.' ),
		array( 'Recebo modelos de documentos editáveis?', 'Esta página descreve os materiais de leitura e seus temas. Não anuncia um pack de documentos editáveis como parte da oferta. Considere incluídos apenas os itens expressamente apresentados na descrição do produto no checkout.' ),
		array( 'Sou iniciante. Este conteúdo faz sentido para mim?', 'Sim. Reconhecer a importância da formalização, dos registros e dos limites da atuação profissional é útil desde o início da carreira. Profissionais experientes também podem usar a leitura para revisar seus cuidados e sua organização.' ),
		array( 'Como funciona o pagamento e o acesso?', 'O material é digital e o pagamento é realizado pela Greenn. Antes de concluir a compra, confira as condições de pagamento, entrega e acesso apresentadas no checkout.' ),
		array( 'O material garante minha comissão ou elimina riscos?', 'Não. Nenhum material educativo garante o resultado de uma negociação ou elimina riscos jurídicos. O objetivo é ampliar o conhecimento e a atenção aos cuidados profissionais. Casos concretos exigem orientação jurídica individualizada.' ),
	);
}
