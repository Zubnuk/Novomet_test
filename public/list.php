<?php
require_once __DIR__ . '/../app/config/db.php';

$pageTitle = 'Просмотр данных';
require_once __DIR__ . '/partials/header.php';


$types = $pdo->query("SELECT * FROM transport_type ORDER BY name")->fetchAll();
$drivers = $pdo->query("SELECT * FROM driver ORDER BY full_name")->fetchAll();
$routes = $pdo->query("SELECT * FROM route ORDER BY route_number")->fetchAll();
$stops = $pdo->query("SELECT * FROM stop ORDER BY name")->fetchAll();

$transports = $pdo->query("
    SELECT t.transport_id,
           t.plate_number,
           t.model,
           t.year,
           t.condition,
           tt.name AS type_name,
           r.route_number,
           d.full_name
    FROM transport t
    JOIN transport_type tt ON t.type_id = tt.type_id
    JOIN route r ON t.route_id = r.route_id
    JOIN driver d ON t.driver_id = d.driver_id
    ORDER BY t.transport_id DESC
")->fetchAll();
?>
<link rel="stylesheet" href="css/main.css">
<h2>Типы транспорта</h2>
<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Название</th>
    <th>Действия</th>
</tr>
<?php foreach ($types as $type): ?>
<tr>
    <td><?= $type['type_id'] ?></td>
    <td><?= htmlspecialchars($type['name']) ?></td>
    <td>
        <form action="/handlers/delete/delete_type.php" method="post" style="display:inline;">
            <input type="hidden" name="type_id" value="<?= $type['type_id'] ?>">
            <button type="submit">Удалить</button>
        </form>

        <a href="/edit/edit_type.php?id=<?= $type['type_id'] ?>">Редактировать</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<hr>

<h2>Водители</h2>
<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>ФИО</th>
    <th>Действия</th>
</tr>
<?php foreach ($drivers as $driver): ?>
<tr>
    <td><?= $driver['driver_id'] ?></td>
    <td><?= htmlspecialchars($driver['full_name']) ?></td>
    <td>
        <form action="/handlers/delete/delete_driver.php" method="post" style="display:inline;">
            <input type="hidden" name="driver_id" value="<?= $driver['driver_id'] ?>">
            <button type="submit">Удалить</button>
        </form>

        <a href="/edit/edit_driver.php?id=<?= $driver['driver_id'] ?>">Редактировать</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<hr>

<h2>Маршруты</h2>
<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Номер</th>
    <th>Действия</th>
</tr>
<?php foreach ($routes as $route): ?>
<tr>
    <td><?= $route['route_id'] ?></td>
    <td><?= htmlspecialchars($route['route_number']) ?></td>
    <td>
        <form action="/handlers/delete/delete_route.php" method="post" style="display:inline;">
            <input type="hidden" name="route_id" value="<?= $route['route_id'] ?>">
            <button type="submit">Удалить</button>
        </form>

        <a href="/edit/edit_route.php?id=<?= $route['route_id'] ?>">Редактировать</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<hr>

<h2>Остановки</h2>
<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Название</th>
    <th>Координаты</th>
    <th>Действия</th>
</tr>
<?php foreach ($stops as $stop): ?>
<tr>
    <td><?= $stop['stop_id'] ?></td>
    <td><?= htmlspecialchars($stop['name']) ?></td>
    <td><?= $stop['latitude'] ?> / <?= $stop['longitude'] ?></td>
    <td>
        <form action="/handlers/delete/delete_stop.php" method="post" style="display:inline;">
            <input type="hidden" name="stop_id" value="<?= $stop['stop_id'] ?>">
            <button type="submit">Удалить</button>
        </form>

        <a href="/edit/edit_stop.php?id=<?= $stop['stop_id'] ?>">Редактировать</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<hr>

<h2>Транспорт</h2>
<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Госномер</th>
    <th>Тип</th>
    <th>Модель</th>
    <th>Год</th>
    <th>Состояние</th>
    <th>Маршрут</th>
    <th>Водитель</th>
    <th>Действия</th>
</tr>
<?php foreach ($transports as $transport): ?>
<tr>
    <td><?= $transport['transport_id'] ?></td>
    <td><?= htmlspecialchars($transport['plate_number']) ?></td>
    <td><?= htmlspecialchars($transport['type_name']) ?></td>
    <td><?= htmlspecialchars($transport['model']) ?></td>
    <td><?= $transport['year'] ?></td>
    <td><?= htmlspecialchars($transport['condition']) ?></td>
    <td><?= htmlspecialchars($transport['route_number']) ?></td>
    <td><?= htmlspecialchars($transport['full_name']) ?></td>
    <td>
        <form action="/handlers/delete/delete_transport.php" method="post" style="display:inline;">
            <input type="hidden" name="transport_id" value="<?= $transport['transport_id'] ?>">
            <button type="submit">Удалить</button>
        </form>

        <a href="/edit/edit_transport.php?id=<?= $transport['transport_id'] ?>">Редактировать</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<h2>Остановки в маршрутах</h2>
<table border="1" cellpadding="5">
<tr>
    <th>Маршрут</th>
    <th>Остановка</th>
    <th>Порядок</th>
    <th>Действия</th>
</tr>

<?php
$routeStops = $pdo->query("
    SELECT rs.route_id,
           rs.stop_id,
           rs.stop_order,
           r.route_number,
           s.name AS stop_name
    FROM route_stop rs
    JOIN route r ON rs.route_id = r.route_id
    JOIN stop s ON rs.stop_id = s.stop_id
    ORDER BY r.route_number, rs.stop_order
")->fetchAll();

foreach ($routeStops as $rs):
?>
<tr>
    <td><?= htmlspecialchars($rs['route_number']) ?></td>
    <td><?= htmlspecialchars($rs['stop_name']) ?></td>
    <td><?= $rs['stop_order'] ?></td>
    <td>
        <form action="/handlers/delete/delete_route_stop.php" method="post" style="display:inline;">
            <input type="hidden" name="route_id" value="<?= $rs['route_id'] ?>">
            <input type="hidden" name="stop_id" value="<?= $rs['stop_id'] ?>">
            <button type="submit">Удалить</button>
        </form>

        <a href="/edit/edit_route_stop.php?route_id=<?= $rs['route_id'] ?>&stop_id=<?= $rs['stop_id'] ?>">
            Редактировать
        </a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<hr>