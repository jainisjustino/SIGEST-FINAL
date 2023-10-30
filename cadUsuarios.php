<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Cadastro de usuários</title>
  <style>
        /* Estilos para o cabeçalho ... */

        /* Estilos para o formulário ... */

          body {
      margin-left: 0px;
      margin-top:0px;
      margin-right:0px;
      background-color: #f1f1f1;
    }
    

    #header {
            margin-left: 0;
            background-color: #900603;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        #logo {
            color: white;
            font-family: arial, Helvetica, sans-serif;
            font-size: 35px;
            font-weight: bold;
            margin-left:5px;
            margin-right: 50px;
            text-decoration: none;
        }

        h2 {
          margin-bottom: -10px;
        }
        
        #menu1, #menu2 {
          display: flex;
        }
        
        #menu1 a, #menu2 a {
          font-family: Arial, sans-serif;
          text-decoration: none;
          color: white;
          padding: 10px;
          margin-right: 10px;
          background-color: #900603;
          border-radius: 5px;
          font-size: 20px;
        }
        
        #menu1 a:hover {
          background-color: rgb(177, 177, 177);
        }

         #menu2 a:hover {
          background-color: rgb(177, 177, 177);
        }

        #menu2 {
          margin-left: 19%;
        }

        .container {
          max-width: 50%;
          margin: 0 auto;
          margin-top: 30px;
          padding: 20px;
          background-color: #900603;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    
        .container h2 {
          text-align: center;
          font-size: 30px;
          font-family: Arial, sans-serif;
          color: white;
        }

        .container h3 {
          text-align: center;
          font-size: 20px;
          font-family: Arial, sans-serif, italic;
          color: white;
        }

        .container p {
          text-align: left;
          font-size: 19px;
          margin-left: 2%;
          margin-top: 5%;
          margin-bottom: 1%;
          font-family: Arial, sans-serif, italic;
          color: white;
        }
    
        .container form {
          margin-top: 20px;
          color: white;
        }
    
        .container form label,
        .container form input {
          display: block; /* Para que os campos fiquem em uma linha separada */
          width: 100%; /* Para ocupar toda a largura da linha */
        }
    
        .container form label {
          text-align: left;
          margin-bottom: 0px;
          font-size: 20px;
          font-family: Arial, sans-serif;
        }
    
        .container form input[type="text"],
        .container form input[type="email"],
        .container form input[type="date"],
        .container form input[type="password"],
        .container form textarea,
        .container form select {
          padding: 5px;
          border: 1px solid #dddddd;
          border-radius: 3px;
          margin-bottom: -10px;
          width: 100%;
          box-sizing: border-box;
          font-size: 20px;
          height:24px;
        }
    
        .container form textarea {
          resize: none;
          height: 80px;
        }
    
        .botoes {
          text-align: right; /* Alinhar os botões à direita */
        }

        .botoes a, .botoes button {
          font-family: Arial, sans-serif;
          text-decoration: none;
          color: #000;
          padding: 4px 6px;
          margin-top: 10px;
          margin-right: 10px;
          background-color: #ddd;
          border-radius: 5px;
          font-size: 20px;
          border: 2px solid #333;
        }

        .botoes a:hover, .botoes button:hover {
          background-color: rgb(177, 177, 177);
        }

        /* Estilos para a divisão de colunas ... */
        .div1 {
          width: 100%;
          text-align: center;
          display: inline-block;
          padding: 10px;
          box-sizing: border-box;
        }

        #btnlogin {
            margin-left: 2%;
            font-size: 20px;
            color: white;
            font-family: Arial, sans-serif;
        }
        #titulo {
          font-size:25px;
          font-family:arial, sans-serif;
          color:white;
          text-align:center;
          margin-top:0px;
          margin-bottom:-15px;
        }
        #pcad {
          font-size:20px;
          font-family:arial, sans-serif;
          color:white;
          text-align:left ;
          margin-left:13px;
          margin-top: 15px;
          margin-bottom:10px;
        }

  </style>
</head>
  <div id="header">
        <div id="logo">SIGEST</div>
    </div>
<body>
   <!-- Cabeçalho da página ... -->

  <!-- Conteúdo principal -->
  <div class="container">
    <p id="titulo">CADASTRO DE USUÁRIO</p>
    <form method="POST" action="processaUsuarios.php">
      <div class="div1">
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" placeholder="" required>
      </div>

      <div class="div1">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="" required>
      </div>

      <div>
        <p id="pcad">Já tem cadastro?</p>
        <a id="btnlogin" href="login.php">Login</a>
      </div>

      <div class="botoes">
        <button id="entrar" type="submit">cadastrar</button>
      </div>
    </form>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
    var senhaInput = document.getElementById("senha");

    senhaInput.addEventListener("input", function () {
        var senha = senhaInput.value;
        var senhaSemEspacos = senha.replace(/\s/g, ''); // Remove espaços em branco

        if (senhaSemEspacos.length >= 8) {
            senhaInput.setCustomValidity(''); // Senha válida
        } else {
            senhaInput.setCustomValidity('A senha deve conter pelo menos 8 caracteres não espaços em branco.');
        }
    });
});
  </script>
</body>
</html>