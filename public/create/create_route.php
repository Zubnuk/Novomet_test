<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';
$renderer = new Render();
echo $renderer->renderPage('create/create_route', [
    'page_title' => 'Создать маршрут'
]);