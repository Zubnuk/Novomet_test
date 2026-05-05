<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$types = $pdo->query("SELECT * FROM transport_type ORDER BY name ASC")->fetchAll();

$renderer = new Render();
echo $renderer->renderPage('lists/types', [
    'page_title' => 'Типы транспорта',
    'types'      => $types
]);