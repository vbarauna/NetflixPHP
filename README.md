<h1> MovieIt </h1>
Uma pagina WEB baseada nas funcionalidades e design da Netflix, criado em PHP.


![Screenshot](https://i.ibb.co/jVtmsnY/logo2.png)


<h2>Objetivos do Projeto</h2>
    Desenvolver uma aplicação WEB com o intuito de disponibilizar entretenimento de um jeito mais universal.
Juntando vários filmes, séries e desenhos é possível reunir os gostos de vários usuários numa mesma plataforma, assim, atraindo 
publico que procura praticidade e uma plataforma menos específica em questão de o que podemos assistir.



<h2>Principais funcionalidades:</h2>

 * Cadastro de usuário
 * Assistir filmes e séries (Até o momento apenas video samples, por conta de diretrizes de autoria)
 * Filtro de filmes e séries por categoria ou por busca direta
 * Guardar dados dos vídeos no banco, para que a aplicação consiga retomar o vídeo ou o número do episódio 
 no exato momento onde o usuário parou, em caso de interrupção
 * Edição de perfil de usuário e possível inscrição para um plano "premium" pago (Ainda não disponível).
 
 
 <h2>Tecnologias Utilizadas:</h2>
 
* Sublime Text (Editor de texto)
* XAMPP (para hospedar o site e o banco)
* MySQL
 
 
 <h2>Resultados</h2>
 
  Tela de cadastro: 
 ![Screenshot](https://i.ibb.co/FHqmhHg/Tela-Cadastro.png)
  Tela onde o usuário poderá se cadastrar, com o formulário formatando todos os dados e incluindo no banco de dados.
 
  Tela de login: 
 ![Screenshot](https://i.ibb.co/mSJKM71/Tela-Login.png)
  Tela onde o usuário já cadastrado poderá fazer login, puxando os dados cadastrados no banco de dados.
 
 Tela Inicial 1: 
 ![Screenshot](https://i.ibb.co/4Pn6bg2/Tela-Inicio1.png)
  Tela que o usuário irá se deparar ao logar no site. Um preview de um filme/série aletório é tocado assim que o usuário abre a tela
  e botões estarão incluídos caso o cliente queira que o som do vídeo toque, ou caso queira ser levado para a pagina do filme/série 
  mostrado na tela.
  
 Tela Inicial 2: 
 ![Screenshot](https://i.ibb.co/TK71K7F/Tela-Inicio2.png)
 É a mesma tela anterior, porém se "scrollar" para baixo, encontrará mais opções de séries e filmes separados por categoria.
  
 Tela de filme/série: 
 ![Screenshot](https://i.ibb.co/FYYZFbr/Tela-Serie-Esp.png)
 Tela que o usuário encontrará caso acesse alguma série ou filme em específico,
 nela podemos ver todos os episódios disponíveis para essa série, e caso for filme, podemos ver sugestões de filmes da mesma categoria
  
 Tela para assistir:
 ![Screenshot](https://i.ibb.co/SRmMQvM/Tela-Assistir.png)
 Tela que o usuário encontrará ao colocar algum filme para reproduzir... HUD com o nome do episódio aparece apenas quando 
 passamos o mouse pela tela, e HUD com opções de reiniciar o vídeo ou de passar para o próximo episódio aparecerão ao finalizarmos o vídeo.
  
 Tela de busca:
 ![Screenshot](https://i.ibb.co/sV5xg70/Tela-Busca.png)
 Tela de busca onde o usuário pode filtrar o que quer assistir pelo nome.
