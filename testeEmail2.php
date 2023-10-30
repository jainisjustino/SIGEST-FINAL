<?php
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;

//use PHPMailer\PHPMailer;
//use PHPMailer\SMTP;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$email = new PHPMailer(TRUE);

$host = 'smtp.gmail.com'; // Endereço do servidor SMTP
$port = 587; // Porta SMTP
$username = 'sigest123@gmail.com'; // Seu e-mail
$password = 'efvordkhbojdybxl'; // Sua senha
$secure = PHPMailer::ENCRYPTION_STARTTLS;


// Crie uma instância do PHPMailer
$email = new PHPMailer(true);

try {
    // Configurar o servidor SMTP
    $email->isSMTP();
    $email->Host = $host;
    $email->SMTPAuth = true;
    $email->Username = $username;
    $email->Password = $password;
    $email->SMTPSecure = $secure;
    $email->Port = $port;

    // Remetente e destinatário do e-mail
    $email->setFrom('sigest123@gmail.com', 'SIGEST');
    $email->addAddress('jainisjustino@gmail.com', 'Jaíni');

    // Conteúdo do e-mail
    $email->isHTML(true);
    $email->Subject = 'Lembrete de consulta';
    $email->Body = 'consulta para dia x';

    // Envie o e-mail
    $email->send();
    echo 'E-mail enviado com sucesso';
} catch (Exception $e) {
    echo "Erro ao enviar o e-mail: {$email->ErrorInfo}";
}
?>