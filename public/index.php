<?php
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/models/TransportCondition.php';
require_once __DIR__ . '/../app/Render.php';
use App\Models\TransportCondition;
$renderer = new Render();

// Получаем данные из БД
$types = $pdo->query("SELECT type_id, name FROM transport_type ORDER BY name")->fetchAll();
$drivers = $pdo->query("SELECT driver_id, full_name FROM driver ORDER BY full_name")->fetchAll();
$routes = $pdo->query("SELECT route_id, route_number FROM route ORDER BY route_number")->fetchAll();
$stops = $pdo->query("SELECT stop_id, name FROM stop ORDER BY name")->fetchAll();

// Подготавливаем состояния транспорта для выпадающего списка
$conditions = [];
foreach (TransportCondition::LIST as $value => $label) {
    $conditions[] = ['value' => $value, 'label' => $label];
}

// Собираем всё в один массив для шаблона
$data = [
    'page_title' => 'Управление справочниками',
    'types'      => $types,
    'drivers'    => $drivers,
    'routes'     => $routes,
    'stops'      => $stops,
    'conditions' => $conditions
];

// Выводим страницу
echo $renderer->renderPage('index', $data);