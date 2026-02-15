<?php
require_once __DIR__ . '/../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$routeId = $_POST['route_id'] ?? null;
$stopId = $_POST['stop_id'] ?? null;
$stopOrder = $_POST['stop_order'] ?? null;

if (!$routeId || !$stopId || !$stopOrder) {
    exit('Все поля обязательны');
}

$sql = "INSERT INTO route_stop (route_id, stop_id, stop_order)
        VALUES (:route_id, :stop_id, :stop_order)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':route_id' => $routeId,
        ':stop_id' => $stopId,
        ':stop_order' => $stopOrder
    ]);

    echo 'Сохранено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
