<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/Render.php';
require_once __DIR__ . '/../../app/models/TransportCondition.php';

use App\Models\TransportCondition;

$sql = "SELECT t.*, tt.name AS type_name, r.route_number, d.full_name
        FROM transport t
        JOIN transport_type tt ON t.type_id = tt.type_id
        JOIN route r ON t.route_id = r.route_id
        JOIN driver d ON t.driver_id = d.driver_id
        ORDER BY t.transport_id DESC";

$transports = $pdo->query($sql)->fetchAll();


foreach ($transports as &$item) {
    $item['condition_text'] = TransportCondition::LIST[$item['condition']] ?? $item['condition'];
}

$renderer = new Render();
echo $renderer->renderPage('lists/transports', [
    'page_title' => 'Реестр транспорта',
    'transports' => $transports
]);