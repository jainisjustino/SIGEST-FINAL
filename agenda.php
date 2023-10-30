<?php 
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: paginaInicial.php');
    exit;
}   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
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

        .menu1, .menu2 {
            display: flex;
        }

        .menu1 a, .menu2 a {
            font-family: Arial, sans-serif;
            text-decoration: none;
            color: white;
            padding: 10px;
            margin-right: 10px;
            background-color: #900603;
            border-radius: 5px;
            font-size: 20px;
        }

        .menu1 a:hover {
            background-color: #b22222;
        }

        .menu2 a:hover {
            background-color: #b22222;
        }

        .menu2 {
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

        /* Estilização das labels */
        label {
            display: block;
            text-align: left;
            font-size: 140%;
            font-family: Arial, sans-serif;
            color: white;
            margin-bottom: 10px; /* Aumentei o margin-bottom para separar um pouco mais as labels dos campos de entrada */
        }

        .container form {
            margin-top: 20px;
            color: white;
        }

        .container input[type="text"],
        .container input[type="password"] {
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            font-size: 130%;
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
            margin-top: 10px;
            margin-right: 10px;
            background-color: #ddd;
            border-radius: 5px;
            font-size: 20px;
            height:50px;
        }

        .botoes a:hover, .botoes button:hover {
            background-color: rgb(177, 177, 177);
        }
        body {
            font-family: Arial, sans-serif;
        }

        .calendario {
            max-width: 95%;
            padding-top:0px;
            margin: 20px auto;
            text-align:center;
            border-radius:5px;
            border:4px solid #900603;
            background-color:#900603;
        }   

        .mes {
            display: inline-block;
            vertical-align: top;
            text-align: center;
        }

        .mes p {
            font-size: 20px;
            margin-bottom: 6px;
            color:white;
        }

        .dia {
            display: block;
            width: 89px;
            height: 20px;
            margin: 3px;
            padding: 1px;
            border-radius:2px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 20px;
            cursor: pointer;
            background-color:white;
        }
        .menu1 .btnpg {
            background-color:#b22222;
        }
        
    </style>
</head>
<div id="header">
        <a href="index.php" id="logo">SIGEST</a>
        <div class="menu1">
        <a class="btnpg" href="agenda.php">Agenda</a>
        <a href="cadPacientes.php">Cadastro de pacientes</a>
        <a href="listagemProntuarios.php">Prontuários</a>
        </div>
        <div class="menu2">
            <a href="perfil.php">Perfil</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>
<body>
    <div class="calendario">
        <div id="meses-do-ano">
            <!-- JavaScript irá gerar os meses do próximo ano aqui -->
        </div>
    </div>

    <script>
        const mesesDoAno = document.getElementById('meses-do-ano');

        // Função para gerar os meses do próximo ano
        function gerarMesesDoProximoAno() {
            const agora = new Date();
            const anoAtual = agora.getFullYear();
            const mesAtual = agora.getMonth();

            for (let mes = mesAtual; mes < mesAtual + 12; mes++) {
                const ano = mes < 12 ? anoAtual : anoAtual + 1;
                const mesExibido = mes < 12 ? mes : mes - 12;

                // Crie um contêiner para o mês
                const mesContainer = document.createElement('div');
                mesContainer.classList.add('mes');

                // Crie um elemento para o mês
                const mesElemento = document.createElement('div');
                mesElemento.classList.add('mes');
                mesElemento.innerHTML = `<p>${nomeDoMes(mesExibido)} ${ano}</p>`;

                // Adicione os dias do mês ao elemento do mês
                for (let dia = 1; dia <= diasNoMes(mesExibido, ano); dia++) {
                    const diaNumero = dia.toString().padStart(2, '0'); // Dia com 2 dígitos
                    const mesNumero = (mesExibido + 1).toString().padStart(2, '0'); // Mês com 2 dígitos

                    const dataFormatada = `${diaNumero}`; // data exibida na tela

                    const dataAtual = new Date();
                    const dataDoDia = new Date(ano, mesExibido, dia);

                    // Verifique se a data é maior ou igual à data atual
                    if (dataDoDia >= dataAtual || dataDoDia.toDateString() === dataAtual.toDateString()) {
                        const diaElemento = document.createElement('div');
                        diaElemento.classList.add('dia');
                        diaElemento.textContent = dataFormatada;
                        diaElemento.dataset.data = dataFormatada;
                        diaElemento.addEventListener('click', () => {
                            // Redirecionar para a página de agenda com a data selecionada
                            window.location.href = `testeDiaAgendaLembrete.php?data=${ano}-${mesNumero}-${dataFormatada}`;
                        });

                        mesElemento.appendChild(diaElemento);
                    }
                }

                // Verifique se o mês tem dias futuros antes de adicioná-lo ao calendário
                if (mesElemento.children.length > 0) {
                    mesContainer.appendChild(mesElemento);
                    mesesDoAno.appendChild(mesContainer);
                }
            }
        }

        // Função para obter o nome do mês a partir do número do mês (0-11)
        function nomeDoMes(numeroDoMes) {
            const meses = [
                'Jan.', 'Fev.', 'Mar.', 'Abr.', 'Mai.', 'Jun.',
                'Jul.', 'Ago.', 'Set.', 'Out.', 'Nov.', 'Dez.'
            ];
            return meses[numeroDoMes];
        }

        // Função para calcular o número de dias em um mês e ano específicos
        function diasNoMes(mes, ano) {
            return new Date(ano, mes + 1, 0).getDate();
        }

        gerarMesesDoProximoAno();
        
    </script>
</body>
</html>
