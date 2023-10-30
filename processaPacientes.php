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
$data = $_POST['data'];
$tratamentoRealizado = $_POST['tratamentoRealizado'];
$dente = $_POST['dente'];
$formaPagamento = $_POST['formaPagamento'];
$saldo = $_POST['saldo'];

function inserirPaciente($conn, $nome, $cpf, $rg, $dn, $sexo, $email, $fone, $endereco, $informacaoComplementar, $medicacoesUtilizadas, $alergiasReacoes, $doencaPreExistente, $historicoFamiliar, $habitos, $experienciaOdontologicaAnterior) {
    // Inserir paciente na tabela "Pacientes"
    $sqlInserirPaciente = "INSERT INTO pacientes (nome, cpf, rg, dn, sexo, email, fone, endereco, informacaoComplementar,  medicacoesUtilizadas, alergiasReacoes, doencaPreExistente, historicoFamiliar, habitos, experienciaOdontologicaAnterior)
    VALUES ('$nome','$cpf','$rg','$dn','$sexo','$email','$fone','$endereco','$informacaoComplementar','$medicacoesUtilizadas','$alergiasReacoes','$doencaPreExistente','$historicoFamiliar','$habitos','$experienciaOdontologicaAnterior')";

    if ($conn->query($sqlInserirPaciente) === TRUE) {
        return $conn->insert_id;

    } else {
        return -1;
    }
}

// Exemplo de uso da função
$paciente_id = inserirPaciente($conn, $nome, $cpf, $rg, $dn, $sexo, $email, $fone, $endereco, $informacaoComplementar, $medicacoesUtilizadas, $alergiasReacoes, $doencaPreExistente, $historicoFamiliar, $habitos, $experienciaOdontologicaAnterior);

if ($paciente_id !== -1) {

    // Agora, insira os dados na tabela "tratamento" usando o ID do paciente
    $sqlInserirTratamento = "INSERT INTO tratamento (paciente_id, avaliacao, data, tratamentoRealizado, dente, formaPagamento, saldo)
    VALUES ('$paciente_id', '$avaliacao', '$data', '$tratamentoRealizado', '$dente', '$formaPagamento', '$saldo')";

    if ($conn->query($sqlInserirTratamento) === TRUE) {
        header("Location: listagemProntuarios.php");
        exit();    
    } 
} else {
    echo "Erro ao inserir dados!";
}

$conn->close();
?>
