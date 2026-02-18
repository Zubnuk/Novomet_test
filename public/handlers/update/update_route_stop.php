<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$routeId   = $_POST['route_id'] ?? null;
$stopId    = $_POST['stop_id'] ?? null;
$stopOrder = $_POST['stop_order'] ?? null;

if (!$routeId || !$stopId || !$stopOrder) {
    exit('Все поля обязательны');
}

$sql = "UPDATE route_stop
        SET stop_order = :stop_order
        WHERE route_id = :route_id
          AND stop_id = :stop_id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':route_id'   => $routeId,
        ':stop_id'    => $stopId,
        ':stop_order' => $stopOrder
    ]);

    echo 'Обновлено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
