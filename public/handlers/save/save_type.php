<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$name = trim($_POST['name'] ?? '');

if ($name === '') {
    exit('Название обязательно');
}

$sql = "INSERT INTO transport_type (name) VALUES (:name)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name
    ]);

    echo 'Сохранено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
