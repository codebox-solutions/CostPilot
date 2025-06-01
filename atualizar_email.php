<?php
session_start();
include 'conexao.php';

if (isset($_POST['id'], $_POST['novo_email'])) {
    $id = intval($_POST['id']);
    $novo_email = trim($_POST['novo_email']);


    if (!filter_var($novo_email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido.";
        exit;
    }


    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $stmt->execute([$novo_email, $id]);

    if ($stmt->rowCount() > 0) {
        echo "Este email já está em uso.";
        exit;
    }


    $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
    if ($stmt->execute([$novo_email, $id])) {
        $_SESSION['email'] = $novo_email;
        echo "Email atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o email.";
    }
} else {
    echo "Dados incompletos.";
}
