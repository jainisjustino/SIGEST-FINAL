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
    $dataHora = $_POST['dataHora'];
    $nome = mysqli_real_escape_string($conn, $_POST['nome']); // Evita SQL Injection

    // Você também pode adicionar validações adicionais aqui

    // Consulta SQL para inserir o agendamento no banco de dados
    $sql = "INSERT INTO agenda (nome, dataHora) VALUES ('$nome','$dataHora')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: agenda.php"); // Redirecione para a página de login após a exclusão bem-sucedida
        exit();
    } else {
        echo "Erro ao agendar o horário: " . mysqli_error($conn);
    }
} else {
    die("Método de solicitação inválido.");
}
?>
