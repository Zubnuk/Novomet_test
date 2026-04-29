<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$id = $_GET['id'] ?? null;
if (!$id) exit('ID не указан');

$stmt = $pdo->prepare("SELECT * FROM route WHERE route_id = :id");
$stmt->execute([':id' => $id]);
$route = $stmt->fetch();

if (!$route) exit('Маршрут не найден');

$renderer = new Render();

$data = [
    'page_title'   => 'Редактировать маршрут',
    'route_id'     => $route['route_id'],
    'route_number' => $route['route_number']
];

echo $renderer->renderPage('edit/route', $data);