<?php
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CostPilot</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <div class="hero-section">
        <h1>CostPilot, descomplicando seu cálculo de finanças</h1>
        <h3>Transformamos números em decisões estratégicas. Descubra como nossa tecnologia calcula o preço ideal e projeta seu crescimento.</h3>
    </div>

    <div>
        <h3 class="text-center">Nosso Processo em 4 Etapas</h3>
        <div class="container my-4">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <div class="custom-card">
                        <i class="bi bi-box-seam"></i>
                        <div class="custom-title">Informe o que está vendendo</div>
                        <div class="custom-text">Descreva seu produto ou serviço e seu preço atual. Nós analisamos, você decide.</div>
                    </div>
                </div>
                <div class="col">
                    <div class="custom-card">
                        <i class="bi bi-cash-stack"></i>
                        <div class="custom-title">Adicione seus custos</div>
                        <div class="custom-text">Insira despesas fixas e variáveis: materiais, impostos, logística, marketing, etc.</div>
                    </div>
                </div>
                <div class="col">
                    <div class="custom-card">
                        <i class="bi bi-bar-chart-line"></i>
                        <div class="custom-title">Receba o preço ideal</div>
                        <div class="custom-text">Com base na margem esperada, mostramos o valor ideal para seu produto/serviço.</div>
                    </div>
                </div>
                <div class="col">
                    <div class="custom-card">
                        <i class="bi bi-graph-up"></i>
                        <div class="custom-title">Acompanhe o crescimento</div>
                        <div class="custom-text">Gráficos, projeções, previsões de lucro e muito mais em tempo real.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="highlight-section mt-5">
        <h1>
            CostPilot tem o que é preciso para <span class="text-accent">gerenciar seu lucro</span> com inteligência
        </h1>
    </div>

    <div class="two-column-section">
        <div class="logo-column">
            <img src="img/logo.png" alt="Logo" style="border-radius: 20px;">
        </div>
        <div class="text-column">
            <h2 class="text-center">
                Automatize e <span class="text-accent">poupe tempo</span> com a Costpilot
            </h2>
            <p class="text-center">
                A plataforma ideal para micro e pequenas empresas que querem lucrar mais, entender seus números e prever o futuro com confiança.
            </p>
        </div>
    </div>

    <h3 class="mt-5 mb-5 text-center">
        Recursos para <span class="text-accent">facilitar a gestão</span> das suas finanças
    </h3>

    <div class="container my-3">
        <div class="row row-cols-1 row-cols-md-3 g-3">
            <div class="col">
                <div class="custom-card">
                    <i class="bi bi-graph-up"></i>
                    <div class="custom-title">Simulações inteligentes</div>
                    <div class="custom-text">Calcule com base em margens, custos variáveis e fixos para prever lucros com precisão.</div>
                </div>
            </div>
            <div class="col">
                <div class="custom-card">
                    <i class="bi bi-filetype-pdf"></i>
                    <div class="custom-title">Exportação em PDF</div>
                    <div class="custom-text">Gere relatórios prontos para imprimir ou compartilhar com seus parceiros e clientes.</div>
                </div>
            </div>
            <div class="col">
                <div class="custom-card">
                    <i class="bi bi-bar-chart-line"></i>
                    <div class="custom-title">Previsões de preço</div>
                    <div class="custom-text">Use simulações para prever valores de venda com base nos custos atuais e metas de lucro.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="cta-box mt-5 mb-5">
        <p>Se junte a nós e facilite sua gestão financeira com a CostPilot</p>
        <a href="login.php" class="cta-button">Comece agora</a>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>