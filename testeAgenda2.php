<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="agenda_fisica.css">
    <title>Agenda Física</title>
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

        .agenda {
            max-width: auto;
            margin: 40px auto;
            
        }

        .dias {
            display: flex;
            justify-content: space-between;
        }

        .dia {
            width: 300px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        h2 {
            text-align: center;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
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
<div class="agenda">
    <div class="dias">
        <div class="dia">
            <h2>Segunda-feira</h2>
            <ul id="segunda">
                <!-- JavaScript irá gerar os horários -->
            </ul>
        </div>
        <div class="dia">
            <h2>Terça-feira</h2>
            <ul id="terca">
                <!-- JavaScript irá gerar os horários -->
            </ul>
        </div>
        <div class="dia">
            <h2>Quarta-feira</h2>
            <ul id="quarta">
                <!-- JavaScript irá gerar os horários -->
            </ul>
        </div>
        <div class="dia">
            <h2>Quinta-feira</h2>
            <ul id="quinta">
                <!-- JavaScript irá gerar os horários -->
            </ul>
        </div>
        <div class="dia">
            <h2>Sexta-feira</h2>
            <ul id="sexta">
                <!-- JavaScript irá gerar os horários -->
            </ul>
        </div>
    </div>
</div>

<script>
    // Função para gerar os horários a cada 15 minutos
    function gerarHorarios() {
    const diasDaSemana = ['segunda', 'terca', 'quarta', 'quinta', 'sexta'];

    for (let dia = 0; dia < diasDaSemana.length; dia++) {
        const ul = document.getElementById(diasDaSemana[dia]);
        const agora = new Date();
        agora.setDate(agora.getDate() + dia); // Incrementa o dia da semana
        const anoAtual = agora.getFullYear();
        const mesAtual = agora.toLocaleString('default', { month: 'long' });
        const diaDaSemanaAtual = agora.getDay(); // 0 = Domingo, 1 = Segunda, ..., 6 = Sábado
        const nomeDia = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'][diaDaSemanaAtual];
        const diaDoMes = agora.getDate();

        ul.innerHTML = `<li>${nomeDia}, ${diaDoMes} de ${mesAtual} de ${anoAtual}</li>`;
        for (let hora = 8; hora <= 12; hora++) {
            for (let minuto = 0; minuto < 60; minuto += 15) {
                ul.innerHTML += `<li>${hora.toString().padStart(2, '0')}:${minuto.toString().padStart(2, '0')}</li>`;
            }
        }
    }
}

gerarHorarios();

</script>
</body>
</html>
