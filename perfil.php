<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="css/perfil.css">
</head>

<body>
    <div class="container py-5">
        <div class="card shadow p-4">

            <div class="d-flex align-items-center justify-content-between w-100 mb-4">
                <div class="d-flex align-items-center gap-3">
                    <div id="perfil_avatar_usuario" class="avatar-circle d-flex align-items-center justify-content-center fs-5">
                        <?= strtoupper(substr($_SESSION['usuario'], 0, 2)) ?>
                    </div>
                    <h5 id="perfil_nome_usuario" class="mb-0 fw-bold"></h5>
                </div>

                <span class="text-muted">ID do usuário: #<span id="perfil_id_usuario"></span></span>
            </div>

            <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap">
                <div>
                    <p class="fw-bold mb-1">Informações Pessoais</p>
                    <p class="mb-1">Nome: <span id="perfil_segundo_nome_usuario"></span></p>
                    <p class="mb-1">E-mail: <span id="perfil_email_usuario"></span></p>
                </div>
                <a style="background-color: #1e4359" id="btn_alterar_email_usuario" class="btn btn-dark mt-2 mt-md-0">Alterar Email</a>
            </div>

            <div class="d-flex justify-content-between align-items-start flex-wrap">
                <div>
                    <p class="fw-bold mb-1">Segurança</p>
                    <p class="mb-1">Último Login: <span id="perfil_ultimo_login_usuario"></span></p>
                </div>
                <a style="background-color: #1e4359;" id="btn_alterar_senha_usuario" class="btn btn-dark mt-2 mt-md-0">Alterar Senha</a>
            </div>

        </div>
    </div>
    <script src="js/perfil.js"></script>
</body>

</html>