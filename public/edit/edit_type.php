<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    exit('ID не указан');
}

$stmt = $pdo->prepare("SELECT * FROM transport_type WHERE type_id = :id");
$stmt->execute([':id' => $id]);
$type = $stmt->fetch();

if (!$type) {
    exit('Тип не найден');
}

$renderer = new Render();

$data = [
    'page_title' => 'Редактировать тип транспорта',
    'type_id'    => $type['type_id'],
    'name'       => $type['name']
];

echo $renderer->renderPage('edit/type', $data);