<html>

<head>
<style>

.center {
  margin: auto;
  width: 900px;
  border: 1px solid #73AD21;
  padding: 10px;
}

div.a {
  width: 1000px;
  horizontal-align: middle;
}

table {
    border-collapse: collapse; 
    border:1px solid #69899F;
} 
table td{
    border:1px dotted #000000;
    padding:5px;
}
table td:first-child{
    border-left:0px solid #000000;
}

</style>

</head>
<body>

<div class="center">

<a id="topo"></a>
<h2>mKAOS Studio Lite - Tutorial </h2>

Índice<br/>
<ul>
<li><a href='#introducao'>1. Introdução </a></li>
<li><a href='#exemplo'>2. Exemplo de modelo de missões de SoS </a></li>
<li><a href='#elementos'>3. Os elementos utilizados no modelo</a></li>
<li><a href='#construindo'>4. Construindo um diagrama na ferramenta</a></li>
<li><a href='#heuristicas'>5 - Heurísticas</a></li>
<li><a href='#duvidas'>6. Dúvidas, sugestões e contato</a></li>
</ul>

<a id="introducao"></a>
<h3>1. Introdução</h3>

<p> 
Esta ferramenta tem a finalidade de auxiliar no desenho de projetos de sistemas-de-sistemas (SoS) 
e foi desenvolvida no âmbito do Laboratório de Engenharia de Sistemas Complexos (LabESC) da UNIRIO. 
Esta ferramenta utiliza elementos da ferramenta mKAOS Studio, desenvolvida no ambiente Eclipse e construída
no âmbito do Departamento de Informática e Matemática Aplicada (DIMAp) da UFRN.
<p>
SoS são arranjos de sistemas independentes gerencial e operacionalmente chamados sistemas constituintes,
que unem capacidades para cumprir uma nova missão que não é de responsabilidade de nenhum dos sistemas consituintes
isoladamente. Exemplos de SoS são as cidades inteligentes onde vários sistemas públicos e privados se comunicam
para promover melhor mobilidade urbana, atendimento de emergência e saúde e bem-estar social.
<p>
O diagrama do modelo de missões de SoS, construído com esta ferramenta, representa quais são os sistemas constituintes
envolvidos no projeto de SoS, como esses sistemas constituintes se relacionam e como as capacidades fornecidas são 
utilizadas para gerar novas capacidades e para cumprir as missões do SoS. Este diagrama pode facilitar a 
comunicação entre gerentes, engenheiros de sistemas e desennvolvedores na fase de projeto de SoS.
<p>

<h4>1.1 Sobre a ferramenta </h4>

Esta ferramenta de modelagem foi desenvolvida com o intuito de auxiliar no projeto de SoS utilizando regras 
(heurísticas) a serem aplicadas durante a modelagem do SoS. Conforme o diagrama é construído,
a ferramenta ajuda tanto na composição dos elementos, criticando os tipos de ligações, quanto no preenchimento
dos atributos necessários para o sucesso do projeto. 
<p>
É possível avaliar possíveis problemas no modelo sendo gerado utilizando o botão [Check Model] a qualquer tempo
durante a construção do diagrama. As mensagens emitidas pela ferramenta indicam o possível problema, o 
elemento envolvido e a respectiva heurística envolvida se for o caso. A própria interface da ferramenta também previne que ligações incorretas sejam feitas entre os elementos como 
por exemplo um sistema constituinte A ligado a outro sistema constituinte B, representando que o sistema 
A fornece o sistema B, o que para o SoS não faz sentido já que sistemas constituintes fornecem capacidades e 
não outros sistemas. 
<p>
Elementos que precisam que atributos adicionais sejam definidos aparecem inicialmente com fundo branco no
diagrama. Assim que estas informações são inseridas o elemento é preenchido com a cor de fundo correspondente.
A figura abaixo mostra um exemplo de elementos sem atributos indicados (à esquerda) e com atributos completos
(à direita).

<center>
<img src='../images/elementos_vazados.png' width=600>
<br/>
Figura 1. Exemplo de SoS
</center>

<br/><br/><a href='#topo'>Volta ao topo</a><br/>

