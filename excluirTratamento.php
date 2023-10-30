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
    if (isset($_POST['tratamento_id'])) {
        $tratamento_id = $_POST['tratamento_id'];

        // Execute uma consulta SQL para excluir o tratamento com base no seu ID
        $delete_query = "DELETE FROM tratamento WHERE id = $tratamento_id";
        if (mysqli_query($conn, $delete_query)) {
            // Tratamento excluído com sucesso
            header("Location: listagemProntuarios.php");
            exit();
        } else {
            echo "Erro ao excluir o tratamento: " . mysqli_error($conn);
        }
    }
}
?>
