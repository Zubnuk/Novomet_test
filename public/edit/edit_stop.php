<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$id = $_GET['id'] ?? null;
if (!$id) exit('ID не указан');

$stmt = $pdo->prepare("SELECT * FROM stop WHERE stop_id = :id");
$stmt->execute([':id' => $id]);
$stop = $stmt->fetch();

if (!$stop) exit('Остановка не найдена');

$renderer = new Render();

$data = [
    'page_title' => 'Редактировать остановку',
    'stop_id'    => $stop['stop_id'],
    'name'       => $stop['name'],
    'latitude'   => $stop['latitude'],
    'longitude'  => $stop['longitude']
];

echo $renderer->renderPage('edit/stop', $data);
