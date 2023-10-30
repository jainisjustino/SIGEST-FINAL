
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

        $query_tratamento = "SELECT * FROM tratamento WHERE paciente_id = $paciente_id";
        $result_tratamento = mysqli_query($conn, $query_tratamento);
    }

    if (mysqli_num_rows($result_tratamento) > 0) {
        $tratamento = mysqli_fetch_assoc($result_tratamento);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Restante do código de processamento aqui
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
}

    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $allowed_extensions = ['pdf'];
        $file_info = pathinfo($_FILES['pdf_file']['name']);
        $file_extension = strtolower($file_info['extension']);

        if (in_array($file_extension, $allowed_extensions)) {
            $pdfContent = file_get_contents($_FILES['pdf_file']['tmp_name']);
            $pdfContent = mysqli_real_escape_string($conn, $pdfContent); // Evita injeção SQL

            $query = "UPDATE tratamento SET documento_pdf = '$pdfContent' WHERE paciente_id = $paciente_id";

            if (mysqli_query($conn, $query)) {
                echo "PDF enviado e armazenado no banco de dados com sucesso.";
            } else {
                echo "Erro ao inserir o PDF no banco de dados: " . mysqli_error($conn);
            }
        } else {
            echo "Erro ao fazer o upload do PDF.";
        }
    } else {
        echo "Erro ao atualizar dados de tratamento: " . mysqli_error($conn);
} 
?>
