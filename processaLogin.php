<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $query = "SELECT * FROM usuarios WHERE nome='$nome' AND senha='$senha'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
    session_start();

    $row = mysqli_fetch_assoc($result);
    $_SESSION['idUsuario'] = $row['id'];
    
    $_SESSION['logged_in'] = true;
    $_SESSION['nomeUsuario'] = $nome;
    $_SESSION['senhaUsuario'] = $senha;
     
        header("Location: index.php");
    exit;
    } else {
        echo "Nome de usuário ou senha incorretos!";
    }
    
    mysqli_close($conn);
}
    ?>