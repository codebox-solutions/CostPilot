<?php

include 'conexao.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'ID inválido'
        ]);
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM simulations WHERE id = ?");
    $stmt->execute([(int) $_GET['id']]);

    $simulacao = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($simulacao) {
        echo json_encode([
            'status' => 'sucesso',
            'data' => $simulacao
        ]);
    } else {
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'Simulação não encontrada'
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro na conexão: ' . $e->getMessage()
    ]);
}