<a id="exemplo"></a>
<h3>2. Exemplo de modelo de missões de SoS </h3>

Abaixo é apresentado um exemplo de diagrama representando um SoS com 2 sistemas constituintes 
fornecendo a capacidade 1 e a capacidade 2. Neste modelo, o sistema constituinte 1 fornece uma capacidade 
mas pode apresentar falhas temporárias (símbolo do relógio) e assim foi adicionado ao projeto o sistema 
redundante para que forneça uma capacidade redundante à capacidade 1 em caso de falha, garantindo assim 
que a missão global possa ser cumprida com mais confiabilidade.

<center>
<img src='../images/exemplo_sos.png' width=600>
<br/>
Figura 2. Exemplo de SoS
</center>

<br/><br/><a href='#topo'>Volta ao topo</a><br/>

<a id="elementos"></a>
<h2>3. Os elementos utilizados no modelo</h2>

O diagrama do modelo de missões do mKAOS utiliza os seguintes elementos:
<table>
<tr>
    <td> <img src='../images/mini-constituent.png' width=50/> </td>
    <td> Sistema constituinte: Sistema independente que fornece uma ou mais capacidades ao SoS. </td>
</tr>
<tr>
    <td> <img src='../images/mini-mission.png' width=50/> </td>
    <td> Capacidade / Missão: Representa uma capacidade fornecida por um sistema constituinte ou uma missão cumprida pelo SoS.</td>
</tr>
<tr>
    <td> <img src='../images/mini-refinement.png' width=50/>  </td>
    <td> Refinamento: É uma atividade desenvolvida para processar uma ou mais capacidades fornecidas para entregar novas caapcidades ou realizar missões do SoS. </td>
</tr>
<tr>
    <td> <img src='../images/responsible_for.png' width=50/>  </td>
    <td> Link de sistema constituinte responsável por: Indica que um sistema constituinte é responsável por entregar uma determinada capacidade. </td>
</tr>
<tr>
    <td> <img src='../images/refinement_to.png' width=50/>  </td>
    <td> Link de refinamento responsável por: Indica que um determinado refinamento é responsável por entregar uma nova capacidade ou missão. </td>
</tr>
<tr>
    <td> <img src='../images/link_refinement.png' width=50/>  </td>
    <td> Link de fornecimento de capacidade para refinamento: Indica que capacidades são entregues para refinamento. Note que não há seta nesta aresta 
        pois não há entrega de capacidade ou missão para o SoS. 
    </td>
</tr>

</table>

<p>
Além dos elementos acima, o mKSLite adiciona os seguintes elementos:
<table>
<tr>
    <td> <img src='../images/exclusive-gateway.png' width=50/> </td>
    <td> Gatway exclusivo: utilizado para representar que há mais de um sistema constituinte disponível para fornecer redundância em caso de falha no fornecimento de alguma capacidade. </td>
</tr>
<tr>
    <td> <img src='../images/timer.png' width=30/> </td>
    <td> Falha temporária: Acontece quando um sistema para de fornecer uma capacidade mas retorna a 
        fornecê-la sem necessidade de atuação, como por exemplo quando quando há um problema de rede.</td>
</tr>
<tr>
    <td> <img src='../images/cancel.png' width=30/> </td>
    <td> Falha permanente: Acontece quando um sistema para de responder e é preciso uma ação para 
        que volte a funcioinar ou seja substituido, como por exemplo quando uma atualização de sistema
        causa erro em um serviço web..</td>
</tr>
</table>

<p>
Segue abaixo um esquema dos elementos da interface da ferramenta:
<br/>
<img src='../images/ferramenta.png' width= 800/>
<br/>
<center>    
Figura 3. Elementos da interface da ferramenta
</center>

<br/><br/><a href='#topo'>Volta ao topo</a><br/>

<a id="construindo"></a>
<h2>4. Construindo um diagrama na ferramenta</h2>

Para construir um projeto de SoS utilizando esta ferramenta, você pode seguir os seguintes passos:

<p>Passo 1. Identifique quais são os sistemas constituintes e as respectivas capacidades que serão utilizadas
    pelo SoS e faça sua representação:
<ul>
<li>
    Clique no símbolo <img src='../images/mini-constituent.png' width=40> para criar cada um dos
     sistemas constituintes. 
