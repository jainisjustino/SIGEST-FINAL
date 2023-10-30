<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'sigest123@gmail.com';
$mail->Password = 'efvordkhbojdybxl';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('sigest123@gmail.com');

$mail->addAddress($_POST["email"]);  // Fix the typo here

$mail->isHTML(true);

return $mail

?>
