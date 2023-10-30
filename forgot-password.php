<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" >
    <title>Esqueci a senha</title>
</head>
<body>


    <form method="post" action="send-password-reset.php">
    <h1>Esqueci a senha</h1><br>

        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" class="input_1"><br>


        <button class="login">Enviar</button><br>
        <a class="link" href="login.php" name="back">Lembrou?</a><br>


    </form>
</body>
</html>