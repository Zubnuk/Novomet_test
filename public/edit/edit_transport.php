<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/models/TransportCondition.php';
require_once __DIR__ . '/../../app/Render.php';

use App\Models\TransportCondition;

$id = $_GET['id'] ?? null;
if (!$id) exit('ID не указан');

$stmt = $pdo->prepare("SELECT * FROM transport WHERE transport_id = :id");
$stmt->execute([':id' => $id]);
$transport = $stmt->fetch();

if (!$transport) exit('Транспорт не найден');

// Функция-помощник для разметки выбранных пунктов
function markSelected($items, $key, $selectedValue) {
    return array_map(function($item) use ($key, $selectedValue) {
        $item['is_selected'] = ($item[$key] == $selectedValue);
        return $item;
    }, $items);
}

$types = markSelected($pdo->query("SELECT * FROM transport_type")->fetchAll(), 'type_id', $transport['type_id']);
$drivers = markSelected($pdo->query("SELECT * FROM driver")->fetchAll(), 'driver_id', $transport['driver_id']);
$routes = markSelected($pdo->query("SELECT * FROM route")->fetchAll(), 'route_id', $transport['route_id']);

$conditions = [];
foreach (TransportCondition::LIST as $value => $label) {
    $conditions[] = [
        'value' => $value,
        'label' => $label,
        'is_selected' => ($transport['condition'] === $value)
    ];
}

$renderer = new Render();

$data = [
    'page_title'   => 'Редактировать транспорт',
    'transport'    => $transport,
    'types'        => $types,
    'drivers'      => $drivers,
    'routes'       => $routes,
    'conditions'   => $conditions
];

echo $renderer->renderPage('edit/transport', $data);