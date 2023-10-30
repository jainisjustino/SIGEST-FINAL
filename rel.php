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

$tratamento = array( // Inicialize $tratamento com valores padrão vazios
  'avaliacao' => '',
  'data' => '',
  'tratamentoRealizado' => '',
  'dente' => '',
  'formaPagamento' => '',
  'saldo' => '',
);

if (isset($_GET['id'])) {
    $paciente_id = $_GET['id'];
    $query_pacientes = "SELECT * FROM pacientes WHERE id = $paciente_id";
    $result_pacientes = mysqli_query($conn, $query_pacientes);

    if (mysqli_num_rows($result_pacientes) > 0) {
        $paciente = mysqli_fetch_assoc($result_pacientes);
    }
}

$dataTratamento = $tratamento['data'];
$dataFormatada = date('d/m/Y', strtotime($dataTratamento));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Relatório do Paciente</title>
    <style>
        body {
            margin-left:20px;
            margin-right:20px;
        }
        #titulo {
            font-weight:normal;
            font-size: 25px;
            font-family:arial,sans-serif;
        }
        .cont {
            margin-bottom:0px;
            margin-top:3px;
            font-weight:normal; /* Define uma largura máxima para o conteúdo */
            word-wrap: break-word;
            overflow: auto;
           
        }
        .titulose {
            text-decoration:underline;
            font-weight:normal;
            font-size: 22px;
            font-family:arial,sans-serif;

        }
        strong {
            font-weight:normal;
            font-size: 18px;
            display:inline-block;
        }
        p {
            margin-right:15px;
            font-size: 18px;
            font-family:arial,sans-serif;
        }
        .trat  {
            font-weight:normal;
            font-size: 18px;
            font-family:arial,sans-serif;
            border:1px solid black;
            padding-left:5px;
            margin-bottom:5px;
            border-radius:5px;
            display:block;
        }
        table {
            font-family:arial, sans-serif;
            font-size:18px;
            border:1px solid black;
            border-radius:3px;
            width:100%;
        }
        th {
            font-weight:normal;
            font-family:arial, sans-serif;
            font-size:18px;
        }
        td {
            border-radius:3px;
            border:1px solid black;
            padding-left:3px;
            padding-right:3px;
            word-wrap: break-word;
            width:auto;
        }
        .tdtrat { 
            max-width:800px;
            width:auto;
        }
        .se {
            padding-left:5px;
            border:1px solid black;
            border-radius:3px;
            margin-bottom:10px;
        }
        #imprimirBotao {
            font-size:20px;
            margin-top:15px;
        }
        @media print{
        #imprimirBotao {
  display: none;
}}
    </style>
</head>
<body>
    <!-- Cabeçalho da página -->
    <div id="header">
        <!-- Seu cabeçalho aqui -->
    </div>

    <!-- Conteúdo principal -->
    <div id="container">
        <h2 id="titulo">Relatório do Paciente</h2>

        <div class="se">
            <p class="cont"><strong>Nome:</strong> <?php echo $paciente['nome']; ?></p>
            <p class="cont"><strong>CPF:</strong> <?php echo $paciente['cpf']; ?></p>
            <p class="cont"><strong>RG:</strong> <?php echo $paciente['rg']; ?></p>
            <p class="cont"><strong>Data de Nascimento:</strong> <?php
                $dataNascimento = $paciente['dn'];
                $dataFormatada = date('d/m/Y', strtotime($dataNascimento));
                echo $dataFormatada; ?></p>
        </div>

        <div class="se">
        <div>
            <p class="cont"><strong>Medicações utilizadas: </strong><?php echo $paciente['medicacoesUtilizadas']; ?></p>
        </div>

        <div>
            <p class="cont"><strong>Alergias e/ou reações: </strong><?php echo $paciente['alergiasReacoes']; ?></p>
        </div>

        <div>
            <p class="cont"><strong>Doenças pré-existentes: </strong><?php echo $paciente['doencaPreExistente']; ?></p>
        </div>

        <div>
            <p class="cont"><strong>Histórico familiar: </strong><?php echo $paciente['historicoFamiliar']; ?></p>
        </div>

        <div>
            <p class="cont"><strong>Hábitos: </strong><?php echo $paciente['habitos']; ?></p>
        </div>

        <div>
            <p class="cont"><strong>Experiências odontológicas anteriores: </strong><?php echo $paciente['experienciaOdontologicaAnterior']; ?></p>
        </div>
    </div>
    <?php
$host = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$nome_bd = "test";

$conn = mysqli_connect($host, $usuario_bd, $senha_bd, $nome_bd);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$tratamento = array( // Inicialize $tratamento com valores padrão vazios
  'avaliacao' => '',
  'data' => '',
  'tratamentoRealizado' => '',
  'dente' => '',
  'formaPagamento' => '',
  'saldo' => '',
);
?><table>
    <tr>
        <th>Data</th>
        <th>Tratamento realizado</th>
        <th>Dente</th>
        <th>Forma pagamento</th>
        <th>Saldo</th>
    </tr>
    <?php
    
$host = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$nome_bd = "test";

$conn = mysqli_connect($host, $usuario_bd, $senha_bd, $nome_bd);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$tratamento = array( // Inicialize $tratamento com valores padrão vazios
  'avaliacao' => '',
  'data' => '',
  'tratamentoRealizado' => '',
  'dente' => '',
  'formaPagamento' => '',
  'saldo' => '',
);

if (isset($_GET['id'])) {
    $paciente_id = $_GET['id'];
    $query_pacientes = "SELECT * FROM pacientes WHERE id = $paciente_id";
    $result_pacientes = mysqli_query($conn, $query_pacientes);

    if (mysqli_num_rows($result_pacientes) > 0) {
        $paciente = mysqli_fetch_assoc($result_pacientes);

        $query_tratamento = "SELECT tratamento.*, pacientes.nome AS nome
                            FROM tratamento
                            INNER JOIN pacientes ON tratamento.paciente_id = pacientes.id
                            WHERE tratamento.paciente_id = $paciente_id";

        $result_tratamento = mysqli_query($conn, $query_tratamento);

        if (mysqli_num_rows($result_tratamento) > 0) {
    while ($tratamento = mysqli_fetch_assoc($result_tratamento)) {
        $dataTratamento = $tratamento['data'];
        $dataFormatada = date('d/m/Y', strtotime($dataTratamento));
        echo "<tr>";
        echo "<td class='tddata'>" . $dataFormatada . "</td>";
        echo "<td class='tdtrat'>" . $tratamento['tratamentoRealizado'] . "</td>";
        echo "<td class='tddente'>" . $tratamento['dente'] . "</td>";
        echo "<td class='tdpgto'>" . $tratamento['formaPagamento'] . "</td>";
        echo "<td class='tdsaldo'>" . $tratamento['saldo'] . "</td>";
        echo "</tr>";
    }}}}
    ?>
</table>
<button id="imprimirBotao" type="button" onclick="imprimirPagina()">Imprimir</button>

<script>
        function imprimirPagina() {
            // Abre a janela de impressão do navegador
            window.print();
        }
    </script>
    
</body>
</html>
