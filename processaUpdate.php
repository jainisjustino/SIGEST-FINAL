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

if (isset($_GET['id'])) {
    $paciente_id = $_GET['id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Atualizar os dados do paciente no banco de dados
        $novo_nome = $_POST['nome'];
        $novo_cpf = $_POST['cpf'];
        $novo_rg = $_POST['rg'];
        $novo_dn = $_POST['dn'];
        $novo_sexo = $_POST['sexo'];
        $novo_email = $_POST['email'];
        $novo_fone = $_POST['fone'];
        $novo_endereco = $_POST['endereco'];
        $novo_informacaoComplementar = $_POST['informacaoComplementar'];
        $novo_medicacoesUtilizadas = $_POST['medicacoesUtilizadas'];
        $novo_alergiasReacoes = $_POST['alergiasReacoes'];
        $novo_doencaPreExistente = $_POST['doencaPreExistente'];
        $novo_historicoFamiliar = $_POST['historicoFamiliar'];
        $novo_habitos = $_POST['habitos'];
        $novo_experienciaOdontologicaAnterior = $_POST['experienciaOdontologicaAnterior'];
        $novo_avaliacao = $_POST['avaliacao'];
        $novo_data = $_POST['data'];
        $novo_tratamentoRealizado = $_POST['tratamentoRealizado'];
        $novo_dente = $_POST['dente'];
        $novo_formaPagamento = $_POST['formaPagamento'];
        $novo_saldo = $_POST['saldo'];
        

        $update_pacientes = "UPDATE pacientes SET nome = '$novo_nome', cpf='$novo_cpf', rg='$novo_rg',
        dn='$novo_dn', sexo='$novo_sexo',email = '$novo_email', fone='$novo_fone', endereco='$novo_endereco',
        informacaoComplementar='$novo_informacaoComplementar', medicacoesUtilizadas='$novo_medicacoesUtilizadas',
        alergiasReacoes='$novo_alergiasReacoes', doencaPreExistente='$novo_doencaPreExistente', 
        historicoFamiliar='$novo_historicoFamiliar', habitos='$novo_habitos', 
        experienciaOdontologicaAnterior='$novo_experienciaOdontologicaAnterior' WHERE id = $paciente_id";

if (mysqli_query($conn, $update_pacientes)) {
    // Consulta de atualização de pacientes foi bem-sucedida

    $update_tratamento = "UPDATE tratamento SET avaliacao = '$novo_avaliacao', data = '$novo_data',
    tratamentoRealizado = '$novo_tratamentoRealizado',dente = '$novo_dente', 
    formaPagamento = '$novo_formaPagamento', saldo = '$novo_saldo' WHERE paciente_id = $paciente_id";
   
    if (mysqli_query($conn, $update_tratamento)) {
        // Consulta de inserção de tratamento bem-sucedida
        header("Location: listagemProntuarios.php");
        exit();
    } else {
        echo "Erro ao inserir dados de tratamento: " . mysqli_error($conn);
    }
} else {
    echo "Erro ao atualizar dados do paciente: " . mysqli_error($conn);
}
}
}

?>