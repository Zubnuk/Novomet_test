<?php
require_once __DIR__ . '/../../app/config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit('ID не указан');

$stmt = $pdo->prepare("SELECT * FROM driver WHERE driver_id = :id");
$stmt->execute([':id' => $id]);
$driver = $stmt->fetch();

if (!$driver) exit('Водитель не найден');

$pageTitle = 'Редактировать водителя';
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Редактировать водителя</h2>

<form action="/handlers/update/update_driver.php" method="post">
    <input type="hidden" name="driver_id" value="<?= $driver['driver_id'] ?>">

    <input type="text"
           name="full_name"
           value="<?= htmlspecialchars($driver['full_name']) ?>"
           required>

    <button type="submit">Сохранить</button>
</form>

