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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verificamos se o ID para excluir foi passado via POST
  if (isset($_POST["id"])) {
      $id_para_excluir = $_POST["id"];
        echo 'ID para excluir: ' . $id_para_excluir;}

        $sql_excluir_tratamento = "DELETE FROM tratamento WHERE paciente_id = $id_para_excluir";

        if ($conn->query($sql_excluir_tratamento)) {
            
        } else {
            echo "Erro ao excluir dados de tratamento relacionados: " . $conn->error;
        }
    
        // Agora você pode continuar com a exclusão do paciente na tabela "pacientes"
        $sql_excluir_paciente = "DELETE FROM pacientes WHERE id = $id_para_excluir";
    
        if ($conn->query($sql_excluir_paciente)) {
          header("Location: listagemProntuarios.php"); // Redirecione para a página de login após a exclusão bem-sucedida
          exit();
        } else {
            echo "Erro ao excluir paciente: " . $conn->error;
        }
    }

$conn->close();
?>