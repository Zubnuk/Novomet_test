<?php
require_once __DIR__ . '/../../app/config/db.php';

$routeId = $_GET['route_id'] ?? null;
$stopId  = $_GET['stop_id'] ?? null;

if (!$routeId || !$stopId) exit('Некорректные данные');

$stmt = $pdo->prepare("
    SELECT * FROM route_stop
    WHERE route_id = :route_id
    AND stop_id = :stop_id
");
$stmt->execute([
    ':route_id' => $routeId,
    ':stop_id'  => $stopId
]);

$rs = $stmt->fetch();
if (!$rs) exit('Связь не найдена');

$pageTitle = 'Редактировать порядок';
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Изменить порядок остановки</h2>

<form action="/handlers/update/update_route_stop.php" method="post">
    <input type="hidden" name="route_id" value="<?= $routeId ?>">
    <input type="hidden" name="stop_id" value="<?= $stopId ?>">

    <input type="number"
           name="stop_order"
           value="<?= $rs['stop_order'] ?>"
           required>

    <button type="submit">Сохранить</button>
</form>


