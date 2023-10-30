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

        $update_pacientes = "UPDATE pacientes SET nome = '$novo_nome', cpf='$novo_cpf', rg='$novo_rg',
        dn='$novo_dn', sexo='$novo_sexo',email = '$novo_email', fone='$novo_fone', endereco='$novo_endereco',
        informacaoComplementar='$novo_informacaoComplementar', medicacoesUtilizadas='$novo_medicacoesUtilizadas',
        alergiasReacoes='$novo_alergiasReacoes', doencaPreExistente='$novo_doencaPreExistente', 
        historicoFamiliar='$novo_historicoFamiliar', habitos='$novo_habitos', 
        experienciaOdontologicaAnterior='$novo_experienciaOdontologicaAnterior' WHERE id = $paciente_id";

        if (mysqli_query($conn,$update_pacientes)) {
            if (isset($_POST['tratamento_ids']) && is_array($_POST['tratamento_ids'])) {
                $tratamento_ids = $_POST['tratamento_ids'];
                $data = $_POST['data'];
                $tratamentoRealizado = $_POST['tratamentoRealizado'];
                $dente = $_POST['dente'];
                $formaPagamento = $_POST['formaPagamento'];
                $saldo = $_POST['saldo'];

                foreach ($tratamento_ids as $i => $tratamento_id) {
                    $update_tratamento = "UPDATE tratamento SET avaliacao = '$novo_avaliacao', data = '$data[$i]',
                    tratamentoRealizado = '$tratamentoRealizado[$i]',dente = '$dente[$i]', 
                    formaPagamento = '$formaPagamento[$i]', saldo = '$saldo[$i]' WHERE id = $tratamento_id";

                    mysqli_query($conn, $update_tratamento);
                }
            }

            header("Location: listagemProntuarios.php");
            exit();
        } else {
            echo "Erro ao atualizar dados do paciente: " . mysqli_error($conn);
        }
    }
}
?>
