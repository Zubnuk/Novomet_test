<?php
require_once __DIR__ . '/../../app/config/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    exit('ID не указан');
}

$stmt = $pdo->prepare("SELECT * FROM transport_type WHERE type_id = :id");
$stmt->execute([':id' => $id]);
$type = $stmt->fetch();

if (!$type) {
    exit('Тип не найден');
}

$pageTitle = 'Редактировать тип';
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Редактировать тип транспорта</h2>

<form action="/handlers/update/update_type.php" method="post">
    <input type="hidden" name="type_id" value="<?= $type['type_id'] ?>">

    <input type="text"
           name="name"
           value="<?= htmlspecialchars($type['name']) ?>"
           required>

    <button type="submit">Сохранить</button>
</form>

