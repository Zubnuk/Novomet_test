<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$typeId = $_POST['type_id'] ?? null;
$name = trim($_POST['name'] ?? '');

if (!$typeId || $name === '') {
    exit('Все поля обязательны');
}

$sql = "UPDATE transport_type SET name = :name WHERE type_id = :type_id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':type_id' => (int)$typeId,
        ':name' => $name
    ]);

    echo 'Обновлено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
