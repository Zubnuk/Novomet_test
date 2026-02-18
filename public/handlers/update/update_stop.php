<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$stopId = $_POST['stop_id'] ?? null;
$name = trim($_POST['name'] ?? '');
$latitude = $_POST['latitude'] ?? null;
$longitude = $_POST['longitude'] ?? null;

if (!$stopId || $name === '' || $latitude === null || $longitude === null) {
    exit('Все поля обязательны');
}

$sql = "UPDATE stop
        SET name = :name,
            latitude = :latitude,
            longitude = :longitude
        WHERE stop_id = :stop_id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':stop_id' => $stopId,
        ':name' => $name,
        ':latitude' => $latitude,
        ':longitude' => $longitude
    ]);

    echo 'Обновлено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
