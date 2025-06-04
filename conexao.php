<?php
$envPath = __DIR__ . '/.env';

if (!file_exists($envPath)) {
    die("Arquivo .env não encontrado.");
}

$env = parse_ini_file($envPath);

$host = $env['DB_HOST'] ?? '';
$dbname = $env['DB_NAME'] ?? '';
$user = $env['DB_USER'] ?? '';
$pass = $env['DB_PASS'] ?? '';

if (empty($host) || empty($dbname) || empty($user) || empty($pass)) {
    die("Algumas variáveis de configuração do banco de dados estão faltando.");
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
