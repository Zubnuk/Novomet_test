<?php

require_once __DIR__ . '/../app/models/TransportCondition.php';
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/partials/header.php';

use App\Models\TransportCondition;

$types = $pdo->query("
    SELECT type_id, name 
    FROM transport_type 
    ORDER BY name
")->fetchAll();

$drivers = $pdo->query("
    SELECT driver_id, full_name 
    FROM driver 
    ORDER BY full_name
")->fetchAll();

$routes = $pdo->query("
    SELECT route_id, route_number 
    FROM route 
    ORDER BY route_number
")->fetchAll();

$stops = $pdo->query("
    SELECT stop_id, name 
    FROM stop 
    ORDER BY name
")->fetchAll();
?>



<h1>Справочники транспортной системы</h1>

<hr>

<h2>Добавить тип транспорта</h2>
<form action="/handlers/save/save_type.php" method="post">
    <input type="text" name="name" required minlength="3">
    <button type="submit">Сохранить</button>
</form>

<hr>

<h2>Добавить водителя</h2>
<form action="/handlers/save/save_driver.php" method="post">
    <input type="text" name="full_name" required minlength="5">
    <button type="submit">Сохранить</button>
</form>

<hr>

<h2>Добавить остановку</h2>
<form action="/handlers/save/save_stop.php" method="post">
    <input type="text" name="name" placeholder="Название" required>

    <input type="number" name="latitude" step="0.000001" placeholder="Широта" required>
    <input type="number" name="longitude" step="0.000001" placeholder="Долгота" required>

    <button type="submit">Сохранить</button>
</form>

<hr>

<h2>Добавить маршрут</h2>
<form action="/handlers/save/save_route.php" method="post">
    <input type="text" name="route_number" required>
    <button type="submit">Сохранить</button>
</form>

<hr>

<h2>Добавить остановку в маршрут</h2>
<form action="/handlers/save/save_route_stop.php" method="post">

    <label>Маршрут:</label>
    <select name="route_id" required>
        <option value="">-- выберите --</option>
        <?php foreach ($routes as $route): ?>
            <option value="<?= htmlspecialchars($route['route_id']) ?>">
                <?= htmlspecialchars($route['route_number']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Остановка:</label>
    <select name="stop_id" required>
        <option value="">-- выберите --</option>
        <?php foreach ($stops as $stop): ?>
            <option value="<?= htmlspecialchars($stop['stop_id']) ?>">
                <?= htmlspecialchars($stop['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="number" name="stop_order" min="1" placeholder="Порядок" required>

    <button type="submit">Сохранить</button>
</form>

<hr>

<h2>Добавить транспорт</h2>
<form action="/handlers/save/save_transport.php" method="post">

    <label>Тип транспорта:</label>
    <select name="type_id" required>
        <option value="">-- выберите --</option>
        <?php foreach ($types as $type): ?>
            <option value="<?= htmlspecialchars($type['type_id']) ?>">
                <?= htmlspecialchars($type['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Госномер:</label>
    <input type="text" name="plate_number" required pattern="[A-Za-zА-Яа-я0-9\- ]+">

    <label>Модель:</label>
    <input type="text" name="model">

    <label>Год выпуска:</label>
    <input type="number" name="year" min="1950" max="2100">

    <label>Состояние:</label>
    <select name="condition" required>
    <?php foreach (TransportCondition::LIST as $value => $label): ?>
        <option value="<?= htmlspecialchars($value) ?>">
            <?= htmlspecialchars($label) ?>
        </option>
    <?php endforeach; ?>
    </select>


    <label>Описание:</label>
    <textarea name="description"></textarea>

    <label>Водитель:</label>
    <select name="driver_id" required>
        <option value="">-- выберите --</option>
        <?php foreach ($drivers as $driver): ?>
            <option value="<?= htmlspecialchars($driver['driver_id']) ?>">
                <?= htmlspecialchars($driver['full_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Маршрут:</label>
    <select name="route_id" required>
        <option value="">-- выберите --</option>
        <?php foreach ($routes as $route): ?>
            <option value="<?= htmlspecialchars($route['route_id']) ?>">
                <?= htmlspecialchars($route['route_number']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Сохранить</button>
</form>

</body>
</html>
