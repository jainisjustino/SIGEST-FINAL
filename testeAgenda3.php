<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .calendario {
            max-width: 95%;
            padding-top:6px;
            margin: 30px auto;
            text-align:center;
            border-radius:5px;
            border:4px solid #900603;
        }

        .dia {
            display: inline-block;
            width: 72px;
            height: 14px;
            margin: 3px;
            padding:2px;
            border: 1px solid #ccc;
            text-align: center;
            font-size:15px;
            font-weight:bold;
            cursor: pointer;
            border:2px solid;
        }
        body {
            margin-left: 0px;
            margin-top: 0px;
            margin-right: 0px;
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
    </style>
</head>
<div id="header">
        <a href="index.php" id="logo">SIGEST</a>
        <div id="menu1">
            <a href="listagemProntuarios.php">Prontuários</a>
            <a href="#">Relatório</a>
            <a href="cadPacientes.php">Cadastro de pacientes</a>
        </div>
        <div id="menu2">
            <a href="perfil.php">Perfil</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>
<body>
    <div class="calendario">
        
        <div id="dias-do-ano">
            <!-- JavaScript irá gerar os dias do ano aqui -->
        </div>
    </div>

    <script>
        const diasDoAno = document.getElementById('dias-do-ano');
// // Função para gerar os dias do ano a partir da data atual
function gerarDiasDoAno() {
    const agora = new Date();
    const anoAtual = agora.getFullYear();
    const mesAtual = agora.getMonth();
    const diaAtual = agora.getDate();
    const primeiroDia = new Date(anoAtual, mesAtual, diaAtual);

    for (let dia = 0; dia < 365; dia++) {
        const data = new Date(primeiroDia);
        data.setDate(primeiroDia.getDate() + dia);
        const diaNumero = data.getDate().toString().padStart(2, '0'); // Dia com 2 dígitos
        const mesNumero = (data.getMonth() + 1).toString().padStart(2, '0'); // Mês com 2 dígitos
        const ano = data.getFullYear();

        const dataFormatada = `${diaNumero}/${mesNumero}/${ano}`; // data exibida na tela

        const diaElemento = document.createElement('div');
        diaElemento.classList.add('dia');
        diaElemento.textContent = dataFormatada;
        diaElemento.dataset.data = dataFormatada;
        diaElemento.addEventListener('click', () => {
            // Redirecionar para a página de agenda com a data selecionada
            window.location.href = `testeAgenda33.php?data=${dataFormatada}`;
        });

        diasDoAno.appendChild(diaElemento);
    }
}

gerarDiasDoAno();

    </script>
</body>
</html>
