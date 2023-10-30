<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: paginaInicial.php');
    exit;
}   
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Início</title>
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
          background-color: #b22222;
        }

         #menu2 a:hover {
          background-color: #b22222;
        }

        #menu2 {
          margin-left: auto;
        }

        .container {
          max-width: 90%;
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
    
        .container form {
          margin-top: 20px;
          color: white;
        }
    
        .container form label,
        .container form input {
          display:inline-block; /* Para que os campos fiquem em uma linha separada */
          width: 100%; /* Paa ocupar toda a largura da linha */
        }
    
        .container form label {
          text-align: left;
          margin-bottom: 0px;
          font-size: 140%;
          font-family: Arial, sans-serif;
        }
    
        .container form input[type="text"],
        .container form input[type="email"],
        .container form textarea,
        .container form select {
          padding: 10px;
          border: 1px solid #dddddd;
          border-radius: 5px;
          margin-bottom: -10px;
          width: 100%;
          box-sizing: border-box;
          font-size: 130%;
        }
    
        .container form textarea {
          resize: none;
          height:35px;
          width: 100%;
        }
    
        .botoes {
          text-align: right; /* Alinhar os botões à direita */
        }

        .botoes a, .botoes button {
          font-family: Arial, sans-serif;
          text-decoration: none;
          color: #000;
          padding: 10px 20px;
          margin-top: 10px;
          margin-right: 10px;
          background-color: #ddd;
          border-radius: 5px;
          font-size: 20px;
        }

        .botoes a:hover, .botoes button:hover {
          background-color: rgb(177, 177, 177);
        }

        /* Estilos para a divisão de colunas ... */
        .div1 {
          width: 49%;
          text-align: center;
          display: inline-block;
          padding: 10px;
          box-sizing: border-box;
        }
        .div2 {
          width: 50%;
          text-align: center;
          display: inline-block;
          padding: 10px;
          box-sizing: border-box;
        }
  </style>
</head>
  <div id="header">
        <div id="logo">SIGEST</div>
        <div id="menu1">
        <a href="agenda.php">Agenda</a>
        <a href="cadPacientes.php">Cadastro de pacientes</a>
        <a href="listagemProntuarios.php">Prontuários</a>
        </div>
        <div id="menu2">
            <a href="perfil.php">Perfil</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>
<body></body>
      </html>