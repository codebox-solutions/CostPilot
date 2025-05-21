<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h4 class="mb-3">Histórico de Simulações</h4>

        <div class="filtros">
            <input type="text" id="filtro_nome_simulacoes" placeholder="Buscar por nome..." />

            <select id="filtro_interpolacao_simulacoes">
                <option value="" disabled selected>Tipo de Interpolação</option>
                <option value="Linear">Linear</option>
                <option value="Polinomial">Polinomial</option>
            </select>

            <input type="date" id="filtro_data_simulacoes" />
            <button id="btn_criar_nova_simulacao" class="btn btn-secondary" style="background-color: #1e4359;" >
                Nova Simulação
            </button>

            <button class="btn btn-dark">Relatórios</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Nome da Simulação</th>
                        <th scope="col">Tipo de Interpolação</th>
                        <th scope="col">Data</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody id="tabela_simulacoes">


                </tbody>
            </table>
        </div>
    </div>

    <script src="js/dashboard.js"></script>
</body>

</html>