<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Criar Simulação - CostPilot</title>
    <link rel="stylesheet" href="css/nova_simulacao.css" />
</head>

<body class="bg-light">

    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2 class="title">Nova Simulação</h2>
        <div class="mt-3">
            <form class="simform">
                <div class="form-group">
                    <label for="nome_nova_simulacao">Nome do produto:</label>
                    <input type="text" id="nome_nova_simulacao" class="form-control" name="productname" placeholder="Ex: Camisa Gucci Tamanho P" required />
                </div>

                <div class="form-group">
                    <label for="custo_fixo">Custo Fixo (R$):</label>
                    <input type="number" min="0" step="0.01" id="custo_fixo" class="form-control" name="custofixo" required />
                </div>

                <div class="form-group">
                    <label for="custo_variavel">Custo Variável Unitário (R$):</label>
                    <input type="number" min="0" step="0.01" id="custo_variavel" class="form-control" name="custovariavel" required />
                </div>

                <div class="form-group">
                    <label for="volume">Volume Produzido/Vendido:</label>
                    <input type="number" min="1" step="1" id="volume" class="form-control" name="volume" required />
                </div>

                <div class="form-group">
                    <label for="margem_lucro">Margem de Lucro Desejada (%):</label>
                    <input type="number" min="0" step="0.01" id="margem_lucro" class="form-control" name="margemlucro" required />
                </div>

                <div class="form-group">
                    <label for="impostos">Impostos (Opcional, %):</label>
                    <input type="number" min="0" step="0.01" id="impostos" class="form-control" name="impostos" />
                </div>

                <button id="btn_opcoes_avancadas" type="button" class="btn btn-primary acordiao_btn">+ Opções Avançadas</button>

                <div class="acordiao">
                    <div class="conteudo">
                        <div class="form-check mb-3">
                            <input type="checkbox" id="juros_compostos" class="form-check-input" name="juroscompostos" />
                            <label for="juros_compostos" class="form-check-label">Aplicar juros compostos contínuos</label>
                        </div>

                        <div class="juros_campos" style="display: none;">
                            <div class="form-group">
                                <label for="taxa_juros">Taxa de Juros (%) ao período:</label>
                                <input type="number" min="0" step="0.01" id="taxa_juros" class="form-control" name="taxa_juros" placeholder="Ex: 1.5" />
                            </div>

                            <div class="form-group">
                                <label for="periodo_juros">Período (em meses):</label>
                                <input type="number" min="1" step="1" id="periodo_juros" class="form-control" name="periodo_juros" placeholder="Ex: 12" />
                            </div>
                        </div>

                        <div class="form-check my-3">
                            <input type="checkbox" id="fluxo_caixa" class="form-check-input" name="fluxocaixa" />
                            <label for="fluxo_caixa" class="form-check-label">Inserir previsão de fluxo de caixa</label>
                        </div>

                        <div class="fluxo_campos" style="display: none;">
                            <div class="form-group">
                                <label for="horizonte_fluxo">Horizonte de Fluxo de Caixa (nº de períodos):</label>
                                <input type="number" min="1" step="1" id="horizonte_fluxo" class="form-control" name="horizonte_fluxo" placeholder="Ex: 24" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="interpolacao">Tipo de Interpolação</label>
                            <select id="interpolacao" name="interpolacao" class="form-select">
                                <option value="linear">Linear</option>
                                <option value="polinomial">Polinomial</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary d-block mx-auto" style="width: 500px;">Calcular</button>

            </form>
        </div>
    </div>

    <script src="js/nova_simulacao.js"></script>
</body>

</html>