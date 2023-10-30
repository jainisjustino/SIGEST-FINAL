<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: paginaInicial.php');
    exit;
}   


$host = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$nome_bd = "test";

$conn = mysqli_connect($host, $usuario_bd, $senha_bd, $nome_bd);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Perfil</title>
  <style>
   body {
            margin-left: 0px;
            margin-top: 0px;
            margin-right: 0px;
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
            max-width: 50%;
            margin: 0 auto;
            margin-top: 20px;
            padding: 20px;
            background-color: #900603;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilização das labels */
        label {
            display: block;
            text-align: left;
            font-size: 140%;
            font-family: Arial, sans-serif;
            color: white;
            margin-bottom: 10px; /* Aumentei o margin-bottom para separar um pouco mais as labels dos campos de entrada */
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

        .container input[type="text"],
        .container input[type="password"] {
            padding: 5px;
            border: 1px solid #dddddd;
            border-radius: 3px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            font-size: 20px;
            height:24px;
        }

        .container form textarea {
            resize: none;
            height: 80px;
        }

        /* Botões alinhados à direita */
        .botoes {
          justify-content: flex-end;
          display:flex;
        }

        .botoes a, .botoes button {
            font-family: Arial, sans-serif;
            text-decoration: none;
            color: #000;
            padding:4px 6px;
            margin-top: 10px;
            margin-right: 0px;
            margin-left:3px;
            background-color: #ddd;
            border-radius: 5px;
            font-size: 20px;
            border:2px solid #333;
            
        }

        .botoes a:hover, .botoes button:hover {
            background-color: rgb(177, 177, 177);
        }

        /* Estilização das labels */
        label {
            text-align: left;
            margin-bottom: 0px;
            font-size: 20px ;
            font-family: Arial, sans-serif; /* Aumentei o margin-bottom para separar um pouco mais as labels dos campos de entrada */
        }

        .container h2 {
            text-align: center;
            font-size: 30px;
            font-family: Arial, sans-serif;
            color: white;
            margin-bottom: 15px;
        }
        #btnexcluir {
            margin-top:-10px;
        }
        #titulo {
            font-size:25px;
          font-family:arial, sans-serif;
          color:white;
          text-align:center;
          margin-top:0px;
          margin-bottom:-10px;
        }
        #menu2 .btnpg {
            background-color:#b22222;
        }
  </style>
</head>
<body>
<div id="header">
        <a href="index.php" id="logo">SIGEST</a>
        <div id="menu1">
        <a href="agenda.php">Agenda</a>
        <a href="cadPacientes.php">Cadastro de pacientes</a>
        <a href="listagemProntuarios.php">Prontuários</a>
        </div>
        <div id="menu2">
            <a class="btnpg" href="perfil.php">Perfil</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>
<div class="container">
  <p id="titulo">PERFIL</p>
  <form method="POST" action="processaPerfil.php">
      <div class="div1">
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" value="<?php echo $_SESSION['nomeUsuario']; ?>" required>
      </div>

      <div class="div1">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" value="<?php echo $_SESSION['senhaUsuario']; ?>">
      </div>

      <div class="botoes">
        <button type="submit">Salvar</button>
    </form>
    <form method="POST" action="processaExcluirUsuario.php">
        <button id="btnexcluir" type="submit">Excluir conta</button>
    </form>
    </div>
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
