<?php
require_once __DIR__ . '/../../app/config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit('ID не указан');

$stmt = $pdo->prepare("SELECT * FROM stop WHERE stop_id = :id");
$stmt->execute([':id' => $id]);
$stop = $stmt->fetch();

if (!$stop) exit('Остановка не найдена');

$pageTitle = 'Редактировать остановку';
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Редактировать остановку</h2>

<form action="/handlers/update/update_stop.php" method="post">
    <input type="hidden" name="stop_id" value="<?= $stop['stop_id'] ?>">

    <input type="text" name="name"
           value="<?= htmlspecialchars($stop['name']) ?>"
           required>

    <input type="number" step="0.000001"
           name="latitude"
           value="<?= $stop['latitude'] ?>"
           required>

    <input type="number" step="0.000001"
           name="longitude"
           value="<?= $stop['longitude'] ?>"
           required>

    <button type="submit">Сохранить</button>
</form>


