<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$stops = $pdo->query("SELECT * FROM stop ORDER BY name ASC")->fetchAll();

$renderer = new Render();
echo $renderer->renderPage('lists/stops', [
    'page_title' => 'Справочник остановок',
    'stops'      => $stops
]);