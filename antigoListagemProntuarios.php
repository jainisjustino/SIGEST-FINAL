<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}   
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Prontuários</title>
  <style>
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
        h3 {
          color
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
          margin-left: auto;
        }

        .container {
          max-width: 33%;
          margin: 0 auto;
          margin-top: 20px;
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
          text-align: left;
          margin-bottom: 0px;
          font-size: 140%;
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
          border-radius: 3px;
          margin-bottom: -10px;
          width: 100%;
          box-sizing: border-box;
          font-size: 130%;
          height:33px;
        }
    
        .container form textarea {
          resize: none;
          height:35px;
          width: 100%;
        }
    
        button a, button button {
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

        button a:hover, button button:hover {
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
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 0px solid #ddd;
            color: white;
        }

        th {
            background-color: #900603;
            text-align: left;
          margin-bottom: 0px;
          font-size: 140%;
          font-family: Arial, sans-serif;
          color: white;
        }
        .rpesquisa {
          text-align: left;
          margin-bottom: -10px;
          margin-top:10px;
          margin-left:0px;
          font-size: 140%;
          font-family: Arial, sans-serif;
          color: white;
        }
        #btnbuscar {
          margin-top:20px;
          margin-left:375px;
        }
        .btnpacientes {
         font-size: 20px;
    color: white;
    text-decoration: none;
    font-family: Arial, sans-serif;
    padding: 10px 20px;
    margin-top: 10px;
    margin-right: 10px;
    margin-bottom:0px;
    border-radius: 5px;
    font-size: 20px;
        }

        #thnomes {
          margin-left:0px;
        }
        #titulo {
          font-size:25px;
          font-family:arial, sans-serif;
          color:white;
          text-align:center;
          margin-top:0px;
          margin-bottom:-10px;
        }

  </style>
</head>

<?php
$host = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$nome_bd = "test";

$conn = mysqli_connect($host, $usuario_bd, $senha_bd, $nome_bd);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Verificar se houve uma pesquisa
if (isset($_POST['busca'])) {
    $termo_busca = $_POST['busca'];

    // Consulta SQL para buscar pacientes
    $query = "SELECT * FROM pacientes WHERE nome LIKE '%$termo_busca%'";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Prontuários</title>
    <style>
        /* Seus estilos (mantidos) ... */
    </style>
</head>
<body>
<div id="header">
        <a href="index.php" id="logo">SIGEST</a>
        <div id="menu1">
            <a href="agenda.php">Agenda</a>
            <a href="#">Relatório</a>
            <a href="cadPacientes.php">Cadastro de pacientes</a>
        </div>
        <div id="menu2">
        <a href="perfil.php">Perfil</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>

  <div class="container">
    <p id="titulo">PRONTUÁRIOS</p>

    <form  class="buscar" method="post">
        <label for="busca">Buscar Paciente</label>
        <input type="text" id="busca" name="busca">
        <button id="btnbuscar" type="submit">Buscar</button>
    </form>
    <p class="rpesquisa">Pacientes:</p>
    <?php if (isset($result) && mysqli_num_rows($result) > 0) { ?>
        
        <table>
            
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><a class="btnpacientes" href="fichaPaciente.php?id=<?php echo $row['id']; ?>"><?php echo $row['nome']; ?></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } elseif (isset($result)) { ?>
        <p class="rpesquisa">Nenhum paciente encontrado.</p>
    <?php } ?>
</div>

</body>
</html>
