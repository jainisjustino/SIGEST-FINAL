<?php
session_start();
session_destroy(); // Destruir a sessão atual
header('Location: login.php'); // Redirecionar para a página de login
exit;
?>