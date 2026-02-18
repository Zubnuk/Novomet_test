<?php
require_once __DIR__ . '/../../../app/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$driverId = $_POST['driver_id'] ?? null;
$fullName = trim($_POST['full_name'] ?? '');

if (!$driverId || $fullName === '') {
    exit('Некорректные данные');
}

$sql = "
    UPDATE driver
    SET full_name = :full_name
    WHERE driver_id = :driver_id
";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':full_name' => $fullName,
        ':driver_id' => $driverId
    ]);

    echo 'Обновлено';
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
