<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cadastro de pacientes</title>
</head>
<body>
    <!-- Campos do paciente -->
    <div class="div1">
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" placeholder="" required>
    </div>

    <!-- Campos para procedimentos -->
    <div class="procedimentos">
        <div class="procedimento-template" style="display: none;">
            <div class="procedimento">
                <label for="data_procedimento">Data do procedimento</label>
                <input type="date" name="data_procedimento[]" required>
                
                <label for="dente">Dente</label>
                <input type="text" name="dente[]" required>
                
                <label for="preco">Preço</label>
                <input type="text" name="preco[]" required>
            </div>
        </div>
    </div>
    <button id="adicionar_procedimento" type="button">Adicionar Procedimento</button>

    <script>
        document.getElementById("adicionar_procedimento").addEventListener("click", function() {
            const procedimentoTemplate = document.querySelector(".procedimento-template");
            const clone = procedimentoTemplate.cloneNode(true);
            clone.style.display = "block"; // Exibir o procedimento clonado
            document.querySelector(".procedimentos").appendChild(clone);
        });
    </script>
</body>
</html>
