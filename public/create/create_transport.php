<?php

require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/models/TransportCondition.php';
require_once __DIR__ . '/../../app/Render.php';

use App\Models\TransportCondition;


$types = $pdo->query("SELECT * FROM transport_type")->fetchAll();
$drivers = $pdo->query("SELECT * FROM driver")->fetchAll();
$routes = $pdo->query("SELECT * FROM route")->fetchAll();


$conditions = [];
foreach (TransportCondition::LIST as $value => $label) {
    $conditions[] = [
        'value' => $value,
        'label' => $label
    ];
}

$renderer = new Render();

$data = [
    'page_title' => 'Добавить новый транспорт',
    'types'      => $types,
    'drivers'    => $drivers,
    'routes'     => $routes,
    'conditions' => $conditions
];


echo $renderer->renderPage('create/create_transport', $data);