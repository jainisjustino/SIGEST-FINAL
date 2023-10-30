<?php
session_start(); // Inicie a sessão

// Verifique se o usuário está logado
if (!isset($_SESSION['logged_in'])) {
    header("Location: paginaInicial.php"); // Redirecione para a página de login se não estiver logado
    exit();
}

// Verifique se o ID do usuário está disponível na sessão
if (!isset($_SESSION['idUsuario'])) {
    echo "ID do usuário não disponível.";
    exit();
}

// ID do usuário a ser editado
$idUsuarioEditar = $_SESSION['idUsuario'];

// Conexão com o banco de dados (substitua com suas próprias informações)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];

    // Consulta SQL para atualizar os dados do usuário
    $updateQuery = "UPDATE usuarios SET nome='$nome', senha='$senha' WHERE id=$idUsuarioEditar";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Dados do usuário atualizados com sucesso.";
    } else {
        echo "Erro ao atualizar os dados do usuário: " . $conn->error;
    }
}

session_destroy(); // Destruir a sessão atual
header('Location: login.php'); // Redirecionar para a página de login
exit;

// Consulta SQL para recuperar os dados do usuário com base no ID
$getUserQuery = "SELECT nome, senha FROM usuarios WHERE id=$idUsuarioEditar";
$result = $conn->query($getUserQuery);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nomeUsuarioEditar = $row['nome'];
    $senhaUsuarioEditar = $row['senha'];
}

// Certifique-se de fechar a conexão após o uso
$conn->close();
?>
