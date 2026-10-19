# Componente selecionado no 21st.dev

- Diretório: https://21st.dev/@ibelick/components/accordion
- Metadados verificados: https://21st.dev/@ibelick/components/accordion.md
- Autor: Julien Thibeaut / ibelick. Biblioteca: Motion Primitives.
- Repositório original: https://github.com/ibelick/motion-primitives
- Commit consultado: `120f64f6ca60348e251f929e9c81f11ccbe45eda`.
- Código consultado: `components/core/accordion.tsx`.
- Licença: MIT, conferida no diretório e na licença do repositório; texto integral em MOTION-PRIMITIVES-LICENSE.txt.
- Não foi executado um instalador remoto de componentes. O registry do 21st.dev exige chave de instalação; usamos a fonte upstream pública da biblioteca indicada no catálogo. Nenhuma chave é necessária em runtime.

## Avaliação e adaptação

O original emprega Motion, provider/contexto, cloneElement e animação de altura. O conceito de accordion/trigger/content e o indicador de estado foram adaptados em `components/ui/accordion.tsx`, com atribuição MIT. Não se importou uma coleção inteira de componentes.

Mudanças deliberadas: usar details/summary nativos, manter a resposta no HTML renderizado, permitir FAQ sem JS, usar teclado nativo, isolar a rotação do indicador com Motion, respeitar useReducedMotion e evitar animação de altura. Estado nativo aberto/fechado continua sendo a fonte da interação. Sem div clicável ou dependência de hover.

Compatibilidade: React 19 e App Router com ilha client pequena; textos e restante das páginas são renderizados no servidor. `motion/react` substitui a dependência histórica `framer-motion` indicada no catálogo, com uma única versão do Motion instalada.

Nenhum outro componente foi importado sem análise. Heros, coleção, preços e layouts editoriais foram escritos especificamente para a marca; a procedência verificada de um accordion não licencia artes de outros autores.
