<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login - CostPilot</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="bg-light">

    <?php include 'navbar.php'; ?>

    <div class="login-container d-flex justify-content-center align-items-start mt-5">
        <div class="login-card card shadow p-4">
            <div class="text-center mb-3">
                <h4 class="mt-2" style="color: #1E4359;"><strong>Bem-vindo de volta!</strong></h4>
            </div>

            <form id="loginForm">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email_login" name="email">
                    <div class="invalid-feedback">Insira um e-mail válido.</div>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha_login" name="senha">
                    <div class="invalid-feedback">Senha deve ter no mínimo 6 caracteres.</div>
                </div>

                <button type="submit" class="btn btn-primary w-100" style="background-color: #63a5bf;">Entrar</button>

                <div class="d-flex justify-content-between mt-2">
                    <a href="#" class="text-success small">Esqueci minha senha</a>
                    <a href="cadastro_usuario.php" class="text-success small">Criar conta</a>
                </div>
            </form>

            <p class="text-center text-muted mt-4 small">
                Que bom ter você por aqui, pronto para pilotar seus custos?
            </p>
        </div>
    </div>

    <script src="js/login.js"></script>
    <script src="js/itens_basicos.js"></script>
</body>

</html>