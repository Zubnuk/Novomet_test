<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$typeId = $_POST['type_id'] ?? null;

if (!$typeId) {
    exit('ID обязателен');
}

$sql = "DELETE FROM transport_type WHERE type_id = :type_id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':type_id' => (int)$typeId
    ]);

    echo 'Удалено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
