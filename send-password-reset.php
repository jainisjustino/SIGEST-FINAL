<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$mysqli = require __DIR__ . "/database.php";

// Check if $mysqli is an instance of mysqli
if (!($mysqli instanceof mysqli)) {
    die('Database connection error');
}

$sql = "UPDATE users
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $mysqli->prepare($sql);

// Check for statement preparation errors
if (!$stmt) {
    die('Error in statement preparation: ' . $mysqli->error);
}

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($mysqli->affected_rows) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom('pileupoficial@gmail.com');
    $mail->addAddress($email);
    $mail->Subject = "Recuperar senha"; // Added semicolon here
    $mail->Body = <<<END
    Clique <a href="http://localhost/loginCopia/reset-password.php?token=$token">Aqui</a>
    para recuperar sua senha.
END;

    try {
        $mail->send();
    } catch (Exception $e) {
        echo "A mensagem não pode ser enviada. Problema com o Mailer {$mail->ErrorInfo}";
    }
}

echo "Mensagem enviada, verifique seu Email.";
?>
