<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda do Dia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .tabela-agenda {
            max-width: 800px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }
        #hora {
            width:70px;
        }
    </style>
</head>
<body>
    <div class="tabela-agenda">
        <h2><span id="data-selecionada"></span></h2>
        <table>
            <thead>
                <tr>
                    <th id="hora">Hora</th>
                    <th id="nome">Atividade</th>
                </tr>
            </thead>
            <tbody id="horarios-do-dia">
                <!-- JavaScript irá gerar os horários aqui -->
            </tbody>
        </table>
    </div>

    <script>
        const dataSelecionada = document.getElementById('data-selecionada');
        const horariosDoDia = document.getElementById('horarios-do-dia');

        // Função para obter a data da URL
        function obterDataDaURL() {
            const parametros = new URLSearchParams(window.location.search);
            return parametros.get('data');
        }

        // Função para exibir a data selecionada
        function exibirDataSelecionada() {
            const data = obterDataDaURL();
            if (data) {
                dataSelecionada.textContent = data;
            }
        }

        // Função para gerar os horários do dia (das 8h às 20h, a cada 15 minutos)
        function gerarHorariosDoDia() {
            const horaInicial = 8; // Hora de início
            const horaFinal = 20;  // Hora de término

            for (let hora = horaInicial; hora <= horaFinal; hora++) {
                for (let minuto = 0; minuto < 60; minuto += 15) {
                    const horaFormatada = hora.toString().padStart(2, '0');
                    const minutoFormatado = minuto.toString().padStart(2, '0');

                    const linha = document.createElement('tr');
                    const colunaHora = document.createElement('td');
                    const colunaAtividade = document.createElement('td');

                    colunaHora.textContent = `${horaFormatada}:${minutoFormatado}`;
                    colunaAtividade.textContent = ''; // Você pode adicionar atividades aqui se necessário

                    linha.appendChild(colunaHora);
                    linha.appendChild(colunaAtividade);
                    horariosDoDia.appendChild(linha);
                }
            }
        }

        exibirDataSelecionada();
        gerarHorariosDoDia();
    </script>
</body>
</html>
