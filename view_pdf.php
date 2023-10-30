<!DOCTYPE html>
<html>
<head>
    <title>Visualizar PDF</title>
    <!-- Inclua a biblioteca PDF.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
</head>
<body>
    <?php
    // Recupere o ID do PDF da URL
    if (isset($_GET['pdfId'])) {
        $pdfId = $_GET['pdfId'];

        // Consulte o banco de dados para obter o nome do arquivo PDF com base no ID
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";

        // Crie uma conexão com o banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifique a conexão
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Consulta SQL para obter o nome do arquivo PDF com base no ID
        $sql = "SELECT documento FROM tratamento WHERE id = $paciente_id";

        // Execute a consulta SQL
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $pdfFileName = $row['documento'];

            echo '<h1>Visualizar PDF: ' . $pdfFileName . '</h1>';
            echo '<canvas id="pdfViewer" style="border: 1px solid black;"></canvas>';

            // Inclua o JavaScript para exibir o PDF usando PDF.js
            echo '<script>
                    pdfjsLib.getDocument("' . $pdfFileName . '").then(function(pdf) {
                        pdf.getPage(1).then(function(page) {
                            var canvas = document.getElementById("pdfViewer");
                            var context = canvas.getContext("2d");
                            var viewport = page.getViewport({ scale: 1.0 });

                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            page.render({ canvasContext: context, viewport: viewport });
                        });
                    });
                  </script>';
        } else {
            echo 'PDF não encontrado.';
        }

        // Feche a conexão com o banco de dados
        $conn->close();
    } else {
        echo 'Nenhum ID de PDF especificado.';
    }
    ?>
</body>
</html>
