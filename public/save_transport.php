<?php
require_once __DIR__ . '/../app/config/db.php';

$sql = "
INSERT INTO transport
(plate_number, model, description, year, type_id, route_id, driver_id)
VALUES
(:plate_number, :model, :description, :year, :type_id, :route_id, :driver_id)
";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'plate_number' => $_POST['plate_number'],
    'model'        => $_POST['model'] ?? null,
    'description'  => $_POST['description'] ?? null,
    'year'         => $_POST['year'] ?? null,
    'type_id'      => $_POST['type_id'],
    'route_id'     => $_POST['route_id'],
    'driver_id'    => $_POST['driver_id'],
]);

echo 'OK';