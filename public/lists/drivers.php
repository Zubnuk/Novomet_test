<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$drivers = $pdo->query("SELECT * FROM driver ORDER BY full_name ASC")->fetchAll();

$renderer = new Render();
echo $renderer->renderPage('lists/drivers', [
    'page_title' => 'Список водителей',
    'drivers'    => $drivers
]);