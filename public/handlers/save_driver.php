<?php
require_once __DIR__ . '/../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$full_name = trim($_POST['full_name'] ?? '');

if ($full_name === '') {
    exit('Название обязательно');
}

$sql = "INSERT INTO driver (full_name) VALUES (:full_name)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':full_name' => $full_name
    ]);

    echo 'Сохранено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
