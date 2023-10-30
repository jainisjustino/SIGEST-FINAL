<?php

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Função para enviar um email
function enviarEmail($email, $mensagem) {
    $mail = new PHPMailer(true);

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sigest123@gmail.com';
    $mail->Password   = 'ggzw wupv nzez sgyu';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('sigest123@gmail.com');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Lembrete de consulta';
    $mail->Body    = $mensagem;

    $mail->send();
}

// Conexão com o banco de dados
$host = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$nome_bd = "test";

$conn = mysqli_connect($host, $usuario_bd, $senha_bd, $nome_bd);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
if (isset($_GET['data'])) {
   $dataAmanha = $_GET['data'];
   $dataAmanhaFormatada = date("d/m/Y", strtotime($dataAmanha));
} else {
}


$sql = "SELECT email, dataHora FROM agenda WHERE DATE(dataHora) = '$dataAmanha'";
$result = mysqli_query($conn, $sql);



if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $emailPaciente = $row['email'];

        // Verifique se o email é válido antes de enviar
        if (filter_var($emailPaciente, FILTER_VALIDATE_EMAIL)) {
            $mensagem = "Voce tem um horario marcado com a Dra. Roselaine Fagundes em $dataAmanhaFormatada.";
            enviarEmail($emailPaciente, $mensagem);

            header ("location: agenda.php");
        } else {
            echo "Endereço de email inválido: $emailPaciente";
        }
    }
}

mysqli_close($conn);
?>

