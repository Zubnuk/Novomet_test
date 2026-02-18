<?php
require_once __DIR__ . '/../../app/config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit('ID не указан');

$stmt = $pdo->prepare("SELECT * FROM route WHERE route_id = :id");
$stmt->execute([':id' => $id]);
$route = $stmt->fetch();

if (!$route) exit('Маршрут не найден');

$pageTitle = 'Редактировать маршрут';
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Редактировать маршрут</h2>

<form action="/handlers/update/update_route.php" method="post">
    <input type="hidden" name="route_id" value="<?= $route['route_id'] ?>">

    <input type="text"
           name="route_number"
           value="<?= htmlspecialchars($route['route_number']) ?>"
           required>

    <button type="submit">Сохранить</button>
</form>

