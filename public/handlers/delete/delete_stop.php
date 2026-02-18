<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$stopId = $_POST['stop_id'] ?? null;

if (!$stopId) {
    exit('ID обязателен');
}

$sql = "DELETE FROM stop WHERE stop_id = :stop_id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':stop_id' => $stopId
    ]);

    echo 'Удалено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
