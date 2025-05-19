<?php
session_start();
require_once 'conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

try {
    $stmt = $pdo->prepare("SELECT id, name, password_hash FROM users WHERE email = ?");
    $stmt->execute([$email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['password_hash'])) {
    
        $update = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $update->execute([$usuario['id']]);

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['name'];
        $_SESSION['usuario'] = $usuario['name'];

        echo json_encode(['status' => 'sucesso', 'redirect' => 'dashboard.php']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'E-mail ou senha inválidos.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro no servidor.']);
}
