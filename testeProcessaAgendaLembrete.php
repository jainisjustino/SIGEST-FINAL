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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']); // Evita SQL Injection
    $dataHora = $_POST['dataHora'];

    // Consulta SQL para buscar o email do paciente com base no nome
    $sqlPaciente = "SELECT email FROM pacientes WHERE nome = '$nome'";
    $resultPaciente = mysqli_query($conn, $sqlPaciente);

    if ($resultPaciente && mysqli_num_rows($resultPaciente) > 0) {
        $rowPaciente = mysqli_fetch_assoc($resultPaciente);
        $email = $rowPaciente['email'];

        // Consulta SQL para inserir o agendamento no banco de dados
        $sql = "INSERT INTO agenda (nome, dataHora, email) VALUES ('$nome', '$dataHora', '$email')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header ("location: agenda.php");
            exit();
        } else {
            echo "Erro ao agendar o horário: " . mysqli_error($conn);
        }
    } else {
        echo "Nome de paciente não encontrado no banco de dados.";
    }
} else {
    die("Método de solicitação inválido.");
}
?>
