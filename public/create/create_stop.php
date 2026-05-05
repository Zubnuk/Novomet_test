<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$renderer = new Render();
echo $renderer->renderPage('create/create_stop', [
    'page_title' => 'Новая остановка'
]);