</li>    
<li>
    Clique sobre cada um dos símbolos dos sistemas constituintes e altere seu nome na caixa "Node" 
    abaixo do diagrama, modificando o nome genérico dado pela ferramenta no campo Label e a dica a 
    ser mostrada quando o mouse pousa sobre a figura. 
</li>
<li>
    Identifique quais capacidades devem ser combinadas para gerar novas capacidades e realizar as
    missões secundárias e a missão global do SoS.
</li>
<li>
    Clique no símbolo <img src='../images/mini-mission.png' width=40> para criar cada uma das capacidades.
</li>
<li>
    Clique sobre cada um dos símbolos das capacidades e altere seu nome na caixa "Edge" 
    abaixo do diagrama, modificando o nome genérico dado pela ferramenta no campo Label e a dica a 
    ser mostrada quando o mouse pousa sobre a figura. 
</li>
<li>
    Faça a ligação entre os sistemas constituintes e suas respectivas capacidades clicando no símbolo
    <img src='../images/responsible_for.png' width=40/> e em seguida no par de sistema e capacidade a ligar. 
    A ferramenta já escolhe a direção da seta.
</li>
</ul>

<p>Passo 2. Identifique quais são os refinamentos necessários e quais capacidades estão envolvidas em cada refinamento.    
<ul>
<li>    
Clique no símbolo <img src='../images/mini-refinement.png' width=40/> para criar a representação dos
refinamentos necessários para cada um dos processos para utilizar as capacidades. 
</li>
<li>
Clique no símbolo <img src='../images/link_refinement.png' width=40/> e faça a ligação das capacidades 
a serem refinadas (combinadas, processadas etc) por cada um dos refinamentos criados. 
</li>
<li>
Clique no símbolo <img src='../images/mini-mission.png' width=40> para criar a missão a ser realizada ou 
nova capacidade sendo entregue ao SoS.
</li>
<li>
Para cada refinamento, clique no símbolo <img src='../images/refinement_to.png' width=40/> para criar a 
missão a ser realizada ou a nova capacidade a ser entregue ao SoS.
</li>
<li>
Clique no símbolo <img src='../images/refinement_to.png' width=40/> e faça a ligação dos 
refinamentos às suas respectivas capacidades ou missões criadas.
</li>
</ul>

<p>Passo 3. Se for necessário, repita o passo 2 para criar novos refinamentos das capacidades ou missões criadas pelos 
    refinamentos anteriores até conseguir representar a missão global do SoS.

<p>Caso se possa identificar possíveis falhas já no projeto siga o passo 4.

<p>Passo 4. Identifique se há possíveis falhas dos sistemas constituintes para representá-las no modelo.

<ul>
<li>
Clique na aresta <img src='../images/responsible_for.png' width=40> entre o sistema que pode 
apresentar falha e sua capacidade a escolha a opção de tipo de falha na caixa Edge abaixo do diagrama, 
salvando em seguida. À ligação será adicionado um ícone representando o tipo de falha.
</li>
<li>
Se já for possível identificar uma capacidade redundante para esta possível falha, crie o sistema 
    e capacidade redundante utilizando o passo 1.
</li>
<li>
    Clique no símbolo <img src='../images/exclusive-gateway.png' width=40> para criar a representação
de um consumo alternativo no caso de fallha e ligue este símbolo às capacidades envolvidas.
</li>
<li>
<p> - Ligue <img src='../images/exclusive-gateway.png' width=40> ao respectivo refinamento, denotando que 
a capacidade redundante pode ser consumida no caso de falha da capacidade principal.
</li>
</ul>

<p>Para apagar qualquer elemento criado basta clicar sobre o mesmo e em seguida clicar no 
    ícone <img src='../images/trash.png' width=40> ou na tecla [DEL].


<br/><br/><a href='#topo'>Volta ao topo</a><br/>

<a id="heuristicas"></a>
<h2>5. Heurísticas avaliadas pela ferramenta</h2>

