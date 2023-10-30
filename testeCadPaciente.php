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
  <title>Cadastro de pacientes</title>
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
          text-decoration:none;
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
          border-radius: 3px;
          margin-bottom: -10px;
          width: 100%;
          box-sizing: border-box;
          font-size: 130%;
          height: 33px;
        }
    
        .container form textarea {
          resize: none;
          height: 60px;
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
          .div11 {
            width: 12%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }
          .div12 {
            width: 13%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }
          .div13 {
            width: 44%;
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
            width: 21%;
            text-align: center;
            display: inline-block;
            padding: 10px;
            box-sizing: border-box;
          }

  </style>
</head>
  <div id="header">
        <a href="index.php" id="logo">SIGEST</a>
        <div id="menu1">
            <a href="agenda.php">Agenda</a>
            <a href="listagemProntuarios.php">Prontuários</a>
            <a href="#">Relatório</a>
        </div>
        <div id="menu2">
        <a href="perfil.php">Perfil</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>
<body>
   <!-- Cabeçalho da página ... -->

  <!-- Conteúdo principal -->
  <div class="container">

    <h2>CADASTRO DE PACIENTES</h2>
    <h3 class="h3inferiores">DADOS GERAIS</h3>

    <form  method="POST" action="processaPacientes.php">

      <div class="div1">
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" placeholder="" required>
      </div>

      <div class="div2">
        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name="cpf" placeholder="" required>
      </div>

      <div class="div2">
        <label for="rg">RG</label>
        <input type="text" id="rg" name="rg" placeholder="" required>
      </div>

      <div class="div3">
        <label for="dn">Data de nascimento</label>
        <input type="date" id="dn" name="dn" placeholder="" required>
      </div>

      <div class="div4">
        <label for="sexo">Sexo</label>
        <input type="text" id="sexo" name="sexo" placeholder="" required>
        </select>
      </div>

      <div class="div7">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="" required>
      </div>

      <div class="div2">
        <label for="fone">Telefone</label>
        <input type="text" id="fone" name="fone" placeholder="" required>
      </div>

      <div class="div6">
        <label for="endereco">Endereço</label>
        <input type="text" id="endereco" name="endereco" placeholder="" required>
      </div>
      <div class="div8">
        <label for="informacaoComplementar">Informação complementar</label>
        <textarea type="text" id="informacaoComplementar" name="informacaoComplementar" placeholder="" ></textarea>
      </div>

      <h3 class="h3inferiores">ANAMNESE</h3>

      <div class="div9">
        <label for="medicacoesUtilizadas">Medicações utilizadas</label>
        <textarea type="text" id="medicacoesUtilizadas" name="medicacoesUtilizadas" placeholder="" ></textarea>
      </div>

      <div class="div10">
        <label for="alergiasReacoes">Alergias e/ou reações</label>
        <textarea type="text" id="alergiasReacoes" name="alergiasReacoes" placeholder="" ></textarea>
      </div>

      <div class="div9">
        <label for="doencaPreExistente">Doenças pré-existentes</label>
        <textarea type="text" id="doencaPreExistente" name="doencaPreExistente" placeholder="" ></textarea>
      </div>

      <div class="div10">
        <label for="historicoFamiliar">Histórico familiar</label>
        <textarea type="text" id="historicoFamiliar" name="historicoFamiliar" placeholder="" ></textarea>
      </div>

      <div class="div9">
        <label for="habitos">Hábitos</label>
        <textarea type="text" id="habitos" name="habitos" placeholder="" ></textarea>
      </div>

      <div class="div10">
        <label for="experienciaOdontologicaAnterior">Experiências odontológicas anteriores</label>
        <textarea type="text" id="experienciaOdontologicaAnterior" name="experienciaOdontologicaAnterior" placeholder="" ></textarea>
      </div>

      <h3 class="h3inferiores">TRATAMENTO</h3>

      <div class="div8">
        <label for="avaliacao">Avaliação</label>
        <textarea type="text" id="avaliacao" name="avaliacao" placeholder="" ></textarea>
      </div>

      <div class="div12">
        <label for="data">Data</label>
        <textarea type="date" id="data" name="data" placeholder="" ></textarea>
      </div>

      <div class="div13">
        <label for="tratamentoRealizado">Tratamento realizado</label>
        <textarea type="text" id="tratamentoRealizado" name="tratamentoRealizado" placeholder="" ></textarea>
      </div>

      <div class="div14">
        <label for="dente">Dente</label>
        <textarea type="text" id="dente" name="dente" placeholder="" ></textarea>
      </div>

      <div class="div15">
        <label for="formaPagamento">Forma de pagamento</label>
        <textarea type="text" id="formaPagamento" name="formaPagamento" placeholder="" ></textarea>
      </div>

      <div class="div12">
        <label for="saldo">Saldo</label>
        <textarea type="text" id="saldo" name="saldo" placeholder="" ></textarea>
      </div>

      <div class="div10">
        <label for="documento">Exames</label>
        <input type="file" name="documento" id="documento">
      </div>

      <div class="botoes">
        <button id="salvar" type="submit">Salvar</button>
      </div>
    </form>
  </div>
</body>
</html>
