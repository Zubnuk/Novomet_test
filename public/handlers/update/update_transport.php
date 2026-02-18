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

$sql = "
UPDATE transport SET
    plate_number = :plate_number,
    model = :model,
    description = :description,
    year = :year,
    `condition` = :condition,
    type_id = :type_id,
    route_id = :route_id,
    driver_id = :driver_id
WHERE transport_id = :id
";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':plate_number' => $_POST['plate_number'],
        ':model' => $_POST['model'] ?? null,
        ':description' => $_POST['description'] ?? null,
        ':year' => $_POST['year'] ?? null,
        ':condition' => $_POST['condition'] ?? null,
        ':type_id' => (int)$_POST['type_id'],
        ':route_id' => (int)$_POST['route_id'],
        ':driver_id' => (int)$_POST['driver_id'],
        ':id' => (int)$id
    ]);

    echo 'Обновлено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
