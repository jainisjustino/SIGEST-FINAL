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

 

    $query = "SELECT * FROM pacientes WHERE id = $paciente_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $paciente = mysqli_fetch_assoc($result);
    } else {
        
    }
} else {
   
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>SIGEST</title>
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

        .h3inferiores{
            text-align: center;
            font-size: 25px;
            font-family: Arial, sans-serif;
            color: white;
            margin-top: 50px;
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

        .container h3 {
            text-align: center;
            font-size: 20px;
            font-family: Arial, sans-serif;
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
          font-size: 140%;
          font-family: Arial, sans-serif;
        }
    
        .container form input[type="text"],
        .container form input[type="email"],
        .container form input[type="date"],
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
          height: 80px;
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
          width: 43%;
          text-align: center;
          display: inline-block;
          padding: 10px;
          box-sizing: border-box;
        }

        .div2 {
          width: 17%;
          text-align: center;
          display: inline-block;
          padding: 10px;
          box-sizing: border-box;
        }

        .div3 {
          width: 21%;
          text-align: center;
          display: inline-block;
          padding: 10px;
          box-sizing: border-box;
        }

        .div4 {
            width: 20%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }

          .div5 {
            width: 18%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }

          .div6 {
            width: 99%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }

          .div7 {
            width: 61%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }

          .div8 {
            width: 99%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }

          .div9 {
            width: 49%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }

          .div10 {
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
            <a href="#">Agenda</a>
            <a href="listagemProntuarios.php">Prontuários</a>
            <a href="#">Relatório</a>
            <a href="cadPacientes.php">Cadastro de pacientes</a>
        </div>
        <div id="menu2">
            <a href="">Sair</a>
        </div>
    </div>
<body>
   <!-- Cabeçalho da página ... -->

  <!-- Conteúdo principal -->
  <div class="container">

    <h2>PRONTUARIO DO PACIENTE</h2>
    <h3>DADOS GERAIS</h3>

    <form  method="POST" action="processaUpdate.php?id=<?php echo $paciente_id; ?>">

      <div class="div1">
        <label for="nome">Nome completo:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $paciente['nome']; ?>">
      </div>

      <div class="div2">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?php echo $paciente['cpf']; ?>">
      </div>

      <div class="div2">
        <label for="rg">RG:</label>
        <input type="text" id="rg" name="rg" value="<?php echo $paciente['rg']; ?>">
      </div>

      <div class="div3">
        <label for="dn">Data de nascimento:</label>
        <input type="date" id="dn" name="dn" value="<?php echo $paciente['dn']; ?>">
      </div>

      <div class="div4">
        <label for="sexo">Sexo:</label>
        <input type="text" id="sexo" name="sexo" value="<?php echo $paciente['sexo']; ?>">
      </div>

      <div class="div7">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $paciente['email']; ?>">
      </div>

      <div class="div2">
        <label for="fone">Telefone:</label>
        <input type="text" id="fone" name="fone" value="<?php echo $paciente['fone']; ?>">
      </div>

      <div class="div6">
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo $paciente['endereco']; ?>">
      </div>
      <div class="div8">
        <label for="informacaoComplementar">Informação complementar:</label>
        <input type="text" id="informacaoComplementar" name="informacaoComplementar" value="<?php echo $paciente['informacaoComplementar']; ?>">
      </div>

      <h3 class="h3inferiores">ANAMNESE</h3>

      <div class="div9">
        <label for="medicacoesUtilizadas">Medicações utilizadas:</label>
        <input type="text" id="medicacoesUtilizadas" name="medicacoesUtilizadas" value="<?php echo $paciente['medicacoesUtilizadas']; ?>">
      </div>

      <div class="div10">
        <label for="alergiasReacoes">Alergias e/ou reações:</label>
        <input type="text" id="alergiasReacoes" name="alergiasReacoes" value="<?php echo $paciente['alergiasReacoes']; ?>">
      </div>

      <div class="div9">
        <label for="doencaPreExistente">Doenças pré-existentes:</label>
        <input type="text" id="doencaPreExistente" name="doencaPreExistente" value="<?php echo $paciente['doencaPreExistente']; ?>">
      </div>

      <div class="div10">
        <label for="historicoFamiliar">Histórico familiar:</label>
        <input type="text" id="historicoFamiliar" name="historicoFamiliar" value="<?php echo $paciente['historicoFamiliar']; ?>">
      </div>

      <div class="div9">
        <label for="habitos">Hábitos:</label>
        <input type="text" id="habitos" name="habitos" value="<?php echo $paciente['habitos']; ?>">
      </div>

      <div class="div10">
        <label for="experienciaOdontologicaAnterior">Experiências odontológicas anteriores:</label>
        <input type="text" id="experienciaOdontologicaAnterior" name="experienciaOdontologicaAnterior" value="<?php echo $paciente['experienciaOdontologicaAnterior']; ?>">
      </div>

      <div class="botoes">
        <a id="voltar" href="">Cancelar</a>
        <button id="salvar" type="submit">Salvar</button>
      </div>
    </form>
  </div>
</body>
</html>
