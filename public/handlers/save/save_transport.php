<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$plateNumber = trim($_POST['plate_number'] ?? '');
$typeId      = $_POST['type_id'] ?? null;
$routeId     = $_POST['route_id'] ?? null;
$driverId    = $_POST['driver_id'] ?? null;

if ($plateNumber === '' || !$typeId || !$routeId || !$driverId) {
    exit('Обязательные поля не заполнены');
}

$sql = "
INSERT INTO transport
(plate_number, model, description, year, `condition`, type_id, route_id, driver_id)
VALUES
(:plate_number, :model, :description, :year, :condition, :type_id, :route_id, :driver_id)
";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':plate_number' => $plateNumber,
        ':model'        => $_POST['model'] ?? null,
        ':description'  => $_POST['description'] ?? null,
        ':year'         => $_POST['year'] ?? null,
        ':condition'    => $_POST['condition'] ?? null,
        ':type_id'      => (int)$typeId,
        ':route_id'     => (int)$routeId,
        ':driver_id'    => (int)$driverId,
    ]);

    echo 'Сохранено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
