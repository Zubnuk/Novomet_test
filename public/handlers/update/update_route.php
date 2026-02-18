<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$routeId = $_POST['route_id'] ?? null;
$routeNumber = trim($_POST['route_number'] ?? '');

if (!$routeId || $routeNumber === '') {
    exit('Все поля обязательны');
}

$sql = "UPDATE route 
        SET route_number = :route_number 
        WHERE route_id = :route_id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':route_id' => $routeId,
        ':route_number' => $routeNumber
    ]);

    echo 'Обновлено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
