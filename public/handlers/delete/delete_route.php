<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$routeId = $_POST['route_id'] ?? null;

if (!$routeId) {
    exit('ID обязателен');
}

$sql = "DELETE FROM route WHERE route_id = :route_id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':route_id' => $routeId
    ]);

    echo 'Удалено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
