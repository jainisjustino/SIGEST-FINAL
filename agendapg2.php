<?php
$host = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$nome_bd = "test";

$conn = mysqli_connect($host, $usuario_bd, $senha_bd, $nome_bd);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}



if (isset($_GET['data'])) {
    $dataSelecionada = $_GET['data'];
    list($ano, $mes, $dia) = explode('-', $dataSelecionada);
} else {
    echo "Data não recebida.";
}



// Defina um valor padrão para a data selecionada (por exemplo, a data atual)
//$dataSelecionada = date("Y-m-d"); // Data atual (altere conforme necessário)

// Defina um valor padrão para a hora formatada (por exemplo, 08:00)
$horaFormatada = "08:00"; // Hora padrão (altere conforme necessário)

// Defina as horas de início e término e o intervalo (15 minutos)
$horaInicio = strtotime('08:00');
$horaTermino = strtotime('20:00');
$intervalo = 15 * 60; // 15 minutos em segundos

// Consulta SQL para verificar os horários já agendados
$sql = "SELECT dataHora, nome FROM agenda WHERE dataHora LIKE '%$dataSelecionada%'";
$result = mysqli_query($conn, $sql);

$horariosAgendados = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $horariosAgendados[] = strtotime($row["dataHora"]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <style>
        /* Adicione seus estilos CSS aqui */
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
            display: inline-block;
            text-align: left;
            font-size: 140%;
            font-family: Arial, sans-serif;
            color: white;
            margin-bottom: 10px; /* Aumentei o margin-bottom para separar um pouco mais as labels dos campos de entrada */
        }

        .container p {
            text-align: left;
            font-size: 15px;
            margin-left: 2%;
            margin-top: 5%;
            margin-bottom: 1%;
            font-family: Arial, sans-serif, italic;
            color: white;
        }

        .container form {
            margin-top: 0px;
            color: white;
        }

        .container input[type="text"],
        .container input[type="password"] {
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            margin-bottom: 0px;
            width: 100%;
            box-sizing: border-box;
            font-size: 20px;
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
        #nome{
          padding: 10px;
          border: 1px solid #dddddd;
          border-radius: 3px;
          margin-bottom: 0px;
          margin-top:0px;
          width: 100%;
          box-sizing: border-box;
          font-size: 20px;
          height: 28px;
        }
        h2 {
          text-align: center;
          font-size: 30px;
          font-family: Arial, sans-serif;
          color: white;
        }
        strong {
            margin-left:-11px;
        }
        .horario {
            display: flex;
            align-items: center;
        }
        
        .horario strong {
            margin-right: 10px;
            margin-left:0px;
            text-align: center;
          font-size: 25px;
          font-family: Arial, sans-serif;
          color: white;
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
    <!-- Código HTML para exibir o calendário e permitir o agendamento -->
    <div class="container">
        <h2>Agenda para <?php echo $dia,"/",$mes,"/",$ano; ?></h2>
        <div class="horarios-disponiveis">
            <?php
            // Loop para gerar horários disponíveis
            for ($hora = $horaInicio; $hora < $horaTermino; $hora += $intervalo) {
                $horaFormatada = date("H:i", $hora);
                $horaUnix = date("Y-m-d H:i:s", strtotime("$dataSelecionada $horaFormatada"));
            
                // Verifique se o horário está disponível
                if (!in_array($horaUnix, $horariosAgendados)) {
                    echo "<p>";
                    echo "<div class='horario'>";
                    echo "<strong>$horaFormatada:</strong>";
                    echo "<form action='agendar.php' method='post'>";
                    echo "<input type='hidden' name='dataHora' value='$horaUnix'>";
                    echo "<input type='text' name='nome' id='nome' placeholder='Nome do Paciente' required>";
                    echo "</form>";
                    echo "</div>";
                    echo "</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
