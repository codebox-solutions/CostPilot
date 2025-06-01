<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $productName = $_POST['productname'] ?? '';
    $custoFixo = floatval($_POST['custofixo'] ?? 0);
    $custoVariavel = floatval($_POST['custovariavel'] ?? 0);
    $volume = intval($_POST['volume'] ?? 0);
    $margemLucro = floatval($_POST['margemlucro'] ?? 0);
    $impostos = floatval($_POST['impostos'] ?? 0);

    $usarJuros = isset($_POST['juroscompostos']);
    $taxaJuros = floatval($_POST['taxa_juros'] ?? 0);
    $periodoJuros = intval($_POST['periodo_juros'] ?? 0);

    $usarFluxo = isset($_POST['fluxocaixa']);
    $horizonteFluxo = intval($_POST['horizonte_fluxo'] ?? 0);

    $interpolacao = $_POST['interpolacao'] ?? 'linear';

    $custoTotal = $custoFixo + ($custoVariavel * $volume);

    $receitaBruta = $custoTotal * (1 + ($margemLucro / 100));

    if ($impostos > 0) {
        $receitaLiquida = $receitaBruta * (1 - ($impostos / 100));
    } else {
        $receitaLiquida = $receitaBruta;
    }

    $lucroEstimado = $receitaLiquida - $custoTotal;

    if ($usarJuros && $taxaJuros > 0 && $periodoJuros > 0) {
        $fatorJuros = pow((1 + ($taxaJuros / 100)), $periodoJuros);
        $lucroComJuros = $lucroEstimado * $fatorJuros;
    } else {
        $lucroComJuros = $lucroEstimado;
    }

    if ($usarFluxo && $horizonteFluxo > 0) {
        $fluxoCaixa = [];
        $valorPorPeriodo = $lucroComJuros / $horizonteFluxo;
        for ($i = 1; $i <= $horizonteFluxo; $i++) {
            $fluxoCaixa[] = $valorPorPeriodo;
        }
    } else {
        $fluxoCaixa = null;
    }

    $tipoInterpolacao = $interpolacao;

    echo "<h2>Resultado da Simulação</h2>";
    echo "<p><strong>Produto:</strong> $productName</p>";
    echo "<p><strong>Custo Total:</strong> R$ " . number_format($custoTotal, 2, ',', '.') . "</p>";
    echo "<p><strong>Receita Líquida:</strong> R$ " . number_format($receitaLiquida, 2, ',', '.') . "</p>";
    echo "<p><strong>Lucro Estimado:</strong> R$ " . number_format($lucroEstimado, 2, ',', '.') . "</p>";

    if ($usarJuros) {
        echo "<p><strong>Lucro com Juros Compostos:</strong> R$ " . number_format($lucroComJuros, 2, ',', '.') . "</p>";
    }

    if ($usarFluxo) {
        echo "<h4>Fluxo de Caixa (R$ por período):</h4><ul>";
        foreach ($fluxoCaixa as $periodo => $valor) {
            echo "<li>Período " . ($periodo + 1) . ": R$ " . number_format($valor, 2, ',', '.') . "</li>";
        }
        echo "</ul>";
    }

    echo "<p><strong>Tipo de Interpolação Escolhido:</strong> $tipoInterpolacao</p>";

} else {
    echo "Acesso inválido.";
}
?>
