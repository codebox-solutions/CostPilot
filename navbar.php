<?php
session_start();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="css/navbar.css">

<nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background: white;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="img/logo.png" alt="CostPilot Logo" height="50">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Simulações</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Relatórios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Configurações</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
                    <li class="nav-item">
                        <span class="nav-link disabled">
                            <div class="avatar-circle">
                                <?= strtoupper(substr($_SESSION['usuario'], 0, 2)) ?>
                            </div>
                        </span>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=cadastro">Cadastro</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <i class="bi bi-person-circle"></i> Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<script src="js/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>