<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: paginaInicial.php');
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

if (isset($_GET['data'])) {
    $dataSelecionada = $_GET['data'];
    list($ano, $mes, $dia) = explode('-', $dataSelecionada);
} else {
    echo "Data não recebida.";
}

$horaFormatada = "08:00"; // Hora padrão (altere conforme necessário)
$horaInicio = strtotime('08:00');
$horaTermino = strtotime('20:15');
$intervalo = 15 * 60; // 15 minutos em segundos

$sql = "SELECT dataHora, nome FROM agenda WHERE DATE(dataHora) = '$dataSelecionada'";
$result = mysqli_query($conn, $sql);

$horariosAgendados = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $horariosAgendados[$row['dataHora']] = $row['nome'];
    }
}

// Consulta SQL para buscar nomes de pacientes
$sqlPacientes = "SELECT nome FROM pacientes";
$resultPacientes = mysqli_query($conn, $sqlPacientes);

$nomesPacientesDisponiveis = array();

if (mysqli_num_rows($resultPacientes) > 0) {
    while ($rowPacientes = mysqli_fetch_assoc($resultPacientes)) {
        $nomePacienteDisponivel = $rowPacientes['nome'];
        $nomesPacientesDisponiveis[] = $nomePacienteDisponivel;
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
            background-color:#b22222;
        }

        #menu2 a:hover {
            background-color: #b22222;
        }

        #menu2 {
            margin-left: auto;
        }

        .container {
            max-width: 90%;
            margin: 0 auto;
            margin-top: 20px;
            padding: 20px;
            background-color: #900603;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: inline-block;
            text-align: left;
            font-size: 140%;
            font-family: Arial, sans-serif;
            color: white;
            margin-bottom: 10px; /* Aumentei o margin-bottom para separar um pouco mais as labels dos campos de entrada */
        }

        .container form {
            margin-top: 0px;
            color: white;
        }

        .container input[type="text"],
        .container input[type="password"] {
            padding: 10px;
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
        
        p {
          text-align: center;
          font-size: 25px;
          font-family: Arial, sans-serif;
          color: white;
          margin-top:0px;
          margin-bottom:20px;
        }
      
        .horario {
            display: flex;
            text-align:center;
            margin-bottom:4px;
            vertical-align:middle;
        }
             
        .horario strong {
            font-weight:300;
            margin-right: 10px;
            margin-left:0px;
            text-align: center;
            font-size: 20px;
            font-family: Arial, sans-serif;
            color: white;
        }
       
        #rpaciente,
        #nome {   
          padding: 4px;
          border: 1px solid #dddddd;
          border-radius: 3px;
          width: 274px;
          font-size: 20px;
          height: 24px;
          vertical-align:top;
        }
        #btnagendamentos {
            background-color:#00e676;
        }
        #btnexcluir {
            background-color:#ff291e;
        }

        #btnexcluir,
        #btnagendamentos {
            border:none;
            border-radius:4px;
            height:25px;
            width:26px;
            vertical-align:top;
            margin-left:3px;
        }
        #menu1 .btnpg {
            background-color:#b22222;
        }
        .titulobotao {
            display:flex;
        }
        #btnlembrete {
            font-family: Arial, sans-serif;
          text-decoration: none;
          color: #000;
          padding: 2px;
          margin-top: 0px;
          margin-left:0px;
          background-color: #ddd;
          border-radius: 5px;
          font-size: 20px;
          border: 2px solid #333;
          width:auto;
          height:22px;
        }
        #titulo123{
            margin-left:32%;
        }
    </style>
</head>
<body>
<div id="header">
        <a href="index.php" id="logo">SIGEST</a>
        <div id="menu1">
        <a class="btnpg" href="agenda.php">Agenda</a>
        <a href="cadPacientes.php">Cadastro de pacientes</a>
        <a href="listagemProntuarios.php">Prontuários</a>
        </div>
        <div id="menu2">
            <a href="perfil.php">Perfil</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>
    <div class="container">
        <div class="titulobotao">
        <a href="testeLembrete2.php?data=<?php echo $dataSelecionada; ?>" id="btnlembrete">Enviar lembrete</a>

        <p id="titulo123"><?php echo $dia,"/",$mes,"/",$ano; ?></p>
    </div>
        <div class="horarios-disponiveis" style="column-count: 3;">
            <?php
            // Loop para gerar horários disponíveis
            for ($hora = $horaInicio; $hora < $horaTermino; $hora += $intervalo) {
                $horaFormatada = date("H:i", $hora);

                if (!in_array($horaFormatada, ['12:00', '12:15', '12:30', '12:45'])) {
                    $horaUnix = date("Y-m-d H:i:s", strtotime("$dataSelecionada $horaFormatada"));

                    if (isset($horariosAgendados[$horaUnix])) {
                        $nomePaciente = $horariosAgendados[$horaUnix];
                        echo "<div class='horario'>";
                        echo "<form action='testeProcessaExcluirHorario.php' method='post' onsubmit='return confirm(\"Deseja excluir $horaUnix?\");'>";
                        echo "<strong>$horaFormatada</strong>";
                        echo "<input type='hidden' name='horaUnix' value='$horaUnix'>";
                        echo "<input id='rpaciente' type='text' value='$nomePaciente' readonly>";
                        echo "<button id='btnexcluir' type='submit'></button>";
                        echo "</form>";
                        echo "</div>";
                    } else {
                        echo "<div class='horario'>";
                        echo "<strong>$horaFormatada</strong>";
                        echo "<form action='testeProcessaAgendaLembrete.php' method='post'>";
                        echo "<input type='hidden' name='dataHora' value='$horaUnix'>";

                        echo "<input type='text' name='nome' id='nome' list='pacientesList' required>";
                        echo "<datalist id='pacientesList'>";
                        foreach ($nomesPacientesDisponiveis as $nomePacienteDisponivel) {
                            echo "<option value='$nomePacienteDisponivel'>";
                        }
                        echo "</datalist>";

                        echo "<input id='btnagendamentos' type='submit' value=''>";
                        echo "</form>";
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
$(document).ready(function() {
    $('#nome').on('input', function() {
        var nomePesquisa = $(this).val();
        var pacientesList = $('#pacientesList').find('option[value="' + nomePesquisa + '"]');

        if (pacientesList.length === 0) {
            // Se a opção não existir no datalist, adicione-a manualmente
            $('#pacientesList').append('<option value="' + nomePesquisa + '">');
        }
    });
});
</script>
    </div>
</body>
</html>
