<?php
require_once __DIR__ . '/../app/Render.php';
$renderer = new Render();


echo $renderer->renderPage('index', [
    'page_title' => 'Транспортная система: Панель управления'
]);