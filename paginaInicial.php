<?php
$mensagem = "Usuário ou senha incorreto!";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $query = "SELECT * FROM usuarios WHERE nome='$nome' AND senha='$senha'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
    session_start();
    
    $row = mysqli_fetch_assoc($result);
    $_SESSION['idUsuario'] = $row['id'];
    
    $_SESSION['logged_in'] = true;
    $_SESSION['nomeUsuario'] = $nome;
    $_SESSION['senhaUsuario'] = $senha;
     
        header("Location: index.php");
    exit;
    } else {
      echo "<script>alert('$mensagem');</script>";
    }
    
    mysqli_close($conn);
}
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Login</title>
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

        .container {
            text-align:center;
          max-width: 30%;
          margin: 0 auto;
          margin-top: 30px;
          padding-bottom:30px;
          padding-top: 20px;
          background-color: #900603;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    
        .container h3 {
          text-align: center;
          font-size: 20px;
          font-family: Arial, sans-serif, italic;
          color: white;
        }

        .container p {
          text-align: center;
          font-size: 20px;
          margin-bottom: 15px;
          font-family: Arial, sans-serif, italic;
          color: white;
        }
    
        #subtitulo {
          font-size:25px;
          font-family:arial, sans-serif;
          color:white;
          text-align:center;
          margin-top:0px;
          margin-bottom:-15px;
        }
        .btns {
            font-size:20px;
            font-family:arial, sans-serif;
            padding:8px 12px;
            border-radius:10px;
            text-decoration:none;
            color:black;
            background-color:white;
        }
        .div0 {
            padding-bottom:25px;
            margin-right:70px;
            margin-left:70px;
            margin-top:60px;
            border:0px solid white;
            border-radius:5px;
        }
        .div00 {

            padding-bottom:25px;
            margin-right:70px;
            margin-left:70px;
            margin-top:25px;
            border:0px solid white;
            border-radius:5px;
        }

  </style>
</head>
  <div id="header">
        <div id="logo">SIGEST</div>
    </div>
<body>
  <div class="container">
    <p id="subtitulo">Bem-vindo ao SIGEST</p>
    <div class="div0">
        <p>Já tenho cadastro</p>
        <a href="login.php" class="btns">Login</a>
    </div>
    <div class="div00">
        <p>Gostaria de me cadastrar</p>
        <a href="cadUsuarios.php" class="btns" >Cadastrar-me</a>
    </div>
  </div>
</body>
</html>