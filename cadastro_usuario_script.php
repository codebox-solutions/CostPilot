<?php
header('Content-Type: application/json');
require_once 'conexao.php';

try {
    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($nome) || empty($email) || empty($senha)) {
        echo json_encode([ 'status' => 'erro','mensagem' => 'Todos os campos são obrigatórios.']);
        exit;
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        http_response_code(409);
        echo json_encode([ 'status' => 'erro','mensagem' => 'E-mail já está cadastrado.']);
        exit;
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $senhaHash]);

    echo json_encode(['status' => 'sucesso','mensagem' => 'Usuário cadastrado com sucesso!']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([ 'status' => 'erro','mensagem' => 'Erro ao cadastrar usuário.', 'erro' => $e->getMessage()]);
}
