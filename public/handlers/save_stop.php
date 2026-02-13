<?php
require_once __DIR__ . '/../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$name = trim($_POST['name'] ?? '');
$latitude = $_POST['latitude'] ?? null;
$longitude = $_POST['longitude'] ?? null;

if ($name === '' || $latitude === null || $longitude === null) {
    exit('Все поля обязательны');
}

$sql = "INSERT INTO stop (name, latitude, longitude)
        VALUES (:name, :latitude, :longitude)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':latitude' => $latitude,
        ':longitude' => $longitude
    ]);

    echo 'Сохранено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
