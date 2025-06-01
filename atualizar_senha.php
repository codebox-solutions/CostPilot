<?php
session_start();
include 'conexao.php';

if (isset($_POST['id'], $_POST['nova_senha'])) {
    $id = intval($_POST['id']);
    $nova_senha = $_POST['nova_senha'];

    if (strlen($nova_senha) < 6) {
        echo "A senha deve ter pelo menos 6 caracteres.";
        exit;
    }

    $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
    if ($stmt->execute([$senha_hash, $id])) {
        echo "Senha atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar a senha.";
    }
} else {
    echo "Dados incompletos.";
}
