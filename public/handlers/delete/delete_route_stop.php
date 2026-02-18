<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$routeId = $_POST['route_id'] ?? null;
$stopId  = $_POST['stop_id'] ?? null;

if (!$routeId || !$stopId) {
    exit('Все поля обязательны');
}

$sql = "DELETE FROM route_stop
        WHERE route_id = :route_id
          AND stop_id = :stop_id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':route_id' => $routeId,
        ':stop_id'  => $stopId
    ]);

    echo 'Удалено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
