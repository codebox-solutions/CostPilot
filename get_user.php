<?php
session_start();
header('Content-Type: application/json');

include 'conexao.php';

function resposta_json($status, $dados = null, $mensagem = null) {
    $resposta = ['status' => $status];
    if ($dados !== null) {
        $resposta['data'] = $dados;
    }
    if ($mensagem !== null) {
        $resposta['mensagem'] = $mensagem;
    }
    echo json_encode($resposta);
    exit;
}

if (!isset($_SESSION['usuario_id'])) {
    resposta_json('erro', null, 'Usuário não autenticado.');
}

$usuario_id = $_SESSION['usuario_id'];

try {
    $stmt = $pdo->prepare("SELECT id, name, email, profile_picture, last_login FROM users WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        resposta_json('sucesso', $usuario);
    } else {
        resposta_json('erro', null, 'Usuário não encontrado.');
    }

} catch (PDOException $e) {
    resposta_json('erro', null, 'Erro na conexão: ' . $e->getMessage());
}
