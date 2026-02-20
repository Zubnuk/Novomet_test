<?php
require_once __DIR__ . '/../../app/config/db.php';
require_once __DIR__ . '/../../app/models/TransportCondition.php';

use App\Models\TransportCondition;

$id = $_GET['id'] ?? null;
if (!$id) exit('ID не указан');

$stmt = $pdo->prepare("SELECT * FROM transport WHERE transport_id = :id");
$stmt->execute([':id' => $id]);
$transport = $stmt->fetch();

if (!$transport) exit('Транспорт не найден');

$types = $pdo->query("SELECT * FROM transport_type")->fetchAll();
$drivers = $pdo->query("SELECT * FROM driver")->fetchAll();
$routes = $pdo->query("SELECT * FROM route")->fetchAll();

$pageTitle = 'Редактировать транспорт';
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Редактировать транспорт</h2>

<form action="/handlers/update/update_transport.php" method="post">
    <input type="hidden" name="transport_id" value="<?= $transport['transport_id'] ?>">

    <select name="type_id" required>
        <?php foreach ($types as $type): ?>
            <option value="<?= $type['type_id'] ?>"
                <?= $type['type_id'] == $transport['type_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($type['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="text" name="plate_number"
           value="<?= htmlspecialchars($transport['plate_number']) ?>"
           required>

    <input type="text" name="model"
           value="<?= htmlspecialchars($transport['model']) ?>">

    <input type="number" name="year"
           value="<?= $transport['year'] ?>">

    <select name="condition" required>
        <?php foreach (TransportCondition::LIST as $value => $label): ?>
            <option value="<?= htmlspecialchars($value) ?>"
                <?= $transport['condition'] === $value ? 'selected' : '' ?>>
                <?= htmlspecialchars($label) ?>
            </option>
    <?php endforeach; ?>
    </select>
        
    <select name="driver_id" required>
        <?php foreach ($drivers as $driver): ?>
            <option value="<?= $driver['driver_id'] ?>"
                <?= $driver['driver_id'] == $transport['driver_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($driver['full_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="route_id" required>
        <?php foreach ($routes as $route): ?>
            <option value="<?= $route['route_id'] ?>"
                <?= $route['route_id'] == $transport['route_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($route['route_number']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <textarea name="description"><?= htmlspecialchars($transport['description']) ?></textarea>

    <button type="submit">Сохранить</button>
</form>

