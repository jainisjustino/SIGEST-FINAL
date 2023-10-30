<?php
$host = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$nome_bd = "test";

$conn = mysqli_connect($host, $usuario_bd, $senha_bd, $nome_bd);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $paciente_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Atualizar os dados do paciente no banco de dados
        $novo_nome = $_POST['nome'];
        $novo_email = $_POST['email'];

        $update_query = "UPDATE pacientes SET nome = '$novo_nome', email = '$novo_email' WHERE id = $paciente_id";
        mysqli_query($conn, $update_query);
    }

    $query = "SELECT * FROM pacientes WHERE id = $paciente_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $paciente = mysqli_fetch_assoc($result);
    } else {
        header("Location: listagem_pacientes.php");
        exit();
    }
} else {
    header("Location: listagem_pacientes.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Ficha do Paciente</title>
    <!-- Seus estilos ... -->
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
          padding: 20px;
          display: flex;
          align-items: center;
        }
        
        #logo {
          color: white;
          font-family: Arial, Helvetica, sans-serif;
          font-size: 40px;
          font-weight: bold;
          margin-right: 50px;
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
          margin-left: auto;
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
    
        button {
          text-align: right; /* Alinhar os botões à direita */
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
        }

  </style>
</head>
<body>
<div id="header">
        <div id="logo">SIGEST</div>
        <div id="menu1">
            <a href="#">Agenda</a>
            <a href="#">Relatório</a>
            <a href="cadPacientes.php">Cadastro de pacientes</a>
        </div>
        <div id="menu2">
            <a href="">Sair</a>
        </div>
    </div>

<div class="container">
    <h2>Ficha do Paciente</h2>

    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $paciente['nome']; ?>">

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?php echo $paciente['cpf']; ?>">

        <label for="rg">RG:</label>
        <input type="text" id="rg" name="rg" value="<?php echo $paciente['rg']; ?>">

        <label for="dn">Data de nascimento:</label>
        <input type="date" id="dn" name="dn" value="<?php echo $paciente['dn']; ?>">

        <label for="sexo">Sexo:</label>
        <input type="text" id="sexo" name="sexo" value="<?php echo $paciente['sexo']; ?>">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $paciente['email']; ?>">
        
        <label for="fone">Telefone:</label>
        <input type="text" id="fone" name="fone" value="<?php echo $paciente['fone']; ?>">

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo $paciente['endereco']; ?>">

        <label for="informacaoComplementar">Informação complementar:</label>
        <input type="text" id="informacaoComplementar" name="informacaoComplementar" value="<?php echo $paciente['informacaoComplementar']; ?>">

        <label for="medicacoesUtilizadas">Medicações utilizadas:</label>
        <input type="text" id="medicacoesUtilizadas" name="medicacoesUtilizadas" value="<?php echo $paciente['medicacoesUtilizadas']; ?>">

        <label for="alergiasReacoes">Alergias e/ou Reações:</label>
        <input type="text" id="alergiasReacoes" name="alergiasReacoes" value="<?php echo $paciente['alergiasReacoes']; ?>">

        <label for="doencaPreExistente">Doenças pré-existentes:</label>
        <input type="text" id="doencaPreExistente" name="doencaPreExistente" value="<?php echo $paciente['doencaPreExistente']; ?>">

        <label for="historicoFamiliar">Histórico familiar:</label>
        <input type="text" id="historicoFamiliar" name="historicoFamiliar" value="<?php echo $paciente['historicoFamiliar']; ?>">

        <label for="habitos">Hábitos:</label>
        <input type="text" id="habitos" name="habitos" value="<?php echo $paciente['habitos']; ?>">

        <label for="experienciaOdontologicaAnterior">Experiências odontológicas anteriores:</label>
        <input type="text" id="experienciaOdontologicaAnterior" name="experienciaOdontologicaAnterior" value="<?php echo $paciente['experienciaOdontologicaAnterior']; ?>">

        <button type="submit">Salvar</button>
    </form>
</div>

</body>
</html>
