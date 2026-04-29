<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$routeId = $_GET['route_id'] ?? null;
$stopId  = $_GET['stop_id'] ?? null;

if (!$routeId || !$stopId) exit('Некорректные данные');

$stmt = $pdo->prepare("
    SELECT * FROM route_stop 
    WHERE route_id = :route_id 
    AND stop_id = :stop_id
");
$stmt->execute([
    ':route_id' => $routeId,
    ':stop_id'  => $stopId
]);

$rs = $stmt->fetch();
if (!$rs) exit('Связь не найдена');

$renderer = new Render();

$data = [
    'page_title' => 'Изменить порядок остановки',
    'route_id'   => $routeId,
    'stop_id'    => $stopId,
    'stop_order' => $rs['stop_order']
];

echo $renderer->renderPage('edit/route_stop', $data);