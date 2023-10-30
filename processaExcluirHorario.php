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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["horaUnix"])) {
    $horaUnix = $_POST["horaUnix"];

    // Execute uma consulta para excluir o paciente agendado
    $sql = "DELETE FROM agenda WHERE dataHora = '$horaUnix'";
    
    if (mysqli_query($conn, $sql)) {
        // Paciente excluído com sucesso
        header ("location: agenda.php");
    } else {
        echo "Erro ao excluir o paciente: " . mysqli_error($conn);
    }
} else {
    echo "Acesso inválido.";
}
?>