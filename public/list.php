<?php
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/Render.php';

$renderer = new Render();

// 1. Получаем все справочники
$types = $pdo->query("SELECT type_id, name FROM transport_type ORDER BY name")->fetchAll();
$drivers = $pdo->query("SELECT driver_id, full_name FROM driver ORDER BY full_name")->fetchAll();
$routes = $pdo->query("SELECT route_id, route_number FROM route ORDER BY route_number")->fetchAll();
$stops = $pdo->query("SELECT stop_id, name, latitude, longitude FROM stop ORDER BY name")->fetchAll();

// 2. Получаем основной список транспорта с JOIN
$transports = $pdo->query("
    SELECT t.transport_id, t.plate_number, t.model, t.year, t.condition,
           tt.name AS type_name, r.route_number, d.full_name
    FROM transport t
    JOIN transport_type tt ON t.type_id = tt.type_id
    JOIN route r ON t.route_id = r.route_id
    JOIN driver d ON t.driver_id = d.driver_id
    ORDER BY t.transport_id DESC
")->fetchAll();

// 3. Получаем связи маршрутов и остановок
$routeStops = $pdo->query("
    SELECT rs.route_id, rs.stop_id, rs.stop_order,
           r.route_number, s.name AS stop_name
    FROM route_stop rs
    JOIN route r ON rs.route_id = r.route_id
    JOIN stop s ON rs.stop_id = s.stop_id
    ORDER BY r.route_number, rs.stop_order
")->fetchAll();

// 4. Передаем всё в шаблон
$data = [
    'page_title'  => 'Просмотр данных системы',
    'types'       => $types,
    'drivers'     => $drivers,
    'routes'      => $routes,
    'stops'       => $stops,
    'transports'  => $transports,
    'route_stops' => $routeStops
];

echo $renderer->renderPage('list', $data);