As heurísticas são critérios, pontos-chave ou "regras de ouro" que um projeto precisa 
atender para cumprir uma determinada proposta. A heurística pode ser considerada um 
"atalho mental" usado no pensamento humano para se chegar aos resultados e questões 
mais complicadas de modo rápido e fácil, mesmo que estes sejam incertos ou incompletos.
<br/><br/>
A avaliação heurística é um método proposto por Jakob Nielsen e Rolf Molich que consiste em uma 
inspeção com o intuito de encontrar problemas em uma interface de usuário.

Nesta ferramenta utilizamos heurísticas para auxiliar na construção de projetos de SoS. 
Elas podem ser verificadas por meio do botão [Check Model] na parte de baixo da barra de ferramentas.
<br/><br/>
Os elementos são criados vazados , 

<br/><br/>

<b>Heurística de inicialização IN 1</b> - O projeco deve identificar claramente quem fornece as capacidades e recursos 
necessários para a operação do SoS.
<br/><br/>
O SoS depende da sinergia entre sistemas que fornece as capacidades necessárias para sua operação,
sendo necessário garantir quem as fornece. Exemplo: num SoS para prevenção de desastres naturais, existe
um responsável capaz de indicar quais sistemas podem ser integrados ao SoS?
<br/>
<br/>
<b>Heurística de inicialização IN 2</b> - O projeto deve identificar claramente quem é o responsável pela 
construção e operação do SoS.
<br/><br/>
Quando financiamento é necessário para operação do SoS, os envolvidos devem informar como e por quem isto
será feito para que essas questões sejam tratadas no tempo apropriado. Exemplo: Quanto vai custar e quem
vai para pelas atividades e recursos necessário para construir e manter o SoS, além daqueles já disponíveis
pelos sistemas constituintes?
<br/>
<br/>
<b>Heurística de sistemas constituintes SC 1</b> - Defina que capacidades já estão disponíveis e quais precicsam
ser implementadas nos sistemas constituintes para construção e operação do SoS.
<br/><br/>
O projeto do SoS deve antever se as funcionalidades necessárias já existem nos sistemas constituintes ou
se será necessário implementar novas funcionalidades. Exemplo: será necessária demandar que um sistema
de controle de tráfego forneça uma nova capacidade para que se possa produzir uma informação para auxiliar
no trajeto de ambulâncias?
<br/>
<br/>
<b>Heurística de sistemas constituintes SC 2</b> - As capacidades individuais precisam ser checadas.
<br/><br/>
Cada capacidade dos sistema constituintes devem ser checada para verificar se corresponde ao esperado.
Exemplo: O projetista deve verificar se a capacidade de um sistema de localização está disponível com  a
frequência e precisão adequadas para o propósito do SoS.
<br/>
<br/>
<b>Heurística de interoperabilidade IO 1</b> - As interfaces entre os sistemas constituintes e o SoS devem 
ser definidas durante o projeto.
<br/><br/>
As interfaces entre os sistemas constituintes e o SoS são um fator crucial para operação do SoS e
são pontos nos quais o projetista pode exercer influência. Exemplo: A comunicação necessária entre 
2 sistemas constituintes está disponível de maneira satisfatória para operação do SoS ou será necessário
construir novos canais para conectividade?
<br/>
<br/>
<b>Heurística de monitoramento MO 1 </b> - Os padrões de interface surgidos no processo evolucionário
devem ser identificados.
<br/><br/>
O processo evolucionário (p.ex. upgrades) pode demandar novos padrões de comunicação ou a atualização de padrões projetados
inicialmente. É necessário manter um conjunto de padrões utilizados conforme os sistemas constituintes e 
o próprio SoS evoluem, gerando um roteiro para o processo. Exemplo: Quando um novo hospital se torna parte 
do sistema municipal de saúde, é necessário incluir os padrões de comunicação de seus sistemas no projeto 
do SoS se for necessário.

<br/><br/><a href='#topo'>Volta ao topo</a><br/>

<a id="duvidas"></a>
<h2>6. Dúvidas, sugestões e contato</h2>

<p>Em caso de dúvidas e sugestões favor entre em contato pelo email:
<p>marcio.imamura@edu.unirio.br
<br/>
<h4>Obrigado por contribuir com este estudo!</h4>

<br/><a href='#topo'>Volta ao topo</a><br/>

</div>

</body>
</html>
