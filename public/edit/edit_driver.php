<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$id = $_GET['id'] ?? null;
if (!$id) exit('ID не указан');

$stmt = $pdo->prepare("SELECT * FROM driver WHERE driver_id = :id");
$stmt->execute([':id' => $id]);
$driver = $stmt->fetch();

if (!$driver) exit('Водитель не найден');

$renderer = new Render();

$data = [
    'page_title' => 'Редактировать водителя',
    'driver_id'  => $driver['driver_id'],
    'full_name'  => $driver['full_name']
];

echo $renderer->renderPage('edit/driver', $data);