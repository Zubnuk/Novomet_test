<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$routes = $pdo->query("SELECT * FROM route ORDER BY route_number ASC")->fetchAll();

$renderer = new Render();
echo $renderer->renderPage('lists/routes', [
    'page_title' => 'Маршрутная сеть',
    'routes'     => $routes
]);