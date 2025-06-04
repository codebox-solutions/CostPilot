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

$params = [$usuario_id, $nome_like];
$sql = "
SELECT id, product_name, interpolation_type, created_at
FROM simulations
WHERE user_id = ?
AND product_name LIKE ?
";


if (!empty($tipo)) {
    $sql .= " AND interpolation_type = ? ";
    $params[] = $tipo;
}


if (!empty($data)) {

    $data_formatada = date('Y-m-d', strtotime($data));
    $sql .= " AND DATE(created_at) = ? ";
    $params[] = $data_formatada;
}

$sql .= " ORDER BY created_at DESC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $simulacoes = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $simulacoes[] = [
            'id' => (int)$row['id'],
            'nome' => $row['product_name'],
            'tipo' => $row['interpolation_type'],
            'data' => date("d/m/Y", strtotime($row['created_at']))
        ];
    }

    echo json_encode($simulacoes);

} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro na consulta: ' . $e->getMessage()]);
}
