<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$id = $_POST['transport_id'] ?? null;

if (!$id) {
    exit('ID обязателен');
}

$sql = "DELETE FROM transport WHERE transport_id = :id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => (int)$id
    ]);

    header("Location: /index.php?success=updated");
    exit;
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
