<?php
session_start();
header('Content-Type: application/json');

include 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['erro' => 'Usuário não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$nome = $_GET['nome'] ?? '';
$tipo = $_GET['tipo'] ?? '';
$data = $_GET['data'] ?? '';

$nome_like = '%' . $nome . '%';

// Passa null para os parâmetros vazios
$tipo = $tipo === '' ? null : $tipo;
$data = $data === '' ? null : $data;

$sql = "
SELECT id, product_name, interpolation_type, created_at
FROM simulations
WHERE user_id = ?
AND product_name LIKE ?
AND ( ? IS NULL OR interpolation_type = ? )
AND ( ? IS NULL OR DATE(created_at) = ? )
ORDER BY created_at DESC
";

try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $usuario_id,
        $nome_like,
        $tipo,
        $tipo,
        $data,
        $data,
    ]);

    $simulacoes = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $simulacoes[] = [
            'id' => (int)$row['id'],
            'nome' => $row['product_name'],
            'tipo' => $row['interpolation_type'],
            'data' => date("d/m/Y H:i", strtotime($row['created_at']))
        ];
    }

    echo json_encode($simulacoes);

} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro na consulta: ' . $e->getMessage()]);
}
