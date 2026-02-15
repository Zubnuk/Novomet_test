<?php
require_once __DIR__ . '/../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$route_number = trim($_POST['route_number'] ?? '');

if ($route_number === '') {
    exit('Название обязательно');
}

$sql = "INSERT INTO route (route_number) VALUES (:route_number)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':route_number' => $route_number
    ]);

    echo 'Сохранено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
