<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Coletar dados do formulário
$nome = $_POST['nome'];
$senha = $_POST['senha'];

// Inserir paciente na tabela "Pacientes"
$sqlInserirUsuarios = "INSERT INTO usuarios (nome, senha)
VALUES ('$nome','$senha')";

if ($conn->query($sqlInserirUsuarios) === TRUE) {
    // Redirecionar para a página index.php após a inserção bem-sucedida
    header("Location: login.php");
    exit;
} else {
    echo "Erro ao inserir dados: " . $conn->error;
}

$conn->close();
?>
