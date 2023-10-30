<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}   
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agenda</title>
    <style>
        /* Seus estilos CSS aqui... */
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
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 2px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        th.day-column {
            width: 100px;
            text-align: center;
            white-space: nowrap;
        }

        td.empty-cell {
            background-color: #e0e0e0;
        }

        td.event-cell {
            background-color: #a6ffa6;
        }
    </style>
</head>
<body>
    <div id="header">
    <a href="index.php" id="logo">SIGEST</a>
        <div id="menu1">
            <a href="listagemProntuarios.php">Prontuários</a>
            <a href="#">Relatório</a>
            <a href="cadPacientes.php">Cadastro de pacientes</a>
        </div>
        <div id="menu2">
            <a href="logout.php">Sair</a>
        </div>
    </div>
    <h2>Agenda</h2>

    <?php
    // Conexão com o banco de dados (substitua com suas configurações)
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "test";

    $conexao = mysqli_connect($host, $usuario, $senha, $banco);

    if (!$conexao) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $dataHora = $_POST["dataHora"];

        // Verifica se já existe um evento marcado nesse horário
        $sqlVerificar = "SELECT * FROM agenda WHERE dataHora = '$dataHora'";
        $resultadoVerificar = mysqli_query($conexao, $sqlVerificar);
        if (mysqli_num_rows($resultadoVerificar) > 0) {
            echo "<script>alert('Já existe um evento marcado nesse horário.'); window.location.href='testeAgenda.php';</script>";
            exit;
        } else {
            // Insere o evento na tabela
            $sql = "INSERT INTO agenda (nome, dataHora) VALUES ('$nome', '$dataHora')";
            mysqli_query($conexao, $sql);
            echo "<script>alert('Evento marcado com sucesso!'); window.location.href='testeAgenda.php';</script>";
        }
    }
    ?>

    <form method="POST" action="agenda.php">
        <label>Nome do Evento:</label>
        <input type="text" name="nome" required><br>
        <label>Data e Hora:</label>
        <input type="datetime-local" name="dataHora" min="<?php echo date('Y-m-d\TH:i'); ?>" max="2023-12-31T20:00" step="900" required><br> <!-- 900 segundos = 15 minutos -->
        <button type="submit">Adicionar Evento</button>
    </form>

    <h3>Agenda</h3>
    <table>
        <tr>
            <th class="empty-cell"></th>
            <?php
            $dataInicio = strtotime(date("Y-m-d 07:00:00")); // Dia atual às 07:00
            $dataFim = strtotime(date("Y-12-31 20:00:00")); // Último dia do ano às 20:00

            while ($dataInicio <= $dataFim) {
                echo "<th class='day-column'>" . date("Y-m-d", $dataInicio) . "</th>";
                $dataInicio += 86400; // Adiciona 1 dia (86400 segundos)
            }
            ?>
        </tr>
        <?php
        $horaAtual = date("H");
        $minutoAtual = date("i");
        for ($hora = 7; $hora <= 20; $hora++) {
            for ($minuto = 0; $minuto < 60; $minuto += 15) {
                echo "<tr>";
                echo "<th>$hora:" . str_pad($minuto, 2, "0", STR_PAD_LEFT) . "</th>";
        
                $dataInicio = strtotime(date("Y-m-d 07:00:00")); // Dia atual às 07:00
                while ($dataInicio <= $dataFim) {
                    $horaMinuto = date("H:i", $dataInicio + ($hora - 7) * 3600 + $minuto * 60);
        
                    $sql = "SELECT nome FROM agenda WHERE dataHora = '" . date("Y-m-d H:i:s", strtotime(date("Y-m-d", $dataInicio) . " " . $horaMinuto)) . "'";
                    $resultado = mysqli_query($conexao, $sql);
                    $evento = mysqli_fetch_assoc($resultado);
        
                    echo "<td class='" . ($evento ? "event-cell" : "empty-cell") . "'>" . ($evento ? $evento['nome'] : '') . "</td>";
        
                    $dataInicio += 86400; // Adiciona 1 dia (86400 segundos)
                }
        
                echo "</tr>";
            }
        }        

        // Fecha a conexão
        mysqli_close($conexao);
        ?>
    </table>
</body>
</html>
