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
        .container form select,
        .container form textarea {
          padding: 5px;
          border: 0px;
          border-radius: 3px;
          margin-bottom: -10px;
          width: 100%;
          box-sizing: border-box;
          font-size: 20px;
          height: 24px;
        }

        .container form select {
          padding: 0px;
          border: 1px solid #dddddd;
          border-radius: 3px;
          margin-bottom: -10px;
          width: 100%;
          box-sizing: border-box;
          font-size: 20px;
          height: 24px;
        }

        .container form textarea {
          resize: none;
          height: 24px;
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
          margin-right: 15px;
          background-color: #ddd;
          border-radius: 5px;
          font-size: 20px;
          border: 2px solid #333;
          width:auto;
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
            vertical-align:top;
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
            margin-top:-10px;
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
        #menu1 .btnpg {
            background-color:#b22222;
          }
          input[type="number"]::-webkit-outer-spin-button,
          input[type="number"]::-webkit-inner-spin-button {
          -webkit-appearance: none;
          appearance: none;
          margin: 0;
          }
         
  </style>
</head>
  <div id="header">
        <a href="index.php" id="logo">SIGEST</a>
        <div id="menu1">
        <a href="agenda.php">Agenda</a>
        <a class="btnpg" href="cadPacientes.php">Cadastro de pacientes</a>
        <a href="listagemProntuarios.php">Prontuários</a>
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

    <form  method="POST" action="AProcessaPaciente.php" onsubmit="return confirm('Deseja cadastrar esse paciente?')">

      <div class="div1">
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" placeholder="" required>
      </div>

      <div class="div2">
        <label for="cpf">CPF</label>
        <input type="number" id="cpf" name="cpf" placeholder="" required>
      </div>

      <div class="div2">
        <label for="rg">RG</label>
        <input type="number" id="rg" name="rg" placeholder="" required>
      </div>

      <div class="div3">
        <label for="dn">Data nascimento</label>
        <input type="date" id="dn" name="dn" placeholder="" required>
      </div>

      <div class="div4">
        <label for="sexo">Sexo</label>
        <select id="sexo" name="sexo">
          <option value="Selecionar">Selecionar</option>
          <option value="Masculino">Masculino</option>
          <option value="Feminino">Feminino</option>
        </select>
      </div>

      <div class="div7">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="" required>
      </div>

      <div class="div2">
        <label for="fone">Telefone</label>
        <input type="number" id="fone" name="fone" placeholder="" required>
      </div>

      <div class="div6">
        <label for="endereco">Endereço</label>
        <input type="text" id="endereco" name="endereco" placeholder="" required>
      </div>

      <div class="div8">
        <label for="informacaoComplementar">Informação complementar</label>
        <input type="text" id="informacaoComplementar" name="informacaoComplementar" placeholder="" ></input>
      </div>

      <div class="div9">
        <label for="medicacoesUtilizadas">Medicações utilizadas</label>
        <input type="text" id="medicacoesUtilizadas" name="medicacoesUtilizadas" placeholder="" ></input>
      </div>

      <div class="div10">
        <label for="alergiasReacoes">Alergias e/ou reações</label>
        <input type="text" id="alergiasReacoes" name="alergiasReacoes" placeholder="" ></input>
      </div>

      <div class="div9">
        <label for="doencaPreExistente">Doenças pré-existentes</label>
        <input type="text" id="doencaPreExistente" name="doencaPreExistente" placeholder="" ></input>
      </div>

      <div class="div10">
        <label for="historicoFamiliar">Histórico familiar</label>
        <input type="text" id="historicoFamiliar" name="historicoFamiliar" placeholder="" ></input>
      </div>

      <div class="div9">
        <label for="habitos">Hábitos</label>
        <input type="text" id="habitos" name="habitos" placeholder="" ></input>
      </div>

      <div class="div10">
        <label for="experienciaOdontologicaAnterior">Experiências odontológicas anteriores</label>
        <input type="text" id="experienciaOdontologicaAnterior" name="experienciaOdontologicaAnterior" placeholder="" ></input>
      </div>
      
      <div class="div8">
        <label for="avaliacao">Avaliação</label>
        <input type="text" id="avaliacao" name="avaliacao" placeholder="" ></input>
      </div>
<div class="tratamentos">
      <div class="div12">
        <label for="data">Data</label>
        <input type="date" id="data" name="data[]" placeholder="" ></input>
      </div>
    
      <div class="div13">
        <label for="tratamentoRealizado">Tratamento realizado</label>
        <input type="text" id="tratamentoRealizado" name="tratamentoRealizado[]" placeholder="" ></input>
      </div>

      <div class="div14">
        <label for="dente">Dente</label>
        <input type="number" id="dente" name="dente[]" placeholder="" ></input>
      </div>

      <div class="div15">
        <label for="formaPagamento">Forma pagamento</label>
        <input type="text" id="formaPagamento" name="formaPagamento[]" placeholder="" ></input>
      </div>

      <div class="div16">
        <label for="saldo">Saldo</label>
        <input type="text" id="saldo" name="saldo[]" placeholder="" ></input>
      </div>
        </div>
      <div class="botoes">
      <button id="adicionar_procedimento" type="button">Adicionar tratamento</button>

        <button id="salvar" type="submit">Salvar</button>
      </div>
    </form>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        document
            .getElementById("adicionar_procedimento")
            .addEventListener("click", function () {
                const procedimentoTemplate = document.querySelector(".tratamentos");
                const clone = procedimentoTemplate.cloneNode(true);

                // Limpe o valor dos campos clonados
                const clonedInputs = clone.querySelectorAll("input[type='text'], input[type='date'], input[type='number'], select");
                clonedInputs.forEach(function (input) {
                    input.value = "";
                });

                // Adicione o clone após o último procedimento
                procedimentoTemplate.parentNode.insertBefore(clone, procedimentoTemplate.nextSibling);
            });

        document.getElementById("salvar").addEventListener("click", function (event) {
            const tratamentoCampos = document.querySelectorAll(".tratamentos");
            let tratamentosValidos = [];

            tratamentoCampos.forEach(function (tratamento) {
                const tratamentoRealizado = tratamento.querySelector("input[type='text']");
                if (tratamentoRealizado.value !== "") {
                    tratamentosValidos.push(tratamento);
                }
            });

            if (tratamentosValidos.length === 0) {
                event.preventDefault(); // Impede o envio do formulário se nenhum tratamento for preenchido
                alert("Preencha pelo menos um tratamento antes de salvar.");
            } else {
                // Remova os tratamentos inválidos (com campos de "Tratamento Realizado" vazios) antes de enviar o formulário
                tratamentoCampos.forEach(function (tratamento) {
                    const tratamentoRealizado = tratamento.querySelector("input[type='text']");
                    if (tratamentoRealizado.value === "") {
                        tratamento.remove(); // Remove o tratamento inválido do DOM
                    }
                });
            }
        });
    });
</script>

</body>
</html>
