<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
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

$tratamentos = array(); // Inicialize um array para armazenar todos os tratamentos

if (isset($_GET['id'])) {
    $paciente_id = $_GET['id'];
    $query_pacientes = "SELECT * FROM pacientes WHERE id = $paciente_id";
    $result_pacientes = mysqli_query($conn, $query_pacientes);

    if (mysqli_num_rows($result_pacientes) > 0) {
        $paciente = mysqli_fetch_assoc($result_pacientes);

        // Consulta usando INNER JOIN para obter informações de tratamento para o paciente
        $query_tratamento = "SELECT tratamento.*, pacientes.nome AS nome
                             FROM tratamento
                             INNER JOIN pacientes ON tratamento.paciente_id = pacientes.id
                             WHERE tratamento.paciente_id = $paciente_id";

        $result_tratamento = mysqli_query($conn, $query_tratamento);

        if (mysqli_num_rows($result_tratamento) > 0) {
            // Loop para obter todos os registros de tratamento
            while ($row = mysqli_fetch_assoc($result_tratamento)) {
                $tratamentos[] = $row;
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['data']) && is_array($_POST['data'])) {
        $data = $_POST['data'];
        $tratamentoRealizado = $_POST['tratamentoRealizado'];
        $dente = $_POST['dente'];
        $formaPagamento = $_POST['formaPagamento'];
        $saldo = $_POST['saldo'];

        // Remove tratamentos existentes para o paciente
        $deleteQuery = "DELETE FROM tratamento WHERE paciente_id = $paciente_id";
        mysqli_query($conn, $deleteQuery);

        // Insere ou atualiza os tratamentos no banco de dados
        foreach ($data as $i => $tratamento_data) {
            $tratamento_realizado = $tratamentoRealizado[$i];
            $dente_tratamento = $dente[$i];
            $forma_pagamento = $formaPagamento[$i];
            $saldo_tratamento = $saldo[$i];

            $insertQuery = "INSERT INTO tratamento (paciente_id, data, tratamentoRealizado, dente, formaPagamento, saldo)
                            VALUES ($paciente_id, '$tratamento_data', '$tratamento_realizado', '$dente_tratamento', '$forma_pagamento', '$saldo_tratamento')";

            mysqli_query($conn, $insertQuery);
        }
    }

    // Resto do seu código para atualizar as informações do paciente ...
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Prontuário</title>
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
          margin-top: 20px;
          padding: 15px;
          
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
          margin-top: 0px;
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
        .container form input[type="number"],
        .container form select {
          padding: 5px;
          border: 0px;
          border-radius: 3px;
          margin-bottom: -10px;
          width: 100%;
          box-sizing: border-box;
          font-size: 20px;
          height:24px;
        }
        .container form textarea {
          resize:none;
          padding-top:1px;
          padding-left: 5px;
          border: 0px;
          border-radius: 3px;
          margin-bottom: -10px;
          width: 100%;
          box-sizing: border-box;
          font-size: 20px;
          font-family:arial,sans-serif;
          height:70px;
        }
    
        .botoes {
          justify-content:right;
          display: flex;
        }

        .botoes a, .botoes button {
          font-family: Arial, sans-serif;
          text-decoration: none;
          color: #000;
          padding: 4px 6px;
          margin-top: 10px;
          margin-right: 15px;
          background-color: #ddd;
          border-radius: 5px;
          font-size: 20px;
          border:2px solid #333;
          height:35;
        }
        .botoes .btnrelatorio {
            margin-top:10px;
            font-size:20px;
            height:23px;
            border-radius:5px;
            border:2px solid #333;
          }

        .botoes a:hover, .botoes button:hover {
          background-color: rgb(177, 177, 177);
        }

        /* Estilos para a divisão de colunas ... */
              .div1 {
          width: 54%;
          text-align: center;
          display: inline-block;
          padding: 10px;
          box-sizing: border-box;
        }

        .div2 {
          width: 14%;
          text-align: center;
          display: inline-block;
          padding: 10px;
          box-sizing: border-box;
        }

        .div3 {
          width: 16%;
          text-align: center;
          display: inline-block;
          padding: 10px;
          box-sizing: border-box;
        }

        .div4 {
            width: 13%;
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
            width: 71%;
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
          .div11 {
            width: 12%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }
          .div12 {
            width: 16%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }
          .div13 {
            width: 42%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }
          .div14 {
            width: 7%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }
          .div15 {
            width: 18%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }
          .div16 {
            width: 15%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }
         
          input[type="number"]::-webkit-outer-spin-button,
          input[type="number"]::-webkit-inner-spin-button {
          -webkit-appearance: none;
          appearance: none;
          margin: 0;
          }
          #menu1 .btnpg {
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
        <a class="btnpg" href="listagemProntuarios.php">Prontuários</a>
        </div>
        <div id="menu2">
        <a href="perfil.php">Perfil</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>
  <div class="container">
    <form  method="POST" action="novoprocessaUpdate.php?id=<?php echo $paciente_id; ?>" onsubmit="return confirm('Deseja editar esses dados?');">
      <div class="div1">
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" value="<?php echo $paciente['nome']; ?>">
      </div>
      
      <div class="div2">
        <label for="cpf">CPF</label>
        <input type="number" id="cpf" name="cpf" value="<?php echo $paciente['cpf']; ?>">
      </div>

      <div class="div2">
        <label for="rg">RG</label>
        <input type="number" id="rg" name="rg" value="<?php echo $paciente['rg']; ?>">
      </div>

      <div class="div3">
        <label for="dn">Data nascimento</label>
        <input type="date" id="dn" name="dn" value="<?php echo $paciente['dn']; ?>">
      </div>

      <div class="div4">
        <label for="sexo">Sexo</label>
        <input type="text" id="sexo" name="sexo" value="<?php echo $paciente['sexo']; ?>">
      </div>

      <div class="div7">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $paciente['email']; ?>">
      </div>

      <div class="div2">
        <label for="fone">Telefone</label>
        <input type="number" id="fone" name="fone" value="<?php echo $paciente['fone']; ?>">
      </div>

      <div class="div6">
        <label for="endereco">Endereço</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo $paciente['endereco']; ?>">
      </div>
      <div class="div8">
        <label for="informacaoComplementar">Informação complementar</label>
        <input type="text" id="informacaoComplementar" name="informacaoComplementar" value="<?php echo $paciente['informacaoComplementar']; ?>">
      </div>
      
      <div class="div9">
        <label for="medicacoesUtilizadas">Medicações utilizadas</label>
        <input type="text" id="medicacoesUtilizadas" name="medicacoesUtilizadas" value="<?php echo $paciente['medicacoesUtilizadas']; ?>">
      </div>

      <div class="div10">
        <label for="alergiasReacoes">Alergias e/ou reações</label>
        <input type="text" id="alergiasReacoes" name="alergiasReacoes" value="<?php echo $paciente['alergiasReacoes']; ?>">
      </div>

      <div class="div9">
        <label for="doencaPreExistente">Doenças pré-existentes</label>
        <input type="text" id="doencaPreExistente" name="doencaPreExistente" value="<?php echo $paciente['doencaPreExistente']; ?>">
      </div>

      <div class="div10">
        <label for="historicoFamiliar">Histórico familiar</label>
        <input type="text" id="historicoFamiliar" name="historicoFamiliar" value="<?php echo $paciente['historicoFamiliar']; ?>">
      </div>

      <div class="div9">
        <label for="habitos">Hábitos</label>
        <input type="text" id="habitos" name="habitos" value="<?php echo $paciente['habitos']; ?>">
      </div>

      <div class="div10">
        <label for="experienciaOdontologicaAnterior">Experiências odontológicas anteriores</label>
        <input type="text" id="experienciaOdontologicaAnterior" name="experienciaOdontologicaAnterior" value="<?php echo $paciente['experienciaOdontologicaAnterior']; ?>">
      </div>
    
      <div class="div8">
          <label for="avaliacao">Avaliação</label>
          <textarea id="avaliacao" name="avaliacao"><?php echo isset($tratamentos[0]['avaliacao']) ? $tratamentos[0]['avaliacao'] : ''; ?></textarea>
        </div>
      <div class="tratamentos">
        <?php foreach ($tratamentos as $i => $tratamento) { ?>
            <div class="tratamento">
                <div class="div12">
                    <label for="data_<?php echo $i; ?>">Data</label>
                    <input type="date" id="data_<?php echo $i; ?>" name="data[]" value="<?php echo $tratamento['data']; ?>">
                </div>
                <div class="div13">
                    <label for="tratamentoRealizado_<?php echo $i; ?>">Tratamento realizado</label>
                    <input type="text" id="tratamentoRealizado_<?php echo $i; ?>" name="tratamentoRealizado[]" value="<?php echo $tratamento['tratamentoRealizado']; ?>">
                </div>
                <div class="div14">
                    <label for="dente_<?php echo $i; ?>">Dente</label>
                    <input type="number" id="dente_<?php echo $i; ?>" name="dente[]" value="<?php echo $tratamento['dente']; ?>">
                </div>
                <div class="div15">
                    <label for="formaPagamento_<?php echo $i; ?>">Forma pagamento</label>
                    <input type="text" id="formaPagamento_<?php echo $i; ?>" name="formaPagamento[]" value="<?php echo $tratamento['formaPagamento']; ?>">
                </div>
                <div class="div16"> 
                    <label for="saldo_<?php echo $i; ?>">Saldo</label>
                    <input type="text" id="saldo_<?php echo $i; ?>" name="saldo[]" value="<?php echo $tratamento['saldo']; ?>">
                    <!-- Adicione um campo oculto para armazenar o ID do tratamento -->
                    <input type="hidden" name="tratamento_ids[]" value="<?php echo $tratamento['id']; ?>">
                </div>
            </div>
        <?php } ?>
      </div>
      <div class="botoes">
        <button class="botoes" id="salvar" type="submit">Salvar</button>
    </form>
    <a href="relatorio.php?id=<?php echo $paciente_id; ?>" class="btnrelatorio">Relatório</a>
    <form method="POST" action="processaExcluirPaciente.php" onsubmit="return confirm('Deseja excluir esse prontuário?');">
      <input type="hidden" name="id" value="<?php echo $paciente_id; ?>">
      <button class="botoes" type="submit" name="confirmar" value="Confirmar">Excluir</button>
      </div>

    </form>
  </div>
  
  <script>
    function adicionarTratamento() {
      const tratamentosContainer = document.querySelector(".container form");
      const novoTratamento = document.querySelector(".tratamento").cloneNode(true);

      // Limpe os valores dos campos do novo tratamento
      const inputs = novoTratamento.querySelectorAll("input[type='text'], input[type='date'], input[type='number']");
      inputs.forEach(input => input.value = "");

      tratamentosContainer.insertBefore(novoTratamento, tratamentosContainer.lastElementChild);
    }

    function removerTratamento(button) {
      const tratamento = button.parentElement;
      const tratamentosContainer = document.querySelector(".container form");
      tratamento.remove();
    }
  </script>
</body>
</html>
