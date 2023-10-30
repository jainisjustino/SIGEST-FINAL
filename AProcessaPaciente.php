<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: paginaInicial.php');
    exit;
}   

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Coletar dados do formulário
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$dn = $_POST['dn'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$fone = $_POST['fone'];
$endereco = $_POST['endereco'];
$informacaoComplementar = $_POST['informacaoComplementar'];
$medicacoesUtilizadas = $_POST['medicacoesUtilizadas'];
$alergiasReacoes = $_POST['alergiasReacoes'];
$doencaPreExistente = $_POST['doencaPreExistente'];
$historicoFamiliar = $_POST['historicoFamiliar'];
$habitos = $_POST['habitos'];
$experienciaOdontologicaAnterior = $_POST['experienciaOdontologicaAnterior'];
$avaliacao = $_POST['avaliacao'];

// Inserir paciente na tabela "Pacientes"
$sqlInserirPaciente = "INSERT INTO pacientes (nome, cpf, rg, dn, sexo, email, fone, endereco, informacaoComplementar,  medicacoesUtilizadas, alergiasReacoes, doencaPreExistente, historicoFamiliar, habitos, experienciaOdontologicaAnterior, avaliacao)
VALUES ('$nome','$cpf','$rg','$dn','$sexo','$email','$fone','$endereco','$informacaoComplementar','$medicacoesUtilizadas','$alergiasReacoes','$doencaPreExistente','$historicoFamiliar','$habitos','$experienciaOdontologicaAnterior','$avaliacao')";

if ($conn->query($sqlInserirPaciente) === TRUE) {
    $paciente_id = $conn->insert_id;

    // Coletar dados dos tratamentos
    $tratamentos = [];
    $data = $_POST['data'];
    $tratamentoRealizado = $_POST['tratamentoRealizado'];
    $dente = $_POST['dente'];
    $formaPagamento = $_POST['formaPagamento'];
    $saldo = $_POST['saldo'];

    // Iterar sobre os tratamentos e coletar informações
    foreach ($data as $key => $value) {
        $tratamento = [
            'data' => $data[$key],
            'tratamentoRealizado' => $tratamentoRealizado[$key],
            'dente' => $dente[$key],
            'formaPagamento' => $formaPagamento[$key],
            'saldo' => $saldo[$key]
        ];
        $tratamentos[] = $tratamento;
    }

    // Inserir tratamentos na tabela "tratamento" usando o ID do paciente
    foreach ($tratamentos as $tratamento) {
        $dataTratamento = $tratamento['data'];
        $tratamentoRealizado = $tratamento['tratamentoRealizado'];
        $dente = $tratamento['dente'];
        $formaPagamento = $tratamento['formaPagamento'];
        $saldo = $tratamento['saldo'];

        $sqlInserirTratamento = "INSERT INTO tratamento (paciente_id, data, tratamentoRealizado, dente, formaPagamento, saldo)
        VALUES ('$paciente_id','$dataTratamento', '$tratamentoRealizado', '$dente', '$formaPagamento', '$saldo')";

        if ($conn->query($sqlInserirTratamento) !== TRUE) {
            echo "Erro ao inserir tratamento: " . $conn->error;
        }
    }

    header("Location: listagemProntuarios.php");
    exit();    
} else {
    echo "Erro ao inserir paciente: " . $conn->error;
}

$conn->close();
?>
