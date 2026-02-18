<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$driverId = $_POST['driver_id'] ?? null;

if (!$driverId) {
    exit('ID обязателен');
}

$sql = "DELETE FROM driver WHERE driver_id = :driver_id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':driver_id' => $driverId
    ]);

    echo 'Удалено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
