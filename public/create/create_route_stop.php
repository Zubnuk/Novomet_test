<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$routes = $pdo->query("SELECT * FROM route ORDER BY route_number")->fetchAll();
$stops = $pdo->query("SELECT * FROM stop ORDER BY name")->fetchAll();

$renderer = new Render();
echo $renderer->renderPage('create/create_route_stop', [
    'page_title' => 'Добавить остановку в маршрут',
    'routes'     => $routes,
    'stops'      => $stops
]);