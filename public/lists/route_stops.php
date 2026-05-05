<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$sql = "SELECT rs.*, r.route_number, s.name AS stop_name
        FROM route_stop rs
        JOIN route r ON rs.route_id = r.route_id
        JOIN stop s ON rs.stop_id = s.stop_id
        ORDER BY r.route_number ASC, rs.stop_order ASC";

$route_stops = $pdo->query($sql)->fetchAll();

$renderer = new Render();
echo $renderer->renderPage('lists/route_stops', [
    'page_title' => 'Схемы маршрутов',
    'route_stops' => $route_stops
]);