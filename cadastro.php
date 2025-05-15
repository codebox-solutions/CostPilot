<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Criar conta - CostPilot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cadastro.css">
</head>

<body class="bg-light">

    <?php include 'navbar.php'; ?>

    <div class="register-container d-flex justify-content-center align-items-start mt-5">
        <div class="register-card card shadow p-4">
            <div class="text-center mb-3">
                <h4 class="mt-2"><strong>Criar nova conta</strong></h4>
            </div>

            <form id="form_cadastro" method="POST" action="cadastrar_script.php">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="cadastro_nome" name="nome">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="cadastro_email" name="email">
                    <div class="invalid-feedback">E-mail inválido.</div>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="cadastro_senha" name="senha">
                    <div class="invalid-feedback">A Senha deve ter no mínimo 6 caracteres.</div>
                </div>

                <div class="mb-3">
                    <label for="confirmaSenha" class="form-label">Confirma Senha</label>
                    <input type="password" class="form-control" id="confirma_senha_cadastro" name="confirmaSenha">
                    <div class="invalid-feedback">As senhas não coincidem.</div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>

                <div class="text-center mt-3 small">
                    Já tem uma conta? <a href="login.php">Entrar</a>
                </div>

                <p class="text-center text-muted mt-4 small">
                    Preparado para controlar seus custos como um piloto de elite?
                </p>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="cadastro.js"></script>
</body>

</html>