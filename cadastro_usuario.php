<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Criar conta - CostPilot</title>
    <link rel="stylesheet" href="css/cadastro.css">
</head>

<body class="bg-light">

    <?php include 'navbar.php'; ?>

    <div class="register-container d-flex justify-content-center align-items-start mt-5">
        <div class="register-card card shadow p-4">
            <div class="text-center mb-3">
                <h4 class="mt-2"><strong>Criar nova conta</strong></h4>
            </div>

            <form id="form_cadastro">
                <div class="mb-3">
                    <label for="cadastro_nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="cadastro_nome" name="nome" required>
                    <div class="invalid-feedback">Prencha o campo</div>
                </div>

                <div class="mb-3">
                    <label for="cadastro_email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="cadastro_email" name="email" required>
                    <div class="invalid-feedback">E-mail inválido.</div>
                </div>

                <div class="mb-3">
                    <label for="cadastro_senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="cadastro_senha" name="senha" required>
                    <div class="invalid-feedback">A Senha deve ter no mínimo 6 caracteres.</div>
                </div>

                <div class="mb-3">
                    <label for="cadastro_confirma_senha" class="form-label">Confirma Senha</label>
                    <input type="password" class="form-control" id="cadastro_confirma_senha" name="confirmaSenha" required>
                    <div class="invalid-feedback">As senhas não coincidem.</div>
                </div>

                <button id="btn_cadastro_usuarios" class="btn btn-primary w-100" type="submit">Cadastrar</button>

                <div class="text-center mt-3 small">
                    Já tem uma conta? <a href="login.php">Entrar</a>
                </div>

                <p class="text-center text-muted mt-4 small">
                    Preparado para controlar seus custos como um piloto de elite?
                </p>
            </form>
        </div>
    </div>

    <script src="/js/cadastro_usuario.js"></script>
    <script src="/js/itens_basicos.js"></script>
</body>

</html>
