<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Criar Simulação - CostPilot</title>
    <link rel="stylesheet" href="css/nova_simulacao.css">
</head>

<body class="bg-light">

    <?php include 'navbar.php'; ?>

    <div class="container">
        <h1 class="title"><b>Nova Simulação</b></h1>
        <form class="simform">
            <label for="productname"><b>Nome do produto:</b></label><br>
            <input type="text" id="productname" name="productname" placeholder="EX: Camisa Gucci Tamanho P" required><br>

            <label for="custofixo"><b>Custo Fixo (R$):</b></label><br>
            <input type="number" min="1" step="any" id="custofixo" name="custofixo" required><br>

            <label for="custovariavel"><b>Custo Variável (R$):</b></label><br>
            <input type="number" min="1" step="any" id="custovariavel" name="custovariavel" required><br>

            <label for="margemlucro"><b>Margem de Lucro Desejada (%):</b></label><br>
            <input type="number" min="1" step="any" id="margemlucro" name="margemlucro" required><br>

            <label for="impostos"><b>Impostos (Opcional, %):</b></label><br>
            <input type="number" min="1" step="any" id="impostos" name="impostos"><br><br>

            <div class="acordiao">
                <button type="button" class="acordiao_btn">+ Opções Avançadas</button>
                <div class="conteudo">
                    <div class=checkbox>
                        <input type="checkbox" id="juroscompostos" name="juroscompostos">
                        <label for="juroscompostos">Aplicar juros composos contínuos</label><br>
                        <input type="checkbox" id="fluxocaixa" name="fluxocaixa">
                        <label for="fluxocaixa">Inserir previsão de fluxo de caixa</label><br>
                    </div>
                    <label class="interpolacaolabel" for="interpolacao">Tipo de Interpolação</label><br>
                    <select name="interpolacao" id="interpolacao">
                        <option value="linear">Linear</option>
                        <option value="polinomial">Polinomial</option>
                    </select><br>
                </div>
            </div><br>

            <button class="btn" type="submit">Calcular Simulação</button>

        </form>


    </div>
    <script src="js/nova_simulacao.js"></script>
</body>
</html>
