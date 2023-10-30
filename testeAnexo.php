<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Documento</title>
</head>
<body>
    <h1>Visualizar Documento</h1>

    <!-- Formulário para fazer o upload do documento -->
    <form action="#" method="post" enctype="multipart/form-data">
        <input type="file" name="documentFile">
        <input type="submit" value="Enviar Documento">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["documentFile"])) {
        $documentFile = $_FILES["documentFile"]["tmp_name"];

        if (file_exists($documentFile)) {
            // Gere um nome único para o arquivo
            $fileName = uniqid() . '_' . $_FILES["documentFile"]["name"];
            $uploadDir = 'uploads/';
            $destination = $uploadDir . $fileName;

            if (move_uploaded_file($documentFile, $destination)) {
                // Exibe um link para baixar o documento
                echo '<h2>Documento:</h2>';
                echo '<a href="' . $destination . '" download>Visualizar '. $_FILES["documentFile"] .' </a>';
            } else {
                echo 'Erro ao mover o arquivo para o diretório de destino.';
            }
        } else {
            echo 'Arquivo de documento não encontrado.';
        }
    }
    ?>
</body>
</html>
