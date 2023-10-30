<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
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
        experienciaOdontologicaAnterior='$novo_experienciaOdontologicaAnterior',
        avaliacao = '$novo_avaliacao' WHERE id = $paciente_id";

        if (mysqli_query($conn, $update_pacientes)) {
            if (isset($_POST['data']) && is_array($_POST['data'])) {
                $data = $_POST['data'];
                $tratamentoRealizado = $_POST['tratamentoRealizado'];
                $dente = $_POST['dente'];
                $formaPagamento = $_POST['formaPagamento'];
                $saldo = $_POST['saldo'];
                $tratamento_ids = $_POST['tratamento_ids'];

                // Remove tratamentos existentes para o paciente
                $deleteQuery = "DELETE FROM tratamento WHERE paciente_id = $paciente_id";
                mysqli_query($conn, $deleteQuery);

                // Insere ou atualiza os tratamentos no banco de dados
                foreach ($data as $i => $tratamento_data) {
                    $tratamento_realizado = $tratamentoRealizado[$i];
                    $dente_tratamento = $dente[$i];
                    $forma_pagamento = $formaPagamento[$i];
                    $saldo_tratamento = $saldo[$i];

                    if (!empty($tratamento_realizado)) { // Verifica se o tratamento realizado não está em branco
                        $insertQuery = "INSERT INTO tratamento (paciente_id, data, tratamentoRealizado, dente, formaPagamento, saldo)
                                        VALUES ($paciente_id, '$tratamento_data', '$tratamento_realizado', '$dente_tratamento', '$forma_pagamento', '$saldo_tratamento')";
                        mysqli_query($conn, $insertQuery);
                    }
                }
            }

            // Adicionar novos tratamentos
            if (isset($_POST['nova_data']) && is_array($_POST['nova_data'])) {
                $nova_data = $_POST['nova_data'];
                $novo_tratamentoRealizado = $_POST['novo_tratamentoRealizado'];
                $novo_dente = $_POST['novo_dente'];
                $novo_formaPagamento = $_POST['novo_formaPagamento'];
                $novo_saldo = $_POST['novo_saldo'];

                foreach ($nova_data as $i => $data) {
                    if (!empty($novo_tratamentoRealizado[$i])) { // Verifica se o tratamento realizado não está em branco
                        $insertQuery = "INSERT INTO tratamento (paciente_id, data, tratamentoRealizado, dente, formaPagamento, saldo)
                                VALUES ($paciente_id, '$data', '$novo_tratamentoRealizado[$i]', '$novo_dente[$i]', '$novo_formaPagamento[$i]', '$novo_saldo[$i]')";
                        mysqli_query($conn, $insertQuery);
                    }
                }
            }

            header("Location: -novaFicha.php?id=$paciente_id");
            exit();
        } else {
            echo "Erro ao atualizar dados do paciente: " . mysqli_error($conn);
        }
    }
}
?>
