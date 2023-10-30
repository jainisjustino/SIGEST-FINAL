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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$idUsuarioExcluir = $_SESSION['idUsuario'];
echo $idUsuarioExcluir;

$sql = "DELETE FROM usuarios WHERE id=$idUsuarioExcluir";

if ($conn->query($sql) === TRUE) {
    session_unset();  // Limpe todas as variáveis de sessão
    session_destroy(); // Destrói a sessão
    header("Location: paginaInicial.php"); // Redirecione para a página de login após a exclusão bem-sucedida
    exit();
} else {
  echo "Erro!". $conn->error;
}

$conn->close();
?>