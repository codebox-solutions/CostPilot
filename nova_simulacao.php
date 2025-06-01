<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conexao.php';

$resultado = null;
$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pegando dados do formulário
    $nome = $_POST['productname'] ?? '';
    $custo_fixo = floatval($_POST['custofixo'] ?? 0);
    $custo_variavel = floatval($_POST['custovariavel'] ?? 0);
    $volume = intval($_POST['volume'] ?? 1);
    $margem_lucro = floatval($_POST['margemlucro'] ?? 0) / 100;
    $impostos = floatval($_POST['impostos'] ?? 0) / 100;

    $usar_juros = isset($_POST['juroscompostos']);
    $taxa_juros = floatval($_POST['taxa_juros'] ?? 0) / 100;
    $periodo_juros = intval($_POST['periodo_juros'] ?? 0);

    $usar_fluxo = isset($_POST['fluxocaixa']);
    $horizonte_fluxo = intval($_POST['horizonte_fluxo'] ?? 0);

    $interpolacao = $_POST['interpolacao'] ?? 'linear';

    try {
        // Cálculo base
        $custo_total = $custo_fixo + ($custo_variavel * $volume);
        $custo_unitario = $custo_total / $volume;

        $preco_venda_bruto = $custo_unitario / (1 - $margem_lucro);
        $preco_venda_liquido = $preco_venda_bruto / (1 - $impostos);

        // Aplicando juros compostos se selecionado
        if ($usar_juros && $taxa_juros > 0 && $periodo_juros > 0) {
            $fator_juros = pow(1 + $taxa_juros, $periodo_juros);
            $preco_venda_liquido *= $fator_juros;
        }

        // Simulação de fluxo de caixa (se selecionado)
        $fluxo_caixa = [];
        if ($usar_fluxo && $horizonte_fluxo > 0) {
            for ($i = 1; $i <= $horizonte_fluxo; $i++) {
                if ($interpolacao == 'linear') {
                    $fluxo_caixa[$i] = $preco_venda_liquido * $volume;
                } elseif ($interpolacao == 'polinomial') {
                    $fluxo_caixa[$i] = $preco_venda_liquido * $volume * pow($i, 2);
                }
            }
        }

        // Resultado organizado
        $resultado = [
            'nome' => htmlspecialchars($nome),
            'preco_venda' => number_format($preco_venda_liquido, 2, ',', '.'),
            'custo_unitario' => number_format($custo_unitario, 2, ',', '.'),
            'fluxo_caixa' => $fluxo_caixa,
        ];
    } catch (Exception $e) {
        $erro = "Erro no cálculo: " . $e->getMessage();
    }
}
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
            <form class="simform" method="POST" action="">
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

        <?php if ($resultado) : ?>
            <div class="resultado mt-4 p-4 border bg-white rounded">
                <h3>Resultado da Simulação</h3>
                <p><strong>Produto:</strong> <?= $resultado['nome'] ?></p>
                <p><strong>Custo Unitário:</strong> R$ <?= $resultado['custo_unitario'] ?></p>
                <p><strong>Preço de Venda Sugerido:</strong> R$ <?= $resultado['preco_venda'] ?></p>

                <?php if (!empty($resultado['fluxo_caixa'])) : ?>
                    <h4>Fluxo de Caixa</h4>
                    <ul>
                        <?php foreach ($resultado['fluxo_caixa'] as $periodo => $valor) : ?>
                            <li>Período <?= $periodo ?>: R$ <?= number_format($valor, 2, ',', '.') ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php elseif ($erro) : ?>
            <div class="alert alert-danger mt-4"><?= $erro ?></div>
        <?php endif; ?>
    </div>

    <script src="js/nova_simulacao.js"></script>
</body>

</html>
