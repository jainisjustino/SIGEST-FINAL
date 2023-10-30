<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: paginaInicial.php');
    exit;
}

// Verifique se o botão "Excluir Conta" foi clicado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['excluir_conta'])) {
    $host = "localhost";
    $usuario_bd = "root";
    $senha_bd = "";
    $nome_bd = "test";

    try {//$conn = mysqli_connect($host, $usuario_bd, $senha_bd, $nome_bd);
 $conn = new PDO("mysql:host=$host;dbname=$nome_db",$usuario_bd,$senha_bd);

    if (!$conn) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $idUsuarioExcluir = $_SESSION['idUsuario'];
    echo $idUsuarioExcluir;


    // Consulta SQL para excluir o usuário
    $deleteQuery = "DELETE FROM usuarios WHERE id=$idUsuarioExcluir";

    $conn->exec($deleteQuery);


    //if (mysqli_query($conn, $deleteQuery)) {
        //if ($conn->query($deleteQuery) === TRUE) {

        echo "deletado";
        // Encerre a sessão antes de redirecionar
        session_unset();  // Limpe todas as variáveis de sessão
        session_destroy(); // Destrói a sessão
        header("Location: login.php"); // Redirecione para a página de login após a exclusão bem-sucedida
        exit();
    } else {
        echo "Erro ao excluir a conta do usuário: " . mysqli_error($conn);
    }

    // Certifique-se de fechar a conexão após o uso
    mysqli_close($conn);
} else {
    // Redirecione de volta para a página de perfil se o botão não foi clicado
    header("Location: perfil.php");
    exit();
}
?>
